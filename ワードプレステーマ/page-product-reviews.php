<?php 
session_start(); 
$postId = $_SESSION["post_id"];
$postTitle = $_SESSION["post_title"];
?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/page-product-reviews.css">

<?php get_header(); ?>

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content" class="review">
	<div class="reviewLeft">
		<h1><?php echo $postTitle; ?></h1>
		<?php echo get_the_post_thumbnail($postId); ?>
		<h2>カスタマーレビュー</h2>
		<?php echo do_shortcode('[site_reviews_summary assigned_posts="'.$postId.'"]'); ?>
		<div id="reviewAdd">
			<a href="">商品のレビューを投稿する</a>
		</div>
	</div>
	<div class="reviewRight">
		<?php echo do_shortcode('[site_reviews assigned_posts="'.$postId.'"]'); ?>
	</div>
</div>

<script>
const glsrNoMargins = document.getElementsByClassName("glsr-no-margins")[0];
if(glsrNoMargins){
  glsrNoMargins.textContent = "この商品にはレビューがありません。"
}
</script>

<?php get_footer(); ?>