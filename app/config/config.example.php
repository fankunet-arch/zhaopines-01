<?php
declare(strict_types=1);

/**
 * 机密配置模板。部署时复制为同目录 config.php 并填写真实值。
 * config.php 不入库、不进版本库（已在 .gitignore 排除）。
 */
return [
    'db' => [
        'host'   => '127.0.0.1',
        'port'   => 3306,
        'name'   => 'zhaopin',
        'user'   => 'zhaopin',
        'pass'   => '',
        'prefix' => 'zhaopin_',
    ],

    // Google OAuth（普通用户与管理员登录均用；管理员另加邮箱白名单，白名单存库）
    'google_oauth' => [
        'client_id'     => '',
        'client_secret' => '',
        'redirect_uri'  => 'https://www.zhaopin.es/user/login.php',
    ],

    // Brevo 事务邮件（举报提醒等；需配好域名 SPF/DKIM）
    'brevo' => [
        'api_key'    => '',
        'from_email' => 'no-reply@zhaopin.es',
        'from_name'  => '西华招聘',
    ],

    'site' => [
        'base_url' => 'https://www.zhaopin.es',
        'name'     => '西华招聘',
    ],

    // 本地调试专用。fake_admin_email 非空时 /c/cp/login.php?dev=1 可免 OAuth
    // 直登（邮箱仍须在 zhaopin_admins 白名单内）。生产环境必须留空！
    'dev' => [
        'fake_admin_email' => '',
    ],
];
