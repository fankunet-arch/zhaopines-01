<?php
/**
 * 首页（信息墙）。当前信息流为前端演示数据（assets/js/home.js），
 * P0 实装时改为服务端渲染真实数据 + 筛选。
 * @var string $mode hire|seek
 */
$hire = $mode !== 'seek';
?>
  <!-- ===== 桌面顶栏 ===== -->
  <nav class="d-nav">
    <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <label class="d-search">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="7"/><path d="m21 21-4-4"/></svg>
      <input placeholder="搜店名、工种、地区…">
    </label>
    <div class="spacer"></div>
    <button class="postbtn" data-href="/publish.php"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>发布信息</button>
  </nav>

  <div class="band">
    <span class="eyebrow"><span class="d"></span>西班牙华人 · 餐饮 / 百元店 / 美甲 招工求职</span>
    <h1>在 <span class="loc">Usera</span> <span id="bandVerb"><?= $hire ? '找活、招人' : '想招到的人在这' ?></span></h1>
    <p class="sub">看一眼就联系上 —— <b>免注册发布、一键拨打、每天刷新</b>，不用研究网站。</p>
    <div class="bandrow">
      <div class="seg">
        <button data-mode="hire" class="<?= $hire ? 'on' : '' ?>">招聘 <span class="n">218</span></button>
        <button data-mode="seek" class="<?= $hire ? '' : 'on' ?>">求职 <span class="n">96</span></button>
      </div>
      <div class="stats">
        <div class="stat"><div class="v up">+38</div><div class="l">今日新增</div></div>
        <div class="stat"><div class="v">218</div><div class="l">在招岗位</div></div>
        <div class="stat"><div class="v">12</div><div class="l">覆盖地区</div></div>
      </div>
    </div>
  </div>

  <!-- ===== 移动端头部 ===== -->
  <header class="m-head">
    <div class="m-bar">
      <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
      <span class="tip">zhaopin.es</span>
    </div>
    <div class="m-seg">
      <div class="seg">
        <button data-mode="hire" class="<?= $hire ? 'on' : '' ?>">招聘 <span class="n">218</span></button>
        <button data-mode="seek" class="<?= $hire ? '' : 'on' ?>">求职 <span class="n">96</span></button>
      </div>
    </div>
    <div class="m-chips">
      <span class="chip act">📍 Usera</span>
      <span class="chip">后厨</span>
      <span class="chip">跑堂</span>
      <span class="chip">百元店</span>
      <span class="chip">美甲</span>
      <span class="chip">奶茶</span>
    </div>
  </header>

  <!-- ===== 主体 ===== -->
  <div class="wrap">
    <aside class="rail">
      <div class="group">
        <div class="gt">地区</div>
        <div class="filt">
          <a class="on">Usera<span class="c">96</span></a>
          <a>Cuatro Caminos<span class="c">41</span></a>
          <a>Carabanchel<span class="c">33</span></a>
          <a>Tetuán<span class="c">28</span></a>
          <a>Centro<span class="c">20</span></a>
        </div>
      </div>
      <div class="group">
        <div class="gt">工种</div>
        <div class="filt">
          <a>后厨 / 厨师<span class="c">74</span></a>
          <a>跑堂 / 服务<span class="c">62</span></a>
          <a>百元店店员<span class="c">35</span></a>
          <a>美甲师<span class="c">22</span></a>
          <a>奶茶 / 咖啡<span class="c">18</span></a>
        </div>
      </div>
      <div class="postcard">
        <h4>招到人了？</h4>
        <p>发布只填 5 项，1 分钟搞定。招满随手下架，否则 30 天自动过期。</p>
        <button data-href="/publish.php">免费发布招聘</button>
      </div>
    </aside>

    <main id="feed"><!-- 由 assets/js/home.js 渲染（演示数据） --></main>
  </div>

  <!-- 移动端底部发布栏 -->
  <div class="m-post">
    <button data-href="/publish.php"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>发布信息 <span class="free">· 免费 · 30天有效</span></button>
  </div>
