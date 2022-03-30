<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */
get_header();
?>
<div id="breadcrumb"><?php breadcrumb(); ?></div>
<div id="content">
	<div id="loginPage">
		<div id="loginInfomation" class="two-column">
			<?php if (have_posts()) : usces_remove_filter(); ?>
			<div class="posta" id="wc_<?php usces_page_name(); ?>">
			<h2 class="member_page_title"><?php _e('ログイン'); ?></h2>
			<div class="entry">
				<div id="memberpages">
					<div class="whitebox">
						<div class="header_explanation">
							<?php do_action('usces_action_login_page_header'); ?>
						</div>
						<div class="error_message"><?php usces_error_message(); ?></div>
						<div class="loginbox">
							<form name="loginform" id="loginform" action="<?php echo apply_filters('usces_filter_login_form_action', USCES_MEMBER_URL); ?>" method="post">
							<label>メールアドレス</br>
							<input type="text" name="loginmail" id="loginmail" class="loginmail" value="<?php echo esc_attr(usces_remembername('return')); ?>" size="20" /></label>
							<label>パスワード</br>
							<input class="hidden" value=" " />
							<input type="password" name="loginpass" id="loginpass" class="loginpass" size="20" autocomplete="off" />
							</label>
							<label class="loginInfomationKeep"><input name="rememberme" type="checkbox" id="rememberme" value="forever" />ログイン情報を保存する</label>
							<?php usces_login_button(); ?>
							<?php do_action('usces_action_login_page_inform'); ?>
							</form>
							<div class="passwordForgot">
								<a href="<?php usces_url('lostmemberpassword'); ?>">パスワードを忘れた方はこちら</a>
							</div>
						</div>
						<div class="footer_explanation">
							<?php do_action('usces_action_login_page_footer'); ?>
						</div>
					</div><!-- end of whitebox -->
				</div><!-- end of memberpages -->
				<script type="text/javascript">
				<?php if ( usces_is_login() ) : ?>
					setTimeout( function(){ try{
					d = document.getElementById('loginpass');
					d.value = '';
					d.focus();
					} catch(e){}
					}, 200);
				<?php else : ?>
					try{document.getElementById('loginmail').focus();}catch(e){}
				<?php endif; ?>
				</script>
				</div><!-- end of entry -->
			</div><!-- end of post -->
			<?php else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.', 'usces'); ?></p>
			<?php endif; ?>
		</div><!-- end of login -->
		<div class="signUp"> 
			<h2>当店を初めてご利用のお客様へ</h2>
		 	<p>会員登録、及び機能は無料でご利用いただけます。</p>
		 	<p>ポイントやクーポンなど、お得な特典を受けることができます。</p>
		 	<p class="newMenbar"><a href="<?php usces_url('newmember') . apply_filters('usces_filter_newmember_urlquery', NULL); ?>">新規会員登録はこちら</a></p>
		</div>
	</div>
</div>

<?php get_footer(); ?>