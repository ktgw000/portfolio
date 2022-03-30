


<?php get_header(); ?>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/category.css">

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content" class="category">  
  <?php include( TEMPLATEPATH . "/parts/sideber.php" ); ?>
  <div id="productList">
  <?php
  $getCategory = get_queried_object();
  $categoryName = $getCategory->name;
  $categoryId = $getCategory->cat_ID;
  $categoryCount = $getCategory->count;
  $posts = array(
    "posts_per_page" => 8, 
    "paged" => $paged,
    "category" => "$categoryId",
  );
  if(isset($_POST["categorySort"])){
    $categorySort = $_POST["categorySort"];
    if($categorySort == "新着順"){
      $posts += array(
        'order'=>'ASC',
      );
      echo '<script>
      setTimeout(()=>{
        document.getElementById("productSort").options[0].selected = true;
      },0)
      </script>';
    }
    else if($categorySort == "価格が高い"){
      $posts += array(
        'meta_key'=>'価格',
        'orderby'=>'meta_value_num',
        'order'=>'DESC',
      );
      echo '<script>
      setTimeout(()=>{
        document.getElementById("productSort").options[1].selected = true;
      },0)
      </script>';
    }
    else if($categorySort == "価格が低い"){
      $posts += array(
        'meta_key'=>'価格',
        'orderby'=>'meta_value_num',
        'order'=>'ASC',
      );
      echo '<script>
      setTimeout(()=>{
        document.getElementById("productSort").options[2].selected = true;
      },0)
      </script>';
    }
    else if($categorySort == "評価が高い"){
      $posts += array(
        'meta_key'=>'_glsr_average',
        'orderby'=>'meta_value_num',
        'order'=>'DESC',
      );
      echo '<script>
      setTimeout(()=>{
        document.getElementById("productSort").options[3].selected = true;
      },0)
      </script>';
    }
    else if($categorySort == "評価が多い"){
      $posts += array(
        'meta_key'=>'_glsr_reviews',
        'orderby'=>'meta_value_num',
        'order'=>'DESC',
      );
      echo '<script>
      setTimeout(()=>{
        document.getElementById("productSort").options[4].selected = true;
      },0)
      </script>';
    }
  }
	$postsArray = get_posts($posts); 
  ?>
  <h1><?php echo $categoryName; ?></h1>
  <div class="applicableProduct">
    <span>検索結果：<?php echo $categoryCount; ?>件</span>
    <form method="post" action="">
      <select name="categorySort" id="productSort" onchange="this.form.submit();loading()">
        <option value="新着順">新着順</option>
        <option value="価格が高い">価格が高い</option>
        <option value="価格が低い">価格が安い</option>
        <option value="評価が高い">評価が高い</option>
        <option value="評価が多い">評価が多い</option>
      </select>
    </form>
  </div>
  <?php if(have_posts()): foreach($postsArray as $post): setup_postdata($post); ?>
  <div class="productItem">
    <a href="<?php the_permalink(); ?>">
      <div><?php usces_the_itemImage(); ?></div>
      <h2><?php usces_the_itemName(); ?></h2>			
      <p class="productPrise"><?php usces_the_itemPriceCr_taxincluded(); ?></p>
      <?php echo do_shortcode('[site_reviews_summary hide="bars,rating" assigned_posts="post_id"]'); ?>
    </a>
  </div>	
  <?php endforeach; ?>
  <div id="pagination">
    <?php 
    $pagination = my_get_the_posts_pagination(
      array(
        'show_all' => true, //全てのページ番号を表示
        'type' => 'plain', // 戻り値の指定 (plain/list)
        'total'=> $wp_query->max_num_pages, //ページ総数
      )
    ); 
    $prevButton = get_previous_posts_link('前へ');
    $nextButton = get_next_posts_link('次へ');
    ?>
    <div class="paginationContent">
      <div class="paginationPrevButton"><?php echo $prevButton; ?></div>
      <?php echo $pagination; ?>
      <div class="paginationNextButton"><?php echo $nextButton; ?></div>
    </div>
  </div>
  <?php else: ?>
    <p>商品がありません</p>
  <?php endif; ?>
  </div> 
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/category.js"></script>

<?php get_footer(); ?>

