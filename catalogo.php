<?php
// Conexión a la base de datos
require_once 'conexion.php';

// Obtener todas las categorías
$query_categorias = "SELECT * FROM Categorias ORDER BY Nombre";
$result_categorias = $conn->query($query_categorias);
$categorias = [];
if ($result_categorias->num_rows > 0) {
    while ($row = $result_categorias->fetch_assoc()) {
        $categorias[] = $row;
    }
}

// Obtener todos los productos o filtrar por categoría
$categoria_id = isset($_GET['categoria']) ? intval($_GET['categoria']) : 0;
$where_clause = $categoria_id > 0 ? "WHERE p.ID_categorias = $categoria_id" : "";

$query_productos = "SELECT p.*, c.Nombre as CategoriaNombre 
                    FROM Productos p 
                    LEFT JOIN Categorias c ON p.ID_categorias = c.Id 
                    $where_clause 
                    ORDER BY p.Nombre";
$result_productos = $conn->query($query_productos);
$productos = [];
if ($result_productos->num_rows > 0) {
    while ($row = $result_productos->fetch_assoc()) {
        $productos[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="catalogo.css">
</head>
<body>
    <div class="container">
        <div class="top-header">
            <div class="company-name">HyperDrive</div>
            <a href="login.php" class="logout-btn">Cerrar Sesión</a>
        </div>
        <header>
            <h1>Catálogo de Productos</h1>
        </header>

        <!-- Sección de categorías -->
        <section class="categorias-container">
            <h2>Categorías</h2>
            <div class="categorias-wrapper">
                <div class="categorias">
                    <div class="categoria-item">
                        <input type="radio" name="categoria" id="cat-todos" value="0" <?php echo $categoria_id == 0 ? 'checked' : ''; ?>>
                        <label for="cat-todos" class="categoria-label">
                            <div class="categoria-imagen">
                                <img src="TODOS.jpg" alt="Todos">
                            </div>
                            <span>Todos</span>
                        </label>
                    </div>

                    <?php foreach ($categorias as $categoria): ?>
                    <div class="categoria-item">
                        <input type="radio" name="categoria" id="cat-<?php echo $categoria['Id']; ?>" value="<?php echo $categoria['Id']; ?>" <?php echo $categoria_id == $categoria['Id'] ? 'checked' : ''; ?>>
                        <label for="cat-<?php echo $categoria['Id']; ?>" class="categoria-label">
                            <div class="categoria-imagen">
                                <img src="<?php echo !empty($categoria['ImagenUrl']) ? $categoria['ImagenUrl'] : 'https://via.placeholder.com/100x100?text=' . urlencode($categoria['Nombre']); ?>" 
                                    alt="<?php echo htmlspecialchars($categoria['Nombre']); ?>"
                                    onerror="this.src='NOTEXTURE.jpeg'">
                            </div>
                            <span><?php echo htmlspecialchars($categoria['Nombre']); ?></span>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Sección de productos -->
        <section class="productos-container">
            <h2>Productos <?php echo $categoria_id > 0 ? 'de ' . htmlspecialchars($categorias[array_search($categoria_id, array_column($categorias, 'Id'))]['Nombre']) : ''; ?></h2>
            
            <?php if (empty($productos)): ?>
                <div class="no-productos">
                    <p>No hay productos disponibles en esta categoría.</p>
                </div>
            <?php else: ?>
                <div class="productos-grid">
                    <?php foreach ($productos as $producto): ?>
                    <div class="producto-card">
                        <div class="producto-imagen">
                            <img src="<?php echo !empty($producto['ImagenUrl']) ? $producto['ImagenUrl'] : 'https://via.placeholder.com/300x200?text=' . urlencode($producto['Nombre']); ?>" 
                                alt="<?php echo htmlspecialchars($producto['Nombre']); ?>"
                                onerror="this.src='NOTEXTURE.jpeg'">
                        </div>
                        <div class="producto-info">
                            <h3><?php echo htmlspecialchars($producto['Nombre']); ?></h3>
                            <p class="producto-categoria"><?php echo htmlspecialchars($producto['CategoriaNombre']); ?></p>
                            <p class="producto-descripcion"><?php echo htmlspecialchars(substr($producto['Descripcion'], 0, 100)) . (strlen($producto['Descripcion']) > 100 ? '...' : ''); ?></p>
                            <div class="producto-precio">$<?php echo number_format($producto['Precio'], 2); ?></div>
                            <button class="btn-detalles" data-id="<?php echo $producto['Id']; ?>">Ver detalles</button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>
    </div>

    <!-- Modal de detalles del producto -->
    <div id="productoModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="productoDetalles"></div>
        </div>
    </div>

    <script src="catalogo.js"></script>
</body>
</html>
