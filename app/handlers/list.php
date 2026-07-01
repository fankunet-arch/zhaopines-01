<?php
declare(strict_types=1);

// 列表/筛选/搜索：与首页共用信息墙视图（?type=job|seek 切板块）。
// P0 实装后加类别+地区筛选、LIKE 搜索、置顶>时间倒序
$mode = ($_GET['type'] ?? '') === 'seek' ? 'seek' : 'hire';
zp_render('home', ['title' => $mode === 'seek' ? '求职' : '招聘', 'page' => 'home', 'mode' => $mode]);
