const mobileMenu = document.getElementById("mobileMenu");
const mobileMenuH3 = mobileMenu.getElementsByTagName("h3");
const mobileMenuContent = document.getElementsByClassName("mobileMenuContent");
for(let i = 0; i < mobileMenuH3.length; i++){
  mobileMenuH3[i].addEventListener("click",() => {
    mobileMenuContent[i].classList.toggle("display");
  })
}