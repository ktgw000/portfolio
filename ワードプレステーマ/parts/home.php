<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/home.css">

<div id="content" class="home">

<?php 
$categoryIdLine1 = 2; // 1列目に表示するカテゴリIDを指定
$categoryIdLine2 = 1; // 2列目に表示するカテゴリIDを指定
$categoryIdLine3 = [1,2]; // 3列目に表示するカテゴリIDを指定

// echo get_the_category_by_ID($categoryIdLine2);
?>

<?php include( TEMPLATEPATH . "/parts/sideber.php" ); ?>
	
<div id="itemLists">
	<div class="itemList">
		<h2>オススメ商品リスト1</h2>
		<a class="itemListAll" href="<?php echo esc_url(get_category_link($categoryIdLine1)); ?>">すべて表示</a>
			<div class="itemListContents">
				<?php 
				$posts = array(
				'posts_per_page' => 8, 
				'category' => $categoryIdLine1,
				'orderby' => 'rand',		
				);
				$posts_array = get_posts($posts);
				?>
				<?php foreach($posts_array as $post): setup_postdata($post); ?>
				<?php $prise = SCF::get( '価格' ); ?>
				<div class="itemListContent">
					<a href="<?php the_permalink(); ?>">
					<div class="itemListContentImage">
						<?php usces_the_itemImage($number, 320, 240, $post, $out, $media); ?>
					</div>
					<h3 class="itemListContentTitle"><?php usces_the_itemName(); ?></h3>			
					<p class="itemListContentPrise">
						<span>価格</span>
						<span>\<?php echo $prise; ?></span>
					</p>
					</a>
				</div>	
				<?php endforeach; ?>
				<div class="itemListContentNextButton show"></div>
				<div class="itemListContentPrevButton"></div>
				<div class="itemListContentResetButton"></div>
			</div>
		</div>
		<div class="itemList">
			<h2>オススメ商品リスト2</h2>
			<a class="itemListAll" href="<?php echo esc_url(get_category_link($categoryIdLine2)); ?>">すべて表示</a>
			<div class="itemListContents">
				<?php 
				$posts = array(
					'posts_per_page' => 8, 
					'category' => $categoryIdLine2,
					'orderby' => 'rand',		
				);
				$posts_array = get_posts($posts);
				?>
				<?php foreach($posts_array as $post): setup_postdata($post); ?>
				<?php $prise = SCF::get( '価格' ); ?>
				<div class="itemListContent">
					<a href="<?php the_permalink(); ?>">
					<div class="itemListContentImage">
						<?php usces_the_itemImage($number, 320, 240, $post, $out, $media); ?>
					</div>
					<h3 class="itemListContentTitle"><?php usces_the_itemName(); ?></h3>			
					<p class="itemListContentPrise">
						<span>価格</span>
						<span>\<?php echo $prise; ?></span>
					</p>
					</a>
				</div>	
				<?php endforeach; ?>
				<div class="itemListContentNextButton show"></div>
				<div class="itemListContentPrevButton"></div>
				<div class="itemListContentResetButton"></div>
			</div>
		</div>
		<div class="itemList">
			<h2>オススメ商品リスト3</h2>
			<a class="itemListAll" href="http://localhost/wordpress/category/item/">すべて表示</a>
			<div class="itemListContents">
				<?php 
				$posts = array(
					'posts_per_page' => 8, 
					'category' => $categoryIdLine3,
					'orderby' => 'rand',	
				);
				$posts_array = get_posts($posts); ?>
				<?php foreach($posts_array as $post): setup_postdata($post); ?>
				<?php $prise = SCF::get( '価格' ); ?>
				<div class="itemListContent">
					<a href="<?php the_permalink(); ?>">
					<div class="itemListContentImage">
						<?php usces_the_itemImage($number, 320, 240, $post, $out, $media); ?>
					</div>
					<h3 class="itemListContentTitle"><?php usces_the_itemName(); ?></h3>			
					<p class="itemListContentPrise">
						<span>価格</span>
						<span>\<?php echo $prise; ?></span>
					</p>
				</a>
				</div>	
				<?php endforeach; ?>
				<div class="itemListContentNextButton show"></div>
				<div class="itemListContentPrevButton"></div>
				<div class="itemListContentResetButton"></div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/home.js"></script>