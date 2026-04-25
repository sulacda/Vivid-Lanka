<?php
require_once __DIR__ . '/includes/functions.php';
$cat = $_GET['cat'] ?? null;
$sub = $_GET['sub'] ?? null;
$valid_cats = ['photography','drawings','crafts'];
if ($cat && !in_array($cat, $valid_cats, true)) $cat = null;
$items = fetch_artworks($cat, $sub);
$page_seo = [
  'title' => $cat ? ucfirst($cat) . ' · Vivid Lanka' : 'Shop all works · Vivid Lanka',
  'description' => 'Browse ' . count($items) . ' hand-signed works by Chamara Sulakkhana — photography, drawings and crafts from Sri Lanka.',
];
require __DIR__ . '/includes/header.php';
?>
<header class="page-header wrap">
  <p class="eyebrow">The Gallery</p>
  <h1><?= $cat ? ucfirst(e($cat)) : 'All <em>works</em>' ?></h1>
  <p class="lead"><?= count($items) ?> works · curated and signed by the artist</p>
</header>

<div class="wrap">
  <div class="filters">
    <a class="chip <?= !$cat ? 'active' : '' ?>" href="<?= e(url('shop.php')) ?>">All</a>
    <?php foreach ($valid_cats as $c): ?>
      <a class="chip <?= $cat === $c ? 'active' : '' ?>" href="<?= e(url('shop.php?cat=' . $c)) ?>"><?= ucfirst($c) ?></a>
    <?php endforeach; ?>
  </div>

  <div class="grid cols-3">
    <?php foreach ($items as $a): ?>
      <a class="artwork" href="<?= e(url('product.php?slug=' . $a['slug'])) ?>">
        <div class="img"><img src="<?= e(url($a['image_url'])) ?>" alt="<?= e($a['title']) ?>" loading="lazy"></div>
        <div class="meta">
          <div class="title"><?= e($a['title']) ?></div>
          <div class="price"><?= money($a['price']) ?></div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
  <?php if (!$items): ?>
    <p class="center muted" style="padding:6rem 0">No works match this selection.</p>
  <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
