<?php
declare(strict_types=1);

/**
 * 用户登录（Google OAuth，零成本零密码，docs/01 §4.3）。
 * 本地调试：config['dev']['fake_user_name'] 非空时 ?dev=1 免 OAuth 直登（生产留空）。
 */
zp_session_start();
if (zp_user() !== null) {
    header('Location: /user/my_posts');
    exit;
}

$redirectUri = (string) zp_config('site.base_url', '') . '/user/login';
$err = '';

// 本地调试直登
$devName = (string) zp_config('dev.fake_user_name', '');
if ($devName !== '' && ($_GET['dev'] ?? '') === '1') {
    if (zp_user_login(['sub' => 'dev-user-1', 'email' => '', 'name' => $devName]) !== null) {
        header('Location: /user/my_posts');
        exit;
    }
    $err = '该调试账号已被封禁';
}

// Google 回调
if (isset($_GET['code'])) {
    if (!hash_equals($_SESSION['oauth_state'] ?? '', (string) ($_GET['state'] ?? ''))) {
        $err = '登录状态校验失败，请重试';
    } else {
        try {
            $identity = zp_google_exchange_code((string) $_GET['code'], $redirectUri);
            if (zp_user_login($identity) !== null) {
                header('Location: /user/my_posts');
                exit;
            }
            $err = '该账号已被封禁';
        } catch (Throwable $e) {
            $err = '登录失败：' . $e->getMessage();
        }
    }
}

$oauthReady = (string) zp_config('google_oauth.client_id', '') !== '';
zp_render('user/login', [
    'title' => '登录', 'page' => 'user',
    'authUrl' => $oauthReady ? zp_google_auth_url($redirectUri) : '',
    'devName' => $devName,
    'err' => $err,
]);
