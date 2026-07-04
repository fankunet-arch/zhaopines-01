-- =============================================================
-- 西华招聘 zhaopin.es — 建库 DDL（MySQL 8.4 / 8.x）
-- 来源：docs/03_数据库设计.md §5（定稿 v1.0）
-- 执行顺序：schema.sql → seed_regions.sql → seed_categories.sql
--          → 手工插入第一位管理员（见文件末尾示例）
-- 约定：InnoDB / utf8mb4 / utf8mb4_0900_ai_ci；时间统一存 UTC；
--       内部自增主键永不外露，对外用随机 public_code
-- =============================================================

-- 建议先创建独立库（名称/账号按部署环境调整）：
-- CREATE DATABASE zhaopin DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
-- USE zhaopin;

SET NAMES utf8mb4;

CREATE TABLE zhaopin_regions (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  parent_id INT UNSIGNED NOT NULL DEFAULT 0,
  name VARCHAR(50) NOT NULL,
  level TINYINT UNSIGNED NOT NULL,
  sort INT NOT NULL DEFAULT 0,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (id),
  KEY idx_parent (parent_id, status, sort)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_categories (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  sort INT NOT NULL DEFAULT 0,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_name (name),
  KEY idx_status_sort (status, sort)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_categories_pending (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  name VARCHAR(30) NOT NULL,
  submit_ip VARBINARY(16) DEFAULT NULL,
  user_id BIGINT UNSIGNED DEFAULT NULL,
  status TINYINT UNSIGNED NOT NULL DEFAULT 0,
  submitted_at DATETIME NOT NULL,
  reviewed_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  public_code CHAR(8) NOT NULL,
  google_sub VARCHAR(64) NOT NULL,
  display_name VARCHAR(60) DEFAULT NULL,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  last_login_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_google_sub (google_sub),
  UNIQUE KEY uk_public_code (public_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_admins (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  role TINYINT UNSIGNED NOT NULL DEFAULT 1, -- 1=普通管理员 2=超级管理员
  google_sub VARCHAR(64) DEFAULT NULL,
  display_name VARCHAR(60) DEFAULT NULL,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_posts (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  public_code CHAR(10) NOT NULL,
  type TINYINT UNSIGNED NOT NULL,
  content VARCHAR(1000) NOT NULL,
  content_hash CHAR(64) NOT NULL,
  contact_name VARCHAR(50) NOT NULL,
  phone VARCHAR(30) NOT NULL,
  phone_norm VARCHAR(20) NOT NULL,
  wechat VARCHAR(60) DEFAULT NULL,
  region_id INT UNSIGNED NOT NULL,
  category_id INT UNSIGNED NOT NULL,
  poster_type TINYINT UNSIGNED NOT NULL,
  user_id BIGINT UNSIGNED DEFAULT NULL,
  is_top TINYINT UNSIGNED NOT NULL DEFAULT 0,
  top_expire_at DATETIME DEFAULT NULL,
  invalid_count INT UNSIGNED NOT NULL DEFAULT 0,
  phone_views INT UNSIGNED NOT NULL DEFAULT 0,
  wechat_views INT UNSIGNED NOT NULL DEFAULT 0,
  report_count INT UNSIGNED NOT NULL DEFAULT 0,
  suspicious TINYINT UNSIGNED NOT NULL DEFAULT 0,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  post_ip VARBINARY(16) DEFAULT NULL,
  created_at DATETIME NOT NULL,
  bumped_at DATETIME NOT NULL,
  updated_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_public_code (public_code),
  KEY idx_browse (type, status, is_top, bumped_at),
  KEY idx_browse_cat (type, status, category_id, bumped_at),
  KEY idx_browse_region (type, status, region_id, bumped_at),
  KEY idx_dedup (phone_norm, content_hash),
  KEY idx_user (user_id, status),
  KEY idx_top (is_top, top_expire_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_reports (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id BIGINT UNSIGNED NOT NULL,
  reason VARCHAR(200) DEFAULT NULL,
  reporter_ip VARBINARY(16) DEFAULT NULL,
  status TINYINT UNSIGNED NOT NULL DEFAULT 0,
  created_at DATETIME NOT NULL,
  handled_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  KEY idx_post (post_id),
  KEY idx_status (status),
  KEY idx_dedup (post_id, reporter_ip, created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_coupons (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  code VARCHAR(20) NOT NULL,
  top_days SMALLINT UNSIGNED NOT NULL,
  valid_until DATETIME NOT NULL,
  status TINYINT UNSIGNED NOT NULL DEFAULT 0,
  user_id BIGINT UNSIGNED DEFAULT NULL,
  post_id BIGINT UNSIGNED DEFAULT NULL,
  created_by INT UNSIGNED DEFAULT NULL,
  created_at DATETIME NOT NULL,
  redeemed_at DATETIME DEFAULT NULL,
  used_at DATETIME DEFAULT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_code (code),
  KEY idx_user (user_id, status),
  KEY idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_invalid_marks (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id BIGINT UNSIGNED NOT NULL,
  marker_ip VARBINARY(16) NOT NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_post_ip (post_id, marker_ip),
  KEY idx_post (post_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_keywords (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  word VARCHAR(50) NOT NULL,
  type TINYINT UNSIGNED NOT NULL DEFAULT 1,
  status TINYINT UNSIGNED NOT NULL DEFAULT 1,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uk_word (word),
  KEY idx_type_status (type, status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_settings (
  skey VARCHAR(64) NOT NULL,
  svalue TEXT,
  updated_at DATETIME DEFAULT NULL,
  PRIMARY KEY (skey)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE zhaopin_contact_log (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  post_id BIGINT UNSIGNED NOT NULL,
  contact_type TINYINT UNSIGNED NOT NULL,
  viewer_ip VARBINARY(16) NOT NULL,
  created_at DATETIME NOT NULL,
  PRIMARY KEY (id),
  KEY idx_ip_time (viewer_ip, created_at),
  KEY idx_post_type (post_id, contact_type)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- -------------------------------------------------------------
-- 参数表初始值（docs/03 §3.11 建议默认值，后台"参数配置"可改）
-- -------------------------------------------------------------
INSERT INTO zhaopin_settings (skey, svalue, updated_at) VALUES
('post_expire_days',        '30',  UTC_TIMESTAMP()),
('backfill_n_recruit',      '30',  UTC_TIMESTAMP()),
('backfill_n_seek',         '30',  UTC_TIMESTAMP()),
('daily_post_limit',        '1',   UTC_TIMESTAMP()),
('bump_window_days',        '7',   UTC_TIMESTAMP()),
('top_slot_limit',          '5',   UTC_TIMESTAMP()),
('report_dedup_window_min', '60',  UTC_TIMESTAMP()),
('report_email_merge_min',  '60',  UTC_TIMESTAMP()),
('report_recipients',       '[]',  UTC_TIMESTAMP()),
('invalid_threshold',       '5',   UTC_TIMESTAMP()),
('contact_reveal_per_hour', '30',  UTC_TIMESTAMP()),
('post_per_hour_per_ip',    '5',   UTC_TIMESTAMP()),
('field_name_map', '{"type":"f_01","content":"f_02","contact_name":"f_03","phone":"f_04","wechat":"f_05","region_id":"f_06","category_id":"f_07","new_category":"f_08","captcha":"f_09"}', UTC_TIMESTAMP()),
('normal_admin_can_coupon',  '0',   UTC_TIMESTAMP());

-- -------------------------------------------------------------
-- 第一位管理员（Google 邮箱白名单，role=2 超级管理员）。
-- 上线前把邮箱换成真实管理员：
-- INSERT INTO zhaopin_admins (email, role, status, created_at)
-- VALUES ('admin@example.com', 2, 1, UTC_TIMESTAMP());
-- -------------------------------------------------------------
