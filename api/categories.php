<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../conexion.php';

try {
    $sql = "SELECT Id, Nombre, Descripcion, ImagenUrl FROM Categorias ORDER BY Nombre";
    $result = $conn->query($sql);
    $categories = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $categories[] = [
                'id' => intval($row['Id']),
                'name' => $row['Nombre'],
                'description' => $row['Descripcion'],
                'image' => $row['ImagenUrl']
            ];
        }
    }
    echo json_encode([
        'success' => true,
        'categories' => $categories
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}