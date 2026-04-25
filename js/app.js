
function renderProducts() {
  const container = document.querySelector(".products");
  if (!container) return;

  container.innerHTML = products.map(p => `
    <div class="card product-card">
      <img src="${p.image}" />
      <h3>${p.name}</h3>
      <p>$${p.price}</p>
      <button class="btn" onclick='addToCart(${JSON.stringify(p)})'>
        Add to Cart
      </button>
    </div>
  `).join("");
}

document.addEventListener("DOMContentLoaded", renderProducts);
