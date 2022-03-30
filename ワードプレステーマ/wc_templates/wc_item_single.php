<?php 
session_start(); 
$_SESSION["post_id"] = $post->ID; //レビューページで使用
$_SESSION["post_title"] = $post->post_title; //レビューページで使用
?>

<?php get_header(); ?>

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content">
	
<?php usces_remove_filter(); ?>
<?php usces_the_item(); ?>

<div id="productThumbnailViewerZoom"><img src=""></div>

<div id="product">
	<div id="productThumbnail">
		<div id="productThumbnailImage">
			<?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>
			<?php usces_the_itemImage(0, 500, 500, $post); ?>
			<?php $imageid = usces_get_itemSubImageNums(); ?>
			<?php foreach ( $imageid as $id ) : ?>
				<?php echo apply_filters('usces_itemimg_anchor_rel', NULL); ?>
				<?php usces_the_itemImage($id, 500, 500, $post); ?>
			<?php endforeach; ?>
		</div>
		<div id="productThumbnailViewer"><img src=""></div>
	</div>

<?php if(usces_sku_num() === 1) : usces_have_skus(); ?>
	<!--1SKU-->
<div class="productContent">	
<div class="productContentDiv">
	<h1 class="item_name"><?php usces_the_itemName(); ?> (<?php usces_the_itemCode(); ?>)</h1>
	<div class="review"><?php echo do_shortcode('[site_reviews_summary hide="bars" assigned_posts="post_id"]'); ?></div>
	<!-- <div class="exp clearfix"> -->
		<!-- <div class="field"> -->
		<?php if( usces_the_itemCprice('return') > 0 ) : ?>
			<!-- <div class="field_name"><?php _e('List price', 'usces'); ?><?php usces_guid_tax(); ?></div> 
			<div class="field_cprice"><?php usces_the_itemCpriceCr(); ?></div> -->
		<?php endif; ?>

	<div class="field_price">
			<?php _e('価格', 'usces'); ?>
			<span><?php usces_the_itemPriceCr(); ?></span><?php usces_guid_tax(); ?>
	</div> 

	<!-- 業務パック割引の表示 usces_the_itemGpExp();がデフォルト -->
	<?php my_itemGpExp_msg(); ?>

	<div id="productContentBottom">
		<div id="productInfomationDisplay">商品情報を表示</div>
		<div id="stock">
			<?php if(usces_the_itemZaikoNum("return") == 0): ?>
				<!-- 在庫0 -->
				<span>在庫なし</span>
			<?php elseif(usces_the_itemZaikoNum("return") <= 19): ?>
				<!-- 在庫19以下 -->
				<span>在庫 : 残り<?php usces_the_itemZaikoNum(); ?>点</span>
			<?php elseif(usces_the_itemZaikoNum("return") >= 20): ?>
				<!-- 在庫20以上 -->
				<span>在庫あり</span>
			<?php endif; ?>
		</div>
	</div>

</div>




	<form action="<?php echo USCES_CART_URL; ?>" method="post">

	<div class="skuform" ><!-- skuform Start -->
		<?php if (usces_is_options()) : ?>
			<table class='item_option'>
				<caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
				<?php while (usces_have_options()) : ?>
					<tr><th><?php usces_the_itemOptName(); ?></th><td><?php usces_the_itemOption(usces_getItemOptName(),''); ?></td></tr>
					<?php endwhile; ?>
				</table>
				<?php endif; ?>
				<?php if( !usces_have_zaiko() ) : ?>
					<div class="zaiko_status">
						<?php echo apply_filters('usces_filters_single_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?>
					</div>
					<?php else : ?>
						<div id="favoriteAdd"> <!-- okiniiri -->
						<?php
						global $usces;
						$post_id = (int)$post->ID; 
						$sku = esc_attr(urlencode($usces->itemsku['code']));
						okini_usces_the_itemSkuButton(__('お気に入りに追加')); 
						?>
						</div>
						<div class="form">
						<div class="add-to-number">
							<label>数量</label>
							<?php usces_the_itemQuant(); ?>
						</div>
						<div class="add-to-cart">
							<?php usces_the_itemSkuButton(__('カートに追加'), 0); ?>
						</div>
					</div>

			
			<?php endif; ?>
		</div><!-- skuform End -->


	</div><!--productContent-->
		
		
		
		<div class="error_message">
			<?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?>
		</div>
		<?php echo apply_filters('single_item_single_sku_after_field', NULL); ?>
		<?php do_action('usces_action_single_item_inform'); ?>
	</form>
	

	<?php do_action('usces_action_single_item_outform'); ?>


		<!-- </div> -->
		<?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
		<div class="field"><?php echo $item_custom; ?></div>
		<?php endif; ?>

	<!-- </div>end of exp -->


<?php elseif(usces_sku_num() > 1) : usces_have_skus(); ?>

	<!--some SKU-->
	<h2 class="item_name"><?php usces_the_itemName(); ?> (<?php usces_the_itemCode(); ?>)</h2>
	<div class="exp clearfix">
		<?php the_content(); ?>
		<?php if( $item_custom = usces_get_item_custom( $post->ID, 'list', 'return' ) ) : ?>
		<div class="field">
			<?php echo $item_custom; ?>
		</div>
		<?php endif; ?>
	</div><!-- end of exp -->

	<form action="<?php echo USCES_CART_URL; ?>" method="post">
		<div class="skuform">
			<table class="skumulti">
				<thead>
				<tr>
					<th rowspan="2" class="thborder"><?php _e('order number', 'usces'); ?></th>
					<th colspan="2"><?php _e('Title', 'usces'); ?></th>
		<?php if( usces_the_itemCprice('return') > 0 ) : ?>
					<th colspan="2">(<?php _e('List price', 'usces'); ?>)<?php _e('selling price', 'usces'); ?><?php usces_guid_tax(); ?></th>
		<?php else : ?>
					<th colspan="2"><?php _e('selling price', 'usces'); ?><?php usces_guid_tax(); ?></th>
		<?php endif; ?>
				</tr>
				<tr>
					<th class="thborder"><?php _e('stock status', 'usces'); ?></th>
					<th class="thborder"><?php _e('Quantity', 'usces'); ?></th>
					<th class="thborder"><?php _e('unit', 'usces'); ?></th>
					<th class="thborder">&nbsp;</th>
				</tr>
				</thead>
				<tbody>
		<?php do { ?>
				<tr>
					<td rowspan="2"><?php usces_the_itemSku(); ?></td>
					<td colspan="2" class="skudisp subborder"><?php usces_the_itemSkuDisp(); ?>
			<?php if (usces_is_options()) : ?>
						<table class='item_option'>
						<caption><?php _e('Please appoint an option.', 'usces'); ?></caption>
				<?php while (usces_have_options()) : ?>
							<tr>
								<th><?php usces_the_itemOptName(); ?></th>
								<td><?php usces_the_itemOption(usces_getItemOptName(),''); ?></td>
							</tr>
				<?php endwhile; ?>
						</table>
			<?php endif; ?>
					</td>
					<td colspan="2" class="subborder price">
			<?php if( usces_the_itemCprice('return') > 0 ) : ?>
					<span class="cprice">(<?php usces_the_itemCpriceCr(); ?>)</span>
			<?php endif; ?>
					<span class="price"><?php usces_the_itemPriceCr(); ?></span>
					<br /><?php usces_the_itemGpExp(); ?>
					</td>
				</tr>
				<tr>
					<td class="zaiko"><?php usces_the_itemZaikoStatus(); ?></td>
					<td class="quant"><?php usces_the_itemQuant(); ?></td>
					<td class="unit"><?php usces_the_itemSkuUnit(); ?></td>
				<?php if( !usces_have_zaiko() ) : ?>
					<td class="button"><?php echo apply_filters('usces_filters_multi_sku_zaiko_message', esc_html(usces_get_itemZaiko( 'name' ))); ?></td>
				<?php else : ?>
					<td class="button"><?php usces_the_itemSkuButton(__('Add to Shopping Cart', 'usces'), 0); ?></td>
				<?php endif; ?>
				</tr>
				<tr>
					<td colspan="5" class="error_message"><?php usces_singleitem_error_message($post->ID, usces_the_itemSku('return')); ?></td>
				</tr>

		<?php } while (usces_have_skus()); ?>
				</tbody>
			</table>
		</div><!-- end of skuform -->
		<?php echo apply_filters('single_item_multi_sku_after_field', NULL); ?>
		<?php do_action('usces_action_single_item_inform'); ?>
	</form>
	<?php do_action('usces_action_single_item_outform'); ?>
<?php endif; ?>

	<?php usces_assistance_item( $post->ID, __('An article concerned', 'usces') ); ?>

	</div>

	<?php include( TEMPLATEPATH . "/parts/carousel.php" ); ?>

<div id="productInfomation">
	<div id="productInfomationLeft">
		<h2>商品情報</h2>
		<div>
			<h3>品種</h3>
			<p>
				<?php 
				$text= SCF::get( '品種' );
				echo $text;
				?>
			</p>
		</div>
		<div>
			<h3>分類</h3>
			<p>
				<?php 
				$text = SCF::get( '分類' );
				echo $text;
				?>
			</p>
		</div>
		<div>
			<h3>販売単位</h3>
			<p>
				<?php 
				$text= SCF::get( '販売単位' );
				echo $text;
				?>
			</p>
		</div>
		<div>
			<h3>育成環境</h3>
			<p>
				<?php 
				$text= SCF::get( '育成環境' );
				echo $text;
				?>
			</p>
		</div>
	</div>
	<div id="productInfomationRight">
		<h2>説明</h2>
		<div>
			<p>
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php echo get_the_content();?>
				<?php endwhile; endif; ?>
			</p>
		</div>
	</div>
</div>

 


<div id="customerReviews">
	<div id="customerReviewLeft">
		<h2>カスタマーレビュー</h2>
		<?php echo do_shortcode('[site_reviews_summary class="customerReviewContent" assigned_posts="post_id"]'); ?>
		<div id="reviewAdd">
			<a href="http://localhost/wordpress/reviewadd/">商品のレビューを投稿する</a>
		</div>
	</div>
	<div id="customerReviewRight">
		<?php echo do_shortcode('[site_reviews assigned_posts="post_id" display="3"]'); ?>
		<div id="reviewAllDisplay">
			<a href="http://localhost/wordpress/product-reviews/">全てのレビューを表示</a>
		</div>
	</div>
</div>


</div><!-- end of content -->



<script type="text/javascript" src="/wordpress/<?php echo get_template_directory_uri(); ?>/js/okini.js"></script>
<script type="text/javascript" src="/wordpress/<?php echo get_template_directory_uri(); ?>/js/siteReviews.js"></script>
<script type="text/javascript" src="/wordpress/<?php echo get_template_directory_uri(); ?>/js/productPage.js"></script>
<?php get_footer(); ?>

