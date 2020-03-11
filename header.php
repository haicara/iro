<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('｜', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<? /* Drawer
-------------------- */ ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<? /* Basic
-------------------- */ ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen" />
<? /* Branch
-------------------- */ ?>
<?php if ( is_home() || is_front_page() ) : ?>
<?php else : ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/highlight.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php endif; ?>
</head>
<body class="drawer drawer--right">
<header>
    <div class="inner">
		<h1 id="logo" role="banner">
			<?php // カスタムロゴを表示
			if ( has_custom_logo() ) : ?>
			<a href="<?php echo home_url(); ?>">
				<?php the_custom_logo(); ?>
			</a>
			<?php // カスタムロゴがない場合はサイト名を表示
			else : ?>
			<a href="<?php echo home_url(); ?>">
				<?php bloginfo('name'); ?>
			</a>
			<?php endif ; ?>
		</h1>
		<button type="button" class="drawer-toggle drawer-hamburger">
			<span class="sr-only">toggle navigation</span>
			<span class="drawer-hamburger-icon"></span>
		</button>
		<nav class="drawer-nav" role="navigation">
			<ul class="drawer-menu">
				<li class="drawer-brand">MENU</li>
				<?php wp_nav_menu( array(
					'theme_location'=>'header_menu', 
					'container'     =>'', 
					'menu_class'    =>'',
					'items_wrap'    =>'%3$s'));
				?>
			</ul>
		</nav>
    </div>
</header>