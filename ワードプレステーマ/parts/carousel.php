<link rel="stylesheet" type="text/css" href="/wordpress/wp-content/themes/sample/css/carousel.css">
<?php 
global $post;
$postkeep = $post;
$posts = array(
  'posts_per_page' => 10, 
  'orderby' => 'rand' 	
);
$posts_array = get_posts($posts);
?>
<h2 id="kanren">関連商品リスト</h2>
<div id="carousel">
  <div id="carouselPrev"></div>
  <div id="carouselNext"></div>       
  <div class="carouselItem">
    <?php foreach($posts_array as $post): setup_postdata($post); ?>
    <?php $prise = SCF::get( '価格' ); ?>
    <a href="<?php the_permalink(); ?>">
      <div class="carouselThumbnail"><?php the_post_thumbnail('medium'); ?></div>
      <p class="carouselTitle"><?php the_title(); ?></p>
      <p class="carouselPrise"><span>価格</span><span>\<?php echo $prise; ?></span></p>
    </a>

    <?php endforeach; $post = $postkeep; ?>
  </div>
</div> 

<script type="text/javascript" src="/wordpress/wp-content/themes/sample/js/carousel.js"></script>
