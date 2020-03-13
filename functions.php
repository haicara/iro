<?php
// カスタムロゴ
add_theme_support('custom-logo');
//アイキャッチ表示 
add_theme_support( 'post-thumbnails', array( 'post','page','work' ) );
the_post_thumbnail();
the_post_thumbnail('thumbnail');
the_post_thumbnail('medium');
the_post_thumbnail('large');
the_post_thumbnail('full');
/* カスタマイザー
--------------------*/
function theme_customizer_extension($wp_customize) {
	// メインカラー
	$wp_customize->add_setting( 'main_color', array(
	'default' => '#18cad3',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
	'label' => 'メインカラー',
	'section' => 'colors',
	'settings' => 'main_color',
	'priority' => 20,
	)));
}
add_action('customize_register', 'theme_customizer_extension');
// メインカラー
function customizer_color() {
	$main_color = get_theme_mod( 'main_color', '#18cad3'); ?>
	<style type="text/css">
	 /* ヘッダー */
	.drawer nav {
		background-color: <?php echo $main_color; ?>;
	}
	.post-list li p {
		background-color: <?php echo $main_color; ?>;
	}
	</style>
<?php }
add_action( 'wp_head', 'customizer_color');
/* ウィジェット
--------------------*/
function arphabet_widgets_init() {
    register_sidebar( array(
		'name' => 'ドロワーメニュー',
		'id' => 'drawer-widget',
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
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
/* ページネーション
--------------------*/
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