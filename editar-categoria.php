<?php
require_once 'conexion.php';

// Si es una petición POST, procesar la edición
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $id = trim($_POST['id'] ?? '');
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');
    if ($id !== '' && $name !== '') {
        $stmt = $conn->prepare("UPDATE Categorias SET Nombre=?, Descripcion=?, ImagenUrl=? WHERE Id=?");
        $stmt->bind_param('sssi', $name, $description, $image, $id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Categoría actualizada correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar la categoría: ' . $conn->error]);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Todos los campos obligatorios deben ser completados']);
        exit;
    }
}

// Si es GET, obtener datos de la categoría
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$category = null;

if ($id > 0) {
    $stmt = $conn->prepare("SELECT * FROM Categorias WHERE Id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $row = $result->fetch_assoc()) {
        $category = $row;
    }
}

if (!$category) {
    echo '<div class="error-message">Categoría no encontrada</div>';
    exit;
}
?>
<div class="form-container">
    <form id="editCategoryForm" class="category-form" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['Id']); ?>">
        <div class="form-group">
            <label for="editCategoryName">Nombre de la Categoría *</label>
            <input type="text" id="editCategoryName" name="name" value="<?php echo htmlspecialchars($category['Nombre']); ?>" required>
        </div>
        <div class="form-group">
            <label for="editCategoryDescription">Descripción</label>
            <textarea id="editCategoryDescription" name="description"><?php echo htmlspecialchars($category['Descripcion']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="editCategoryImage">URL de Imagen</label>
            <input type="url" id="editCategoryImage" name="image" value="<?php echo htmlspecialchars($category['ImagenUrl']); ?>">
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="closeModal('editCategoryModal')">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>
<script src="script.js"></script>
