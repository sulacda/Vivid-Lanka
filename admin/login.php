<?php
require_once __DIR__ . '/../includes/functions.php';
$err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_check()) { $err = 'Security check failed.'; }
  else {
    $email = trim($_POST['email'] ?? '');
    $pwd   = $_POST['password'] ?? '';
    if (login($email, $pwd)) { header('Location: ' . url('admin/index.php')); exit; }
    $err = 'Invalid email or password.';
  }
}
$page_seo = ['title'=>'Admin login · Vivid Lanka','description'=>'Studio admin login.'];
require __DIR__ . '/../includes/header.php'; ?>
<div class="login-card">
  <h2>Admin login</h2>
  <?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <?= csrf_field() ?>
    <div class="field"><label>Email</label><input type="email" name="email" required></div>
    <div class="field"><label>Password</label><input type="password" name="password" required></div>
    <button class="btn">Sign in</button>
  </form>
  <p class="muted" style="margin-top:1.5rem; font-size:.85rem">Default: admin@vividlanka.com / ChangeMe123!</p>
</div>
<?php require __DIR__ . '/../includes/footer.php'; ?>
