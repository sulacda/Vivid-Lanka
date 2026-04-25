<?php require_once __DIR__ . '/includes/functions.php';
$page_seo = ['title'=>ucfirst('privacy').' · Vivid Lanka','description'=>'privacy policy for Vivid Lanka.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Legal</p><h1><?= ucfirst('privacy') ?></h1></header>
<article class="wrap" style="max-width:780px; padding-bottom:6rem">
  <p class="lead">This is the privacy page for Vivid Lanka. Please replace this placeholder with your full privacy policy.</p>
  <p>Updated: <?= date('F Y') ?>. For questions, contact <a href="<?= e(url('contact.php')) ?>">the studio</a>.</p>
</article>
<?php require __DIR__ . '/includes/footer.php'; ?>
