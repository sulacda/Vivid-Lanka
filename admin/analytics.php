<?php
$page_seo = ['title'=>'Analytics · Admin'];
require __DIR__ . '/_layout.php';
$top = db()->query("SELECT path, COUNT(*) c FROM analytics_events WHERE created_at >= NOW() - INTERVAL 30 DAY GROUP BY path ORDER BY c DESC LIMIT 20")->fetchAll();
$daily = db()->query("SELECT DATE(created_at) d, COUNT(*) c FROM analytics_events WHERE created_at >= NOW() - INTERVAL 30 DAY GROUP BY d ORDER BY d DESC")->fetchAll();
?>
<h1 style="font-size:2rem">Analytics — last 30 days</h1>
<div style="display:grid; grid-template-columns:1fr 1fr; gap:2rem">
  <div>
    <h3>Top pages</h3>
    <table><tr><th>Path</th><th>Views</th></tr>
      <?php foreach ($top as $r): ?><tr><td><?= e($r['path']) ?></td><td><?= (int)$r['c'] ?></td></tr><?php endforeach; ?>
    </table>
  </div>
  <div>
    <h3>Daily pageviews</h3>
    <table><tr><th>Day</th><th>Views</th></tr>
      <?php foreach ($daily as $r): ?><tr><td><?= e($r['d']) ?></td><td><?= (int)$r['c'] ?></td></tr><?php endforeach; ?>
    </table>
  </div>
</div>
<?php require __DIR__ . '/_layout_end.php';
