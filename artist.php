<?php
require_once __DIR__ . '/includes/functions.php';
$page_seo = [
  'title' => 'Chamara Sulakkhana — Artist · Vivid Lanka',
  'description' => 'From a curious child to an award-winning photographer. The story of Chamara Sulakkhana, based in Ambalangoda, Sri Lanka.',
  'jsonld' => [
    '@context' => 'https://schema.org',
    '@type'    => 'Person',
    'name'     => 'Chamara Sulakkhana',
    'jobTitle' => 'Photographer',
    'address'  => ['@type' => 'PostalAddress', 'addressLocality' => 'Ambalangoda', 'addressCountry' => 'LK'],
    'url'      => url('artist.php'),
  ],
];
require __DIR__ . '/includes/header.php';
?>
<header class="page-header wrap">
  <p class="eyebrow">The Artist</p>
  <h1>Chamara <em>Sulakkhana</em></h1>
  <p class="lead">Ambalangoda, Sri Lanka · Photographer</p>
</header>

<article class="wrap" style="max-width:780px; padding-bottom:6rem">
  <h2 style="color:var(--gold); font-style:italic">From Curious Child to Award-Winning Photographer</h2>

  <h3>Early Encounters</h3>
  <p class="dropcap">A curious child, I explored the world around me, fascinated by nature's wonders, from buzzing insects to soaring birds. Overcoming my fear of snakes by holding a gentle "Depath Naya" was a turning point, sparking a lifelong love for the natural world.</p>

  <h3>Igniting the Passion</h3>
  <p>A school field trip with my father, an Advanced Level teacher, opened my eyes to the vast ecosystems I yearned to explore. Years of travel fueled my passion for nature photography.</p>

  <h3>The Journey Begins</h3>
  <p>At 15, I saved up for my first camera, the Kodak KB10. The excitement of capturing memories, even with the challenges of film, ignited a spark. From my Sony Ericsson phone's 2MP camera to the Sony DSC-W570, each step fueled my learning.</p>

  <h3>Embracing Learning</h3>
  <p>Social media became my gateway to learning photography. In 2014, I proudly acquired my first DSLR, the Nikon D90. Wildlife photography captured my heart, but the intricate world of macro soon mesmerized me. DIY solutions like cardboard light diffusers and extension tubes fueled my creativity.</p>

  <h3>Formal Education</h3>
  <p>Seeking deeper knowledge, I enrolled in the Hegoda School of Photography in 2015, earning my diploma in 2016. Mr. Hegoda's guidance instilled the artistic soul of photography in me. I further explored the scientific side at the Institute of Multimedia Education, a journey that continues to this day.</p>

  <h3>Sharing the Knowledge</h3>
  <p>Workshops became my platform to share my passion and empower aspiring photographers. Each click, each lesson learned, strengthened my own journey.</p>

  <h3>Travels and Accolades</h3>
  <p>From Sri Lanka's breathtaking landscapes to hidden wonders, my travels fueled my creativity. My journey is documented in detailed blog posts, while award-winning photographs stand as testaments to my dedication.</p>

  <h3>Beyond the Lens</h3>
  <p>Photography is more than just capturing images; it's a way of life, a constant exploration of the world around me.</p>

  <div class="divider"></div>
  <p class="center"><a href="<?= e(url('awards.php')) ?>" class="btn btn-ghost">View Awards & Honours</a></p>
</article>
<?php require __DIR__ . '/includes/footer.php'; ?>
