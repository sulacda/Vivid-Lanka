<?php
// Site configuration â€” edit these values for your environment.

return [
  'site' => [
    'name'        => 'Vivid Lanka',
    'tagline'     => 'Hand-signed art from Sri Lanka',
    'url'         => 'http://localhost/vivid-lanka',  // change in production
    'email'       => 'studio@vividlanka.com',
    'currency'    => 'USD',
    'currency_symbol' => '$',
  ],
  'db' => [
    'host'     => '127.0.0.1',
    'name'     => 'vivid_lanka',
    'user'     => 'root',
    'password' => '',                // XAMPP default is empty
    'charset'  => 'utf8mb4',
  ],
  'security' => [
    'session_name' => 'vl_session',
    'csrf_key'     => 'vl_csrf',
    // Used to hash visitor IPs for analytics (so raw IPs are never stored).
    'ip_salt'      => 'change-me-to-a-long-random-string',
  ],
];
