<?php
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/seo.php';
start_session();
track_pageview($_SERVER['REQUEST_URI'] ?? '/');
$__seo = $page_seo ?? [];
?><!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<?= seo_head($__seo) ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Inter:wght@300;400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= e(url('assets/css/style.css')) ?>">
</head>
<body>
<a href="#main" class="skip">Skip to content</a>

<header class="site-header">
  <div class="wrap">
    <a href="<?= e(url('/')) ?>" class="brand">Vivid <span>Lanka</span></a>
    <nav aria-label="Primary">
      <a href="<?= e(url('shop.php')) ?>">Shop</a>
      <a href="<?= e(url('artist.php')) ?>">Artist</a>
      <a href="<?= e(url('awards.php')) ?>">Awards</a>
      <a href="<?= e(url('about.php')) ?>">About</a>
      <a href="<?= e(url('testimonials.php')) ?>">Testimonials</a>
      <a href="<?= e(url('contact.php')) ?>">Contact</a>
    </nav>
    <a href="<?= e(url('cart.php')) ?>" class="cart-btn" aria-label="Cart">
      Cart (<span id="cart-count"><?= cart_count() ?></span>)
    </a>
    <button class="menu-toggle" aria-label="Open menu" onclick="document.body.classList.toggle('nav-open')">☰</button>
  </div>
</header>

<main id="main">
