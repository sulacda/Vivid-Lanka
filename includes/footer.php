</main>
<footer class="site-footer">
  <div class="wrap">
    <div class="cols">
      <div>
        <p class="brand">Vivid <span>Lanka</span></p>
        <p class="muted">Hand-signed art from Sri Lanka.</p>
      </div>
      <div>
        <h4>Shop</h4>
        <a href="<?= e(url('shop.php?cat=photography')) ?>">Photography</a>
        <a href="<?= e(url('shop.php?cat=drawings')) ?>">Drawings</a>
        <a href="<?= e(url('shop.php?cat=crafts')) ?>">Crafts</a>
      </div>
      <div>
        <h4>Studio</h4>
        <a href="<?= e(url('artist.php')) ?>">The Artist</a>
        <a href="<?= e(url('awards.php')) ?>">Awards</a>
        <a href="<?= e(url('about.php')) ?>">About</a>
        <a href="<?= e(url('faq.php')) ?>">FAQ</a>
      </div>
      <div>
        <h4>Legal</h4>
        <a href="<?= e(url('privacy.php')) ?>">Privacy</a>
        <a href="<?= e(url('terms.php')) ?>">Terms</a>
        <a href="<?= e(url('returns.php')) ?>">Returns</a>
      </div>
    </div>
    <p class="copy">© <?= date('Y') ?> Vivid Lanka · Chamara Sulakkhana, Ambalangoda, Sri Lanka</p>
  </div>
</footer>
<script src="<?= e(url('assets/js/main.js')) ?>"></script>
</body>
</html>
