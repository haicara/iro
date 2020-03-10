<?php get_header(); ?>
<div id="container">
    <main>
        <section class="latest">
            <div class="inner">
                <h2 class="latest">Latest Entry<span class="latest">新着記事</span></h2>
                <?php if ( have_posts() ) : ?>
                <ul class="archive-list" data-aos="fade-up">
				<?php while ( have_posts() ) : the_post(); ?>
                    <li>
                        <a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
						<div class="description">
							<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
							<div class="date"><?php the_time('Y.m.d'); ?></div>
						</div>
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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