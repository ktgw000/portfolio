<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/search.css">

<?php get_header(); ?>

<div id="breadcrumb"><?php breadcrumb(); ?></div>

<div id="content" class="search">

    <?php include( TEMPLATEPATH . "/parts/sideber.php" ); ?>

    <?php if(have_posts()): ?> 
    <?php 
    $searchPosts = array(
        'posts_per_page' => 8,
        's' => get_search_query(),
    );
    if(isset($_POST["searchSort"])){
        $searchSort = $_POST["searchSort"];
        if($searchSort == "新着順"){
            $searchPosts += array(
              'order'=>'ASC',
            );
            echo '<script>
            setTimeout(()=>{
              document.getElementById("productSort").options[0].selected = true;
            },0)
            </script>';
        }
        else if($searchSort == "価格が高い"){
            $searchPosts += array(
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
        else if($searchSort == "価格が低い"){
            $searchPosts += array(
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
        else if($searchSort == "評価が高い"){
      
            echo '<script>
            setTimeout(()=>{
              document.getElementById("productSort").options[3].selected = true;
            },0)
            </script>';
        }
        else if($searchSort == "評価が多い"){
      
            echo '<script>
            setTimeout(()=>{
              document.getElementById("productSort").options[4].selected = true;
            },0)
            </script>';
        }
    }
    $searchPostsArray = get_posts($searchPosts);
    ?>
    <div id="productList">
        <h1>"<?php the_search_query(); ?>"</h1>
        <div class="applicableProduct">
            <span>検索結果：<?php echo $wp_query->found_posts; ?>件</span>
            <form method="post" action="/wordpress/?s=<?php echo get_search_query(); ?>">
                <select name="searchSort" id="productSort" onchange="this.form.submit();loading()">
                    <option value="新着順">新着順</option>
                    <option value="価格が高い">価格が高い</option>
                    <option value="価格が低い">価格が安い</option>
                    <option value="評価が高い">評価が高い</option>
                    <option value="評価が多い">評価が多い</option>
                </select>
            </form>
        </div>
        <?php 
        $postKeep = $post; 
        foreach($searchPostsArray as $searchPost): $post = $searchPost; 
        ?> 
        <div class="productItem">
          <a href="<?php the_permalink(); ?>">
          <div><?php the_post_thumbnail(); ?></div>
          <h2><?php the_title(); ?></h2>	
          <p class="productPrise"><?php usces_the_itemPriceCr_taxincluded(); ?></p>
          <?php echo do_shortcode('[site_reviews_summary hide="bars,rating" assigned_posts="post_id"]'); ?>
          </a>
        </div>	
        <?php endforeach; $post = $postKeep; ?>
        <div id="pagination">
            <?php 
            $pagination = my_get_the_posts_pagination(array(
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
    </div>	
    <?php else: ?>
    <p>商品が見つかりませんでした。</p>
    <p>別のキーワードをお試しください。</p>
    <?php endif; ?>
</div>

<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/search.js"></script>

<?php get_footer(); ?>

