-- Vivid Lanka — MySQL schema (XAMPP-ready)
-- Create database first:  CREATE DATABASE vivid_lanka CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

SET NAMES utf8mb4;
SET time_zone = '+00:00';

CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  email         VARCHAR(190) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  name          VARCHAR(120) NOT NULL,
  role          ENUM('admin','moderator') NOT NULL DEFAULT 'moderator',
  created_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS artworks (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  slug            VARCHAR(190) NOT NULL UNIQUE,
  title           VARCHAR(190) NOT NULL,
  category        ENUM('photography','drawings','crafts') NOT NULL,
  sub_category    ENUM('travel','street','wildlife','ink','pencil','wood','weave') NOT NULL,
  tags            VARCHAR(500) NULL,
  price           DECIMAL(10,2) NOT NULL,
  image_url       VARCHAR(500) NOT NULL,
  description     TEXT NULL,
  story           TEXT NULL,
  edition_current INT UNSIGNED NOT NULL DEFAULT 0,
  edition_total   INT UNSIGNED NOT NULL DEFAULT 0,
  is_limited      TINYINT(1) NOT NULL DEFAULT 0,
  is_digital      TINYINT(1) NOT NULL DEFAULT 0,
  sale_ends_at    DATETIME NULL,
  created_at      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_category (category),
  INDEX idx_sub      (sub_category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS testimonials (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(120) NOT NULL,
  location    VARCHAR(120) NULL,
  rating      TINYINT UNSIGNED NOT NULL DEFAULT 5,
  message     TEXT NOT NULL,
  status      ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS feedback (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name        VARCHAR(120) NOT NULL,
  email       VARCHAR(190) NOT NULL,
  subject     VARCHAR(190) NULL,
  message     TEXT NOT NULL,
  created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS orders (
  id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  reference        VARCHAR(40) NOT NULL UNIQUE,
  customer_name    VARCHAR(190) NOT NULL,
  customer_email   VARCHAR(190) NOT NULL,
  shipping_address TEXT NULL,
  total            DECIMAL(10,2) NOT NULL,
  currency         CHAR(3) NOT NULL DEFAULT 'USD',
  status           ENUM('pending','paid','shipped','delivered','cancelled','refunded') NOT NULL DEFAULT 'pending',
  created_at       DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS order_items (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  order_id    INT UNSIGNED NOT NULL,
  artwork_id  INT UNSIGNED NOT NULL,
  title       VARCHAR(190) NOT NULL,
  unit_price  DECIMAL(10,2) NOT NULL,
  quantity    INT UNSIGNED NOT NULL DEFAULT 1,
  CONSTRAINT fk_oi_order   FOREIGN KEY (order_id)   REFERENCES orders(id)   ON DELETE CASCADE,
  CONSTRAINT fk_oi_artwork FOREIGN KEY (artwork_id) REFERENCES artworks(id) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS analytics_events (
  id          BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  type        VARCHAR(20) NOT NULL,
  name        VARCHAR(60) NOT NULL,
  path        VARCHAR(255) NOT NULL,
  referrer    VARCHAR(255) NULL,
  session_id  VARCHAR(64) NOT NULL,
  ip_hash     CHAR(64) NULL,
  user_agent  VARCHAR(255) NULL,
  created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_path (path),
  INDEX idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Default admin: admin@vividlanka.com / ChangeMe123!
INSERT INTO users (email, password_hash, name, role) VALUES
('admin@vividlanka.com',
 '$2b$10$D8ctMmSovxEl7IjH8fv4HOPkzWFP38yd7XhpO7rnhHzP0OxdoUdiq',
 'Studio Admin',
 'admin')
ON DUPLICATE KEY UPDATE email = email;

-- Sample artworks (10) — replace image_url with your uploads
INSERT INTO artworks (slug,title,category,sub_category,tags,price,image_url,description,story,edition_current,edition_total,is_limited,is_digital) VALUES
('stilt-fisherman-dawn','Stilt Fisherman, Dawn','photography','travel','Coastal,Golden Hour,Print',480,'assets/images/art-fisherman.jpg','Archival pigment print on Hahnemühle Photo Rag. Signed and numbered.','Captured at 5:42 a.m. off the southern coast near Weligama.',7,25,1,0),
('elephant-yala','Tusker at Yala','photography','wildlife','Wildlife,Print',520,'assets/images/art-elephant.jpg','Limited edition wildlife print.','A lone tusker emerging from morning mist in Yala National Park.',3,15,1,0),
('tea-pickers','Tea Pickers, Nuwara Eliya','photography','travel','Hill Country,Print',390,'assets/images/art-tea.jpg','Signed archival print.','Hands that have shaped a century of harvests.',5,20,1,0),
('pettah-street','Pettah, Midday','photography','street','Street,Color',310,'assets/images/art-street.jpg','Open edition fine-art print.','The chaos and music of Colombo at noon.',0,0,0,0),
('peacock-feather','Peacock Feather Study','drawings','ink','Ink,Detail',260,'assets/images/art-peacock.jpg','Original ink drawing on cotton paper.','Hand-drawn over six weeks of evenings.',1,1,1,0),
('coastal-portrait','Coastal Portrait','drawings','pencil','Portrait,Pencil',290,'assets/images/art-portrait.jpg','Pencil portrait, signed.','A neighbour from Mirissa.',1,1,1,0),
('kolam-mask','Kolam Mask, Hand-Carved','crafts','wood','Wood,Heritage',640,'assets/images/art-mask.jpg','Hand-carved kaduru wood, traditional Kolam mask.','Carved by master artisan in Ambalangoda over four weeks.',2,5,1,0),
('weave-mat','Palmyra Weave','crafts','weave','Weave,Heritage',180,'assets/images/art-craft.jpg','Hand-woven palmyra mat.','Made by weavers in Jaffna.',8,30,1,0),
('sigiriya-rising','Sigiriya Rising','photography','travel','Heritage,Print',440,'assets/images/art-sigiriya.jpg','Signed print of the lion rock.','Shot from the gardens at first light.',6,20,1,0),
('leopard-wilpattu','Leopard, Wilpattu','photography','wildlife','Wildlife,Print',560,'assets/images/art-leopard.jpg','Limited edition wildlife print.','Eye contact for less than two seconds.',2,12,1,0)
ON DUPLICATE KEY UPDATE slug=slug;
