<?php
$page_seo = ['title'=>'Feedback · Admin'];
require __DIR__ . '/_layout.php'; ?>
<h1 style="font-size:2rem">Feedback inbox</h1>
<table>
  <tr><th>From</th><th>Subject</th><th>Message</th><th>Received</th></tr>
  <?php foreach (db()->query('SELECT * FROM feedback ORDER BY created_at DESC')->fetchAll() as $f): ?>
    <tr>
      <td><?= e($f['name']) ?><br><small><a href="mailto:<?= e($f['email']) ?>"><?= e($f['email']) ?></a></small></td>
      <td><?= e($f['subject'] ?? '—') ?></td>
      <td style="max-width:400px"><?= e($f['message']) ?></td>
      <td><?= e($f['created_at']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
