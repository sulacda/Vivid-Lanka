<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check() && !empty($_POST['id'])) {
  $action = $_POST['action'] ?? '';
  $id = (int)$_POST['id'];
  if ($action === 'approve') db()->prepare("UPDATE testimonials SET status='approved' WHERE id = ?")->execute([$id]);
  if ($action === 'reject')  db()->prepare("UPDATE testimonials SET status='rejected' WHERE id = ?")->execute([$id]);
  if ($action === 'delete')  db()->prepare('DELETE FROM testimonials WHERE id = ?')->execute([$id]);
}
$page_seo = ['title'=>'Testimonials · Admin'];
require __DIR__ . '/_layout.php'; ?>
<h1 style="font-size:2rem">Testimonials</h1>
<table>
  <tr><th>Name</th><th>Rating</th><th>Message</th><th>Status</th><th></th></tr>
  <?php foreach (db()->query('SELECT * FROM testimonials ORDER BY created_at DESC')->fetchAll() as $t): ?>
    <tr>
      <td><?= e($t['name']) ?><br><small class="muted"><?= e($t['location']) ?></small></td>
      <td><?= str_repeat('★', (int)$t['rating']) ?></td>
      <td style="max-width:400px"><?= e($t['message']) ?></td>
      <td><?= e($t['status']) ?></td>
      <td>
        <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$t['id'] ?>"><input type="hidden" name="action" value="approve"><button class="chip">Approve</button></form>
        <form method="post" style="display:inline"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$t['id'] ?>"><input type="hidden" name="action" value="reject"><button class="chip">Reject</button></form>
        <form method="post" style="display:inline" onsubmit="return confirm('Delete?')"><?= csrf_field() ?><input type="hidden" name="id" value="<?= (int)$t['id'] ?>"><input type="hidden" name="action" value="delete"><button class="chip">Delete</button></form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
