<?php
/**
 * 发布页。当前提交为演示提示，P0 实装时接 publish 处理器：
 * 必填/手机号校验、验证码、蜜罐、频率限制、正文夹带检测、字段名混淆。
 */
?>
  <nav class="nav">
    <a class="back" href="/index.php"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>返回</a>
    <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="spacer"></span>
    <span class="dom">zhaopin.es</span>
  </nav>

  <div class="shell">
    <div class="head">
      <h1>发布信息</h1>
      <p>填几项就行，<b>1 分钟搞定</b> · 免注册 · 帖子 30 天有效</p>
      <div class="seg">
        <button data-mode="hire" class="on">我要招人</button>
        <button data-mode="seek">我要找活</button>
      </div>
    </div>

    <div class="cols">

      <!-- ===== 表单 ===== -->
      <div class="formcol">
        <div class="panel">

          <div class="field">
            <label class="lab">工种 <span class="req">*</span></label>
            <div class="chiprow" id="picks">
              <span class="pick on">后厨</span>
              <span class="pick">跑堂</span>
              <span class="pick">百元店</span>
              <span class="pick">美甲</span>
              <span class="pick">奶茶</span>
              <span class="pick">其他</span>
            </div>
          </div>

          <div class="field">
            <label class="lab" id="labTitle">一句话说明 <span class="req">*</span></label>
            <input class="input" id="fTitle" placeholder="如：急招川菜炒锅师傅，有经验优先">
          </div>

          <div class="row">
            <div class="field" id="fieldStore">
              <label class="lab">店名 <span class="opt">选填</span></label>
              <input class="input" id="fStore" placeholder="如：老李川菜馆">
            </div>
            <div class="field">
              <label class="lab" id="labZona">工作地区 <span class="req">*</span></label>
              <span class="selwrap">
                <select class="sel" id="fZona">
                  <option>Usera</option><option>Cuatro Caminos</option><option>Carabanchel</option>
                  <option>Tetuán</option><option>Centro</option><option>其他地区</option>
                </select>
              </span>
            </div>
          </div>

          <div class="field">
            <label class="lab" id="labPay">待遇 <span class="opt">选填</span></label>
            <input class="input" id="fPay" placeholder="如：1600€/月 包食宿">
          </div>

          <div class="row">
            <div class="field">
              <label class="lab">联系电话 <span class="req">*</span></label>
              <input class="input" id="fTel" inputmode="numeric" placeholder="612 34 56 78">
            </div>
            <div class="field">
              <label class="lab">微信 <span class="opt">选填</span></label>
              <input class="input" id="fWx" placeholder="微信号">
            </div>
          </div>

          <div class="field">
            <label class="lab">补充说明 <span class="opt">选填</span></label>
            <textarea class="area" id="fNote" placeholder="工作时间、要求、能否包吃住等，可不填"></textarea>
          </div>

          <button class="submit" id="submitBtn">发布招聘</button>

          <div class="notes">
            <div class="note"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/></svg><span>免注册。发布后给你一个<b>管理链接</b>，凭它随时改或删。</span></div>
            <div class="note"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg><span>招到人随手点一下就<b>下架</b>，否则 <b>30 天</b>自动过期，列表永远新鲜。</span></div>
            <div class="note"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="11" width="14" height="9" rx="2"/><path d="M8 11V8a4 4 0 0 1 8 0v3"/></svg><span>电话默认<b>遮号</b>显示，对方点「拨打」才看到完整号码。</span></div>
          </div>

        </div>
      </div>

      <!-- ===== 实时预览 ===== -->
      <div class="previewcol">
        <div class="peyebrow"><span class="d"></span>实时预览</div>
        <div class="card" id="preview"><!-- 由 assets/js/publish.js 渲染 --></div>
        <p class="pafter">发布后会显示在「今日」最上方</p>
      </div>

    </div>
  </div>

  <div class="toast" id="toast"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg>已发布 · 30 天后自动下架（演示）</div>
