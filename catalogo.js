document.addEventListener("DOMContentLoaded", () => {
  // Manejar cambio de categoría
  const categoriaRadios = document.querySelectorAll('input[name="categoria"]')
  categoriaRadios.forEach((radio) => {
    radio.addEventListener("change", function () {
      window.location.href = "catalogo.php" + (this.value !== "0" ? "?categoria=" + this.value : "")
    })
  })

  // Manejar botones de detalles
  const botonesDetalles = document.querySelectorAll(".btn-detalles")
  const modal = document.getElementById("productoModal")
  const detallesContainer = document.getElementById("productoDetalles")
  const closeModal = document.querySelector(".close-modal")

  botonesDetalles.forEach((boton) => {
    boton.addEventListener("click", function () {
      const productoId = this.getAttribute("data-id")
      obtenerDetallesProducto(productoId)
    })
  })

  // Cerrar modal
  closeModal.addEventListener("click", () => {
    modal.style.display = "none"
  })

  window.addEventListener("click", (event) => {
    if (event.target === modal) {
      modal.style.display = "none"
    }
  })

  // Función para obtener detalles del producto mediante AJAX
  function obtenerDetallesProducto(id) {
    // En un entorno real, esto sería una llamada AJAX a un endpoint
    // Para este ejemplo, obtendremos los datos del DOM
    const productoCard = document.querySelector(`.btn-detalles[data-id="${id}"]`).closest(".producto-card")

    const nombre = productoCard.querySelector("h3").textContent
    const categoria = productoCard.querySelector(".producto-categoria").textContent
    const descripcionCorta = productoCard.querySelector(".producto-descripcion").textContent
    const precio = productoCard.querySelector(".producto-precio").textContent
    const imagenSrc = productoCard.querySelector(".producto-imagen img").src

    // Crear una descripción más larga para simular detalles completos
    const descripcionCompleta = descripcionCorta.endsWith("...")
      ? descripcionCorta.slice(0, -3) +
        " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam auctor, nisl eget ultricies tincidunt, nisl nisl aliquam nisl, eget ultricies nisl nisl eget nisl."
      : descripcionCorta

    // Construir HTML para el modal
    const detallesHTML = `
            <div class="producto-detalle">
                <div class="producto-detalle-imagen">
                    <img src="${imagenSrc}" alt="${nombre}">
                </div>
                <div class="producto-detalle-info">
                    <h3>${nombre}</h3>
                    <div class="producto-detalle-categoria">${categoria}</div>
                    <div class="producto-detalle-descripcion">${descripcionCompleta}</div>
                    <div class="producto-detalle-precio">${precio}</div>
                    <button class="btn-detalles">Añadir al carrito</button>
                </div>
            </div>
        `

    detallesContainer.innerHTML = detallesHTML
    modal.style.display = "block"
  }

  // Hacer scroll horizontal en categorías con rueda del mouse
  const categoriasWrapper = document.querySelector(".categorias-wrapper")
  if (categoriasWrapper) {
    categoriasWrapper.addEventListener("wheel", function (e) {
      if (e.deltaY !== 0) {
        e.preventDefault()
        this.scrollLeft += e.deltaY
      }
    })
  }
})
