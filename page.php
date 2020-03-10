<?php get_header(); ?>
<div id="container">
    <main id="single">
        <div class="inner">
            <?php if(function_exists("the_breadcrumb")){the_breadcrumb();} ?>
        </div>
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php
            setPostViews(get_the_ID()); 
        ?>
        <article>
            <div id="eyecatch">
                <img class="rellax" data-rellax-speed="-5" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" />
                <div class="single_caption">
                    <h1 class="single_title"><?php the_title(); ?></h1>
                    <p class="single_date"><?php the_time('Y.m.d'); ?></p>
                </div>
            </div>
            <div class="content">
            	<div class="text"><?php the_content(); ?></div>
            </div>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
        </main>
</div>
<?php get_footer(); ?>



