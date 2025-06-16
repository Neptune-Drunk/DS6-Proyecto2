<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    
    if ($id > 0) {
        // Primero verificamos si el producto existe
        $check_stmt = $conn->prepare("SELECT Id FROM Productos WHERE Id = ?");
        $check_stmt->bind_param('i', $id);
        $check_stmt->execute();
        $result = $check_stmt->get_result();
        
        if ($result->num_rows === 0) {
            echo json_encode(['success' => false, 'message' => 'El producto no existe']);
            exit;
        }
        
        // Procedemos a eliminar el producto
        $stmt = $conn->prepare("DELETE FROM Productos WHERE Id = ?");
        $stmt->bind_param('i', $id);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Producto eliminado correctamente']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al eliminar el producto: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID de producto inválido']);
    }
    exit;
}

// Si no es POST, devolver error
echo json_encode(['success' => false, 'message' => 'Método no permitido']);
exit; 