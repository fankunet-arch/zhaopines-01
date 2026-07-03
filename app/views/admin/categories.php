<?php require __DIR__ . '/_nav.php'; ?>
  <div class="shell a-shell">
    <h2 class="a-h2">待审核类别（用户录入）</h2>
    <div class="a-tablewrap"><table class="a-table">
      <tr><th>名称</th><th>提交时间</th><th>操作</th></tr>
      <?php foreach ($pending as $r): ?>
      <tr>
        <td><b><?= zp_e($r['name']) ?></b></td>
        <td><?= zp_e(zp_time_ago($r['submitted_at'])) ?></td>
        <td class="c-act">
          <form method="post"><input type="hidden" name="csrf" value="<?= zp_e($csrf) ?>"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><input type="hidden" name="action" value="approve"><button class="a-btn sm">通过并入正式表</button></form>
          <form method="post"><input type="hidden" name="csrf" value="<?= zp_e($csrf) ?>"><input type="hidden" name="id" value="<?= (int) $r['id'] ?>"><input type="hidden" name="action" value="reject"><button class="a-btn sm danger">驳回</button></form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php if ($pending === []): ?><tr><td colspan="3" class="empty">没有待审核的类别</td></tr><?php endif; ?>
    </table></div>

    <h2 class="a-h2">正式类别</h2>
    <div class="a-tablewrap"><table class="a-table">
      <tr><th>名称</th><th>排序</th><th>状态</th><th>在线帖数</th></tr>
      <?php foreach ($active as $r): ?>
      <tr>
        <td><?= zp_e($r['name']) ?></td>
        <td><?= (int) $r['sort'] ?></td>
        <td><?= (int) $r['status'] === 1 ? '启用' : '停用' ?></td>
        <td><?= (int) $r['post_count'] ?></td>
      </tr>
      <?php endforeach; ?>
    </table></div>
  </div>
