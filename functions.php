<?php
// メニュー
register_nav_menu('header_menu', 'ヘッダーメニュー');
//アイキャッチ表示 
add_theme_support( 'post-thumbnails', array( 'post','page','work' ) );
the_post_thumbnail();
the_post_thumbnail('thumbnail');
the_post_thumbnail('medium');
the_post_thumbnail('large');
the_post_thumbnail('full');
// head内の絵文字スクリプトを消す
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');
/* カスタム投稿タイプ / 制作実績
------------------------------ */
add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'work', [
        'labels' => [
            'name'          => 'ポートフォリオ',
            'singular_name' => 'work',
        ],
        'public'        => true,
        'has_archive'   => true,
        'menu_position' => 5,
        'show_in_rest'  => true,
        'rewrite' => array('with_front' => false),
    ]);
}
register_post_type(
    'work',
    array(
        'supports' => array('title','editor','thumbnail')
    )
);
add_filter('post_type_link', 'my_post_type_link', 1, 2 );
		function my_post_type_link($link, $post){
		if ('work' === $post->post_type) {
		return home_url('/work/' . $post->ID);
	} else {
		return $link;
	}
}
	add_filter('rewrite_rules_array', 'my_rewrite_rules_array');
	function my_rewrite_rules_array($rules) {
	$new_rules = array('work/([0-9]+)/?$' => 'index.php?post_type=work&p=$matches[1]',);
	return $new_rules + $rules;
}
// タームタイトル変更
add_filter( 'get_the_archive_title', function ($title) {
    if (is_category()) {
        $title = single_cat_title('',false);
    } elseif (is_tag()) {
        $title = single_tag_title('',false);
	} elseif (is_tax()) {
	    $title = single_term_title('',false);
	} elseif (is_post_type_archive() ){
		$title = post_type_archive_title('',false);
	} elseif (is_date()) {
	    $title = get_the_time('Y年n月');
	} elseif (is_search()) {
	    $title = '検索結果：'.esc_html( get_search_query(false) );
	} elseif (is_404()) {
	    $title = '「404」ページが見つかりません';
	} else {

	}
    return $title;
});
//ウィジェット
function arphabet_widgets_init() {
	register_sidebar( array(
		'name' => '広告/トップ/中部',
		'id' => 'ad-top-middle',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    register_sidebar( array(
		'name' => 'フッター',
		'id' => 'footer-widget',
		'before_widget' => '<dl class="footer_widget">',
		'after_widget' => '</dd></dl>',
		'before_title' => '<dt class="footer_widget">',
		'after_title' => '</dt><dd class="footer_widget">',
	) );
    register_sidebar( array(
		'name' => '広告/PC/サイドバー',
		'id' => 'ad-pc-sidebar',
		'before_widget' => '<div class="right">',
		'after_widget' => '</div>',
		'before_title' => '',
		'after_title' => '',
	) );
    register_sidebar( array(
		'name' => '広告/記事/上部',
		'id' => 'ad-single-top',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
    register_sidebar( array(
		'name' => '広告/記事/下部',
		'id' => 'ad-single-bottom',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '',
		'after_title' => '',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );

// 本文内テキスト装飾
function change_any_texts($text){
$replace = array(
'<ul>' => '<ul class="list">',
'<ol>' => '<ol class="list">'
);
$text = str_replace(array_keys($replace), $replace, $text);
return $text;
}
add_filter('the_content', 'change_any_texts');
// 人気記事
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0 View";
	}
	return $count.' Views';
}
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
	}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
	}
}
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
// パンくずリスト
/**
 * パンくずリスト出力
 * <?php if(function_exists("the_breadcrumb")){the_breadcrumb();} ?>
 */
function the_breadcrumb(){
    global $post;
	$title = '';
    $str ='';
    if(!is_home()&&!is_admin()){
        // ホーム（必ず表示）
        $str.= '<div id="breadcrumb" class="cf"><span itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
        $str.= '<a href="'. home_url() .'" itemprop="url"><span itemprop="title">ホーム</span></a> &gt; </span>';
 
        // 以下条件分岐
        // カテゴリー
        if(is_category()) {
            $cat = get_queried_object();
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor) .'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor) .'</span></a> &gt; </span>';
                }
            }
			$title = single_cat_title('',false);
        // タグ
		} elseif(is_tag()) {
			$title = single_tag_title('',false);
        } elseif(is_date()) {
            $title = get_the_time('Y年n月');
        // 固定ページ
		} elseif(is_page()){
            if($post -> post_parent != 0 ){
                $ancestors = array_reverse(get_post_ancestors( $post->ID ));
                foreach($ancestors as $ancestor){
                    $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_permalink($ancestor).'" itemprop="url"><span itemprop="title">'. get_the_title($ancestor) .'</span></a> &gt; </span>';
                }
            }
			$title = get_the_title();
        // ブログ投稿
		} elseif(is_singular('post')){
            $categories = get_the_category($post->ID);
            $cat = $categories[0];
            if($cat -> parent != 0){
                $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' ));
                foreach($ancestors as $ancestor){
                    $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($ancestor).'" itemprop="url"><span itemprop="title">'. get_cat_name($ancestor). '</span></a> &gt; </span>';
                }
            }
            $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_category_link($cat -> term_id). '" itemprop="url"><span itemprop="title">'. $cat-> cat_name . '</span></a> &gt; </span>';
			$title = get_the_title();
 
        // 以下カスタム投稿
        // タクソノミー
		} elseif(is_tax()){
			$query = get_queried_object();
			$taxonomy_slug = $query->taxonomy;
            $terms = array_reverse(get_the_terms($post->ID, $taxonomy_slug));
			$term = $terms[0];
            if($term -> parent != 0){
				$ancestors = get_ancestors( $term -> term_id, $taxonomy_slug);
                foreach($ancestors as $ancestor){
                	$term_name = get_term_by('term_taxonomy_id', $ancestor, $taxonomy_slug);
                    $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. get_term_link($ancestor, $taxonomy_slug).'" itemprop="url"><span itemprop="title">'. $term_name->name . '</span></a> &gt; </span>';
                }
            }
			$title = esc_html($query->name);
        // カスタム投稿
		} elseif(is_singular()){
			$query = get_queried_object();
            $typelink = get_post_type_archive_link($query->post_type);
			$typename = get_post_type_object($query->post_type);
            $str.='<span itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="'. $typelink .'" itemprop="url"><span itemprop="title">'. $typename->labels->name . '</span></a> &gt; </span>';
			$title = get_the_title();
        // カスタム投稿アーカイブ
		} elseif (is_post_type_archive()) {
			$posttypeTitle = post_type_archive_title('', false );
			$title = esc_html($posttypeTitle);
 
		} elseif (is_404()) {
			$title = '404 ページが見つかりません';
		} else {
 
        }
        $str.='<span>'. $title .'</span>';
        $str.='</div>';
    }
    echo $str;
}
// ページネーション
function pagination( $pages = 1, $range = 2, $show_only = false ) {

    $pages = (int) $pages;    //float型で渡ってくるので明示的に int型 へ
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    //表示テキスト
    $text_first   = "«";
    $text_before  = "‹ PREV";
    $text_next    = "NEXT ›";
    $text_last    = "»";

    if ( $show_only && $pages === 1 ) {
        // １ページのみで表示設定が true の時
        echo '<div class="pagination"><span class="current">1</span></div>';
        return;
    }

    if ( $pages === 1 ) return;    // １ページのみで表示設定もない場合

    if ( 1 !== $pages ) {
        //２ページ以上の時
        echo '<div class="pagination"><span>', $paged ,' / ', $pages ,'</span>';
        if ( $paged > $range + 1 ) {
            // 「最初へ」 の表示
            echo '<a href="', get_pagenum_link(1) ,'">', $text_first ,'</a>';
        }
        if ( $paged > 1 ) {
            // 「前へ」 の表示
            echo '<a href="', get_pagenum_link( $paged - 1 ) ,'">', $text_before ,'</a>';
        }
        for ( $i = 1; $i <= $pages; $i++ ) {

            if ( $i <= $paged + $range && $i >= $paged - $range ) {
                // $paged +- $range 以内であればページ番号を出力
                if ( $paged === $i ) {
                    echo '<span class="current">', $i ,'</span>';
                } else {
                    echo '<a href="', get_pagenum_link( $i ) ,'" class="inactive">', $i ,'</a>';
                }
            }

        }
        if ( $paged < $pages ) {
            // 「次へ」 の表示
            echo '<a href="', get_pagenum_link( $paged + 1 ) ,'">', $text_next ,'</a>';
        }
        if ( $paged + $range < $pages ) {
            // 「最後へ」 の表示
            echo '<a href="', get_pagenum_link( $pages ) ,'">', $text_last ,'</a>';
        }
        echo '</div>', "\n";
    }
}

?>