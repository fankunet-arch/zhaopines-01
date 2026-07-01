<?php
/**
 * 信息详情页。当前为设计模板演示内容，P0 实装时按对外随机码读库渲染，
 * 联系方式改走 get_contact.php 点击取号。
 */
?>
  <nav class="nav">
    <a class="back" href="/index.php"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>返回列表</a>
    <a class="brand" href="/index.php"><span class="zh">西华<span class="hl">招聘</span></span></a>
    <span class="spacer"></span>
    <span class="dom">zhaopin.es</span>
  </nav>

  <div class="shell">
    <div class="cols">

      <!-- ===== 主栏 ===== -->
      <div class="main">
        <div class="ltop">
          <span class="tag">后厨 · 炒锅</span>
          <span class="new">今日新</span>
        </div>
        <h1>急招川菜炒锅师傅，有经验优先</h1>
        <div class="metaline">
          <span class="mi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>今天 09:24 发布</span>
          <span class="mi"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"/><circle cx="12" cy="12" r="3"/></svg>浏览 86</span>
          <span class="mi exp"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M2 12h4M18 12h4"/><circle cx="12" cy="12" r="5"/></svg>28 天后过期</span>
          <button class="report" id="reportBtn"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 21V4h13l-2 4 2 4H4"/></svg>举报</button>
        </div>

        <div class="facts">
          <div class="fact"><div class="l">工作地区</div><div class="v">Usera</div></div>
          <div class="fact"><div class="l">待遇</div><div class="v pay">1600–1900€ <small>/月</small></div></div>
          <div class="fact"><div class="l">用工类型</div><div class="v">全职 · 包食宿</div></div>
          <div class="fact"><div class="l">店铺</div><div class="v">老李川菜馆</div></div>
        </div>

        <div class="sec">
          <h2>职位描述</h2>
          <div class="desc">
            <p>本店主营川菜，开店多年，生意稳定。现招炒锅师傅一名。</p>
            <p>要求会做家常川菜、水煮、干锅、小炒等，出品稳定、干净麻利、能配合后厨节奏。有相关经验者优先，手脚利索的可面议带教。</p>
            <p>做六休一，提供食宿。待遇 1600–1900€/月，按经验和能力面谈。有意者电话或微信联系，可来店里面谈、试工。</p>
          </div>
        </div>

        <div class="sec">
          <div class="safety">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7z"/><path d="M12 8v4M12 16h.01"/></svg>
            <div class="t"><b>谨防诈骗：</b>正规招工不会收取押金、报名费、培训费。请勿在见面前向对方转账或缴纳任何费用。</div>
          </div>
        </div>

        <div class="sec">
          <h2>相似职位 · 同在 Usera</h2>
          <div class="rel">
            <div class="relitem">
              <div class="rt"><div class="rti">招洗碗帮厨，包午饭，离地铁近</div><div class="rtm">粤口福 · Usera · 1小时前</div></div>
              <div class="rp">1300€<small>/月</small></div>
            </div>
            <div class="relitem">
              <div class="rt"><div class="rti">茶餐厅招全职服务员，会简单西语</div><div class="rtm">海记茶餐厅 · Cuatro Caminos · 2小时前</div></div>
              <div class="rp">1400€<small>/月</small></div>
            </div>
            <div class="relitem">
              <div class="rt"><div class="rti">Bazar 99 招全职店员，可长期</div><div class="rtm">Carabanchel · 昨天</div></div>
              <div class="rp">320€<small>/周</small></div>
            </div>
          </div>
        </div>
      </div>

      <!-- ===== 侧栏联系卡 ===== -->
      <aside class="side">
        <div class="contact">
          <div class="store">老李川菜馆</div>
          <div class="sm"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>Usera，马德里</div>

          <button class="callbtn" id="callDesk" data-tel="612 34 56 78">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-3 2a12 12 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>
            拨打 <span class="num">612 ·· ··</span>
          </button>

          <div class="wxrow">
            <span class="wxi"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 4C5 4 2 6.6 2 9.9c0 1.8 1 3.4 2.6 4.5L4 17l2.7-1.4c.7.2 1.5.3 2.3.3h.6a4.6 4.6 0 0 1-.2-1.3c0-3 2.9-5.3 6.4-5.3h.6C15.8 6 12.7 4 9 4z"/></svg></span>
            <span class="wxv"><span class="lab">微信</span>laolisichuan</span>
            <button class="copybtn" id="copyWx">复制</button>
          </div>

          <div class="cmeta">
            <div class="cmi"><span>发布时间</span><b>今天 09:24</b></div>
            <div class="cmi"><span>浏览次数</span><b>86</b></div>
            <div class="cmi"><span>有效期</span><span class="exp">28 天后过期</span></div>
          </div>
        </div>
      </aside>

    </div>
  </div>

  <!-- 移动端底部联系栏 -->
  <div class="m-contact">
    <button class="callbtn" id="callMob" data-tel="612 34 56 78">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-3 2a12 12 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>
      拨打 <span class="num">612 ·· ··</span>
    </button>
    <button class="mwx" id="mwxBtn"><svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 4C5 4 2 6.6 2 9.9c0 1.8 1 3.4 2.6 4.5L4 17l2.7-1.4c.7.2 1.5.3 2.3.3h.6a4.6 4.6 0 0 1-.2-1.3c0-3 2.9-5.3 6.4-5.3h.6C15.8 6 12.7 4 9 4z"/></svg></button>
  </div>

  <!-- 举报弹层 -->
  <div class="overlay" id="overlay">
    <div class="modal">
      <h3>举报这条信息</h3>
      <p class="ms">帮我们让列表保持真实、干净</p>
      <div class="reasons" id="reasons">
        <label class="reason"><input type="radio" name="r">虚假或诈骗信息</label>
        <label class="reason"><input type="radio" name="r">职位已招满 / 已过期</label>
        <label class="reason"><input type="radio" name="r">重复发布</label>
        <label class="reason"><input type="radio" name="r">内容不当</label>
        <label class="reason"><input type="radio" name="r">其他</label>
      </div>
      <div class="mbtns">
        <button class="mcancel" id="mCancel">取消</button>
        <button class="mok" id="mOk">提交举报</button>
      </div>
    </div>
  </div>

  <div class="toast" id="toast"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6 9 17l-5-5"/></svg><span id="toastMsg">已复制微信号</span></div>
