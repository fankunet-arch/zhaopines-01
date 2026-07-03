<?php /** @var array $admin @var string $nav_active */
$items = [
    'dashboard'  => ['/c/cp/',               '看板'],
    'posts'      => ['/c/cp/posts.php',      '信息管理'],
    'categories' => ['/c/cp/categories.php', '类别审核'],
    'reports'    => ['/c/cp/reports.php',    '举报处理'],
    'invalid'    => ['/c/cp/invalid.php',    '失效标记'],
    'coupons'    => ['/c/cp/coupons.php',    '置顶券'],
    'settings'   => ['/c/cp/settings.php',   '参数配置'],
];
?>
  <nav class="nav">
    <a class="brand" href="/c/cp/"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="a-badge">管理后台</span>
    <span class="spacer"></span>
    <span class="a-user"><?= zp_e($admin['email']) ?></span>
    <a class="a-out" href="/c/cp/logout.php">退出</a>
  </nav>
  <div class="a-tabs">
    <?php foreach ($items as $key => [$url, $label]): ?>
    <a href="<?= zp_e($url) ?>" class="<?= $key === $nav_active ? 'on' : '' ?>"><?= zp_e($label) ?></a>
    <?php endforeach; ?>
  </div>
