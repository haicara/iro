<?php
/* jQuery
--------------------*/
function change_jquery() {
    if( !is_admin() ){
        wp_deregister_script('jquery');
        wp_enqueue_script('jquery', '//cdn.jsdelivr.net/jquery/3.1.1/jquery.min.js', array(), '3.1.1', true);
    }
}
add_action('init', 'change_jquery');
// Custom logo
add_theme_support('custom-logo');
// Eyecatch
add_theme_support( 'post-thumbnails', array( 'post','page','work' ) );
the_post_thumbnail();
the_post_thumbnail('thumbnail');
the_post_thumbnail('medium');
the_post_thumbnail('large');
the_post_thumbnail('full');
/* Customizer
--------------------*/
function theme_customizer_extension($wp_customize) {
	// Main color
	$wp_customize->add_setting( 'main_color', array(
		'default' => '#18cad3',
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_color', array(
		'label' => 'Main color',
		'section' => 'colors',
		'settings' => 'main_color',
		'priority' => 20,
	)));
	// Ad codes
	$wp_customize->add_section( 'ad_setting', array (
		'title' => '広告関連',
		'priority' => 100,
	));
	$wp_customize->add_setting( 'ad_ga', array (
		'default' => null,
	));
	$wp_customize->add_control( 'ad_ga', array(
		'section' => 'ad_setting',
		'settings' => 'ad_ga',
		'label' =>'Google Adsense',
		'description' => '&lt;head&gt; ~ &lt;/head&gt;に挿入するコードを入力します。',
		'type' => 'textarea',
		'priority' => 10,
	));
	$wp_customize->add_setting( 'ad_vc', array (
		'default' => null,
	));
	$wp_customize->add_control( 'ad_vc', array(
		'section' => 'ad_setting',
		'settings' => 'ad_vc',
		'label' =>'Value Commerce',
		'description' => '&lt;head&gt; ~ &lt;/head&gt;に挿入するコードを入力します。',
		'type' => 'textarea',
		'priority' => 20,
	));
}
add_action('customize_register', 'theme_customizer_extension');
function ad() {
 return get_theme_mod( 'ad', true );
}
// Main color
function customizer_color() {
	$main_color = get_theme_mod( 'main_color', '#18cad3'); ?>
	<style type="text/css">
	 /* header */
	.drawer nav {
		background-color: <?php echo $main_color; ?>;
	}
	/* post list */
	.post-list li p {
		background-color: <?php echo $main_color; ?>;
	}
	/* single aside */
	article aside {
		background-color: <?php echo $main_color; ?>;
	}
	footer .about dt {
		color: <?php echo $main_color; ?>;
	}
	footer dl {
		border-left: 1px solid <?php echo $main_color; ?>;
	}
	</style>
<?php }
add_action( 'wp_head', 'customizer_color');
/* Widget setting
--------------------*/
// Drawer menu
function arphabet_widgets_init() {
    register_sidebar( array(
		'name' => 'ドロワーメニュー',
		'id' => 'drawer-widget',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
// Footer menu
    register_sidebar( array(
		'name' => 'フッターメニュー',
		'id' => 'footer-widget',
		'before_widget' => '<dl>',
		'after_widget' => '</dd></dl>',
		'before_title' => '<dt>',
		'after_title' => '</dt><dd>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );
// Tagcloud order by count
function custom_widget_tag_cloud_args($args) {
	$myargs = array(
		'orderby' => 'count',
		'order' => 'DESC',
	);
	$args = wp_parse_args($args, $myargs);
	return $args;
}
add_filter('widget_tag_cloud_args', 'custom_widget_tag_cloud_args');
// Remove head in Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles' );
remove_action('admin_print_styles', 'print_emoji_styles');
// Term title
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
/* Single Content
   img Lazy loading
--------------------*/
function change_any_texts($text){
	$replace = array(
		'<img' => '<img loading="lazy"',
		'<iframe' => '<iframe loading="lazy"'
	);
	$text = str_replace(array_keys($replace), $replace, $text);
	return $text;
}
add_filter('the_content', 'change_any_texts');
/* Pagination
--------------------*/
function pagination( $pages = 1, $range = 2, $show_only = false ) {
    $pages = (int) $pages;
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $text_first   = "<<";
    $text_before  = "< PREV";
    $text_next    = "NEXT >";
    $text_last    = ">>";
    if ( $show_only && $pages === 1 ) {
        echo '<div class="pagination"><span class="current">1</span></div>';
        return;
    }
    if ( $pages === 1 ) return;
    if ( 1 !== $pages ) {
        echo '<div class="pagination"><span>', $paged ,' / ', $pages ,'</span>';
        if ( $paged > $range + 1 ) {
            echo '<a href="', get_pagenum_link(1) ,'">', $text_first ,'</a>';
        }
        if ( $paged > 1 ) {
            echo '<a href="', get_pagenum_link( $paged - 1 ) ,'">', $text_before ,'</a>';
        }
        for ( $i = 1; $i <= $pages; $i++ ) {

            if ( $i <= $paged + $range && $i >= $paged - $range ) {
                if ( $paged === $i ) {
                    echo '<span class="current">', $i ,'</span>';
                } else {
                    echo '<a href="', get_pagenum_link( $i ) ,'" class="inactive">', $i ,'</a>';
                }
            }
        }
        if ( $paged < $pages ) {
            echo '<a href="', get_pagenum_link( $paged + 1 ) ,'">', $text_next ,'</a>';
        }
        if ( $paged + $range < $pages ) {
            echo '<a href="', get_pagenum_link( $pages ) ,'">', $text_last ,'</a>';
        }
        echo '</div>', "\n";
    }
}
?>