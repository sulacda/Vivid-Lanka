// UI Enhancements: cart badge, search, filters

function updateCartBadge(){
  const badge=document.getElementById('cart-count');
  if(!badge) return;
  const cart=JSON.parse(localStorage.getItem('cart'))||[];
  const total=cart.reduce((s,i)=>s+i.qty,0);
  badge.textContent=total;
}

function setupSearch(){
  const input=document.getElementById('search');
  if(!input) return;
  input.addEventListener('input',()=>{
    const term=input.value.toLowerCase();
    const filtered=products.filter(p=>p.name.toLowerCase().includes(term));
    renderProducts(filtered);
  });
}

function renderProducts(list=products){
  const el=document.querySelector('.products');
  if(!el) return;
  el.innerHTML=list.map(p=>`
    <div class='card product-card'>
      <img src='${p.image}' />
      <h3>${p.name}</h3>
      <p>$${p.price}</p>
      <button class='btn' onclick='addToCart(${JSON.stringify(p)})'>Add</button>
    </div>
  `).join('');
}

document.addEventListener('DOMContentLoaded',()=>{
  updateCartBadge();
  setupSearch();
});