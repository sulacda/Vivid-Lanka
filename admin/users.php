<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
$me = current_user();
if ($me['role'] !== 'admin') { http_response_code(403); echo 'Admins only'; exit; }
$msg = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
  $action = $_POST['action'] ?? '';
  if ($action === 'create') {
    $email = trim($_POST['email'] ?? '');
    $name  = trim($_POST['name'] ?? '');
    $pwd   = $_POST['password'] ?? '';
    $role  = $_POST['role'] ?? 'moderator';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$name || strlen($pwd) < 8) { $err = 'Valid email, name, and 8+ char password required.'; }
    else {
      try {
        db()->prepare('INSERT INTO users (email,password_hash,name,role) VALUES (?,?,?,?)')
            ->execute([$email, password_hash($pwd, PASSWORD_BCRYPT), $name, in_array($role,['admin','moderator'])?$role:'moderator']);
        $msg = 'User created.';
      } catch (Throwable $e) { $err = 'Email already exists.'; }
    }
  }
  if ($action === 'delete' && !empty($_POST['id']) && (int)$_POST['id'] !== (int)$me['id']) {
    db()->prepare('DELETE FROM users WHERE id = ?')->execute([(int)$_POST['id']]);
    $msg = 'User deleted.';
  }
}
$page_seo = ['title'=>'Users · Admin'];
require __DIR__ . '/_layout.php'; ?>
<h1 style="font-size:2rem">Users</h1>
<?php if ($msg): ?><div class="alert"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
<details style="margin-bottom:2rem"><summary class="btn" style="display:inline-block">+ Add user</summary>
<form method="post" style="margin-top:1.5rem; max-width:480px">
  <?= csrf_field() ?><input type="hidden" name="action" value="create">
  <div class="field"><label>Name</label><input name="name" required></div>
  <div class="field"><label>Email</label><input type="email" name="email" required></div>
  <div class="field"><label>Password (8+ chars)</label><input type="password" name="password" required></div>
  <div class="field"><label>Role</label><select name="role"><option>moderator</option><option>admin</option></select></div>
  <button class="btn">Create</button>
</form>
</details>
<table>
  <tr><th>Name</th><th>Email</th><th>Role</th><th>Joined</th><th></th></tr>
  <?php foreach (db()->query('SELECT * FROM users ORDER BY created_at DESC')->fetchAll() as $u): ?>
    <tr>
      <td><?= e($u['name']) ?></td>
      <td><?= e($u['email']) ?></td>
      <td><?= e($u['role']) ?></td>
      <td><?= e($u['created_at']) ?></td>
      <td>
        <?php if ((int)$u['id'] !== (int)$me['id']): ?>
        <form method="post" onsubmit="return confirm('Delete user?')"><?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$u['id'] ?>"><button class="chip">Delete</button></form>
        <?php else: ?><span class="muted">you</span><?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
