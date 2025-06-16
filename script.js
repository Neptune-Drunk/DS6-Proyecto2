// Variables globales
const filteredProducts = [...window.products]

// Inicialización
document.addEventListener("DOMContentLoaded", () => {
  initializeFilters()
  initializeDropdowns()
  initializeFormHandlers()
  initializeModalHandlers()
})

// Filtros y búsqueda
function initializeFilters() {
  const searchInput = document.getElementById("searchInput")
  const categoryFilter = document.getElementById("categoryFilter")

  searchInput.addEventListener("input", filterProducts)
  categoryFilter.addEventListener("change", filterProducts)
}

function filterProducts() {
  const searchTerm = document.getElementById("searchInput").value.toLowerCase()
  const selectedCategory = document.getElementById("categoryFilter").value
  const productRows = document.querySelectorAll(".product-row")
  const noResults = document.getElementById("noResults")
  let visibleCount = 0

  productRows.forEach((row) => {
    const productName = row.getAttribute("data-name")
    const productCategory = row.getAttribute("data-category")

    const matchesSearch = productName.includes(searchTerm)
    const matchesCategory = selectedCategory === "all" || productCategory === selectedCategory

    row.style.display = matchesSearch && matchesCategory ? "" : "none"
    if (matchesSearch && matchesCategory) visibleCount++
  })

  document.getElementById("productCount").textContent = visibleCount
  noResults.style.display = visibleCount === 0 ? "block" : "none"
}

// Dropdowns
function initializeDropdowns() {
  document.addEventListener("click", (e) => {
    if (!e.target.closest(".dropdown")) {
      document.querySelectorAll(".dropdown-menu").forEach((menu) => {
        menu.classList.remove("show")
      })
    }
  })
}

function toggleDropdown(button) {
  const dropdown = button.nextElementSibling
  const isOpen = dropdown.classList.contains("show")

  document.querySelectorAll(".dropdown-menu").forEach((menu) => {
    menu.classList.remove("show")
  })

  if (!isOpen) {
    dropdown.classList.add("show")
  }
}

// Modales
function initializeModalHandlers() {
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      document.querySelectorAll('.modal[style*="block"]').forEach((modal) => {
        modal.style.display = "none"
      })
    }
  })

  document.querySelectorAll('.modal').forEach(modal => {
    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        closeModal(modal.id)
      }
    })
  })
}

function openModal(modalId) {
  const modal = document.getElementById(modalId)
  modal.style.display = "block"

  if (modalId === "categoryModal") {
    loadCategoryForm()
  } else if (modalId === "productModal") {
    loadProductForm()
  }
}

function closeModal(modalId) {
  const modal = document.getElementById(modalId)
  modal.style.display = "none"
}

// Formularios
function initializeFormHandlers() {
  const handleFormSubmit = (form, endpoint, successMessage) => {
    form.addEventListener('submit', function(e) {
      e.preventDefault()
      const formData = new FormData(form)
      
      fetch(endpoint, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          showNotification(successMessage, 'success')
          form.reset()
          closeModal(form.closest('.modal').id)
          window.location.reload()
        } else {
          showNotification(data.message, 'error')
        }
      })
      .catch(error => {
        showNotification('Error de red o de servidor: ' + error.message, 'error')
      })
    })
  }

  const categoryForm = document.getElementById('categoryForm')
  if (categoryForm) {
    handleFormSubmit(categoryForm, 'agregar-categoria.php', 'Categoría añadida exitosamente')
    initializeCategoryPreview()
  }

  const productForm = document.getElementById('productForm')
  if (productForm) {
    handleFormSubmit(productForm, 'agregar-producto.php', 'Producto añadido exitosamente')
  }
}

function initializeCategoryPreview() {
  const nameInput = document.getElementById('categoryName')
  const descriptionInput = document.getElementById('categoryDescription')
  const imageInput = document.getElementById('categoryImageUrl')
  const preview = document.getElementById('categoryPreview')
  const previewName = document.getElementById('previewCategoryName')
  const previewDescription = document.getElementById('previewCategoryDescription')
  const previewImage = document.getElementById('previewCategoryImage')

  const updatePreview = () => {
    const name = nameInput.value.trim()
    const description = descriptionInput.value.trim()
    const imageUrl = imageInput.value.trim()

    if (name) {
      previewName.textContent = name
      previewDescription.textContent = description || ''
      previewImage.src = imageUrl || 'https://via.placeholder.com/150x100?text=Sin+Imagen'
      previewImage.onerror = () => {
        previewImage.src = 'https://via.placeholder.com/150x100?text=Imagen+No+Válida'
      }
      preview.style.display = 'block'
    } else {
      preview.style.display = 'none'
    }
  }

  nameInput.addEventListener('input', updatePreview)
  descriptionInput.addEventListener('input', updatePreview)
  imageInput.addEventListener('input', updatePreview)
}

// Carga de formularios
function loadCategoryForm() {
  loadFormContent("categoryFormContainer", "agregar-categoria.php")
}

function loadProductForm() {
  loadFormContent("productFormContainer", "agregar-producto.php")
}

function loadFormContent(containerId, url) {
  const container = document.getElementById(containerId)
  fetch(url)
    .then(response => response.text())
    .then(html => {
      container.innerHTML = html
      initializeFormHandlers()
    })
    .catch(error => {
      console.error(`Error loading form from ${url}:`, error)
      container.innerHTML = "<p>Error al cargar el formulario</p>"
    })
}

// Utilidades
function showNotification(message, type = "success") {
  const notification = document.createElement("div")
  notification.className = `notification notification-${type}`
  notification.textContent = message

  document.body.appendChild(notification)

  setTimeout(() => notification.classList.add("show"), 100)
  setTimeout(() => {
    notification.classList.remove("show")
    setTimeout(() => notification.remove(), 300)
  }, 3000)
}

// Gestión de categorías
function editCategory(categoryId) {
  // Convertir categoryId a número
  categoryId = parseInt(categoryId);
  
  // Obtener los datos de la categoría del array window.categories
  const category = window.categories.find(cat => cat.id === categoryId);
  if (!category) {
    showNotification('Categoría no encontrada', 'error');
    return;
  }

  // Abrir el modal
  const modal = document.getElementById('editCategoryModal');
  modal.style.display = 'block';
  
  // Cargar el formulario
  const container = document.getElementById('editCategoryFormContainer');
  fetch('editar-categoria.php?id=' + categoryId)
    .then(response => response.text())
    .then(html => {
      container.innerHTML = html;
      const form = container.querySelector('#editCategoryForm');
      if (form) {
        form.addEventListener('submit', handleEditCategorySubmit);
      }
    })
    .catch(error => {
      console.error('Error al cargar el formulario de edición de categoría:', error);
      container.innerHTML = '<p>Error al cargar el formulario</p>';
    });
}

function handleEditCategorySubmit(event) {
  event.preventDefault();
  const form = event.target;
  const formData = new FormData(form);

  fetch('editar-categoria.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showNotification(data.message, 'success');
      closeModal('editCategoryModal');
      window.location.reload();
    } else {
      showNotification(data.message, 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('Error al procesar la solicitud', 'error');
  });
}

function deleteCategory(categoryId) {
  // Convertir categoryId a número para asegurar la comparación correcta
  categoryId = parseInt(categoryId);
  
  const category = window.categories.find(cat => parseInt(cat.id) === categoryId);
  if (!category) {
    showNotification("Categoría no encontrada", "error");
    return;
  }

  const productsInCategory = window.products.filter(product => product.category === category.name);
  const confirmMessage = productsInCategory.length > 0
    ? `Esta categoría tiene ${productsInCategory.length} producto(s) asociado(s). ¿Estás seguro de que quieres eliminarla? Los productos quedarán sin categoría.`
    : `¿Estás seguro de que quieres eliminar la categoría "${category.name}"?`;

  if (!confirm(confirmMessage)) {
    return;
  }

  const formData = new FormData();
  formData.append('id', categoryId);

  fetch('eliminar-categoria.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      showNotification(data.message, 'success');
      // Eliminar la tarjeta de categoría
      const categoryCard = document.querySelector(`.category-card[data-category-id="${categoryId}"]`);
      if (categoryCard) {
        categoryCard.remove();
        updateCategoryCount();
      }
      // Recargar la página para actualizar los productos y categorías
      window.location.reload();
    } else {
      showNotification(data.message, 'error');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    showNotification('Error al eliminar la categoría', 'error');
  });
}

function updateCategoriesCount() {
  const categoryCountElement = document.querySelector(".card-header h3")
  if (categoryCountElement?.textContent.includes("Categorías")) {
    categoryCountElement.textContent = `Gestión de Categorías (${window.categories.length})`
  }
}

function updateProductsTable() {
  const tbody = document.getElementById("productsTableBody")
  tbody.innerHTML = ""
  window.products.forEach(addProductToTable)
  filterProducts()
}

function addProductToTable(product) {
  const tbody = document.getElementById("productsTableBody")
  const row = document.createElement("tr")
  row.className = "product-row"
  row.setAttribute("data-name", product.name.toLowerCase())
  row.setAttribute("data-category", product.category)

  row.innerHTML = `
        <td><img src="${product.image || "https://via.placeholder.com/60x60?text=Sin+Imagen"}" alt="${product.name}" class="product-image" onerror="this.src='https://via.placeholder.com/60x60?text=Sin+Imagen'"></td>
        <td class="product-name">${product.name}</td>
        <td><span class="badge badge-secondary">${product.category || "Sin categoría"}</span></td>
        <td>$${product.price ? product.price.toFixed(2) : "0.00"}</td>
        <td>
            <div class="dropdown">
                <button class="btn btn-sm dropdown-toggle" onclick="toggleDropdown(this)">Acciones</button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item"><i class="fas fa-edit"></i> Editar</a>
                    <a href="#" class="dropdown-item text-danger"><i class="fas fa-trash"></i> Eliminar</a>
                </div>
            </div>
        </td>
    `

  tbody.appendChild(row)
}

function updateCategoryFilter() {
  const categoryFilter = document.getElementById("categoryFilter")
  categoryFilter.innerHTML = '<option value="all">Todas las categorías</option>'
  window.categories.forEach(category => {
    const option = document.createElement("option")
    option.value = category.name
    option.textContent = category.name
    categoryFilter.appendChild(option)
  })
}

// Función para eliminar un producto
function deleteProduct(productId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto?')) {
        return;
    }

    const formData = new FormData();
    formData.append('id', productId);

    fetch('eliminar-producto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            // Eliminar la fila del producto de la tabla
            const row = document.querySelector(`tr[data-product-id="${productId}"]`);
            if (row) {
                row.remove();
                updateProductCount();
            }
            // Recargar la página para actualizar los contadores
            window.location.reload();
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Error al eliminar el producto', 'error');
    });
}

// Función para actualizar el contador de productos
function updateProductCount() {
    const productCount = document.getElementById('productCount');
    if (productCount) {
        const visibleProducts = document.querySelectorAll('.product-row:not([style*="display: none"])').length;
        productCount.textContent = visibleProducts;
    }
}

// Función para actualizar el contador de categorías
function updateCategoryCount() {
    const categoryCount = document.querySelector('.card-header h3');
    if (categoryCount) {
        const totalCategories = document.querySelectorAll('.category-card').length;
        categoryCount.textContent = `Gestión de Categorías (${totalCategories})`;
    }
}
