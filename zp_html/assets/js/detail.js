/* 详情页交互。取号/举报当前为演示行为，P0 实装后改走 get_contact.php / report.php。 */
const $=id=>document.getElementById(id);
function toast(msg){const t=$('toast');$('toastMsg').textContent=msg;t.classList.add('show');setTimeout(()=>t.classList.remove('show'),2400);}

// 遮号电话：点击才显示
function revealCall(btn){
  if(btn.dataset.shown) return;
  btn.querySelector('.num').textContent = btn.dataset.tel;
  btn.dataset.shown='1';
}
$('callDesk')?.addEventListener('click',function(){revealCall(this);});
$('callMob')?.addEventListener('click',function(){revealCall(this);});

// 复制微信号
$('copyWx').addEventListener('click',()=>{
  navigator.clipboard?.writeText('laolisichuan').catch(()=>{});
  toast('已复制微信号：laolisichuan');
});
$('mwxBtn').addEventListener('click',()=>{
  navigator.clipboard?.writeText('laolisichuan').catch(()=>{});
  toast('已复制微信号：laolisichuan');
});

// 举报弹层
$('reportBtn').addEventListener('click',()=>$('overlay').classList.add('show'));
$('mCancel').addEventListener('click',()=>$('overlay').classList.remove('show'));
$('overlay').addEventListener('click',e=>{if(e.target===$('overlay'))$('overlay').classList.remove('show');});
$('reasons').addEventListener('change',()=>{
  document.querySelectorAll('#reasons .reason').forEach(l=>l.classList.toggle('on',l.querySelector('input').checked));
});
$('mOk').addEventListener('click',()=>{
  $('overlay').classList.remove('show');
  toast('已收到你的举报，谢谢（演示）');
});
