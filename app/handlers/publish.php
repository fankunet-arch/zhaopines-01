<?php
declare(strict_types=1);

// 发布页。当前提交为演示提示；P0 实装：必填/手机号校验、验证码、蜜罐、
// 频率限制、正文夹带检测、字段名混淆、每日限发1条、7天顶帖
zp_render('publish', ['title' => '发布信息', 'page' => 'publish', 'mode' => 'hire']);
