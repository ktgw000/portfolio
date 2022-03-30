<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="utf-8">
	<title>サイトタイトル</title>
	<meta name="description" content="ディスクリプション">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">

	<script src="https://kit.fontawesome.com/e8d28d07a2.js" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>



<header>
	<nav id="headerNav">
		<ul>
			<li id="PcNavLogo"><a href="http://localhost/wordpress">LOGO</a></li>
			<li id="PcNavSearch"><?php get_search_form(); ?></li>
			<li id="PcNavLogin">
				<?php if(usces_is_login()): ?>
					<a href="<?php usces_url("login");?>">ログイン中</a>
				<?php else: ?>
					<a href="<?php usces_url("login");?>">ログイン</a>
				<?php endif; ?>
			</li>
			<li id="PcNavFavorite">
				<div id="PcNavFavoriteHover">
					<div class="PcNavFavoriteHoverContent">
						<?php if(isset($_SESSION["okini"])): ?>
						<div>お気に入りの商品が<span></span>点あります</div>
						<div class=""><a href="<?php usces_url("cart");?>">お気に入りの商品を確認</a></div>
						<?php else: ?>
						<div>お気に入りの商品がありません</div>
						<?php endif; ?>
					</div>
				</div>
			</li>
			<li id="PcNavCart">
				<a href="<?php usces_url("cart");?>"><span><?php usces_totalquantity_in_cart(); ?></span></a>
					<div id="PcNavCartHover">
						<div class="PcNavCartHoverContent">
							<?php if(usces_is_cart()): ?>
								<div>カートに商品が<span><?php usces_totalquantity_in_cart(); ?></span>点あります</div>
								<div>合計<?php usces_totalprice_in_cart(); ?>円<span>(税込)</span></div>
								<div class="PcNavCartContentView"><a href="<?php usces_url("cart");?>">ショッピングカートを確認</a></div>
							<?php else: ?>
								<div>カートに商品がありません</div>
							<?php endif; ?>
						</div>
					</div>
				</li>
				<li id="headerNavMenu">
					<span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
				</li>
				<li  id="headerNavMenuContent">
				<!-- <?php get_search_form(); ?> -->
				<?php include( TEMPLATEPATH . "/parts/mobileMenu.php" ); ?>
				</li>
			</ul>
		</nav>
	</header>
	<div id="backgroundCover"></div>
	<body <?php body_class( $class ); ?>>	