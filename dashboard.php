<?php
require_once 'conexion.php';

// Obtener categorías desde la base de datos
$categories = [];
$sqlCat = "SELECT Id, Nombre, Descripcion, ImagenUrl FROM Categorias";
$resultCat = $conn->query($sqlCat);
if ($resultCat && $resultCat->num_rows > 0) {
    while ($row = $resultCat->fetch_assoc()) {
        $categories[] = [
            'id' => $row['Id'],
            'name' => $row['Nombre'],
            'description' => $row['Descripcion'],
            'image' => $row['ImagenUrl']
        ];
    }
}

// Obtener productos desde la base de datos
$products = [];
$sqlProd = "SELECT p.Id, p.Nombre, p.Descripcion, p.Precio, p.ImagenUrl, p.ID_categorias, c.Nombre AS CategoriaNombre FROM Productos p LEFT JOIN Categorias c ON p.ID_categorias = c.Id";
$resultProd = $conn->query($sqlProd);
if ($resultProd && $resultProd->num_rows > 0) {
    while ($row = $resultProd->fetch_assoc()) {
        $products[] = [
            'id' => $row['Id'],
            'name' => $row['Nombre'],
            'description' => $row['Descripcion'],
            'price' => $row['Precio'],
            'category' => $row['CategoriaNombre'],
            'stock' => 0, // Puedes agregar campo stock si lo tienes en la tabla
            'status' => 'Activo', // Puedes ajustar el estado si tienes campo en la tabla
            'image' => $row['ImagenUrl']
        ];
    }
}

// Calcular estadísticas
$totalProducts = count($products);
$totalCategories = count($categories);
$activeProducts = $totalProducts; // Ajusta si tienes campo de estado
$totalStock = 0; // Ajusta si tienes campo de stock
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador de Catálogos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-content">
                <div>
                    <h1>Administrador de Catálogos</h1>
                    <p>Gestiona tus productos y categorías</p>
                </div>
                <div class="header-buttons">
                    <button class="btn btn-outline" onclick="openModal('categoryModal')">
                        <i class="fas fa-plus"></i> Añadir Categoría
                    </button>
                    <button class="btn btn-primary" onclick="openModal('productModal')">
                        <i class="fas fa-plus"></i> Añadir Producto
                    </button>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Total Productos</span>
                </div>
                <div class="stat-value"><?php echo $totalProducts; ?></div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Categorías</span>
                </div>
                <div class="stat-value"><?php echo $totalCategories; ?></div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card">
            <div class="card-header">
                <h3>Filtros y Búsqueda</h3>
            </div>
            <div class="card-content">
                <div class="filters">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Buscar productos por nombre..." class="search-input">
                    </div>
                    <select id="categoryFilter" class="filter-select">
                        <option value="all">Todas las categorías</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['name']); ?>">
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="card">
            <div class="card-header">
                <h3>Lista de Productos (<span id="productCount"><?php echo $totalProducts; ?></span>)</h3>
            </div>
            <div class="card-content">
                <div class="table-container">
                    <table class="products-table">
                        <thead>
                            <tr>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableBody">
                            <?php foreach ($products as $product): ?>
                                <tr class="product-row" data-name="<?php echo strtolower($product['name']); ?>" data-category="<?php echo $product['category']; ?>">
                                    <td>
                                        <img src="<?php echo $product['image']; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                                    </td>
                                    <td class="product-name"><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td>
                                        <span class="badge badge-secondary"><?php echo htmlspecialchars($product['category']); ?></span>
                                    </td>
                                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm dropdown-toggle" onclick="toggleDropdown(this)">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <a href="#" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="noResults" class="no-results" style="display: none;">
                        No se encontraron productos que coincidan con los filtros.
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Management -->
        <div class="card">
            <div class="card-header">
                <h3>Gestión de Categorías (<?php echo count($categories); ?>)</h3>
            </div>
            <div class="card-content">
                <div class="categories-grid" id="categoriesGrid">
                    <?php foreach ($categories as $category): ?>
                        <div class="category-card" data-category-id="<?php echo $category['id']; ?>">
                            <div class="category-image">
                                <img src="<?php echo $category['image'] ?? 'https://via.placeholder.com/150x100?text=Sin+Imagen'; ?>" 
                                alt="<?php echo htmlspecialchars($category['name']); ?>" 
                                onerror="this.src='https://via.placeholder.com/150x100?text=Sin+Imagen'">
                            </div>
                            <div class="category-info">
                                <h4><?php echo htmlspecialchars($category['name']); ?></h4>
                                <p><?php echo htmlspecialchars($category['description']); ?></p>
                            </div>
                            <div class="category-actions">
                                <button class="btn btn-sm btn-outline" onclick="editCategory(<?php echo $category['id']; ?>)">
                                    <i class="fas fa-edit"></i> Editar
                                </button>
                                <button class="btn btn-sm btn-danger" onclick="deleteCategory(<?php echo $category['id']; ?>)">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Añadir Categoría -->
    <div id="categoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Añadir Nueva Categoría</h2>
                <span class="close" onclick="closeModal('categoryModal')">&times;</span>
            </div>
            <div id="categoryFormContainer"></div>
        </div>
    </div>

    <!-- Modal para Añadir Producto -->
    <div id="productModal" class="modal">
        <div class="modal-content modal-large">
            <div class="modal-header">
                <h2>Añadir Nuevo Producto</h2>
                <span class="close" onclick="closeModal('productModal')">&times;</span>
            </div>
            <div id="productFormContainer"></div>
        </div>
    </div>

    <!-- Modal para Editar Categoría -->
    <div id="editCategoryModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Editar Categoría</h2>
                <span class="close" onclick="closeModal('editCategoryModal')">&times;</span>
            </div>
            <div id="editCategoryFormContainer"></div>
        </div>
    </div>

    <script>
        // Pasar datos PHP a JavaScript
        window.categories = <?php echo json_encode($categories); ?>;
        window.products = <?php echo json_encode($products); ?>;

        // Función para abrir modales
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'block';
            
            if (modalId === 'categoryModal') {
                loadCategoryForm();
            } else if (modalId === 'productModal') {
                loadProductForm();
            }
        }

        // Función para cerrar modales
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = 'none';
        }

        // Función para manejar el envío del formulario de categoría
        function handleCategorySubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('agregar-categoria.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeModal('categoryModal');
                    window.location.reload(); // Recargar la página
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
        }

        // Función para manejar el envío del formulario de producto
        function handleProductSubmit(event) {
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);

            fetch('agregar-producto.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    closeModal('productModal');
                    window.location.reload(); // Recargar la página
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al procesar la solicitud');
            });
        }

        // Agregar event listeners cuando se cargan los formularios
        function loadCategoryForm() {
            const container = document.getElementById("categoryFormContainer");
            fetch("agregar-categoria.php")
                .then((response) => response.text())
                .then((html) => {
                    container.innerHTML = html;
                    // Agregar event listener al formulario
                    const form = container.querySelector('#categoryForm');
                    if (form) {
                        form.addEventListener('submit', handleCategorySubmit);
                    }
                })
                .catch((error) => {
                    console.error("Error al cargar el formulario de categoría:", error);
                    container.innerHTML = "<p>Error al cargar el formulario</p>";
                });
        }

        function loadProductForm() {
            const container = document.getElementById("productFormContainer");
            fetch("agregar-producto.php")
                .then((response) => response.text())
                .then((html) => {
                    container.innerHTML = html;
                    // Agregar event listener al formulario
                    const form = container.querySelector('#productForm');
                    if (form) {
                        form.addEventListener('submit', handleProductSubmit);
                    }
                })
                .catch((error) => {
                    console.error("Error al cargar el formulario de producto:", error);
                    container.innerHTML = "<p>Error al cargar el formulario</p>";
                });
        }

        // Cerrar modal cuando se hace clic fuera de él
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>
