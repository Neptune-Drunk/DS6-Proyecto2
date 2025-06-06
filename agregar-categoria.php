<?php
require_once 'conexion.php';

// Si es una petición POST, procesar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $image = trim($_POST['image'] ?? '');
    
    if ($name !== '') {
        $stmt = $conn->prepare("INSERT INTO Categorias (Nombre, Descripcion, ImagenUrl) VALUES (?, ?, ?)");
        $stmt->bind_param('sss', $name, $description, $image);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Categoría añadida correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al añadir la categoría: ' . $conn->error]);
        }
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'El nombre es obligatorio']);
        exit;
    }
}

// Si no es POST, mostrar el formulario
?>
<div class="form-container">
    <form id="categoryForm" class="category-form" method="post">
        <div class="form-group">
            <label for="categoryName">Nombre de la Categoría *</label>
            <input type="text" id="categoryName" name="name" placeholder="Ej: Electrónicos, Ropa, Hogar..." required>
        </div>
        <div class="form-group">
            <label for="categoryDescription">Descripción</label>
            <textarea id="categoryDescription" name="description" placeholder="Describe brevemente esta categoría..." rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="categoryImageUrl">URL de Imagen</label>
            <input type="url" id="categoryImageUrl" name="image" placeholder="https://ejemplo.com/imagen.jpg">
            <small class="form-help">Ingresa la URL de una imagen para representar esta categoría</small>
        </div>
        <div class="form-actions">
            <button type="button" class="btn btn-outline" onclick="closeModal('categoryModal')">Cancelar</button>
            <button type="submit" class="btn btn-primary">Añadir Categoría</button>
        </div>
    </form>

    <!-- Vista Previa -->
    <div id="categoryPreview" class="preview-container" style="display: none;">
        <h4>Vista Previa:</h4>
        <div class="category-preview-card">
            <div class="preview-image">
                <img id="previewCategoryImage" src="https://via.placeholder.com/150x100?text=Sin+Imagen" alt="Vista previa">
            </div>
            <div class="preview-info">
                <div class="preview-name" id="previewCategoryName"></div>
                <div class="preview-description" id="previewCategoryDescription"></div>
            </div>
        </div>
    </div>
</div>
<!-- Incluye el script externo solo una vez -->
<script src="script.js"></script>
