# Vivid Lanka — PHP / MySQL Edition

Plain HTML + CSS + JavaScript frontend with PHP/MySQL backend. Runs on XAMPP, any LAMP stack, or shared hosting (cPanel).

## Quick start (XAMPP)

1. Copy this whole folder into `C:/xampp/htdocs/vivid-lanka/`
2. Start **Apache** and **MySQL** in XAMPP Control Panel
3. Open phpMyAdmin → create a new database called **`vivid_lanka`** (utf8mb4)
4. Import `database.sql` into that database
5. Open `includes/config.php` and confirm DB credentials (default XAMPP: user `root`, no password)
6. Visit http://localhost/vivid-lanka/

## Default admin

- URL:      http://localhost/vivid-lanka/admin/login.php
- Email:    `admin@vividlanka.com`
- Password: `ChangeMe123!`

**Change the password immediately after first login.**

## Folder structure

```
vivid-lanka/
├── index.php                # Home
├── shop.php                 # Gallery
├── product.php              # Single artwork
├── artist.php               # Chamara Sulakkhana bio
├── awards.php               # Awards & honours
├── about.php
├── contact.php
├── testimonials.php
├── faq.php
├── cart.php
├── checkout.php
├── privacy.php
├── terms.php
├── returns.php
├── 404.php
├── database.sql
├── assets/
│   ├── css/style.css
│   ├── js/main.js
│   └── images/
├── includes/
│   ├── config.php           # DB + site config
│   ├── db.php               # PDO connection
│   ├── header.php
│   ├── footer.php
│   ├── functions.php        # helpers, auth, CSRF
│   └── seo.php
├── api/                     # JSON endpoints (cart, contact, testimonials)
├── admin/                   # Admin panel (login required)
└── uploads/                 # User-uploaded artwork images
```

## Security features included

- **PDO prepared statements** everywhere (no SQL injection)
- **bcrypt** password hashing (`password_hash` / `password_verify`)
- **CSRF tokens** on every POST form
- **Session-based auth** with httpOnly + SameSite cookies
- **Output escaping** via `e()` helper to prevent XSS
- **Role-based access** (admin / moderator)
- `.htaccess` blocks direct access to `/includes/` and `/uploads/*.php`

## SEO features included

- Per-page `<title>` and `<meta description>`
- Open Graph + Twitter card tags
- JSON-LD structured data (Person / Product / BreadcrumbList)
- Semantic HTML5 (`<main> <article> <nav> <header> <footer>`)
- Auto-generated `sitemap.xml` (visit `/sitemap.php` once to regenerate)
- `robots.txt`
- Single `<h1>` per page, descriptive alt text
- Canonical URLs

## Analytics

First-party pageview tracking writes to the `analytics_events` table (no cookies, IPs are SHA-256 hashed). View stats in admin panel.

