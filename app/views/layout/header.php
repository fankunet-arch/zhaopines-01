<?php
/**
 * @var string|null $title 页面标题
 * @var string|null $page  页面标识 home|detail|publish|plain：决定加载的页面级 css/js 与 body class
 * @var string|null $mode  hire|seek：决定强调色（珊瑚红/玉绿）
 */
$page = $page ?? 'plain';
$mode = ($mode ?? 'hire') === 'seek' ? 'seek' : 'hire';
$zpHtmlDir = dirname(ZP_APP_PATH) . '/zp_html';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= zp_e(isset($title) && $title !== '' ? $title . ' · ' : '') ?><?= zp_e((string) zp_config('site.name', '西华招聘')) ?> · zhaopin.es</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,400;12..96,600;12..96,700;12..96,800&family=Noto+Sans+SC:wght@400;500;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/site.css">
<?php if (is_file($zpHtmlDir . '/assets/css/' . $page . '.css')): ?>
<link rel="stylesheet" href="/assets/css/<?= zp_e($page) ?>.css">
<?php endif; ?>
</head>
<body data-mode="<?= zp_e($mode) ?>" class="page-<?= zp_e($page) ?>">
