// siteReviews N件の評価 ⇒ (N)に変更
const glsrTagValue = document.getElementsByClassName("glsr-tag-value");
for(let i = 0; i < glsrTagValue.length; i++){
  const glsrTagValueContent = glsrTagValue[i].textContent.replace(/[^0-9]/g,"");
  glsrTagValue[i].textContent = "(" + glsrTagValueContent + ")"; 
}