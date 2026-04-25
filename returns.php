<?php require_once __DIR__ . '/includes/functions.php';
$page_seo = ['title'=>ucfirst('returns').' · Vivid Lanka','description'=>'returns policy for Vivid Lanka.'];
require __DIR__ . '/includes/header.php'; ?>
<header class="page-header wrap"><p class="eyebrow">Legal</p><h1><?= ucfirst('returns') ?></h1></header>
<article class="wrap" style="max-width:780px; padding-bottom:6rem">
  <p class="lead">This is the returns page for Vivid Lanka. Please replace this placeholder with your full returns policy.</p>
  <p>Updated: <?= date('F Y') ?>. For questions, contact <a href="<?= e(url('contact.php')) ?>">the studio</a>.</p>
</article>
<?php require __DIR__ . '/includes/footer.php'; ?>
