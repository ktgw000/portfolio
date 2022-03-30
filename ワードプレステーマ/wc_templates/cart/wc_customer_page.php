<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */
get_header();
?>

<div id="content" class="two-column">
<div id="cartPage2" class="catbox">

<?php if (have_posts()) : usces_remove_filter(); ?>

	<div class="posta" id="wc_<?php usces_page_name(); ?>">

	<h1 class="cart_page_title"><?php _e('Customer Information', 'usces'); ?></h1>
		<div class="entry">

			<div id="customer-info">

				<div class="usccart_navi">
					<ol class="ucart">
					<li class="ucart usccart">注文内容</li>
					<li class="ucart usccustomer">お客様情報</li>
					<li class="ucart uscdelivery">発送・支払方法</li>
					<li class="ucart uscconfirm">最終確認</li>
					</ol>
				</div>

				<div class="header_explanation">
				<?php do_action('usces_action_customer_page_header'); ?>
				</div><!-- end of header_explanation -->

				<div class="error_message"><?php usces_error_message(); ?></div>
			<?php if( usces_is_membersystem_state() ) : ?>
				<!-- 会員ログイン -->
				<h2>会員の方はこちら</h2>
				<form action="<?php usces_url('cart'); ?>" method="post" name="customer_loginform" onKeyDown="if (event.keyCode == 13) {return false;}">
				<div>
					<!-- メールアドレス -->
					<input name="loginmail" id="loginmail" type="text" value="<?php echo esc_attr($usces_entries['customer']['mailaddress1']); ?>" placeholder="メールアドレスを入力" style="ime-mode: inactive" />
				</br>
					<!-- パスワード -->
					<input class="hidden" value=" " /><input name="loginpass" id="loginpass" type="password" placeholder="パスワードを入力" value="" autocomplete="off" />
				</div>
				<!-- 次へ -->
				<div class="cartPageLogin">
					<input name="customerlogin" type="submit" value="<?php _e(' ログイン ', 'usces'); ?>" />
					<a href="<?php usces_url('lostmemberpassword'); ?>">パスワードを忘れた場合</a>
				</div>
				<?php do_action('usces_action_customer_page_member_inform'); ?>
				
				</form>
				<?php endif; ?>
				<!-- 非会員用フォーム -->
				<h2>お届け先の情報を入力</h2>
				<form action="<?php echo USCES_CART_URL; ?>" method="post" name="customer_form" onKeyDown="if (event.keyCode == 13) {return false;}">
				<!-- 名前~FAX -->
				<table class="customer_form">
					<?php uesces_addressform( 'customer', $usces_entries, 'echo' ); ?>
				</table>
				<h2>新規アカウント作成</h2>
				<table class="customer_form">
					<tr>
					<!-- メールアドレス -->
						<th><em>＊</em>メールアドレス</th>
						<td><input name="customer[mailaddress1]" id="mailaddress1" type="text" value="<?php echo esc_attr($usces_entries['customer']['mailaddress1']); ?>" style="ime-mode: inactive" /></td>
					</tr>
					<tr>
				<!-- メールアドレス確認 -->
						<th><em>＊</em>メールアドレス（確認用）</th>
						<td><input name="customer[mailaddress2]" id="mailaddress2" type="text" value="<?php echo esc_attr($usces_entries['customer']['mailaddress2']); ?>" style="ime-mode: inactive" /></td>
					</tr>
					<?php if( usces_is_membersystem_state() ) : ?>
					<tr>
					<!-- パスワード -->
						<th>
							<?php if( $member_regmode == 'editmemberfromcart' ) : ?>
							<?php endif; ?>
							<em>＊</em>パスワード
						</th>
						<td>
							<input class="hidden" value=" " />
							<input name="customer[password1]" id="password1" style="width:100px" type="password" value="<?php echo esc_attr($usces_entries['customer']['password1']); ?>" autocomplete="off" />
						</td>
					</tr>
					<!-- パスワード確認 -->
					<tr>
						<th>
							<?php if( $member_regmode == 'editmemberfromcart' ) : ?>
								<?php endif; ?>
								<em>＊</em>パスワード（確認用）
							</th>
						<td><input name="customer[password2]" id="password2" style="width:100px" type="password" value="<?php echo esc_attr($usces_entries['customer']['password2']); ?>" /></td>
					</tr>
				</table>
			<?php endif; ?>

				<input name="member_regmode" type="hidden" value="<?php echo $member_regmode; ?>" />
				<div><?php usces_agree_member_field(); ?></div>
				<div class="send">
				<?php my_usces_get_customer_button(); ?><!-- 修正前 → usces_get_customer_button() -->
				</div>

				<?php do_action('usces_action_customer_page_inform'); ?>
				</form>

				<div class="footer_explanation">
				<?php do_action('usces_action_customer_page_footer'); ?>
				</div><!-- end of footer_explanation -->
			</div><!-- end of customer-info -->

		</div><!-- end of entry -->
	</div><!-- end of post -->
<?php else: ?>
<p><?php _e('Sorry, no posts matched your criteria.', 'usces'); ?></p>
<?php endif; ?>
</div><!-- end of catbox -->
</div><!-- end of content -->

<?php get_footer(); ?>
