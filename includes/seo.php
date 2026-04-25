<?php
// Render <head> SEO tags. Pass ['title'=>..., 'description'=>..., 'image'=>..., 'canonical'=>..., 'jsonld'=>[...]]
function seo_head(array $opts = []): string {
  require_once __DIR__ . '/functions.php';
  $site = cfg()['site'];
  $title = $opts['title']       ?? $site['name'] . ' — ' . $site['tagline'];
  $desc  = $opts['description'] ?? 'Hand-signed photography, drawings and crafts from Sri Lanka.';
  $img   = $opts['image']       ?? url('assets/images/og-default.jpg');
  $canon = $opts['canonical']   ?? url($_SERVER['REQUEST_URI'] ?? '/');
  $jsonld= $opts['jsonld']      ?? null;

  ob_start(); ?>
  <title><?= e($title) ?></title>
  <meta name="description" content="<?= e($desc) ?>">
  <link rel="canonical" href="<?= e($canon) ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#0b0b0b">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= e($title) ?>">
  <meta property="og:description" content="<?= e($desc) ?>">
  <meta property="og:image" content="<?= e($img) ?>">
  <meta property="og:url" content="<?= e($canon) ?>">
  <meta property="og:site_name" content="<?= e($site['name']) ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($title) ?>">
  <meta name="twitter:description" content="<?= e($desc) ?>">
  <meta name="twitter:image" content="<?= e($img) ?>">
  <?php if ($jsonld): ?>
  <script type="application/ld+json"><?= json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?></script>
  <?php endif; ?>
  <?php
  return ob_get_clean();
}
