<?php /** @var string|null $title 页面标题（各视图传入） */ ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= zp_e(isset($title) && $title !== '' ? $title . ' - ' : '') ?><?= zp_e((string) zp_config('site.name', '西华招聘')) ?> zhaopin.es</title>
<link rel="stylesheet" href="/assets/css/site.css">
<?php /* Bootstrap 5 落地时放入 zp_html/assets/vendor/ 本地引用，无 CDN、无构建链 */ ?>
</head>
<body>
<header class="site-header">
    <a class="site-brand" href="/index.php"><?= zp_e((string) zp_config('site.name', '西华招聘')) ?></a>
    <nav class="site-nav">
        <a href="/list.php?type=job">招聘</a>
        <a href="/list.php?type=seek">求职</a>
        <a href="/publish.php">发布信息</a>
        <a href="/user/my_posts.php">我的发布</a>
    </nav>
</header>
