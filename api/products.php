<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../conexion.php';

try {
    $categoryId = isset($_GET['category']) && is_numeric($_GET['category']) ? intval($_GET['category']) : null;
    $products = [];
    if ($categoryId) {
        $stmt = $conn->prepare("SELECT p.Id, p.Nombre, p.Descripcion, p.Precio, p.ImagenUrl, p.ID_categorias, c.Nombre AS CategoriaNombre FROM Productos p LEFT JOIN Categorias c ON p.ID_categorias = c.Id WHERE p.ID_categorias = ? ORDER BY p.Nombre");
        $stmt->bind_param('i', $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT p.Id, p.Nombre, p.Descripcion, p.Precio, p.ImagenUrl, p.ID_categorias, c.Nombre AS CategoriaNombre FROM Productos p LEFT JOIN Categorias c ON p.ID_categorias = c.Id ORDER BY p.Nombre";
        $result = $conn->query($sql);
    }
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = [
                'id' => intval($row['Id']),
                'name' => $row['Nombre'],
                'description' => $row['Descripcion'],
                'price' => floatval($row['Precio']),
                'image' => $row['ImagenUrl'],
                'category_id' => intval($row['ID_categorias']),
                'category' => $row['CategoriaNombre']
            ];
        }
    }
    echo json_encode([
        'success' => true,
        'products' => $products
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}