const glsrSummaryText = document.getElementsByClassName("glsr-summary-text");
const glsrTagValue = glsrSummaryText[1].getElementsByClassName("glsr-tag-value")[0];
const createA = document.createElement("a");
createA.setAttribute("href","http://localhost/wordpress/product-reviews/");
createA.appendChild(glsrTagValue);
glsrSummaryText[1].appendChild(createA);

// レビュー数が0の時の文字列を変更
const glsrNoMargins = document.getElementsByClassName("glsr-no-margins")[0];
if(glsrNoMargins){
  glsrNoMargins.textContent = "この商品にはレビューがありません。"
}

// レビューを投稿をクリックした時の処理
const reviewAdd = document.getElementById("reviewAdd");
const reviewAddContent = document.getElementsByClassName("reviewAddContent")[0];
reviewAdd.addEventListener("click",() => {
  reviewAddContent.classList.toggle("show");
})

// レビュー評価が整数の時に".0"を追加 "1" => "1.0"
const glsrSummaryRating = document.getElementsByClassName("glsr-summary-rating");
const gisrTagValue1 = glsrSummaryRating[0].getElementsByClassName("glsr-tag-value")[0];
const gisrTagValue2 = glsrSummaryRating[1].getElementsByClassName("glsr-tag-value")[0];
// Number.isInteger()は整数か判定
// Number()は文字列を数値に変換
// insertAdjacentText()はTextContentの前後に文字列を追加
if(Number.isInteger(Number(gisrTagValue1.textContent))){
  gisrTagValue1.insertAdjacentText("beforeend",".0")
}
if(Number.isInteger(Number(gisrTagValue2.textContent))){
  gisrTagValue2.insertAdjacentText("beforeend",".0")
}

// 商品名下部のレビュー評価をクリックした時の処理
const glsrSummary = document.getElementsByClassName("glsr-summary")[0];
const customerReviews = document.getElementById("customerReviews");
glsrSummary.addEventListener("click",() => {
  customerReviews.scrollIntoView({behavior:"smooth"});
})

// カスタマーレビューをクリックした時の処理 600px以下で利用
const customerReviewLeft = document.getElementById("customerReviewLeft");
const customerReviewLeftTitle = customerReviewLeft.querySelector("h2");
const customerReviewLeftContent = customerReviewLeft.querySelectorAll("div");
const customerReviewRight = document.getElementById("customerReviewRight");
customerReviewLeftTitle.addEventListener("click",() => {
  for(let i = 0; i < customerReviewLeftContent.length; i ++){
    customerReviewLeftContent[i].classList.toggle("display");
  }
  customerReviewRight.classList.toggle("display");
})

// レビュー数が3未満の時の処理
const glsrReview = document.getElementsByClassName("glsr-review");
const reviewAllDisplay = document.getElementById("reviewAllDisplay");
if(glsrReview.length < 3){
	reviewAllDisplay.style.display = "none";
}