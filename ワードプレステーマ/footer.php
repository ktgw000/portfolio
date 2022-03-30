<footer>
  <div id="footerMenu">
    <div class="menu">
      <div><a>LOGO</a></div>
    </div>
    <div class="menu">
      <ul>
        <dl>運営情報</dl>
        <li><a href="">お知らせ</a></li>
        <li><a href="">会社概要</a></li>
      </ul>
    </div>
    <div class="menu">
      <ul>
        <dl>アカウント</dl>
        <li><a href="">ログイン</a></li> <!--ログインしてたら何かテキストを追加-->
        <li><a href="">注文履歴</a></li>
      </ul>
    </div>
    <div class="menu">
      <ul>
        <dl>サポート</dl>
        <li><a href="">FAQ</a></li> <!--お支払い方法 送料・配送方法はQ&Aに-->
        <li><a href="">お問い合わせ</a></li>
      </ul>
    </div>
    <div class="menu">
      <ul>
        <dl>サイト情報</dl>
        <li><a href="">利用規約</a></li>
        <li><a href="">プライバシーポリシー</a></li>
        <li><a href="">特定商取引法の表記</a></li>
      </ul>
    </div>
  </div>
  <div class="copyright">© 2021 □□□□ Corporation. All Rights Reserved.</div>
</footer>

<?php wp_footer(); ?>

<script type="text/javascript">
// ヘッダー
const headerNavMenu = document.getElementById("headerNavMenu");
const headerNavMenuLine = headerNavMenu.getElementsByClassName("line");
const headerNavMenuContent = document.getElementById("headerNavMenuContent");
headerNavMenu.addEventListener("click",() => {
  headerNavMenuContent.classList.toggle("display");
  for(let i = 0; i < headerNavMenuLine.length; i++){
    headerNavMenuLine[i].classList.toggle("animation");
  }
})
// お気に入り
const backgroundCover = document.getElementById("backgroundCover");
const PcNavFavorite = document.getElementById("PcNavFavorite");
const PcNavFavoriteHover = document.getElementById("PcNavFavoriteHover");
PcNavFavorite.addEventListener("mouseover",() => {
  PcNavFavoriteHover.classList.add("display");
  backgroundCover.style.opacity = "1";
})
PcNavFavorite.addEventListener("mouseout",() => {
  PcNavFavoriteHover.classList.remove("display");
  backgroundCover.style.opacity = "0";
})
// カート
const PcNavCart = document.getElementById("PcNavCart");
const PcNavCartHover = document.getElementById("PcNavCartHover");
PcNavCart.addEventListener("mouseover",() => {
  PcNavCartHover.classList.add("display");
  backgroundCover.style.opacity = "1";
})
PcNavCart.addEventListener("mouseout",() => {
  PcNavCartHover.classList.remove("display");
  backgroundCover.style.opacity = "0";
})
</script>

</body>
</html>