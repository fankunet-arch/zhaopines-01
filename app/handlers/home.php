<?php
declare(strict_types=1);

// 首页（信息墙）。信息流当前为演示数据，P0 实装后服务端渲染真实数据
$mode = ($_GET['type'] ?? '') === 'seek' ? 'seek' : 'hire';
zp_render('home', ['title' => '', 'page' => 'home', 'mode' => $mode]);
