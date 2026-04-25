<?php
require_once __DIR__ . '/includes/functions.php';
$items = cart_items();
$total = cart_total();
$ok = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_check()) { $err = 'Security check failed.'; }
  elseif (!$items) { $err = 'Your cart is empty.'; }
  else {
    $name  = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $addr  = trim($_POST['address'] ?? '');
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$addr) { $err = 'Please complete all fields.'; }
    else {
      $ref = 'VL-' . strtoupper(bin2hex(random_bytes(4)));
      $pdo = db();
      $pdo->beginTransaction();
      try {
        $pdo->prepare('INSERT INTO orders (reference,customer_name,customer_email,shipping_address,total,currency,status) VALUES (?,?,?,?,?,?, "pending")')
            ->execute([$ref, $name, $email, $addr, $total, cfg()['site']['currency']]);
        $orderId = (int)$pdo->lastInsertId();
        $st = $pdo->prepare('INSERT INTO order_items (order_id,artwork_id,title,unit_price,quantity) VALUES (?,?,?,?,?)');
        foreach ($items as $i) $st->execute([$orderId, $i['id'], $i['title'], $i['price'], $i['quantity']]);
        $pdo->commit();
        $_SESSION['cart'] = [];
        $ok = $ref;
      } catch (Throwable $e) { $pdo->rollBack(); $err = 'Could not place order. Please try again.'; }
    }
  }
}
$page_seo = ['title'=>'Checkout · Vivid Lanka','description'=>'Complete your order.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Checkout</p><h1><em>Final</em> details</h1></header>
<div class="wrap" style="max-width:640px; padding-bottom:6rem">
  <?php if ($ok): ?>
    <div class="alert">
      <h3>Order placed</h3>
      <p>Your reference is <b><?= e($ok) ?></b>. We've recorded your order and will email payment instructions shortly.</p>
    </div>
  <?php elseif (!$items): ?>
    <p class="muted">Your cart is empty. <a href="<?= e(url('shop.php')) ?>" class="gold">Browse the gallery →</a></p>
  <?php else: ?>
    <?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
    <p class="muted">Total: <b><?= money($total) ?></b> · <?= count($items) ?> item(s)</p>
    <form method="post">
      <?= csrf_field() ?>
      <div class="field"><label>Full name *</label><input name="name" required></div>
      <div class="field"><label>Email *</label><input type="email" name="email" required></div>
      <div class="field"><label>Shipping address *</label><textarea name="address" required></textarea></div>
      <button class="btn">Place order</button>
    </form>
  <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
