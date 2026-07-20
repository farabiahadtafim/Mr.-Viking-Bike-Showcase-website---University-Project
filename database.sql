-- ============================================================
-- MR. VIKING - Premium Motorcycle E-Commerce Platform
-- Database Schema & Seed Data
-- Version: 1.0.0
-- Engine: MySQL 5.7+ / MariaDB 10.3+
-- ============================================================

-- Create Database
CREATE DATABASE IF NOT EXISTS `MrViking_db`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `MrViking_db`;

-- ============================================================
-- 1. USERS TABLE
-- Core authentication & user profile storage.
-- First registered user is auto-assigned admin (is_admin = 1).
-- ============================================================
CREATE TABLE IF NOT EXISTS `users` (
    `id`                    INT AUTO_INCREMENT PRIMARY KEY,
    `first_name`            VARCHAR(50)   NOT NULL,
    `middle_name`           VARCHAR(50)   DEFAULT NULL,
    `last_name`             VARCHAR(50)   NOT NULL,
    `birth_date`            DATE          NOT NULL,
    `gender`                VARCHAR(20)   NOT NULL,
    `contact`               VARCHAR(100)  NOT NULL UNIQUE,
    `password`              VARCHAR(255)  NOT NULL,
    `is_admin`              TINYINT(1)    DEFAULT 0,
    `is_verified`           TINYINT(1)    DEFAULT 0,
    `otp_code`              VARCHAR(10)   DEFAULT NULL,
    `otp_expiry`            DATETIME      DEFAULT NULL,
    `two_factor_enabled`    TINYINT(1)    DEFAULT 0,
    `password_reset_token`  VARCHAR(100)  DEFAULT NULL,
    `password_reset_expiry` DATETIME      DEFAULT NULL,
    `profile_image`         VARCHAR(255)  DEFAULT NULL,
    `phone`                 VARCHAR(30)   DEFAULT NULL,
    `address`               TEXT          DEFAULT NULL,
    `nickname`              VARCHAR(100)  DEFAULT NULL,
    `created_at`            TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 2. PRODUCTS TABLE
-- Full motorcycle catalog: 18 MR. VIKING + 9 Honda = 27 products.
-- ============================================================
CREATE TABLE IF NOT EXISTS `products` (
    `id`          VARCHAR(100)  PRIMARY KEY,
    `brand`       VARCHAR(100)  DEFAULT 'MR. VIKING',
    `family`      VARCHAR(100)  DEFAULT NULL,
    `name`        VARCHAR(200)  NOT NULL,
    `description` TEXT          DEFAULT NULL,
    `thumbnail`   VARCHAR(255)  DEFAULT NULL,
    `priceBDT`    VARCHAR(50)   DEFAULT NULL,
    `cylinders`   VARCHAR(50)   DEFAULT NULL,
    `capacity`    VARCHAR(50)   DEFAULT NULL,
    `hp`          VARCHAR(50)   DEFAULT NULL,
    `topSpeed`    VARCHAR(50)   DEFAULT NULL,
    `weight`      VARCHAR(50)   DEFAULT NULL,
    `status`      VARCHAR(20)   DEFAULT 'Published',
    `stock`       INT           DEFAULT 10,
    `created_at`  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 3. ORDERS TABLE
-- Customer orders with status workflow.
-- ============================================================
CREATE TABLE IF NOT EXISTS `orders` (
    `order_id`      INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`       INT           DEFAULT NULL,
    `customer_name` VARCHAR(150)  DEFAULT NULL,
    `phone`         VARCHAR(50)   DEFAULT NULL,
    `address`       TEXT          DEFAULT NULL,
    `total_price`   BIGINT        DEFAULT NULL,
    `status`        ENUM('Pending','Approved','Rejected','Delivered')
                                  DEFAULT 'Pending',
    `created_at`    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 4. ORDER ITEMS TABLE
-- Line items for each order.
-- ============================================================
CREATE TABLE IF NOT EXISTS `order_items` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `order_id`   INT           DEFAULT NULL,
    `product_id` VARCHAR(100)  DEFAULT NULL,
    `quantity`   INT           DEFAULT 1,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`order_id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 5. NEWS / BLOG POSTS TABLE
-- Admin-managed news articles.
-- ============================================================
CREATE TABLE IF NOT EXISTS `news_posts` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `title`      VARCHAR(300)  NOT NULL,
    `content`    TEXT          NOT NULL,
    `image`      VARCHAR(255)  DEFAULT NULL,
    `created_at` TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 6. LOGIN ATTEMPTS TABLE
-- Brute-force protection tracking.
-- ============================================================
CREATE TABLE IF NOT EXISTS `login_attempts` (
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `id_source`     VARCHAR(100)  NOT NULL,
    `attempt_time`  TIMESTAMP     DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ============================================================
-- 7. COMMUNITY POSTS TABLE
-- User-generated content: News, Reviews, User Posts.
-- ============================================================
CREATE TABLE IF NOT EXISTS `community_posts` (
    `id`            INT AUTO_INCREMENT PRIMARY KEY,
    `user_id`       INT           NOT NULL,
    `type`          ENUM('News','Review','User Post') DEFAULT 'User Post',
    `content`       TEXT          NOT NULL,
    `media_url`     VARCHAR(255)  DEFAULT NULL,
    `bike_id`       VARCHAR(100)  DEFAULT NULL,
    `rating`        TINYINT       DEFAULT NULL,
    `is_pinned`     TINYINT(1)    DEFAULT 0,
    `status`        ENUM('Published','Hidden','Archived') DEFAULT 'Published',
    `fake_likes`    INT           DEFAULT 0,
    `fake_comments` INT           DEFAULT 0,
    `fake_shares`   INT           DEFAULT 0,
    `created_at`    TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_user`   (`user_id`),
    INDEX `idx_type`   (`type`),
    INDEX `idx_bike`   (`bike_id`)
) ENGINE=InnoDB;

-- ============================================================
-- 8. POST REACTIONS TABLE
-- 7 reaction types: Like, Love, Care, Haha, Wow, Sad, Angry.
-- ============================================================
CREATE TABLE IF NOT EXISTS `post_reactions` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `post_id`    INT       NOT NULL,
    `user_id`    INT       NOT NULL,
    `type`       ENUM('Like','Love','Care','Haha','Wow','Sad','Angry')
                           NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY `unique_user_post_reaction` (`post_id`, `user_id`),
    FOREIGN KEY (`post_id`) REFERENCES `community_posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 9. POST COMMENTS TABLE
-- Supports nested comments via parent_id.
-- ============================================================
CREATE TABLE IF NOT EXISTS `post_comments` (
    `id`         INT AUTO_INCREMENT PRIMARY KEY,
    `post_id`    INT       NOT NULL,
    `parent_id`  INT       DEFAULT NULL,
    `user_id`    INT       NOT NULL,
    `content`    TEXT      NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX `idx_post`   (`post_id`),
    INDEX `idx_parent` (`parent_id`),
    FOREIGN KEY (`post_id`) REFERENCES `community_posts`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;

-- ============================================================
-- 10. SEED DATA: Products (27 motorcycles)
-- ============================================================
INSERT INTO `products` (`id`, `brand`, `family`, `name`, `description`, `thumbnail`, `priceBDT`, `cylinders`, `capacity`, `hp`) VALUES
-- MR. VIKING - BRUTALE Family (5)
('brutale-1000-rr-assen', 'MR. VIKING', 'BRUTALE', 'Brutale 1000 RR Assen',
 'Limited Edition — Only 300 numbered units.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR ASSEN.webp',
 '9,500,000', '4', '998', '208'),

('brutale-1000-rr', 'MR. VIKING', 'BRUTALE', 'Brutale 1000 RR',
 'The hyper-naked benchmark.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RR.webp',
 '8,800,000', '4', '998', '208'),

('brutale-1000-rs', 'MR. VIKING', 'BRUTALE', 'Brutale 1000 RS',
 'Evolved performance for the road.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 1000 RS.webp',
 '7,500,000', '4', '998', '208'),

('brutale-800', 'MR. VIKING', 'BRUTALE', 'Brutale 800',
 'The three-cylinder icon.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE 800.webp',
 '4,500,000', '3', '798', '140'),

('brutale-rr-80', 'MR. VIKING', 'BRUTALE', 'Brutale RR Ottantesimo',
 'Celebrating 80 years of MR. VIKING.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/BRUTALE RR OTTANTESIMO.webp',
 '5,200,000', '3', '798', '140'),

-- MR. VIKING - DRAGSTER Family (1)
('dragster-rr-80', 'MR. VIKING', 'DRAGSTER', 'Dragster RR Ottantesimo',
 'Pure rebellious spirit.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/DRAGSTER RR OTTANTESIMO.webp',
 '5,500,000', '3', '798', '140'),

-- MR. VIKING - ENDURO VELOCE Family (2)
('enduro-veloce', 'MR. VIKING', 'ENDURO VELOCE', 'Enduro Veloce',
 'Adventure without limits.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE ENDURO VELOCE.webp',
 '6,200,000', '3', '931', '124'),

('enduro-veloce-lxp', 'MR. VIKING', 'ENDURO VELOCE', 'Enduro Veloce LXP Orioli',
 'Ultimate off-road exploration.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/ENDURO VELOCE  LXP ORIOLI.png',
 '7,000,000', '3', '931', '124'),

-- MR. VIKING - F3 Family (3)
('f3-competizione', 'MR. VIKING', 'F3', 'F3 Competizione',
 'Racing DNA at its finest.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 COMPETIZIONE.webp',
 '8,200,000', '3', '798', '160'),

('f3-r', 'MR. VIKING', 'F3', 'F3 R',
 'The essence of supersport.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 R.png',
 '5,500,000', '3', '798', '147'),

('f3-rr', 'MR. VIKING', 'F3', 'F3 RR',
 'Aerodynamic perfection.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/F3 RR.webp',
 '6,500,000', '3', '798', '147'),

-- MR. VIKING - RUSH Family (1)
('rush-mamba', 'MR. VIKING', 'RUSH', 'Rush Mamba',
 'The world''s most aggressive naked bike.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/RUSH Mamba.webp',
 '12,000,000', '4', '998', '208'),

-- MR. VIKING - SUPERVELOCE Family (4)
('superveloce-1000-ago', 'MR. VIKING', 'SUPERVELOCE', 'Superveloce 1000 Ago',
 'A tribute to Giacomo Agostini.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 1000 AGO.webp',
 '15,000,000', '4', '998', '208'),

('superveloce-1000-oro', 'MR. VIKING', 'SUPERVELOCE', 'Superveloce 1000 Serie Oro',
 'Motorcycle art in gold.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 1000 SERIE ORO.webp',
 '18,000,000', '4', '998', '208'),

('superveloce-98', 'MR. VIKING', 'SUPERVELOCE', 'Superveloce 98 Edition',
 'Heritage reimagined.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE 98.png',
 '7,000,000', '3', '798', '148'),

('superveloce-s', 'MR. VIKING', 'SUPERVELOCE', 'Superveloce S',
 'Classic beauty meets modern tech.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SUPERVELOCE S.webp',
 '6,800,000', '3', '798', '148'),

-- MR. VIKING - TURISMO VELOCE Family (3)
('turismo-veloce-r', 'MR. VIKING', 'TURISMO VELOCE', 'Turismo Veloce R',
 'Fast touring excellence.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE  R.png',
 '5,800,000', '3', '798', '110'),

('turismo-veloce-lusso', 'MR. VIKING', 'TURISMO VELOCE', 'Turismo Veloce Lusso SCS',
 'The ultimate road voyager.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE LUSSO SCS.webp',
 '6,500,000', '3', '798', '110'),

('turismo-veloce-r-scs', 'MR. VIKING', 'TURISMO VELOCE', 'Turismo Veloce R SCS',
 'Dynamic touring performance.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/TURISMO VELOCE R SCS.webp',
 '6,200,000', '3', '798', '110'),

-- HONDA - SCOOTER (1)
('honda-dio', 'HONDA', 'SCOOTER', 'Honda Dio',
 'Smart and sporty urban scooter.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/DIO  Pearl Igneous Black.png',
 '199,000', '1', '110', '8'),

-- HONDA - COMMUTER (4)
('honda-dream', 'HONDA', 'COMMUTER', 'Honda Dream 110',
 'Reliable and fuel-efficient performance.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/Dream 110 Red.png',
 '121,000', '1', '110', '8'),

('honda-livo', 'HONDA', 'COMMUTER', 'Honda Livo CBS',
 'Style meets economy.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/Honda Livo CBS Imperial Red Metallic.png',
 '145,000', '1', '110', '8'),

('honda-sp125', 'HONDA', 'COMMUTER', 'Honda SP 125',
 'The advanced commuter.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SP 125 Matt Marvel Blue.png',
 '167,000', '1', '125', '10'),

('honda-shine', 'HONDA', 'COMMUTER', 'Honda Shine 100',
 'Basic commuting at its best.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/Shine 100 Red.png',
 '111,000', '1', '100', '7'),

-- HONDA - SPORT (3)
('honda-hornet', 'HONDA', 'SPORT', 'Honda Hornet 2.0',
 'Muscular performance with USD forks.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/Hornet 2.0 Pearl Igneous Black.png',
 '289,000', '1', '184', '17'),

('honda-sp160', 'HONDA', 'SPORT', 'Honda SP 160',
 'Comfortable sport riding.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/SP160 Pearl igneous Black.png',
 '225,000', '1', '160', '13'),

('honda-xblade', 'HONDA', 'SPORT', 'Honda X-Blade',
 'Sharp design, capable performance.',
 'images/MR. VIKING - About Us - MR. VIKING/All Bikes/X-Blade Pearl Spartan red.png',
 '240,000', '1', '160', '13');