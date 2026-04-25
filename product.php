<?php
require_once __DIR__ . '/includes/functions.php';
$slug = $_GET['slug'] ?? '';
$a = fetch_artwork_by_slug($slug);
if (!$a) { http_response_code(404); require __DIR__ . '/404.php'; exit; }
$page_seo = [
  'title' => $a['title'] . ' · Vivid Lanka',
  'description' => mb_substr($a['description'] ?? $a['story'] ?? '', 0, 155),
  'image' => url($a['image_url']),
  'jsonld' => [
    '@context' => 'https://schema.org',
    '@type'    => 'Product',
    'name'     => $a['title'],
    'image'    => url($a['image_url']),
    'description' => $a['description'],
    'sku'      => 'VL-' . $a['id'],
    'brand'    => ['@type' => 'Brand', 'name' => 'Vivid Lanka'],
    'offers'   => [
      '@type' => 'Offer',
      'price' => $a['price'],
      'priceCurrency' => cfg()['site']['currency'],
      'availability' => 'https://schema.org/InStock',
      'url' => url('product.php?slug=' . $a['slug']),
    ],
  ],
];
require __DIR__ . '/includes/header.php';
?>
<section class="wrap product">
  <div class="gallery">
    <img src="<?= e(url($a['image_url'])) ?>" alt="<?= e($a['title']) ?>">
  </div>
  <div>
    <p class="eyebrow"><?= e($a['category']) ?> · <?= e($a['sub_category']) ?></p>
    <h1><?= e($a['title']) ?></h1>
    <p class="price-tag"><?= money($a['price']) ?></p>
    <?php if ($a['is_limited']): ?>
      <p class="muted">Limited edition · <?= (int)$a['edition_current'] ?> of <?= (int)$a['edition_total'] ?></p>
    <?php endif; ?>
    <p class="lead" style="margin-top:1.5rem"><?= e($a['description']) ?></p>
    <p style="font-style:italic; color:var(--muted)"><?= e($a['story']) ?></p>
    <p style="margin-top:2rem">
      <button class="btn" data-add-cart="<?= (int)$a['id'] ?>" data-label="Add to cart">Add to cart</button>
      <a href="<?= e(url('shop.php')) ?>" class="btn btn-ghost">Back to gallery</a>
    </p>
  </div>
</section>
<meta name="csrf" content="<?= e(csrf_token()) ?>">
<?php require __DIR__ . '/includes/footer.php'; ?>
