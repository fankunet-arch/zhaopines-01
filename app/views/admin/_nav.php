<?php /** @var array $admin @var string $nav_active */
$items = [
    'dashboard'  => ['/c/cp/',               '看板'],
    'posts'      => ['/c/cp/posts',      '信息管理'],
    'categories' => ['/c/cp/categories', '类别审核'],
    'reports'    => ['/c/cp/reports',    '举报处理'],
    'invalid'    => ['/c/cp/invalid',    '失效标记'],
    'coupons'    => ['/c/cp/coupons',    '置顶券'],
    'settings'   => ['/c/cp/settings',   '参数配置'],
];
?>
  <nav class="nav">
    <a class="brand" href="/c/cp/"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="a-badge">管理后台</span>
    <span class="spacer"></span>
    <span class="a-user"><?= zp_e($admin['email']) ?></span>
    <a class="a-out" href="/c/cp/logout">退出</a>
  </nav>
  <div class="a-tabs">
    <?php foreach ($items as $key => [$url, $label]): ?>
    <a href="<?= zp_e($url) ?>" class="<?= $key === $nav_active ? 'on' : '' ?>"><?= zp_e($label) ?></a>
    <?php endforeach; ?>
  </div>
