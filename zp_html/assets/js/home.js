/* 首页（信息墙）交互。DATA 为演示数据，P0 实装后由服务端渲染真实信息流。 */
const ICON_PIN = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>';
const ICON_TEL = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-3 2a12 12 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>';
const ICON_WX  = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 4C5 4 2 6.6 2 9.9c0 1.8 1 3.4 2.6 4.5L4 17l2.7-1.4c.7.2 1.5.3 2.3.3h.6a4.6 4.6 0 0 1-.2-1.3c0-3 2.9-5.3 6.4-5.3h.6C15.8 6 12.7 4 9 4z"/></svg>';

const DATA = {
  hire: {
    today: [
      {tag:'后厨 · 炒锅', neu:true, ago:'1小时前', title:'急招川菜炒锅师傅，有经验优先', place:'老李川菜馆 · Usera', pay:'1600–1900€', note:'/月·包食宿', tel:'612 34 56 78', wx:true},
      {tag:'跑堂 · 服务员', neu:true, ago:'2小时前', title:'茶餐厅招全职服务员，会简单西语', place:'海记茶餐厅 · Cuatro Caminos', pay:'1400€', note:'/月 + 小费', tel:'644 11 22 33'},
      {tag:'美甲师', ago:'5小时前', title:'招美甲师，会做光疗、款式，客源稳定', place:'Lily Nails · Centro', pay:'底薪 + 提成50%', tel:'688 90 12 34', wx:true},
      {tag:'奶茶店 · 兼职', ago:'今天', title:'珍珠奶茶店招兼职店员，周末班', place:'Tetuán', pay:'9€', note:'/时 · 兼职', tel:'631 55 66 77'},
    ],
    yesterday: [
      {tag:'百元店 · 店员', ago:'昨天', faded:true, title:'Bazar 99 招全职店员，可长期', place:'Carabanchel', pay:'320€', note:'/周 · 全职', tel:'602 33 44 55'},
      {tag:'后厨 · 帮厨', ago:'昨天', faded:true, title:'招洗碗帮厨，包午饭，离地铁近', place:'粤口福 · Usera', pay:'1300€', note:'/月', tel:'610 77 88 99'},
    ]
  },
  seek: {
    today: [
      {tag:'求职 · 帮厨', neu:true, ago:'3小时前', title:'找帮厨/洗碗工作，能吃苦、可全职', place:'本人现居 Usera · 可就近', pay:'面议', tel:'699 12 34 56', wx:true},
      {tag:'求职 · 服务员', ago:'今天', title:'有2年跑堂经验，找全职服务员，西语流利', place:'本人现居 Centro', pay:'1500€+', note:'/月', tel:'677 22 33 44'},
      {tag:'求职 · 美甲', ago:'今天', title:'美甲师找工作，会光疗手绘，可看作品', place:'本人现居 Tetuán', pay:'提成优先', tel:'655 88 99 00', wx:true},
    ],
    yesterday: [
      {tag:'求职 · 店员', ago:'昨天', faded:true, title:'找百元店或超市店员，长期稳定', place:'本人现居 Carabanchel', pay:'面议', tel:'622 11 00 99'},
    ]
  }
};

function mask(tel){ const p=tel.split(' '); return p[0]+' ·· ··'; }

function cardHTML(c){
  return `<div class="card${c.faded?' faded':''}" data-href="/detail.php">
    <div class="ctop">
      <span class="tag">${c.tag}</span>
      ${c.neu?'<span class="new">今日新</span>':''}
      <span class="ago">${c.ago}</span>
    </div>
    <div class="title">${c.title}</div>
    <div class="meta">${ICON_PIN}${c.place}</div>
    <div class="foot">
      <div class="pay">${c.pay}${c.note?` <small>${c.note}</small>`:''}</div>
      <div class="cact">
        <button class="call" data-tel="${c.tel}">${ICON_TEL}拨打 <span class="num">${mask(c.tel)}</span></button>
        ${c.wx?`<button class="wx" title="微信">${ICON_WX}</button>`:''}
      </div>
    </div>
  </div>`;
}

function render(){
  const mode = document.body.dataset.mode;
  const d = DATA[mode];
  const feed = document.getElementById('feed');
  feed.innerHTML =
    `<div class="day">今日</div><div class="grid">${d.today.map(cardHTML).join('')}</div>`+
    `<div class="day gap">昨天</div><div class="grid">${d.yesterday.map(cardHTML).join('')}</div>`;
}

document.querySelectorAll('.seg button[data-mode]').forEach(btn=>{
  btn.addEventListener('click',()=>{
    const mode = btn.dataset.mode;
    document.body.dataset.mode = mode;
    document.querySelectorAll('.seg button[data-mode]').forEach(b=>b.classList.toggle('on', b.dataset.mode===mode));
    const verb = document.getElementById('bandVerb');
    if(verb) verb.textContent = mode==='hire' ? '找活、招人' : '想招到的人在这';
    render();
  });
});

document.addEventListener('click',e=>{
  // 遮号电话：点击才显示完整号码（P0 实装后改走 get_contact.php 取号）
  const call = e.target.closest('.call');
  if(call){
    if(!call.dataset.shown){
      call.querySelector('.num').textContent = call.dataset.tel;
      call.dataset.shown = '1';
    }
    return;
  }
  if(e.target.closest('.wx')) return;
  // 卡片/按钮跳转
  const nav = e.target.closest('[data-href]');
  if(nav) location.href = nav.dataset.href;
});

document.querySelectorAll('.filt').forEach(group=>{
  group.querySelectorAll('a').forEach(a=>a.addEventListener('click',()=>{
    group.querySelectorAll('a').forEach(x=>x.classList.remove('on'));
    a.classList.add('on');
  }));
});
document.querySelector('.m-chips')?.addEventListener('click',e=>{
  const c=e.target.closest('.chip'); if(!c) return;
  document.querySelectorAll('.m-chips .chip').forEach(x=>x.classList.remove('act'));
  c.classList.add('act');
});

render();
