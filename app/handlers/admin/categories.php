<?php
declare(strict_types=1);

// 类别审核：待审核表 → 通过并入正式表 / 驳回；正式类别一览
require __DIR__ . '/_common.php';
zp_require_admin();
$db = zp_db();
$CP = zp_table('categories_pending');
$C = zp_table('categories');

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    zp_csrf_check();
    $id = (int) ($_POST['id'] ?? 0);
    $action = (string) ($_POST['action'] ?? '');
    $stmt = $db->prepare("SELECT * FROM $CP WHERE id = ? AND status = 0");
    $stmt->execute([$id]);
    if (($row = $stmt->fetch()) !== false) {
        if ($action === 'approve') {
            $maxSort = (int) $db->query("SELECT COALESCE(MAX(sort),0) FROM $C WHERE sort < 999")->fetchColumn();
            $db->prepare("INSERT IGNORE INTO $C (name, sort, status, created_at) VALUES (?, ?, 1, ?)")
               ->execute([$row['name'], $maxSort + 10, zp_now()]);
            $db->prepare("UPDATE $CP SET status = 1, reviewed_at = ? WHERE id = ?")->execute([zp_now(), $id]);
        } elseif ($action === 'reject') {
            $db->prepare("UPDATE $CP SET status = 2, reviewed_at = ? WHERE id = ?")->execute([zp_now(), $id]);
        }
    }
    header('Location: /c/cp/categories.php');
    exit;
}

$pending = $db->query("SELECT * FROM $CP WHERE status = 0 ORDER BY id")->fetchAll();
$active = $db->query("SELECT c.*, (SELECT COUNT(*) FROM " . zp_table('posts') . " p WHERE p.category_id = c.id AND p.status = 1) post_count FROM $C c ORDER BY c.sort")->fetchAll();

zp_admin_page('categories', '类别审核', ['pending' => $pending, 'active' => $active]);
