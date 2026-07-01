/* 发布页交互：模式切换 + 实时预览。提交当前为演示提示，P0 实装后 POST 到 publish.php。 */
const ICON_PIN = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 21s7-5.5 7-11a7 7 0 1 0-14 0c0 5.5 7 11 7 11z"/><circle cx="12" cy="10" r="2.5"/></svg>';
const ICON_TEL = '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 4h4l2 5-3 2a12 12 0 0 0 5 5l2-3 5 2v4a2 2 0 0 1-2 2A16 16 0 0 1 3 6a2 2 0 0 1 2-2z"/></svg>';
const ICON_WX  = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M9 4C5 4 2 6.6 2 9.9c0 1.8 1 3.4 2.6 4.5L4 17l2.7-1.4c.7.2 1.5.3 2.3.3h.6a4.6 4.6 0 0 1-.2-1.3c0-3 2.9-5.3 6.4-5.3h.6C15.8 6 12.7 4 9 4z"/></svg>';

const $=id=>document.getElementById(id);

function selectedJob(){ const on=document.querySelector('#picks .pick.on'); return on?on.textContent.trim():'后厨'; }
function maskTel(t){ const d=t.replace(/\s/g,''); return d?d.slice(0,3)+' ·· ··':'—'; }

function updatePreview(){
  const mode = document.body.dataset.mode;
  const job  = selectedJob();
  const title= $('fTitle').value.trim();
  const store= $('fStore').value.trim();
  const zona = $('fZona').value;
  const pay  = $('fPay').value.trim();
  const tel  = $('fTel').value.trim();
  const wx   = $('fWx').value.trim();

  const tag  = mode==='hire' ? job : '求职 · '+job;
  const place= mode==='hire' ? (store ? `${store} · ${zona}` : zona) : `本人现居 ${zona}`;
  const titleHTML = title
      ? `<div class="ptitle">${title}</div>`
      : `<div class="ptitle ph">${mode==='hire'?'（在左侧填写，这里实时预览）':'（在上方填写，这里实时预览）'}</div>`;

  $('preview').innerHTML = `
    <div class="ctop"><span class="tag">${tag}</span><span class="new">今日新</span><span class="ago">刚刚</span></div>
    ${titleHTML}
    <div class="meta">${ICON_PIN}${place}</div>
    <div class="cfoot">
      <div class="pay">${pay||'面议'}</div>
      <div class="cact">
        <button class="call">${ICON_TEL}拨打 <span class="num">${maskTel(tel)}</span></button>
        ${wx?`<button class="wx">${ICON_WX}</button>`:''}
      </div>
    </div>`;
}

// 招人/找活切换
document.querySelectorAll('.seg button[data-mode]').forEach(btn=>{
  btn.addEventListener('click',()=>{
    const mode=btn.dataset.mode;
    document.body.dataset.mode=mode;
    document.querySelectorAll('.seg button[data-mode]').forEach(b=>b.classList.toggle('on',b.dataset.mode===mode));
    const hire = mode==='hire';
    $('fieldStore').style.display = hire?'':'none';
    $('labZona').innerHTML = (hire?'工作地区':'现居地区')+' <span class="req">*</span>';
    $('labPay').innerHTML = (hire?'待遇':'期望待遇')+' <span class="opt">选填</span>';
    $('fTitle').placeholder = hire?'如：急招川菜炒锅师傅，有经验优先':'如：找帮厨工作，能吃苦，可全职';
    $('fPay').placeholder = hire?'如：1600€/月 包食宿':'如：1500€/月，面议';
    $('fNote').placeholder = hire?'工作时间、要求、能否包吃住等，可不填':'经验、可上工时间、期望等，可不填';
    $('submitBtn').textContent = hire?'发布招聘':'发布求职';
    updatePreview();
  });
});

// 工种选择
$('picks').addEventListener('click',e=>{
  const p=e.target.closest('.pick'); if(!p) return;
  document.querySelectorAll('#picks .pick').forEach(x=>x.classList.remove('on'));
  p.classList.add('on'); updatePreview();
});

// 输入联动预览
['fTitle','fStore','fZona','fPay','fTel','fWx'].forEach(id=>{
  $(id).addEventListener('input',updatePreview);
  $(id).addEventListener('change',updatePreview);
});

// 提交（演示）
$('submitBtn').addEventListener('click',()=>{
  const t=$('toast'); t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),2600);
});

updatePreview();
