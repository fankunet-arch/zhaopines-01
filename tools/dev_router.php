<?php
declare(strict_types=1);

/**
 * 本地开发路由器：给 PHP 内置服务器模拟生产环境 zp_html/.htaccess 的
 * 无扩展名 URL 行为（内置服务器不解析 .htaccess）。
 * 用法：php -S 127.0.0.1:8000 -t zp_html tools/dev_router.php
 */
$docroot = realpath(__DIR__ . '/../zp_html');
$path = urldecode((string) parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$qs = (string) ($_SERVER['QUERY_STRING'] ?? '');
$qs = $qs !== '' ? '?' . $qs : '';

// 与生产一致①：任意目录下的 /index.php 与 /index → 301 到目录本身
if (preg_match('#^(.*/)index(?:\.php)?$#', $path, $m)) {
    header('Location: ' . $m[1] . $qs, true, 301);
    return true;
}

// 与生产一致②：其余显式 .php 访问 301 到无扩展名地址
if (preg_match('#^(.+)\.php$#', $path, $m) && is_file($docroot . $path)) {
    header('Location: ' . $m[1] . $qs, true, 301);
    return true;
}

// 静态文件按原样交给内置服务器
if ($path !== '/' && is_file($docroot . $path)) {
    return false;
}

// 目录 → 目录下 index.php；无扩展名 → 对应 .php
$candidate = is_dir($docroot . $path) ? rtrim($path, '/') . '/index' : rtrim($path, '/');
if ($candidate === '') {
    $candidate = '/index';
}
$phpFile = $docroot . $candidate . '.php';
if (is_file($phpFile)) {
    require $phpFile;
    return true;
}

http_response_code(404);
echo 'Not Found';
return true;
