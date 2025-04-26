function generateProductCarousel(products, containerId) {
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
            <div class="row">
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
                <div class="card h-100">
                  <img src="${prod.image}" class="card-img-top" alt="${
                      prod.title
                    }">
                  <div class="card-body">
                    <h5 class="card-title">${prod.title}</h5>
                    <p class="card-text">${prod.price}</p>
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
