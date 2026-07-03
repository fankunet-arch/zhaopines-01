<?php /** @var array $user @var array $rows @var string $notice @var string $csrf */ ?>
  <nav class="nav">
    <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="u-badge">我的发布</span>
    <span class="spacer"></span>
    <span class="u-name"><?= zp_e($user['name']) ?></span>
    <a class="u-out" href="/user/logout.php">退出</a>
  </nav>

  <div class="shell u-shell">
    <?php if ($notice !== ''): ?><p class="u-notice">✓ <?= zp_e($notice) ?></p><?php endif; ?>

    <div class="u-top">
      <h1>我的发布</h1>
      <a class="u-btn primary" href="/publish.php">+ 发新信息</a>
    </div>

    <?php if ($rows === []): ?>
    <div class="plainbox">
      <h1>还没有发布过信息</h1>
      <p>登录状态下发布的信息会出现在这里，可以随时编辑、顶帖、下架。</p>
      <p><a class="u-btn primary" href="/publish.php">去发布第一条 →</a></p>
    </div>
    <?php endif; ?>

    <div class="u-list">
      <?php foreach ($rows as $r): $online = (int) $r['status'] === 1; ?>
      <div class="u-item <?= $online ? '' : 'off' ?>">
        <div class="u-itop">
          <span class="tag"><?= (int) $r['type'] === 2 ? '求职 · ' : '' ?><?= zp_e($r['category_name']) ?></span>
          <span class="u-status <?= $online ? 'on' : '' ?>"><?= [1 => '在线', 0 => '已到期', 2 => '已下架'][(int) $r['status']] ?? '' ?></span>
          <span class="ago"><?= zp_e(zp_time_ago($r['bumped_at'])) ?></span>
        </div>
        <a class="u-ititle" href="/detail.php?id=<?= zp_e($r['public_code']) ?>"><?= zp_e(zp_post_excerpt($r['content'])) ?></a>
        <div class="u-imeta"><?= zp_e($r['region_name']) ?> · 电话查看 <?= (int) $r['phone_views'] ?> 次 · 微信查看 <?= (int) $r['wechat_views'] ?> 次</div>
        <div class="u-iact">
          <a class="u-btn sm" href="/user/edit.php?id=<?= zp_e($r['public_code']) ?>">编辑</a>
          <form method="post"><input type="hidden" name="csrf" value="<?= zp_e($csrf) ?>"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><input type="hidden" name="action" value="bump"><button class="u-btn sm" type="submit">顶帖</button></form>
          <?php if ($online): ?>
          <form method="post"><input type="hidden" name="csrf" value="<?= zp_e($csrf) ?>"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><input type="hidden" name="action" value="offline"><button class="u-btn sm" type="submit">已招到/已找到·下架</button></form>
          <?php endif; ?>
          <form method="post" onsubmit="return confirm('确认删除？删除后无法恢复')"><input type="hidden" name="csrf" value="<?= zp_e($csrf) ?>"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><input type="hidden" name="action" value="delete"><button class="u-btn sm danger" type="submit">删除</button></form>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
