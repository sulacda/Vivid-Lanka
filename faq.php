<?php require_once __DIR__ . '/includes/functions.php';
$page_seo = ['title'=>'FAQ · Vivid Lanka','description'=>'Frequently asked questions about ordering, shipping and editions.'];
require __DIR__ . '/includes/header.php';
$qs = [
  ['How are works shipped?', 'All works ship from Ambalangoda, Sri Lanka via tracked international courier. Allow 7–14 business days.'],
  ['Are the prints signed?', 'Every photographic and drawn work is hand-signed and numbered by the artist on the reverse.'],
  ['Can I commission a piece?', 'Yes. Use the contact form to start a conversation about a custom commission.'],
  ['What is your return policy?', 'See our Returns page — works can be returned within 14 days in original condition.'],
];
?>
<header class="page-header wrap"><p class="eyebrow">Help</p><h1>Frequently asked <em>questions</em></h1></header>
<div class="wrap" style="max-width:780px; padding-bottom:6rem">
<?php foreach ($qs as [$q,$a]): ?>
  <details style="border-bottom:1px solid var(--line); padding:1.5rem 0">
    <summary style="font-family:var(--serif); font-size:1.5rem; cursor:pointer"><?= e($q) ?></summary>
    <p style="margin-top:1rem; color:var(--ink-soft)"><?= e($a) ?></p>
  </details>
<?php endforeach; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
