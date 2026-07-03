<?php
declare(strict_types=1);

// 置顶券管理（P2 阶段实装：生成/台账/作废/重发）。表结构已就绪。
require __DIR__ . '/_common.php';
zp_require_admin();
$total = (int) zp_db()->query('SELECT COUNT(*) FROM ' . zp_table('coupons'))->fetchColumn();
zp_admin_page('coupons', '置顶券', ['total' => $total]);
