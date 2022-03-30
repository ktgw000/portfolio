<?php 
session_start(); 
$postId = $_SESSION["post_id"];
$postTitle = $_SESSION["post_title"];
var_dump($_SESSION);
?>

<?php get_header(); ?>

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content" class="review">

<div id="test"><?php get_the_title($postId); ?>
</div>
</div>


<script type="text/javascript" src="/wordpress/<?php echo get_template_directory_uri(); ?>/js/okinicopy.js"></script>

<?php get_footer(); ?>