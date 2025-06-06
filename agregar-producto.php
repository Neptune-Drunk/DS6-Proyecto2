<?php
require_once 'conexion.php';

// Si es una petición POST, procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $category_id = trim($_POST['category_id'] ?? '');
    $image = trim($_POST['image'] ?? '');
    
    if ($name !== '' && $price !== '' && $category_id !== '') {
        $stmt = $conn->prepare("INSERT INTO Productos (Nombre, Descripcion, Precio, ID_categorias, ImagenUrl) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('ssdss', $name, $description, $price, $category_id, $image);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto añadido correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al añadir el producto: ' . $conn->error]);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados']);
        exit;
    }
}

// Si no es POST, obtener categorías y mostrar el formulario
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
    <form id="productForm" class="product-form" method="post">
        <div class="form-group">
            <label for="productName">Nombre del Producto *</label>
            <input type="text" id="productName" name="name" required>
        </div>
        <div class="form-group">
            <label for="productDescription">Descripción</label>
            <textarea id="productDescription" name="description"></textarea>
        </div>
        <div class="form-group">
            <label for="productPrice">Precio *</label>
            <input type="number" id="productPrice" name="price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="productCategory">Categoría *</label>
            <select id="productCategory" name="category_id" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="productImage">URL de Imagen</label>
            <input type="url" id="productImage" name="image">
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="closeModal('productModal')">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir Producto</button>
        </div>
    </form>
</div>
<!-- Incluye el script externo solo una vez -->
<script src="script.js"></script>
