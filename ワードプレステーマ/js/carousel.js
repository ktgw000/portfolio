const carousel = document.getElementById("carousel");
const carouselItem = document.getElementsByClassName("carouselItem")[0];
const carouselItemContent = carouselItem.getElementsByTagName("a")[0];
const carouselItemImage = carouselItem.getElementsByTagName("a");
const carouselPrev = document.getElementById("carouselPrev");
const carouselNext = document.getElementById("carouselNext");
const carouselAutoPlayInterval = 3000; // カルーセル自動再生の間隔 / MS
const carouselAnimationSecond = 700; // アニメーションの時間を指定 / MS
const carouselEventInterval = 700 // イベントが再発火可能になる間隔 / MS
let carouselItemImageWidth = getComputedStyle(carouselItemContent).minWidth; // スライドする横幅を指定
CarouselAutoPlay(); // カルーセル自動再生
CarouselNext(); // Nextのイベント処理
CarouselPrev(); // Prevのイベント処理
function CarouselAutoPlay(){
  const carouselAutoPlaySet = setInterval(() => {
    carouselItemImageWidth = getComputedStyle(carouselItemContent).minWidth;
    carouselItem.style.transform = `translateX(-${carouselItemImageWidth})`;
    carouselItem.style.transitionDuration = carouselAnimationSecond + "ms";
    setTimeout(() => { 
      carouselItem.style.transform = "translateX(-0%)";
      carouselItem.style.transitionDuration = "";
      carouselItem.appendChild(carouselItemImage[0]);
    },carouselEventInterval)
  },carouselAutoPlayInterval)
  carousel.addEventListener("mouseover",() => {
    clearInterval(carouselAutoPlaySet);
  },{once:true});  
  carousel.addEventListener("mouseout",() => {
    CarouselAutoPlay();
  },{once:true});
}
function CarouselNext(){
  carouselNext.addEventListener("click",() => {
    carouselItemImageWidth = getComputedStyle(carouselItemContent).minWidth;
    carouselItem.style.transform = `translateX(-${carouselItemImageWidth})`;
    carouselItem.style.transitionDuration = carouselAnimationSecond + "ms";
    setTimeout(() => { 
      carouselItem.style.transform = "translateX(-0%)";
      carouselItem.style.transitionDuration = "";
      carouselItemImage;
      carouselItem.appendChild(carouselItemImage[0]);
      CarouselNext();
    },carouselEventInterval)
  },{once:true})
}
function CarouselPrev(){
  carouselPrev.addEventListener("click",() => {
    carouselItemImageWidth = getComputedStyle(carouselItemContent).minWidth;
    carouselItem.insertBefore(carouselItemImage[carouselItemImage.length - 1] ,carouselItemImage[0]);
    carouselItem.style.transform = `translateX(-${carouselItemImageWidth})`;
    carouselItem.style.transitionDuration = "";
    setTimeout(() => {
      carouselItem.style.transitionDuration = carouselAnimationSecond + "ms";
      carouselItem.style.transform = "translateX(0%)";
    },0)
    setTimeout(() => {
      CarouselPrev();
    },carouselEventInterval)
  },{once:true})
}