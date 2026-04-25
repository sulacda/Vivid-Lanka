<?php require_once __DIR__ . '/includes/functions.php';
http_response_code(404);
$page_seo = ['title'=>'Not found · Vivid Lanka','description'=>'The page you were looking for could not be found.'];
require __DIR__ . '/includes/header.php'; ?>
<section class="hero" style="min-height:70vh">
  <div>
    <p class="eyebrow">404</p>
    <h1>Lost in <em>the gallery</em></h1>
    <p>The page you were looking for is not here.</p>
    <p style="margin-top:2rem"><a href="<?= e(url('/')) ?>" class="btn">Return home</a></p>
  </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
