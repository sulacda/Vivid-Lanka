
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

async function fetchProducts(){
  const res = await fetch('http://localhost:5000/api/products');
  return await res.json();
}

async function renderProducts(){
  const products = await fetchProducts();
  const el = document.querySelector('.products');

  el.innerHTML = products.map(p => `
    <div class="card product-card">
      <img src="${p.image}" />
      <h3>${p.name}</h3>
      <p>$${p.price}</p>
      <button class="btn" onclick='addToCart(${JSON.stringify(p)})'>
        Add to Cart
      </button>
    </div>
  `).join('');
}

document.addEventListener("DOMContentLoaded", renderProducts);
