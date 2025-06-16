<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {
        // Primero verificamos si la categoría existe
        $check_stmt = $conn->prepare("SELECT Id FROM Categorias WHERE Id = ?");
        $check_stmt->bind_param('i', $id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'La categoría no existe']);
            exit;
        }
        
        // Verificamos si hay productos asociados a esta categoría
        $check_products = $conn->prepare("SELECT COUNT(*) as count FROM Productos WHERE ID_categorias = ?");
        $check_products->bind_param('i', $id);
        $check_products->execute();
        $products_result = $check_products->get_result();
        $products_count = $products_result->fetch_assoc()['count'];
        
        if ($products_count > 0) {
            // Si hay productos, primero actualizamos los productos para quitar la categoría
            $update_products = $conn->prepare("UPDATE Productos SET ID_categorias = NULL WHERE ID_categorias = ?");
            $update_products->bind_param('i', $id);
            $update_products->execute();
        }
        
        // Procedemos a eliminar la categoría
        $stmt = $conn->prepare("DELETE FROM Categorias WHERE Id = ?");
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            $message = $products_count > 0 
                ? "Categoría eliminada correctamente. Los productos asociados ahora están sin categoría."
                : "Categoría eliminada correctamente";
            echo json_encode(['success' => true, 'message' => $message]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar la categoría: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de categoría inválido']);
    }
    exit;
}

// Si no es POST, devolver error
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
exit; 