<?php get_header(); ?>
<div id="container">
    <main>
        <div class="inner archive_breadcrumb">
            <?php if(function_exists("the_breadcrumb")){the_breadcrumb();} ?>
        </div>
        <section class="latest">
            <div class="inner">
                <h2 class="latest"><?php single_cat_title(); ?><span class="latest"><?php echo category_description( $category_id ); ?></span></h2>
                <?php if ( have_posts() ) : ?>
                <ul class="latest_list">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <li class="latest_list">
                        <a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                        <div class="latest_date"><?php the_time('Y.m.d'); ?></div>
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        <div class="latest_category <?php $cat = get_the_category(); $cat = $cat[0]; { echo $cat->slug; } ?>"><?php the_category(); echo $category[0]->cat_name; ?></div>
                    </li>
                    <?php endwhile; ?>
                </ul>
        
                <?php endif; ?>
                <?php if ( is_active_sidebar( 'ad-top-middle' ) ) : ?>
                    <?php dynamic_sidebar( 'ad-top-middle' ); ?>
                <?php endif; ?>
                </div>
            </section>
        <?php 
            if (function_exists("pagination")):
                pagination( $wp_query->max_num_pages);
            endif;
        ?>
    </main>
    <div id="sidebar">
            <?php get_sidebar(); ?>
    </div>
</div>
<?php get_footer(); ?>