const slider = document.getElementById("slider");
const sliderImage = document.getElementById("sliderImage");
const sliderImageContent = sliderImage.getElementsByTagName("img");
const sliderNextButton = document.getElementById("sliderNextButton");
const sliderPrevButton = document.getElementById("sliderPrevButton");
const sliderAnimationSecond = "1500"; //アニメーションにかける時間
const sliderAutoPlaySecond = "5000" //アニメーション自動再生の間隔
const line1 = document.getElementsByClassName("line1")[0];
const line2 = document.getElementsByClassName("line2")[0];
const line3 = document.getElementsByClassName("line3")[0];
const indicator = document.getElementById("indicator");
sliderNext();
sliderPrev(); 
sliderAutoPlay(); 
sliderIndicator();
function sliderNext(){
  sliderNextButton.addEventListener("click",() => {
    sliderImage.style.transform = "translateX(-100%)";
    sliderImage.style.transitionDuration = sliderAnimationSecond + "ms";
    setTimeout(() => {
      sliderImage.style.transform = "translateX(0%)";
      sliderImage.style.transitionDuration= "";
      sliderImage.appendChild(sliderImageContent[0]);
      sliderIndicator();
      sliderNext();
    },sliderAnimationSecond);
  },{once:true})
}
function sliderPrev(){
  sliderPrevButton.addEventListener("click",() => {
    sliderImage.insertBefore(sliderImageContent[sliderImageContent.length - 1],sliderImageContent[0]);
    sliderImage.style.transform = "translateX(-100%)";
    sliderImage.style.transitionDuration = "";
    setTimeout(() => {
      sliderImage.style.transform = "translateX(0%)";
      sliderImage.style.transitionDuration = sliderAnimationSecond + "ms";
    },0);
    setTimeout(() => {
      sliderPrev();
      sliderIndicator();
    },sliderAnimationSecond);
  },{once:true})
}
function sliderAutoPlay(){
  const sliderAutoPlaySet = setInterval(() => {
    sliderImage.style.transform = "translateX(-100%)";
    sliderImage.style.transitionDuration = sliderAnimationSecond + "ms";
    setTimeout(() => {
      sliderImage.style.transform = "translateX(0%)";
      sliderImage.style.transitionDuration= "";
      sliderImage.appendChild(sliderImageContent[0]);  
      sliderIndicator();
    },sliderAnimationSecond);
  },sliderAutoPlaySecond);
    slider.addEventListener("mouseover",() => {
      clearInterval(sliderAutoPlaySet);
    },{once:true})
    slider.addEventListener("mouseout",() => {
      sliderAutoPlay();
    },{once:true})
}
function sliderIndicator(){
  if(sliderImageContent[0].name == "line1"){
    console.log("line1Now");
    lineStyleReset();
    line1.style.backgroundColor = "rgb(61, 167, 52)";
  }
  if(sliderImageContent[0].name == "line2"){
    console.log("line2Now");
    lineStyleReset();
    line2.style.backgroundColor = "rgb(61, 167, 52)";
  }  
  if(sliderImageContent[0].name == "line3"){
    console.log("line3Now");
    lineStyleReset();
    line3.style.backgroundColor = "rgb(61, 167, 52)";
  }  
}
function lineStyleReset(){
  line1.style = "";
  line2.style = "";
  line3.style = "";
}
line1.addEventListener("click",() =>{
  const sliderImageLine1 = document.getElementsByName("line1")[0];
  lineStyleReset();
  sliderImage.prepend(sliderImageLine1);
  line1.style.backgroundColor = "rgb(61, 167, 52)";
})
line2.addEventListener("click",() =>{
  const sliderImageLine2 = document.getElementsByName("line2")[0];
  lineStyleReset();
  sliderImage.prepend(sliderImageLine2);
  line2.style.backgroundColor = "rgb(61, 167, 52)";
})
line3.addEventListener("click",() =>{
  const sliderImageLine3 = document.getElementsByName("line3")[0];
  lineStyleReset();
  sliderImage.prepend(sliderImageLine3);
  line3.style.backgroundColor = "rgb(61, 167, 52)";
})