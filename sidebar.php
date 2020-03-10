<?php if (!wp_is_mobile()) :?>
    <?php if ( is_home() || is_front_page() ) : ?>
        <?php if ( is_active_sidebar( 'ad-pc-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'ad-pc-sidebar' ); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<dl class="widget" id="ranking">
    <dt class="widget">RANKING</dt>
    <?php
    setPostViews(get_the_ID()); query_posts('meta_key=post_views_count&orderby=meta_value_num&posts_per_page=5&order=DESC&range=monthly'); while(have_posts()) : the_post(); ?>
    <dd class="ranking">
        <a class="ranking_img" href="<?php echo get_permalink(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'thumbnail'); } ?></a><a class="ranking_title" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a>
    </dd>
    <?php endwhile; ?>
</dl>
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar' ); ?>
<?php endif; ?>