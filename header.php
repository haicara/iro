<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php wp_title('｜', true, 'right'); ?><?php bloginfo('name'); ?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<? //jQuery
// -------------------- ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<? /* Drawer
-------------------- */ ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
<? /* Other
-------------------- */ ?>
<?php wp_head(); ?>
<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); echo '?' . filemtime(get_stylesheet_directory() . '/style.css'); ?>" type="text/css" media="screen" />
<script>
  (function(d) {
    var config = {
      kitId: 'jbn5bfp',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>
<? /* If
-------------------- */ ?>
<?php if ( is_home() || is_front_page() ) : ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">
<script async src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script async src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/vegas.min.js"></script>
<link href="<?php echo get_template_directory_uri(); ?>/js/vegas.min.css" rel="stylesheet">
<?php else : ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/highlight.css">
<script src="<?php echo get_template_directory_uri(); ?>/js/highlight.pack.js"></script>
<script>hljs.initHighlightingOnLoad();</script>
<?php endif; ?>
</head>
<?php if ( is_front_page() ) :
// ホームの時だけ表示する ?>
<body class="drawer drawer--right">
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
<?php else :
// それ以外のページで表示する ?>
<body class="drawer drawer--right">
<header>
    <div class="inner">
    <h1 id="logo" role="banner">
        <a href="<?php echo home_url(); ?>">
            <?php bloginfo('name'); ?>
        </a>
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
<?php endif; ?>