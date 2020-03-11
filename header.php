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
<? /* WordPress
-------------------- */ ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen" />
<? /* Branch
-------------------- */ ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/highlight.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
</head>
<body>
<header>
    <div class="inner">
		<h1 class="logo" role="banner">
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
		<div class="l-drawer">
		<input class="l-drawer__checkbox" id="drawerCheckbox" type="checkbox">
		<!-- ドロワーアイコン -->
		<label class="l-drawer__icon" for="drawerCheckbox">
		  <span class="l-drawer__icon-parts"></span>
		</label>
		<!-- 背景を暗く -->
		<label class="l-drawer__overlay" for="drawerCheckbox"></label>
		<!-- ドロワーメニュー -->
		<nav>
		  <ul>
			<li>
			  <a href="/">メニュー</a>
			</li>
			<li>
			  <a href="/">メニュー</a>
			</li>
			<li>
			  <a href="/">メニュー</a>
			</li>
		  </ul>
		</nav>
		</div>
    </div>
</header>