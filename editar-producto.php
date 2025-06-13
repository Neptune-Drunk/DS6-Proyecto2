<?php
require_once 'conexion.php';

// Si es una petición POST, procesar la edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $id = trim($_POST['id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $category_id = trim($_POST['category_id'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($id !== '' && $name !== '' && $price !== '' && $category_id !== '') {
        $stmt = $conn->prepare("UPDATE Productos SET Nombre=?, Descripcion=?, Precio=?, ID_categorias=?, ImagenUrl=? WHERE Id=?");
        $stmt->bind_param('ssdssi', $name, $description, $price, $category_id, $image, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto actualizado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el producto: ' . $conn->error]);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados']);
        exit;
    }
}

// Si es GET, obtener datos del producto y categorías
$id = $_GET['id'] ?? '';
$product = null;
if ($id !== '') {
    $stmt = $conn->prepare("SELECT * FROM Productos WHERE Id=?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        $product = $row;
    }
}

$categories = [];
$sqlCat = "SELECT Id, Nombre FROM Categorias";
$resultCat = $conn->query($sqlCat);
if ($resultCat && $resultCat->num_rows > 0) {
    while ($row = $resultCat->fetch_assoc()) {
        $categories[] = [
            'id' => $row['Id'],
            'name' => $row['Nombre']
        ];
    }
}
?>
<div class="form-container">
    <form id="editProductForm" class="product-form" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product['Id'] ?? ''); ?>">
        <div class="form-group">
            <label for="editProductName">Nombre del Producto *</label>
            <input type="text" id="editProductName" name="name" value="<?php echo htmlspecialchars($product['Nombre'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="editProductDescription">Descripción</label>
            <textarea id="editProductDescription" name="description"><?php echo htmlspecialchars($product['Descripcion'] ?? ''); ?></textarea>
        </div>
        <div class="form-group">
            <label for="editProductPrice">Precio *</label>
            <input type="number" id="editProductPrice" name="price" step="0.01" value="<?php echo htmlspecialchars($product['Precio'] ?? ''); ?>" required>
        </div>
        <div class="form-group">
            <label for="editProductCategory">Categoría *</label>
            <select id="editProductCategory" name="category_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>" <?php if (($product['ID_categorias'] ?? '') == $cat['id']) echo 'selected'; ?>><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="editProductImage">URL de Imagen</label>
            <input type="url" id="editProductImage" name="image" value="<?php echo htmlspecialchars($product['ImagenUrl'] ?? ''); ?>">
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="closeModal('editProductModal')">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>
<script src="script.js"></script>
