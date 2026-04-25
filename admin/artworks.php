<?php
require_once __DIR__ . '/../includes/functions.php';
require_admin();
$msg = null; $err = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_check()) {
  $action = $_POST['action'] ?? '';
  if ($action === 'create') {
    $slug  = preg_replace('/[^a-z0-9-]/','', strtolower(trim($_POST['slug'] ?? '')));
    $title = trim($_POST['title'] ?? '');
    $cat   = $_POST['category'] ?? 'photography';
    $sub   = $_POST['sub_category'] ?? 'travel';
    $price = (float)($_POST['price'] ?? 0);
    $img   = trim($_POST['image_url'] ?? '');
    $desc  = trim($_POST['description'] ?? '');
    if (!$slug || !$title || $price <= 0) { $err = 'Slug, title and price required.'; }
    else {
      try {
        db()->prepare('INSERT INTO artworks (slug,title,category,sub_category,price,image_url,description) VALUES (?,?,?,?,?,?,?)')
            ->execute([$slug, $title, $cat, $sub, $price, $img ?: 'assets/images/placeholder.jpg', $desc]);
        $msg = 'Artwork added.';
      } catch (Throwable $e) { $err = 'Slug already exists.'; }
    }
  }
  if ($action === 'delete' && !empty($_POST['id'])) {
    db()->prepare('DELETE FROM artworks WHERE id = ?')->execute([(int)$_POST['id']]);
    $msg = 'Deleted.';
  }
}
$page_seo = ['title'=>'Artworks · Admin'];
require __DIR__ . '/_layout.php'; ?>
<h1 style="font-size:2rem">Artworks</h1>
<?php if ($msg): ?><div class="alert"><?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="alert error"><?= e($err) ?></div><?php endif; ?>

<details style="margin-bottom:2rem"><summary class="btn" style="display:inline-block">+ Add artwork</summary>
<form method="post" style="margin-top:1.5rem; max-width:560px">
  <?= csrf_field() ?><input type="hidden" name="action" value="create">
  <div class="field"><label>Title</label><input name="title" required></div>
  <div class="field"><label>Slug (lowercase, hyphens)</label><input name="slug" required></div>
  <div class="field"><label>Category</label><select name="category"><option>photography</option><option>drawings</option><option>crafts</option></select></div>
  <div class="field"><label>Sub-category</label><select name="sub_category"><option>travel</option><option>street</option><option>wildlife</option><option>ink</option><option>pencil</option><option>wood</option><option>weave</option></select></div>
  <div class="field"><label>Price (USD)</label><input name="price" type="number" step="0.01" required></div>
  <div class="field"><label>Image URL (relative, e.g. assets/images/foo.jpg)</label><input name="image_url"></div>
  <div class="field"><label>Description</label><textarea name="description"></textarea></div>
  <button class="btn">Save</button>
</form>
</details>

<table>
  <tr><th></th><th>Title</th><th>Category</th><th>Price</th><th></th></tr>
  <?php foreach (db()->query('SELECT * FROM artworks ORDER BY created_at DESC')->fetchAll() as $a): ?>
    <tr>
      <td><img src="<?= e(url($a['image_url'])) ?>" style="width:50px; height:50px; object-fit:cover"></td>
      <td><?= e($a['title']) ?></td>
      <td><?= e($a['category']) ?> · <?= e($a['sub_category']) ?></td>
      <td><?= money($a['price']) ?></td>
      <td>
        <form method="post" onsubmit="return confirm('Delete this artwork?')">
          <?= csrf_field() ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$a['id'] ?>">
          <button class="chip">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
</table>
<?php require __DIR__ . '/_layout_end.php';
