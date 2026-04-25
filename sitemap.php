<?php
require_once __DIR__ . '/includes/functions.php';
header('Content-Type: application/xml; charset=utf-8');
$pages = ['', 'shop.php', 'artist.php', 'awards.php', 'about.php', 'contact.php', 'testimonials.php', 'faq.php', 'privacy.php', 'terms.php', 'returns.php'];
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
foreach ($pages as $p) echo '<url><loc>' . e(url($p)) . '</loc></url>' . "\n";
foreach (db()->query('SELECT slug FROM artworks')->fetchAll() as $a) {
  echo '<url><loc>' . e(url('product.php?slug=' . $a['slug'])) . '</loc></url>' . "\n";
}
echo '</urlset>';
