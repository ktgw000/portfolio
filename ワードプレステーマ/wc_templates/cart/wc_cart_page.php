<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */
get_header();
?>

<div id="content" class="two-column">
<div id="cartPage1" class="catbox">

<?php if (have_posts()) : usces_remove_filter(); ?>

	<div class="post" id="wc_<?php usces_page_name(); ?>">

		<div class="entry">

			<div id="inside-cart">



				<div class="header_explanation">
				<?php do_action('usces_action_cart_page_header'); ?>
				</div>

				<div class="error_message"><?php usces_error_message(); ?></div>
				<form action="<?php usces_url('cart'); ?>" method="post" onKeyDown="if (event.keyCode == 13) {return false;}">
				<?php if( usces_is_cart() ) : ?><!-- カートの中身があった場合 -->
				<h1>ショッピングカート</h1>
				<div class="usccart_navi">
					<ol class="ucart">
					<li class="ucart usccart">注文内容</li>
					<li class="ucart usccustomer">お客様情報</li>
					<li class="ucart uscdelivery">発送・支払方法</li>
					<li class="ucart uscconfirm">最終確認</li>
					</ol>
				</div>
				<div id="cart">
					<div class="upbutton">数量を変更した場合は必ず更新ボタンを押してください<input name="upButton" type="submit" value="<?php _e('Quantity renewal','usces'); ?>" onclick="return uscesCart.upCart()" /></div>
					<table id="cart_table">
						<thead>
							<tr>
								<th scope="row" class="num">注文番号</th>
								<th class="thumbnail">/</th>
								<th>商品名</th>
								<th class="quantity">単価</th>
								<th class="quantity">数量</th>
								<th class="subtotal">価格</th>
								<th class="stock">在庫状況</th>
								<th class="action"></th>
							</tr>
						</thead>
						<tbody>
							<?php usces_get_cart_rows(); ?>
						</tbody>
					</table>
					<table id="cartTableBottom">
						<tr>
							<th>商品合計 <?php usces_crform(usces_total_price('return'), true, false); ?><?php usces_guid_tax(); ?></th>
						</tr>
					</table>
					<div class="continueShoppingOrNext"><?php usces_get_cart_button(); ?></div>
					<?php if( $usces_gp ) : ?>
					<img src="<?php bloginfo('template_directory'); ?>/images/gp.gif" alt="<?php _e('Business package discount','usces'); ?>" /><br /><?php _e('The price with this mark applys to Business pack discount.','usces'); ?>

					<?php endif; ?>
				</div><!-- end of cart -->

				<?php else : ?>
					<!-- カートの中身が無かった場合 -->
					<h1>ショッピングカート</h1>
					<div class="no_cart">カートに商品がありません。</div>
					<div class="continueShopping"><?php usces_get_cart_button(); ?></div>
				<?php endif; ?>
				<?php do_action('次へ進む'); ?>
				</form>

				<div class="footer_explanation">
				<?php do_action('次へ進む'); ?>
				</div>
			</div><!-- end of inside-cart -->

		</div><!-- end of entry -->
	</div><!-- end of post -->
<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'usces'); ?></p>
<?php endif; ?>
</div><!-- end of catbox -->
</div><!-- end of content -->

<?php get_footer(); ?>
