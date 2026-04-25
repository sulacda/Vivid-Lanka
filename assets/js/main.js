// Vivid Lanka — frontend JS

// CSRF helper for fetch()
async function postJSON(url, body) {
  const csrf = document.querySelector('meta[name="csrf"]')?.content || '';
  const r = await fetch(url, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json', 'X-CSRF-Token': csrf },
    body: JSON.stringify(body || {}),
  });
  return r.json().catch(() => ({}));
}

// Add to cart
document.addEventListener('click', async (e) => {
  const btn = e.target.closest('[data-add-cart]');
  if (!btn) return;
  e.preventDefault();
  const id = btn.dataset.addCart;
  const res = await postJSON('api/cart.php?action=add', { id: parseInt(id, 10), quantity: 1 });
  if (res.ok) {
    const c = document.getElementById('cart-count');
    if (c) c.textContent = res.count;
    btn.textContent = '✓ Added';
    setTimeout(() => (btn.textContent = btn.dataset.label || 'Add to cart'), 1500);
  } else {
    alert(res.error || 'Could not add to cart');
  }
});

// Reveal on scroll
const io = new IntersectionObserver((entries) => {
  entries.forEach((en) => en.isIntersecting && en.target.classList.add('in'));
});
document.querySelectorAll('.reveal').forEach((el) => io.observe(el));
