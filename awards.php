<?php
require_once __DIR__ . '/includes/functions.php';
$page_seo = [
  'title' => 'Awards & Honours — Chamara Sulakkhana · Vivid Lanka',
  'description' => 'A decade of recognition: national and international photography awards, exhibitions and honours earned by Chamara Sulakkhana between 2016 and 2025.',
];

$awards = [
  '2025' => [
    ['org' => "'Soba Seya' 2025 — Photography Competition (World Environment Day) · Ministry of Environment", 'lines' => ['<b>3rd Place</b>']],
    ['org' => 'PIXEL RIVALRY 2025 — Royal College Photographic Society, Sri Lanka', 'lines' => ['<b>02 Acceptances</b> — International Open Mono', '<b>Acceptance</b> — International Mobile Phone']],
    ['org' => 'ECO-CHAYA Photography Competition on Planetary Health 2025 — University of Colombo', 'lines' => ['<b>1st Place</b> — Sustainable Lifestyles', '<b>2nd Place</b> — Pollution and Human Well-being', '<b>02 Acceptances</b> — Biodiversity, Ecosystems & Climate Change']],
    ['org' => 'IOBSL e-Photography Competition 2025 — Institute of Biology Sri Lanka', 'lines' => ['<b>The Best Biology Photographer of the Year</b> — 18 years and over']],
    ['org' => 'DJMPC 2025 — 14th DJ Memorial Photography Contest', 'lines' => ['<b>Exhibit</b> — Wild Portraits']],
    ['org' => "SANROOPANA 2025 — Infocuor, Faculty of Science, University of Ruhuna", 'lines' => ['<b>2nd Place</b> — Open Nature', '<b>Merit</b> — Open Nature', '<b>Merit</b> — Open Monochrome', '<b>Acceptance</b> — Open Monochrome', '<b>Acceptance</b> — Mobile']],
    ['org' => 'Flutter Shutter — Dilmah Conservation', 'lines' => ['<b>Top 50</b> — Butterfly Photography']],
    ['org' => "Captures '25 — Rotaract Club of University of Peradeniya & perabeats", 'lines' => ['<b>3rd Place</b> — Nature & Wildlife', '<b>Best Finalist</b> — Nature & Wildlife', '<b>Best Finalist</b> — Street Photography']],
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 29 Certificates', '<b>Annual Contest</b> — Top 50 Sri Lanka, Top 300 Macro Nomination, 2nd Stage of voting']],
    ['org' => 'Capture The Wild — ZSJP Wildlife Photography Competition, University of Sri Jayewardenepura', 'lines' => ['<b>Winning Photograph</b> — Wildlife Macro', '<b>Winning Photograph</b> — Landscape']],
  ],
  '2024' => [
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 35 Certificates']],
    ['org' => "SPECULO '23 — Rajans Photography, Dharmaraja College, Kandy", 'lines' => ['<b>3rd Place</b> — Color Open', '<b>3rd Place</b> — Nature Open', '<b>02 Merits</b> — Mono Open', '<b>Merit</b> — Nature Open', '<b>Merit</b> — Street Open', '<b>02 Acceptances</b> — Color Open', '<b>Acceptance</b> — Street Open', '<b>Acceptance</b> — Mono Open']],
    ['org' => 'ROOPA 2023 — Image Arts Society, University of Kelaniya', 'lines' => ['<b>Merit</b> — Nature & Wildlife']],
    ['org' => '45th Annual Competition & Exhibition of Photography 2024 — National Photographic Art Society of Sri Lanka', 'lines' => ['<b>Merit Award</b> — Open Monochrome', '<b>Exhibit</b> — Open Nature & Wildlife', '<b>Acceptance</b> — Open Nature & Wildlife']],
    ['org' => "PILIBIBU '2024 — Photographic Art Society, Ananda College, Colombo 10", 'lines' => ['<b>02 Exhibits</b> — Open Color']],
    ['org' => "FOCUS EYE'24 — Photographic Art Society, Homagama Maha Vidyalaya", 'lines' => ['<b>Exhibit</b> — Mobile']],
    ['org' => 'The Royal Society of Biology — Photography Competition', 'lines' => ['<b>Photographer of the Year 2024</b> — Winner']],
    ['org' => 'World Sight Day 2024 — Arts Council of Sri Lanka', 'lines' => ['<b>Recognition</b> of 02 Photographs']],
    ['org' => "World Children's Day 2024 — Arts Council of Sri Lanka", 'lines' => ['<b>Recognition</b> of Photograph']],
  ],
  '2023' => [
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 30 Certificates', '<b>Annual Contest</b> — Top 70 Sri Lanka, 2nd Stage of voting']],
    ['org' => 'Centre for Environmental Studies & Sustainable Development — Open University of Sri Lanka', 'lines' => ['<b>3rd Place</b> — Open', '<b>Merit</b> — Open']],
    ['org' => 'IOBSL e-Photography Competition 2023', 'lines' => ['<b>Merit</b> — 18 years and over']],
  ],
  '2022' => [
    ['org' => '44th Annual Competition & Exhibition of Photography 2022 — National Photographic Art Society of Sri Lanka', 'lines' => ['<b>Merit Award</b> — Nature', '<b>Merit Award</b> — Travel', '<b>3 Acceptances</b> — Nature', '<b>Acceptance</b> — Color']],
    ['org' => 'Nature Paparazzi Photo Contest — Dilmah Conservation', 'lines' => ['<b>The Nature Paparazzi Award</b>']],
    ['org' => "EXTREMO '22 — Sabaragamuwa University of Sri Lanka", 'lines' => ['<b>Best Photograph</b> — Open']],
    ['org' => 'XVI Golden Turtle Photo Competition — Moscow & St. Petersburg', 'lines' => ['<b>Finalist</b> — Animal Behavior']],
    ['org' => 'VII Nature Photography Contest — The Stewardship Network', 'lines' => ['<b>Category Winner</b>']],
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 17 Certificates']],
    ['org' => "Nalanda Seya 2021 — Nalanda College Photographic Art Society", 'lines' => ['<b>Merit Award</b>']],
    ['org' => 'The Royal Society of Biology', 'lines' => ['<b>Photographer of the Year 2022</b> — Shortlisted']],
    ['org' => "'Soba Seya' 2022 — Ministry of Environment", 'lines' => ['<b>3rd Place</b>', '<b>Special Merit Award</b>', '<b>Merit Award</b>']],
    ['org' => 'Wild Sri Lanka Photographer of the Year 2022', 'lines' => ['<b>3 Acceptances</b>']],
    ['org' => "SPECULO '22 — Dharmaraja College, Kandy", 'lines' => ['<b>02 Merits</b> — Color', '<b>Merit</b> — Nature', '<b>Merit</b> — Mobile']],
  ],
  '2021' => [
    ['org' => "SPECULO '21 — Dharmaraja College, Kandy", 'lines' => ['<b>1st Place</b> — Open Nature', '<b>Merit</b> — Open Nature']],
    ['org' => 'State Festival of Photography — Department of Cultural Affairs', 'lines' => ['<b>2nd & 3rd Place</b> — Animal Behavior', '<b>Merit</b> — Nature', '<b>02 Merits</b> — Animal Portrait', '<b>Merit</b> — Animal Behavior', '<b>Merit</b> — Macro/Micro']],
    ['org' => 'BBC Wildlife Magazine — Monthly Competition', 'lines' => ['<b>Prize Winner</b> — March issue']],
    ['org' => "Soba Seya — Ministry of Environment", 'lines' => ['<b>02 Merits</b> — Nature']],
    ['org' => 'World Photography Awards 2021 — WCAO & NAPA', 'lines' => ['<b>Honorable Mentions</b> — Creative']],
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 14 Certificates', '<b>Annual Contest</b> — Top 35 Sri Lanka, Top 200 Macro, 2nd Stage of voting']],
    ['org' => 'VISTOSA 2021 — Photographic Art Society, Ramabima College', 'lines' => ['<b>Merit</b> — Color']],
  ],
  '2020' => [
    ['org' => 'V Golden Turtle Photo Competition — Moscow & St. Petersburg', 'lines' => ['<b>Finalist</b> — Macroworld']],
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 15 Certificates', '<b>Annual Contest</b> — Top 35 Sri Lanka, Top 200 Macro Nomination, Top 150 Macro']],
  ],
  '2019' => [
    ['org' => 'Nature E-Photo Contest — SLAAS', 'lines' => ['<b>Merit</b> — Nature']],
    ['org' => '35AWARDS — Moscow, Russia', 'lines' => ['<b>Thematic Contests</b> — 16 Certificates', '<b>Annual Contest</b> — Top 70 Sri Lanka, 2nd Stage of voting']],
  ],
  '2018' => [
    ['org' => 'State Festival of Photography — Department of Cultural Affairs', 'lines' => ['<b>Merit</b> — Wildlife and Landscape']],
  ],
  '2017' => [
    ['org' => 'Nethadara Annual Nature & Wildlife Photographic Competition — University of Moratuwa', 'lines' => ['<b>Second Runners-up</b> — Open']],
  ],
  '2016' => [
    ['org' => 'World Environment Day — BEEZ, Faculty of Science, University of Colombo', 'lines' => ['<b>2nd Place</b> — Theme: "Go Wild For Life"', '<b>2 Merits</b> — Theme: "Go Wild For Life"']],
  ],
];

require __DIR__ . '/includes/header.php';
?>
<header class="page-header wrap">
  <p class="eyebrow">A Decade of Recognition</p>
  <h1>Awards & <em>Honours</em></h1>
  <p class="lead">National and international recognition earned by Chamara Sulakkhana between 2016 and 2025.</p>
</header>

<div class="wrap">
<?php foreach ($awards as $year => $list): ?>
  <section class="year-block">
    <h2><?= e($year) ?></h2>
    <?php foreach ($list as $a): ?>
      <div class="award-item">
        <h4><?= e($a['org']) ?></h4>
        <ul>
          <?php foreach ($a['lines'] as $li): ?>
            <li><?= $li /* trusted, only <b> tags */ ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </section>
<?php endforeach; ?>
</div>
<?php require __DIR__ . '/includes/footer.php'; ?>
