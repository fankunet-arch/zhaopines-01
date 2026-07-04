-- =============================================================
-- 迁移：管理员分级 + 普通管理员发券授权开关
-- 适用：已按旧版 schema.sql 建库的环境；新建库直接用最新 schema.sql 即可
-- =============================================================
SET NAMES utf8mb4;

-- 管理员角色：1=普通管理员（信息/类别/举报/失效） 2=超级管理员（另含参数配置/管理员管理/置顶券）
ALTER TABLE zhaopin_admins
  ADD COLUMN role TINYINT UNSIGNED NOT NULL DEFAULT 1 AFTER email;

-- 把第一位（或指定邮箱的）管理员提升为超级管理员——邮箱换成你的：
-- UPDATE zhaopin_admins SET role = 2 WHERE email = 'admin@example.com';

-- 普通管理员是否有权生成/管理置顶券（0=否 1=是；超级管理员在后台"管理员"页可切换）
INSERT INTO zhaopin_settings (skey, svalue, updated_at)
VALUES ('normal_admin_can_coupon', '0', UTC_TIMESTAMP())
ON DUPLICATE KEY UPDATE skey = skey;
