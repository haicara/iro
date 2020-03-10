<?php get_header(); ?>
<div id="container">
    <main>
        <section class="latest">
            <div class="inner">
                <h2 class="latest"><?php the_archive_title(); ?></h2>
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
                <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                <ins class="adsbygoogle"
                     style="display:block"
                     data-ad-format="fluid"
                     data-ad-layout-key="-fi-19+6f-6x-3j"
                     data-ad-client="ca-pub-6565368034448820"
                     data-ad-slot="6857154873"></ins>
                <script>
                     (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
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