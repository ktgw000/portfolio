const productThumbnailImage = document.getElementById("productThumbnailImage")
const productThumbnailImageImg = productThumbnailImage.getElementsByTagName("img");
const productThumbnailViewer = document.getElementById("productThumbnailViewer");
const productThumbnailViewerImg = productThumbnailViewer.getElementsByTagName("img")[0];
const productThumbnailViewerZoom = document.getElementById("productThumbnailViewerZoom");
const productThumbnailViewerZoomImg = productThumbnailViewerZoom.getElementsByTagName("img")[0];

// 初期表示
productThumbnailViewerImg.setAttribute("src",productThumbnailImageImg[0].src);
productThumbnailImageImg[0].style.border = "solid 1px orange"
for(let i = 0; i < productThumbnailImageImg.length; i ++){
  productThumbnailImageImg[i].addEventListener("mouseover",() => {
  for(let j = 0; j < productThumbnailImageImg.length; j ++){
    productThumbnailImageImg[j].style.border = "solid 1px #000";
  }
    productThumbnailImageImg[i].style.border = "solid 1px orange"
    productThumbnailViewerImg.setAttribute("src",productThumbnailImageImg[i].src);
  })
}

// 画像クリックで拡大表示
window.onload = () => {
  productThumbnailViewerZoomImg.setAttribute("src",productThumbnailImageImg[0].src);
  for(let i = 0; i < productThumbnailImageImg.length; i ++){
    productThumbnailImageImg[i].addEventListener("mouseover",() => {
      productThumbnailViewerZoomImg.setAttribute("src",productThumbnailImageImg[i].src);
    })
  }
}
productThumbnailViewer.addEventListener("click",() => {
  productThumbnailViewerZoom.style.display = "flex"
})
productThumbnailViewerZoom.addEventListener("click",() => {
  productThumbnailViewerZoom.style.display = "none"
})

// 商品情報を表示をクリックした時の処理
const productInfomationDisplay = document.getElementById("productInfomationDisplay");
const productInfomation = document.getElementById("productInfomation");
productInfomationDisplay.addEventListener("click",() => {
  productInfomation.scrollIntoView({behavior:"smooth"});
})

// 商品情報 育成方法 をクリックした時の処理
// 600px以下でしか利用しないので 600px以上では動作しないようにする方法があれば探す
const productInfomationLeft = document.getElementById("productInfomationLeft");
const productInfomationLeftTitle = productInfomationLeft.querySelector("h2");
const productInfomationLeftContent = productInfomationLeft.querySelectorAll("div");
const productInfomationRight = document.getElementById("productInfomationRight");
const productInfomationRightTitle = productInfomationRight.querySelector("h2");
const productInfomationRightContent = productInfomationRight.querySelectorAll("div");

productInfomationLeftTitle.addEventListener("click",() => {
  for(let i = 0; i < productInfomationLeftContent.length; i ++) {
    productInfomationLeftContent[i].classList.toggle("display");
  }
})
productInfomationRightTitle.addEventListener("click",() => {
  for(let i = 0; i < productInfomationRightContent.length; i ++) {
    productInfomationRightContent[i].classList.toggle("display");
  }
})