<?php
// メニュー
register_nav_menu('header_menu', 'ヘッダーメニュー');
// カスタムロゴ
add_theme_support('custom-logo');
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