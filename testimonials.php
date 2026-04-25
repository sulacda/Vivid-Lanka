<?php
require_once __DIR__ . '/includes/functions.php';
$msg = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!csrf_check()) { $err = 'Security check failed.'; }
  else {
    $name = trim($_POST['name'] ?? '');
    $loc  = trim($_POST['location'] ?? '');
    $rating  = (int)($_POST['rating'] ?? 5);
    $message = trim($_POST['message'] ?? '');
    if (!$name || !$message || $rating < 1 || $rating > 5) { $err = 'Please complete all fields.'; }
    else {
      $stmt = db()->prepare('INSERT INTO testimonials (name,location,rating,message,status) VALUES (?,?,?,?,"pending")');
      $stmt->execute([$name, $loc ?: null, $rating, $message]);
      $msg = 'Thank you. Your testimonial will appear after review.';
    }
  }
}
$rows = db()->query("SELECT name,location,rating,message,created_at FROM testimonials WHERE status='approved' ORDER BY created_at DESC")->fetchAll();
$page_seo = ['title'=>'Collector testimonials · Vivid Lanka','description'=>'What collectors say about works from Vivid Lanka.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Collectors</p><h1>What collectors <em>say</em></h1></header>
<div class="wrap" style="max-width:780px; padding-bottom:4rem">
  <?php foreach ($rows as $r): ?>
    <blockquote style="border-left:3px solid var(--gold); padding:1rem 1.5rem; margin:0 0 2rem; background:var(--white)">
      <p style="font-family:var(--serif); font-size:1.25rem; font-style:italic; margin:0 0 1rem">"<?= e($r['message']) ?>"</p>
      <footer class="muted" style="font-size:.85rem">— <?= e($r['name']) ?><?= $r['location'] ? ', ' . e($r['location']) : '' ?> · <?= str_repeat('★', (int)$r['rating']) ?></footer>
    </blockquote>
  <?php endforeach; ?>
  <?php if (!$rows): ?><p class="muted">No testimonials yet.</p><?php endif; ?>

  <div class="divider"></div>
  <h2>Share yours</h2>
  <?php if ($msg): ?><div class="alert"><?= e($msg) ?></div><?php endif; ?>
  <?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>
  <form method="post">
    <?= csrf_field() ?>
    <div class="field"><label>Name *</label><input name="name" required></div>
    <div class="field"><label>Location</label><input name="location" placeholder="City, Country"></div>
    <div class="field"><label>Rating *</label>
      <select name="rating">
        <?php for ($i=5;$i>=1;$i--) echo "<option value=\"$i\">$i ★</option>"; ?>
      </select>
    </div>
    <div class="field"><label>Your message *</label><textarea name="message" required></textarea></div>
    <button class="btn">Submit testimonial</button>
  </form>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
