<?php
require_once __DIR__ . '/db.php';

function cfg(): array {
  static $c = null;
  if (!$c) $c = require __DIR__ . '/config.php';
  return $c;
}

// ---------- Session ----------
function start_session(): void {
  if (session_status() === PHP_SESSION_ACTIVE) return;
  $c = cfg();
  session_name($c['security']['session_name']);
  session_set_cookie_params([
    'lifetime' => 0,
    'path'     => '/',
    'httponly' => true,
    'samesite' => 'Lax',
    'secure'   => !empty($_SERVER['HTTPS']),
  ]);
  session_start();
  if (empty($_SESSION['cart']))    $_SESSION['cart'] = [];
  if (empty($_SESSION['sid']))     $_SESSION['sid']  = bin2hex(random_bytes(16));
}

// ---------- Output escaping ----------
function e(?string $s): string {
  return htmlspecialchars($s ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function url(string $path = ''): string {
  $base = rtrim(cfg()['site']['url'], '/');
  return $base . '/' . ltrim($path, '/');
}

function money($v): string {
  return cfg()['site']['currency_symbol'] . number_format((float)$v, 0);
}

// ---------- CSRF ----------
function csrf_token(): string {
  start_session();
  $k = cfg()['security']['csrf_key'];
  if (empty($_SESSION[$k])) $_SESSION[$k] = bin2hex(random_bytes(32));
  return $_SESSION[$k];
}
function csrf_field(): string {
  return '<input type="hidden" name="_csrf" value="' . e(csrf_token()) . '">';
}
function csrf_check(): bool {
  start_session();
  $k = cfg()['security']['csrf_key'];
  $sent = $_POST['_csrf'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
  return !empty($_SESSION[$k]) && hash_equals($_SESSION[$k], (string)$sent);
}

// ---------- Auth ----------
function current_user(): ?array {
  start_session();
  if (empty($_SESSION['user_id'])) return null;
  $stmt = db()->prepare('SELECT id,email,name,role FROM users WHERE id = ?');
  $stmt->execute([$_SESSION['user_id']]);
  $u = $stmt->fetch();
  return $u ?: null;
}
function require_admin(): void {
  $u = current_user();
  if (!$u) { header('Location: ' . url('admin/login.php')); exit; }
}
function login(string $email, string $password): bool {
  $stmt = db()->prepare('SELECT id,password_hash FROM users WHERE email = ?');
  $stmt->execute([$email]);
  $u = $stmt->fetch();
  if (!$u || !password_verify($password, $u['password_hash'])) return false;
  start_session();
  session_regenerate_id(true);
  $_SESSION['user_id'] = (int)$u['id'];
  return true;
}
function logout(): void {
  start_session();
  $_SESSION = [];
  session_destroy();
}

// ---------- Cart ----------
function cart_items(): array {
  start_session();
  if (empty($_SESSION['cart'])) return [];
  $ids = array_keys($_SESSION['cart']);
  $in  = implode(',', array_fill(0, count($ids), '?'));
  $stmt = db()->prepare("SELECT id,slug,title,price,image_url FROM artworks WHERE id IN ($in)");
  $stmt->execute($ids);
  $out = [];
  foreach ($stmt->fetchAll() as $row) {
    $row['quantity'] = (int)$_SESSION['cart'][$row['id']];
    $row['line_total'] = $row['quantity'] * (float)$row['price'];
    $out[] = $row;
  }
  return $out;
}
function cart_total(): float {
  $t = 0; foreach (cart_items() as $i) $t += $i['line_total']; return $t;
}
function cart_count(): int {
  start_session();
  return array_sum($_SESSION['cart'] ?? []);
}

// ---------- Analytics ----------
function track_pageview(string $path): void {
  start_session();
  try {
    $c = cfg();
    $ip = $_SERVER['REMOTE_ADDR'] ?? '';
    $ipHash = $ip ? hash('sha256', $ip . $c['security']['ip_salt']) : null;
    $stmt = db()->prepare(
      'INSERT INTO analytics_events (type,name,path,referrer,session_id,ip_hash,user_agent)
       VALUES (?,?,?,?,?,?,?)'
    );
    $stmt->execute([
      'pageview',
      'pageview',
      substr($path, 0, 255),
      substr($_SERVER['HTTP_REFERER'] ?? '', 0, 255) ?: null,
      $_SESSION['sid'],
      $ipHash,
      substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 255),
    ]);
  } catch (Throwable $e) { /* never break the page */ }
}

// ---------- Artworks ----------
function fetch_artworks(?string $cat = null, ?string $sub = null): array {
  $sql = 'SELECT * FROM artworks WHERE 1=1';
  $args = [];
  if ($cat) { $sql .= ' AND category = ?'; $args[] = $cat; }
  if ($sub) { $sql .= ' AND sub_category = ?'; $args[] = $sub; }
  $sql .= ' ORDER BY created_at DESC';
  $stmt = db()->prepare($sql);
  $stmt->execute($args);
  return $stmt->fetchAll();
}
function fetch_artwork_by_slug(string $slug): ?array {
  $stmt = db()->prepare('SELECT * FROM artworks WHERE slug = ?');
  $stmt->execute([$slug]);
  return $stmt->fetch() ?: null;
}
