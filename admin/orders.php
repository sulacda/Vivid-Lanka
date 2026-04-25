<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check() && !empty($_POST['id'])) {
  $allowed = ['pending','paid','shipped','delivered','cancelled','refunded'];
  $st = $_POST['status'] ?? 'pending';
  if (in_array($st, $allowed, true)) {
    db()->prepare('UPDATE orders SET status = ? WHERE id = ?')->execute([$st, (int)$_POST['id']]);
  }
}
$page_seo = ['title'=>'Orders · Admin'];
require __DIR__ . '/_layout.php'; ?>
<h1 style="font-size:2rem">Orders</h1>
<table>
  <tr><th>Ref</th><th>Customer</th><th>Email</th><th>Total</th><th>Status</th><th>Placed</th></tr>
  <?php foreach (db()->query('SELECT * FROM orders ORDER BY created_at DESC')->fetchAll() as $o): ?>
    <tr>
      <td><?= e($o['reference']) ?></td>
      <td><?= e($o['customer_name']) ?></td>
      <td><?= e($o['customer_email']) ?></td>
      <td><?= money($o['total']) ?></td>
      <td>
        <form method="post" style="display:flex; gap:.5rem">
          <?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$o['id'] ?>">
          <select name="status">
            <?php foreach (['pending','paid','shipped','delivered','cancelled','refunded'] as $s): ?>
              <option <?= $o['status']===$s?'selected':'' ?>><?= $s ?></option>
            <?php endforeach; ?>
          </select>
          <button class="chip">Save</button>
        </form>
      </td>
      <td><?= e($o['created_at']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
