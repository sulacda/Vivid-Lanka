<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
  $action = $_POST['action'] ?? '';
  $id = (int)($_POST['id'] ?? 0);
  if ($action === 'remove' && $id) unset($_SESSION['cart'][$id]);
  if ($action === 'update' && $id) {
    $q = max(0, (int)($_POST['quantity'] ?? 0));
    if ($q === 0) unset($_SESSION['cart'][$id]); else $_SESSION['cart'][$id] = $q;
  }
  header('Location: ' . url('cart.php')); exit;
}
$items = cart_items();
$total = cart_total();
$page_seo = ['title'=>'Your cart · Vivid Lanka','description'=>'Review your selected works.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Checkout</p><h1>Your <em>cart</em></h1></header>
<div class="wrap" style="padding-bottom:6rem">
<?php if (!$items): ?>
  <p class="muted">Your cart is empty. <a href="<?= e(url('shop.php')) ?>" class="gold">Browse the gallery →</a></p>
<?php else: ?>
  <table class="cart-table">
    <thead><tr><th></th><th>Work</th><th>Qty</th><th>Price</th><th>Line</th><th></th></tr></thead>
    <tbody>
    <?php foreach ($items as $i): ?>
      <tr>
        <td><img src="<?= e(url($i['image_url'])) ?>" alt=""></td>
        <td><a href="<?= e(url('product.php?slug=' . $i['slug'])) ?>"><?= e($i['title']) ?></a></td>
        <td>
          <form method="post" style="display:flex; gap:.5rem">
            <?= csrf_field() ?>
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?= (int)$i['id'] ?>">
            <input name="quantity" value="<?= (int)$i['quantity'] ?>" type="number" min="0" style="width:60px">
            <button class="chip">Update</button>
          </form>
        </td>
        <td><?= money($i['price']) ?></td>
        <td><?= money($i['line_total']) ?></td>
        <td>
          <form method="post"><?= csrf_field() ?>
            <input type="hidden" name="action" value="remove">
            <input type="hidden" name="id" value="<?= (int)$i['id'] ?>">
            <button class="chip">Remove</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot><tr><td colspan="4" style="text-align:right"><b>Total</b></td><td colspan="2"><b><?= money($total) ?></b></td></tr></tfoot>
  </table>
  <p style="text-align:right"><a href="<?= e(url('checkout.php')) ?>" class="btn">Proceed to checkout →</a></p>
<?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
