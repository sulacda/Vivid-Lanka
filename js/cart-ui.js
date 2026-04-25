// Render cart page
function renderCart(){
  const el=document.getElementById('cart');
  if(!el) return;
  const cart=JSON.parse(localStorage.getItem('cart'))||[];

  if(cart.length===0){
    el.innerHTML='<p>Cart is empty</p>';return;
  }

  el.innerHTML=cart.map(i=>`
    <div class='card flex-between'>
      <span>${i.name} x ${i.qty}</span>
      <span>$${i.price*i.qty}</span>
      <button onclick='removeFromCart(${i.id});location.reload()'>Remove</button>
    </div>
  `).join('');
}

document.addEventListener('DOMContentLoaded',renderCart);