<?php
declare(strict_types=1);

// 参数配置：zhaopin_settings 键值编辑（保底N/置顶上限/各类阈值/字段名映射等）
require __DIR__ . '/_common.php';
zp_require_admin();
$db = zp_db();
$S = zp_table('settings');
$saved = false;

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    zp_csrf_check();
    foreach ((array) ($_POST['s'] ?? []) as $key => $value) {
        $db->prepare("UPDATE $S SET svalue = ?, updated_at = ? WHERE skey = ?")
           ->execute([(string) $value, zp_now(), (string) $key]);
    }
    header('Location: /c/cp/settings?saved=1');
    exit;
}
$saved = ($_GET['saved'] ?? '') === '1';

$rows = $db->query("SELECT * FROM $S ORDER BY skey")->fetchAll();
zp_admin_page('settings', '参数配置', ['rows' => $rows, 'saved' => $saved]);
