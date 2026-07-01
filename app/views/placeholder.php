<?php /** @var string $title @var string $feature */ ?>
  <nav class="nav">
    <a class="back" href="/index.php"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>返回</a>
    <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="spacer"></span>
    <span class="dom">zhaopin.es</span>
  </nav>

  <div class="shell">
    <div class="plainbox">
      <h1><?= zp_e($title) ?></h1>
      <p>该页面尚未实现（按 docs/04_开发路线图.md 推进中）。</p>
      <p>功能名：<code><?= zp_e($feature) ?></code></p>
    </div>
  </div>
