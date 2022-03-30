itemListContentsScroll(0);
itemListContentsScroll(1);
itemListContentsScroll(2);
function itemListContentsScroll(numbar){
  const itemListContents = document.getElementsByClassName("itemListContents")[numbar];
  const itemListContent = document.getElementsByClassName("itemListContent")[numbar];
  const itemListContentNextButton = document.getElementsByClassName("itemListContentNextButton")[numbar];
  const itemListContentPrevButton = document.getElementsByClassName("itemListContentPrevButton")[numbar];
  const itemListContentResetButton = document.getElementsByClassName("itemListContentResetButton")[numbar];
  let itemListContentsScrollMaxWidth = itemListContents.scrollWidth - itemListContents.clientWidth; // スクロール可能な領域
  let itemListContentWidth = itemListContent.getBoundingClientRect().width + 1; // スクロールする1要素の横幅
  let scrollTime = 300; // スクロールが完全に終わった後に条件分岐するために設定
 //今はscroll-behavior: smooth;でスクロールさせてるからスクロール時間はわからない
  itemListContentsNextButton();
  itemListContentsPrevButton();
  itemListContentsResetButton();
  function itemListContentsNextButton(){
    itemListContentNextButton.addEventListener("click",() => {
      itemListContentsScrollMaxWidth = itemListContents.scrollWidth - itemListContents.clientWidth;
      itemListContentWidth = itemListContent.getBoundingClientRect().width + 1;
      itemListContents.scrollLeft += itemListContentWidth;    
      setTimeout(() => {
        if(itemListContents.scrollLeft > 0){
          itemListContentPrevButton.classList.add("show");
        }
        if(itemListContents.scrollLeft == itemListContentsScrollMaxWidth){
          itemListContentNextButton.classList.remove("show");
          itemListContentResetButton.classList.add("show");
        }
      },scrollTime)
      setTimeout(() => {
        itemListContentsNextButton();
      },scrollTime)
    },{ once:true })
  }
  function itemListContentsPrevButton(){
    itemListContentPrevButton.addEventListener("click",() => {
      itemListContentWidth = itemListContent.getBoundingClientRect().width + 1;
      itemListContents.scrollLeft -= itemListContentWidth;
      setTimeout(() => {
        if(itemListContents.scrollLeft == 0){
          itemListContentPrevButton.classList.remove("show");
        }
        if(itemListContents.scrollLeft >= 1){
          itemListContentResetButton.classList.remove("show");
          itemListContentNextButton.classList.add("show");
        }
      },scrollTime)
      setTimeout(() => {
        itemListContentsPrevButton();
      },scrollTime)
    },{ once:true })
  }
  function itemListContentsResetButton(){
    itemListContentResetButton.addEventListener("click",() => {
      itemListContents.scrollLeft = 0;
      itemListContentPrevButton.classList.remove("show");
      itemListContentResetButton.classList.remove("show");
      itemListContentNextButton.classList.add("show");
    })
  }
}