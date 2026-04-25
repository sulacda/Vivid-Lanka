<?php
require_once __DIR__ . '/includes/functions.php';
$msg = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_check()) { $err = 'Security check failed. Please reload and try again.'; }
  else {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    if (!$name || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$message) {
      $err = 'Please complete all required fields with a valid email.';
    } else {
      $stmt = db()->prepare('INSERT INTO feedback (name,email,subject,message) VALUES (?,?,?,?)');
      $stmt->execute([$name, $email, $subject ?: null, $message]);
      $msg = 'Thank you — your message has reached the studio. We typically reply within two days.';
    }
  }
}
$page_seo = ['title'=>'Contact · Vivid Lanka','description'=>'Get in touch with the Vivid Lanka studio in Ambalangoda, Sri Lanka.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Get in touch</p><h1>Contact <em>the studio</em></h1></header>
<div class="wrap" style="max-width:640px; padding-bottom:6rem">
  <?php if ($msg): ?><div class="alert"><?= e($msg) ?></div><?php endif; ?>
  <?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
  <form method="post" novalidate>
    <?= csrf_field() ?>
    <div class="field"><label>Name *</label><input name="name" required></div>
    <div class="field"><label>Email *</label><input type="email" name="email" required></div>
    <div class="field"><label>Subject</label><input name="subject"></div>
    <div class="field"><label>Message *</label><textarea name="message" required></textarea></div>
    <button class="btn">Send message</button>
  </form>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
