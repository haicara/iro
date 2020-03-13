<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('｜', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<? /* WordPress
-------------------- */ ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen" />
<? /* Fonts
-------------------- */ ?>
<script>
url = 'https://fonts.googleapis.com/css?family=Rajdhani:400,600'
xhr = new XMLHttpRequest()
xhr.open('GET', url)
xhr.onreadystatechange = function () {
	if (xhr.readyState !== 4 || xhr.status !== 200) return
	var style
	style = document.createElement('style')
	style.innerHTML = xhr.responseText.replace(/}/g, 'font-display: swap; }')
	document.head.appendChild(style)
}
xhr.send()
</script>
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
		<div class="drawer">
		<input id="drawerButton" type="checkbox">
		<label class="icon" for="drawerButton">
		  <span></span>
		</label>
		<label class="overlay" for="drawerButton"></label>
		<nav>
			<?php if ( is_active_sidebar( 'drawer-widget' ) ) : ?>
				<?php dynamic_sidebar( 'drawer-widget' ); ?>
			<?php endif; ?>
		</nav>
		</div>
    </div>
</header>