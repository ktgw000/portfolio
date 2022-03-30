<?php
/**
 * <meta content="charset=UTF-8">
 * @package Welcart
 * @subpackage Welcart Default Theme
 */
if(!defined('USCES_VERSION')) return;

add_action( 'after_setup_theme', 'welcart_setup' );
if ( ! function_exists( 'welcart_setup' ) ):
function welcart_setup() {

	load_theme_textdomain( 'uscestheme', get_template_directory() . '/languages' );

	$GLOBALS['content_width'] = 770;

	add_theme_support('title-tag');

	register_nav_menus( array(
		'header' => __('Header Navigation', 'usces' ),
		'footer' => __('Footer Navigation', 'usces' ),
	) );
}
endif;

function welcart_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'welcart_page_menu_args' );
add_filter('widget_categories_dropdown_args', 'welcart_categories_args');
add_filter('widget_categories_args', 'welcart_categories_args');
function welcart_categories_args( $args ){
	global $usces;
	$ids = $usces->get_item_cat_ids();
	$ids[] = USCES_ITEM_CAT_PARENT_ID;
	$args['exclude'] = $ids;
	return $args;
}
add_filter('getarchives_where', 'welcart_getarchives_where');
function welcart_getarchives_where( $r ){
	$where = "WHERE post_type = 'post' AND post_status = 'publish' AND post_mime_type <> 'item' ";
	return $where;
}
add_filter('widget_tag_cloud_args', 'welcart_tag_cloud_args');
function welcart_tag_cloud_args( $args ){
	global $usces;
	if( 'category' == $args['taxonomy']){
		$ids = $usces->get_item_cat_ids();
		$ids[] = USCES_ITEM_CAT_PARENT_ID;
		$args['exclude'] = $ids;
	}else if( 'post_tag' == $args['taxonomy']){
		$ids = $usces->get_item_post_ids();
		$tobs = wp_get_object_terms($ids, 'post_tag');
		foreach( $tobs as $ob ){
			$tids[] = $ob->term_id;
		}
		$args['exclude'] = $tids;
	}
	return $args;
}

if ( ! function_exists( 'welcart_assistance_excerpt_length' ) ) {
	function welcart_assistance_excerpt_length( $length ) {
		return 10;
	}
}

if ( ! function_exists( 'welcart_assistance_excerpt_mblength' ) ) {
	function welcart_assistance_excerpt_mblength( $length ) {
		return 40;
	}
}

if ( ! function_exists( 'welcart_excerpt_length' ) ) {
	function welcart_excerpt_length( $length ) {
		return 40;
	}
}
add_filter( 'excerpt_length', 'welcart_excerpt_length' );

if ( ! function_exists( 'welcart_excerpt_mblength' ) ) {
	function welcart_excerpt_mblength( $length ) {
		return 110;
	}
}
add_filter( 'excerpt_mblength', 'welcart_excerpt_mblength' );

if ( ! function_exists( 'welcart_continue_reading_link' ) ) {
	function welcart_continue_reading_link() {
		return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'uscestheme' ) . '</a>';
	}
}

if ( ! function_exists( 'welcart_auto_excerpt_more' ) ) {
	function welcart_auto_excerpt_more( $more ) {
		return ' &hellip;' . welcart_continue_reading_link();
	}
}
//add_filter( 'excerpt_more', 'welcart_auto_excerpt_more' );

if ( ! function_exists( 'welcart_custom_excerpt_more' ) ) {
	function welcart_custom_excerpt_more( $output ) {
		if ( has_excerpt() && ! is_attachment() ) {
			$output .= welcart_continue_reading_link();
		}
		return $output;
	}
}
//add_filter( 'get_the_excerpt', 'welcart_custom_excerpt_more' );

if( $usces->options['use_ssl'] ){
	add_action('init', 'usces_ob_start');
	function usces_ob_start(){
		global $usces;
		if( $usces->use_ssl && ($usces->is_cart_or_member_page($_SERVER['REQUEST_URI']) || $usces->is_inquiry_page($_SERVER['REQUEST_URI'])) )
			ob_start('usces_ob_callback');
	}
	if ( ! function_exists( 'usces_ob_callback' ) ) {
		function usces_ob_callback($buffer){
			global $usces;
			$pattern = array(
				'|(<[^<]*)href=\"'.get_option('siteurl').'([^>]*)\.css([^>]*>)|', 
				'|(<[^<]*)src=\"'.get_option('siteurl').'([^>]*>)|'
			);
			$replacement = array(
				'${1}href="'.USCES_SSL_URL_ADMIN.'${2}.css${3}', 
				'${1}src="'.USCES_SSL_URL_ADMIN.'${2}'
			);
			$buffer = preg_replace($pattern, $replacement, $buffer);
			return $buffer;
		}
	}
}

// パンくずリスト https://cotodama.co/wordpress_breadcrumb/
function breadcrumb() {
    $home = '<li><a href="'.get_bloginfo('url').'" >HOME</a></li>';
  
    echo '<ol>';
    if ( is_front_page() ) {
        // トップページの場合
    }
    else if ( is_category() ) {
        // カテゴリページの場合
        $cat = get_queried_object();
        $cat_id = $cat->parent;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        echo $home;
        foreach($cat_list as $value){
            echo $value;
        }
        the_archive_title('<li>', '</li>');
    }
    else if ( is_archive() ) {
    // 月別アーカイブ・タグページの場合
    echo $home;
    the_archive_title('<li>', '</li>');
    }
    else if ( is_single() ) {
    // 投稿ページの場合
    $cat = get_the_category();
        if( isset($cat[0]->cat_ID) ) $cat_id = $cat[0]->cat_ID;
        $cat_list = array();
        while ($cat_id != 0){
            $cat = get_category( $cat_id );
            $cat_link = get_category_link( $cat_id );
            array_unshift( $cat_list, '<li><a href="'.$cat_link.'">'.$cat->name.'</a></li>' );
            $cat_id = $cat->parent;
        }
        foreach($cat_list as $value){
            echo $value;
        }
    }
    else if( is_page() ) {
    // 固定ページの場合
    echo $home;
    the_title('<li>', '</li>');
    }
    else if( is_search() ) {
    // 検索ページの場合
    echo $home;
    echo '<li>「'.get_search_query().'」の検索結果</li>';
    }
    else if( is_404() ) {
    // 404ページの場合
    echo $home;
    echo '<li>ページが見つかりません</li>';
    }
    echo "</ol>";
}
// アーカイブの余計なタイトルを削除
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_month() ) {
        $title = single_month_title( '', false );
    }
    return $title;
});

// 関数にウィジェットの情報を配列で入力
function headerWidget(){
    register_sidebar(array(
      "id" => "header",
      "class" => "headerWidget",
      "name" => "ヘッダーエリア",
      "before_widget" => "<div>",
      "after_widget" => "</div>"
    ));
  }
  function  footerWidget(){
    register_sidebar(array(
      "id" => "footera",
      "class" => "footerWidget",
      "name" => "フッダーエリア",
      "before_widget" => "<div>",
      "after_widget" => "</div>"
    ));
  }
  
  // 関数に入ったウィジェットの情報を登録
  add_action("widgets_init","headerWidget");
  add_action("widgets_init","footerWidget");

function my_usces_get_customer_button( $out = '' ) {
	global $usces, $member_regmode;
	$res = '';

	$res = '<input name="backCart" type="submit" class="back_cart_button" value="'.__('Back', 'usces').'" />&nbsp;&nbsp;';

	// $button = '<input name="deliveryinfo" type="submit" class="to_deliveryinfo_button" value="'.__(' Next ', 'usces').'" />&nbsp;&nbsp;';
	
	$res .= apply_filters('usces_filter_customer_button', $button);

	if(usces_is_membersystem_state() && $member_regmode != 'editmemberfromcart' && usces_is_login() == false ){
		$res .= '<input name="reganddeliveryinfo" type="submit" class="to_reganddeliveryinfo_button" value="'.__('To the next while enrolling', 'usces').'"' . apply_filters('usces_filter_customerinfo_prebutton', NULL) . ' />';
	}elseif(usces_is_membersystem_state() && $member_regmode == 'editmemberfromcart' ){
		$res .= '<input name="reganddeliveryinfo" type="submit" class="to_reganddeliveryinfo_button" value="'.__('Revise member information, and to next', 'usces').'"' . apply_filters('usces_filter_customerinfo_nextbutton', NULL) . ' />';
	}

	$res = apply_filters('usces_filter_get_customer_button', $res);

	if($out == 'return'){
		return $res;
	}else{
		echo $res;
	}
}

//郵便番号
function my_example_zipcode() {
  return '';
}
add_filter('usces_filter_after_zipcode', 'my_example_zipcode');

//市区郡町村
function my_example_address1() {
  return '';
}
add_filter('usces_filter_after_address1', 'my_example_address1');

//番地
function my_example_address2() {
  return '';
}
add_filter('usces_filter_after_address2', 'my_example_address2');

//ビル名
function my_example_address3() {
  return '';
}
add_filter('usces_filter_after_address3', 'my_example_address3');

//電話番号
function my_example_tel() {
  return '';
}
add_filter('usces_filter_after_tel', 'my_example_tel');

//FAX番号
function my_example_fax() {
  return '';
}
add_filter('usces_filter_after_fax', 'my_example_fax');

//数量をプルダウン化
add_filter('usces_filter_the_itemQuant',  'my_filter_the_itemQuant', 10, 2);
function my_filter_the_itemQuant($html, $post) {
	$zaiko = usces_the_itemZaikoNum( 'return' );
  $sku = urlencode(usces_the_itemSku('return'));
  $html = '<select name="quant[' . $post->ID . '][' . $sku . ']" class="skuquantity">';
  for ($i = 1; $i <= $zaiko; $i++) {
    $html .= '<option value="' . $i . '">' . $i .  '</option>';
  }
  $html .= '</select>';
  return $html;
}
?>
<?php
// https://nw.myds.me/wecart/welcart-itemgpexp-msg/
function my_itemGpExp_msg() {
	$title = '';
	global $post, $usces;
	if($usces->itemsku['gp'] == 0){return;}               /* 業務パック非適用の場合は終了 */

	$post_id = $post->ID;
	$sku = $usces->itemsku['code'];
	$GpN1 = $usces->getItemGpNum1($post_id);	  /* 指定個数 */
	$GpN2 = $usces->getItemGpNum2($post_id);
	$GpN3 = $usces->getItemGpNum3($post_id);
	$GpD1 = $usces->getItemGpDis1($post_id);		  /* 割引率 */
	$GpD2 = $usces->getItemGpDis2($post_id);
	$GpD3 = $usces->getItemGpDis3($post_id);
	$unit = $usces->getItemSkuUnit($post_id, $sku);  /* 単位 */
	$price = $usces->getItemPrice($post_id, $sku);    /* 価格 */
	if($GpN1 == 0 || $GpD1 == 0){return;}				  /* プライスダウン設定が無い場合は終了 */	

	if($unit == ''){$unit = '個';}								  /* 単位が未設定の時は個を利用 */

	/* 割引１のメッセージ作成 */
	$price1 =number_format(round($price * (100 - $GpD1) / 100));	
	$max1 = $GpN2 - 1;
	if($GpN2 == 0){
		$msg1 = $GpN1.$unit.'~ '.$GpD1.'%OFF：¥'.$price1.'円 /'.$unit;}
	elseif($GpN1 != $max1){
		$msg1 = $GpN1.$unit.'~ '.$GpD1.'%OFF：¥'.$price1.'円 /'.$unit;}
	else{
		$msg1 = $GpN1.$unit.'~ '.$GpD1.'%OFF：¥'.$price1.'円 /'.$unit;}

	/* 割引２のメッセージ作成 */
	$price2 =number_format(round($price * (100 - $GpD2) / 100));
	$max2 = $GpN3 - 1;
	if($GpN3 == 0 || $GpD3 == 0){
		$msg2 = $GpN2.$unit.'~ '.$GpD2.'%OFF：¥'.$price2.'円 /'.$unit;}
	elseif($GpN2 != $max2){
		$msg2 = $GpN2.$unit.'~ '.$GpD2.'%OFF：¥'.$price2.'円 /'.$unit;}
	else{
		$msg2 = $GpN2.$unit.'~ '.$GpD2.'%OFF：¥'.$price2.'円 /'.$unit;}

	/* 割引３のメッセージ作成 */
	$price3 =number_format(round($price * (100 - $GpD3) / 100));


	/* メッセージ入れ替え */
	$msg1_1 = $GpN1.$unit.'~';
	$msg1_2 = $price1;
	$msg1_3 = ' /'.$unit;
	$msg1_4 = $GpD1.'%OFF!!';

	$msg2_1 = $GpN2.$unit.'~';
	$msg2_2 = $price2;
	$msg2_3 = ' /'.$unit;
	$msg2_4 = $GpD2.'%OFF!!';

	$msg3_1 = $GpN3.$unit.'~';
	$msg3_2 = $price3;
	$msg3_3 = ' /'.$unit;
	$msg3_4 = $GpD3.'%OFF!!';
?>

<div class='gp_box'>
	<div class='gp_msg'>
			<div class="sp_msg1">
				<span class='msg1'><?php echo $msg1_1; ?></span>
				<span class='msg2'>\<?php echo $msg1_2; ?></span>
				<span class='msg3'><?php echo $msg1_3; ?></span>
				<span class='msg4'><?php echo $msg1_4; ?></span>
			</div>	
		<?php if($GpN2 != 0 & $GpD2 != 0):?>
			<div class="sp_msg2">
				<span class='msg1'><?php echo $msg2_1; ?></span>
				<span class='msg2'>\<?php echo $msg2_2; ?></span>
				<span class='msg3'><?php echo $msg2_3; ?></span>
				<span class='msg4'><?php echo $msg2_4; ?></span>
			</div>	
		<?php endif;?>
		<?php if($GpN3 != 0 & $GpD3 != 0):?>
			<div class="sp_msg3">
				<span class='msg1'><?php echo $msg3_1; ?></span>
				<span class='msg2'>\<?php echo $msg3_2; ?></span>
				<span class='msg3'><?php echo $msg3_3; ?></span>
				<span class='msg4'><?php echo $msg3_4; ?></span>
			</div>	
		<?php endif;?>
	</div>
</div>

<?php
}
// 個別商品関連関数の追加 
	get_template_part('func/welcart/item/my_itemGpExp_msg');		/* 業務パックマーク＆メッセージ変更 */

function my_paginate_links( $args = '' ) {
	global $wp_query, $wp_rewrite;

	// Setting up default values based on the current URL.
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$url_parts    = explode( '?', $pagenum_link );

	// Get max pages and current page out of the current query, if available.
	$total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
	$current = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;

	// Append the format placeholder to the base URL.
	$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

	// URL base depends on permalink settings.
	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	$defaults = array(
		'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
		'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
		'total'              => $total,
		'current'            => $current,
		'aria_current'       => 'page',
		'show_all'           => false,
		'prev_next'          => true,
		'prev_text'          => __( '&laquo; Previous' ),
		'next_text'          => __( 'Next &raquo;' ),
		'end_size'           => 1,
		'mid_size'           => 2,
		'type'               => 'plain',
		'add_args'           => array(), // Array of query args to add.
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);

	$args = wp_parse_args( $args, $defaults );

	if ( ! is_array( $args['add_args'] ) ) {
		$args['add_args'] = array();
	}

	// Merge additional query vars found in the original URL into 'add_args' array.
	if ( isset( $url_parts[1] ) ) {
		// Find the format argument.
		$format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
		$format_query = isset( $format[1] ) ? $format[1] : '';
		wp_parse_str( $format_query, $format_args );

		// Find the query args of the requested URL.
		wp_parse_str( $url_parts[1], $url_query_args );

		// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
		foreach ( $format_args as $format_arg => $format_arg_value ) {
			unset( $url_query_args[ $format_arg ] );
		}

		$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
	}

	// Who knows what else people pass in $args.
	$total = (int) $args['total'];
	if ( $total < 2 ) {
		return;
	}
	$current  = (int) $args['current'];
	$end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
	if ( $end_size < 1 ) {
		$end_size = 1;
	}
	$mid_size = (int) $args['mid_size'];
	if ( $mid_size < 0 ) {
		$mid_size = 2;
	}

	$add_args   = $args['add_args'];
	$r          = '';
	$page_links = array();
	$dots       = false;

	if ( $args['prev_next'] && $current && 1 < $current ) :
		$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current - 1, $link );
		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args['add_fragment'];

		$page_links[] = sprintf(
			'<a class="prev page-numbers" href="%s">%s</a>',
			/**
			 * Filters the paginated links for the given archive pages.
			 *
			 * @since 3.0.0
			 *
			 * @param string $link The paginated link URL.
			 */
			esc_url( apply_filters( 'my_paginate_links', $link ) ),
			$args['prev_text']
		);
	endif;

	for ( $n = 1; $n <= $total; $n++ ) :
		if ( $n == $current ) :
			$page_links[] = sprintf(
				'<option selected>' . $n . "/" . $wp_query->max_num_pages .'</option>',
				esc_attr( $args['aria_current'] ),
				$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
			);

			$dots = true;
		else :
			if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
				$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
				$link = str_replace( '%#%', $n, $link );
				if ( $add_args ) {
					$link = add_query_arg( $add_args, $link );
				}
				$link .= $args['add_fragment'];

				$page_links[] = sprintf(
					'<option value="%s">%s'. "/" . $wp_query->max_num_pages .'</option>',
					/** This filter is documented in wp-includes/general-template.php */
					esc_url( apply_filters( 'my_paginate_links', $link ) ),
					$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
				);

				$dots = true;
			elseif ( $dots && ! $args['show_all'] ) :
				$page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';

				$dots = false;
			endif;
		endif;
	endfor;

	if ( $args['prev_next'] && $current && $current < $total ) :
		$link = str_replace( '%_%', $args['format'], $args['base'] );
		$link = str_replace( '%#%', $current + 1, $link );
		if ( $add_args ) {
			$link = add_query_arg( $add_args, $link );
		}
		$link .= $args['add_fragment'];

		$page_links[] = sprintf(
			'<a class="next page-numbers" href="%s">%s</a>',
			/** This filter is documented in wp-includes/general-template.php */
			esc_url( apply_filters( 'my_paginate_links', $link ) ),
			$args['next_text']
		);
	endif;

	switch ( $args['type'] ) {
		case 'array':
			return $page_links;

		case 'list':
			$r .= "<ul class='page-numbers'>\n\t<li>";
			$r .= implode( "</li>\n\t<li>", $page_links );
			$r .= "</li>\n</ul>\n";
			break;

		default:
			$r = implode( "\n", $page_links );
			break;
	}

	/**
	 * Filters the HTML output of paginated links for archives.
	 *
	 * @since 5.7.0
	 *
	 * @param string $r    HTML output.
	 * @param array  $args An array of arguments. See paginate_links()
	 *                     for information on accepted arguments.
	 */
	$r = apply_filters( 'paginate_links_output', $r, $args );

	return $r;
}

function my_get_the_posts_pagination( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
		// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
		if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
			$args['aria_label'] = $args['screen_reader_text'];
		}

		$args = wp_parse_args(
			$args,
			array(
				'mid_size'           => 1,
				'prev_text'          => _x( 'Previous', 'previous set of posts' ),
				'next_text'          => _x( 'Next', 'next set of posts' ),
				'screen_reader_text' => __( 'Posts navigation' ),
				'aria_label'         => __( 'Posts' ),
				'class'              => 'pagination',
				'show_all' => true, //全てのページ番号を表示
				'type' => 'plain', // 戻り値の指定 (plain/list)
				'total'=> $wp_query->max_num_pages, //ページ総数
			)
		);

		// Make sure we get a string back. Plain is the next best thing.
		if ( isset( $args['type'] ) && 'array' === $args['type'] ) {
			$args['type'] = 'plain';
		}

		// Set up paginated links.
		$links = my_paginate_links( $args );

		if ( $links ) {
			$navigation = _my_navigation_markup( $links, $args['class'], $args['screen_reader_text'], $args['aria_label'] );
		}
	}

	return $navigation;
}

function my_paginate_comments_links( $args = array() ) {
	global $wp_rewrite;

	if ( ! is_singular() ) {
		return;
	}

	$page = get_query_var( 'cpage' );
	if ( ! $page ) {
		$page = 1;
	}
	$max_page = get_comment_pages_count();
	$defaults = array(
		'base'         => add_query_arg( 'cpage', '%#%' ),
		'format'       => '',
		'total'        => $max_page,
		'current'      => $page,
		'echo'         => true,
		'type'         => 'plain',
		'add_fragment' => '#comments',
	);
	if ( $wp_rewrite->using_permalinks() ) {
		$defaults['base'] = user_trailingslashit( trailingslashit( get_permalink() ) . $wp_rewrite->comments_pagination_base . '-%#%', 'commentpaged' );
	}

	$args       = wp_parse_args( $args, $defaults );
	$page_links = my_paginate_links( $args );

	if ( $args['echo'] && 'array' !== $args['type'] ) {
		echo $page_links;
	} else {
		return $page_links;
	}
}

function my_the_posts_pagination( $args = array() ) {
	$navigation = '';

	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages > 1 ) {
			$args = wp_parse_args( $args, array(
					'mid_size'           => 1,
					'prev_text'          => _x( 'Previous', 'previous post' ),
					'next_text'          => _x( 'Next', 'next post' ),
					'screen_reader_text' => __( 'Posts navigation' ),
			) );

			// Make sure we get a string back. Plain is the next best thing.
			if ( isset( $args['type'] ) && 'array' == $args['type'] ) {
					$args['type'] = 'plain';
			}

			// Set up paginated links.
			$links = paginate_links( $args );

			if ( $links ) {
					$navigation = _my_navigation_markup( $links, 'pagination', $args['screen_reader_text'] );
			}
	}

	echo $navigation;
}

function _my_navigation_markup( $links, $class = 'posts-navigation', $screen_reader_text = '' ) {
	if ( empty( $screen_reader_text ) ) {
			$screen_reader_text = __( 'Posts navigation' );
	}

	$template = '
	<nav class="navigation %1$s" role="navigation">
			<select oninput="location.href=this.value" class="nav-link">%3$s</select>
	</nav>';

	return sprintf( $template, sanitize_html_class( $class ), esc_html( $screen_reader_text ), $links );
}

// お気に入り
function okini_usces_the_itemSkuButton($value, $out = '') {
	global $usces, $post;

	$post_id = (int)$post->ID;
	$zaikonum = esc_attr($usces->itemsku['stocknum']);
	$zaiko_status = esc_attr($usces->itemsku['stock']);
	$gptekiyo = esc_attr($usces->itemsku['gp']);
	$skuPrice = esc_attr($usces->getItemPrice($post_id, $usces->itemsku['code']));
	$value = esc_attr(apply_filters( 'usces_filter_incart_button_label', $value));
	$sku = esc_attr(urlencode($usces->itemsku['code']));
	
		$type = 'button';
		$html = "";
		$html .= "<input name=\"okini[{$post_id}][{$sku}]\" type=\"{$type}\" id=\"okini[{$post_id}][{$sku}]\" class=\"skubutton okinibutton\" data-id=\"$post_id\" data-sku=\"$sku\" value=\"{$value}\" onclick=\"const e=this;fetchJSON('/wordpress/<?php echo get_template_directory_uri(); ?>/test.php',{},{okini_post_id:$post_id,okini_sku:'$sku'}).then(r=>{console.log(r);e.classList.toggle('okinied');});\" />";

	$html .= "<input name=\"usces_referer\" type=\"hidden\" value=\"" . esc_url($_SERVER['REQUEST_URI']) . "\" />\n";
	$html = apply_filters( 'usces_filter_item_sku_button', $html, $value, $type );
	
	if( $out == 'return' ){
		return $html;
	}else{
		echo $html;
	}
}

 //お気に入り登録済みの商品数を表示
function okiniNumber(){
	if(isset($_SESSION['okini'])){
		foreach($_SESSION['okini'] as $k => $v){
			$count = count($k) + 1;
		}
		echo $count;
	}else{
		echo "0"; 
	}
}

?>