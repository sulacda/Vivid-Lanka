<?php
require_once __DIR__ . '/../includes/functions.php';
header('Content-Type: application/json');
$action = $_GET['action'] ?? '';
$body = json_decode(file_get_contents('php://input'), true) ?: [];

if (!csrf_check()) { http_response_code(403); echo json_encode(['error'=>'CSRF']); exit; }

if ($action === 'add') {
  $id = (int)($body['id'] ?? 0);
  $q  = max(1, (int)($body['quantity'] ?? 1));
  $stmt = db()->prepare('SELECT id FROM artworks WHERE id = ?');
  $stmt->execute([$id]);
  if (!$stmt->fetch()) { http_response_code(404); echo json_encode(['error'=>'Not found']); exit; }
  $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $q;
  echo json_encode(['ok'=>true, 'count'=>cart_count()]);
  exit;
}
http_response_code(400);
echo json_encode(['error'=>'Unknown action']);
