function generateProductCarousel(products, containerId, baseUrl) {
  const container = document.getElementById(containerId);
  if (!container) return;

  const width = window.innerWidth;
  let itemsPerSlide = 1;

  if (width >= 992) {
    itemsPerSlide = 3;
  } else if (width >= 768) {
    itemsPerSlide = 2;
  }

  let slides = "";

  for (let i = 0; i < products.length; i += itemsPerSlide) {
    const active = i === 0 ? "active" : "";
    const current = products.slice(i, i + itemsPerSlide);

    slides += `
            <div class="carousel-item ${active}">
            <div class="row row-principal">
                ${current
                  .map(
                    (prod) => `
              <div class="col-12 ${
                itemsPerSlide === 2
                  ? "col-sm-6"
                  : itemsPerSlide === 3
                  ? "col-md-4"
                  : ""
              }">
                <div class="card card-principal h-100">
                    <img src="${prod.imagen}" class="card-img-top card-img-top-principal" alt="${prod.nombre}">
                  <div class="card-body card-body-principal">
                    <h5 class="card-title">${prod.nombre}</h5>
                    <p class="card-text">${prod.descripcion}</p>
                    <p class="card-text">stock: ${prod.stock}</p>
                    <p class="card-text">${prod.precio}</p>
                  </div>
                </div>
              </div>
            `
                  )
                  .join("")}
          </div>
        </div>
      `;
  }

  container.innerHTML = slides;
}
