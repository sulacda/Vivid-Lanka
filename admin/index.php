<?php
$page_seo = ['title'=>'Overview · Admin'];
require __DIR__ . '/_layout.php';
$counts = [
  'Artworks'     => (int)db()->query('SELECT COUNT(*) FROM artworks')->fetchColumn(),
  'Orders'       => (int)db()->query('SELECT COUNT(*) FROM orders')->fetchColumn(),
  'Pending reviews' => (int)db()->query("SELECT COUNT(*) FROM testimonials WHERE status='pending'")->fetchColumn(),
  'Pageviews (30d)' => (int)db()->query("SELECT COUNT(*) FROM analytics_events WHERE created_at >= NOW() - INTERVAL 30 DAY")->fetchColumn(),
];
?>
<h1 style="font-size:2rem">Studio overview</h1>
<div class="stat-grid">
  <?php foreach ($counts as $l => $n): ?>
    <div class="stat"><div class="n"><?= $n ?></div><div class="l"><?= e($l) ?></div></div>
  <?php endforeach; ?>
</div>
<h3>Latest orders</h3>
<table>
  <tr><th>Ref</th><th>Customer</th><th>Total</th><th>Status</th><th>Placed</th></tr>
  <?php foreach (db()->query('SELECT * FROM orders ORDER BY created_at DESC LIMIT 10')->fetchAll() as $o): ?>
    <tr><td><?= e($o['reference']) ?></td><td><?= e($o['customer_name']) ?></td><td><?= money($o['total']) ?></td><td><?= e($o['status']) ?></td><td><?= e($o['created_at']) ?></td></tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
