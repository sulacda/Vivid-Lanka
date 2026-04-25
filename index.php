<?php
require_once __DIR__ . '/includes/functions.php';
$page_seo = [
  'title' => 'Vivid Lanka — Hand-signed art from Sri Lanka',
  'description' => 'Award-winning photography, drawings and crafts by Chamara Sulakkhana. Limited editions, signed and shipped from Ambalangoda, Sri Lanka.',
  'jsonld' => [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => 'Vivid Lanka',
    'url'  => url('/'),
  ],
];
$featured = array_slice(fetch_artworks(), 0, 8);
require __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div>
    <p class="eyebrow">Vivid Lanka · Est. 2014</p>
    <h1>Sri Lanka, <em>seen with patience.</em></h1>
    <p>Hand-signed photography, drawings and crafts by award-winning artist Chamara Sulakkhana — created in Ambalangoda and shipped worldwide.</p>
    <p style="margin-top:2rem"><a href="<?= e(url('shop.php')) ?>" class="btn">Enter the gallery</a></p>
  </div>
</section>

<section class="wrap" style="padding:6rem 0">
  <p class="eyebrow">Featured works</p>
  <h2>From the studio</h2>
  <div class="divider"></div>
  <div class="grid cols-4">
    <?php foreach ($featured as $a): ?>
      <a class="artwork" href="<?= e(url('product.php?slug=' . $a['slug'])) ?>">
        <div class="img"><img src="<?= e(url($a['image_url'])) ?>" alt="<?= e($a['title']) ?>" loading="lazy"></div>
        <div class="meta">
          <div class="title"><?= e($a['title']) ?></div>
          <div class="price"><?= money($a['price']) ?></div>
        </div>
      </a>
    <?php endforeach; ?>
  </div>
  <p class="center" style="margin-top:3rem"><a href="<?= e(url('shop.php')) ?>" class="btn btn-ghost">View all works</a></p>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
