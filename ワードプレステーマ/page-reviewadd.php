<?php 
session_start(); 
$postId = $_SESSION["post_id"];
$postTitle = $_SESSION["post_title"];
?>

<pre>
	<?php
var_dump($_SESSION);
?>
</pre>
<?php get_header(); ?>

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content" class="review">
	<h1><a href="<?php echo esc_url(get_permalink($postId)) ?>"><?php echo $postTitle; ?><a></h1>

	<?php echo do_shortcode('[site_reviews_form assigned_posts="'.$postId.'"]'); ?>
</div>

<?php get_footer(); ?>