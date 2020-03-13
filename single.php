<?php get_header(); ?>
    <main>
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
		<div class="inner">
			<?php include("breadcrumb.php"); ?>
		</div>
        <article>
			<h1 class="single-title"><?php the_title(); ?></h1>
            <div class="single-eyecatch">
				<img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" />
            </div>
                <?php if ( is_active_sidebar( 'ad-single-top' ) ) : ?>
                <div class="inner">
                    <?php dynamic_sidebar( 'ad-single-top' ); ?>
                </div>
                <?php endif; ?>
				<div class="content">
					<div class="text"><?php the_content(); ?></div>
				</div>
				<div class="inner">
					<?php if ( is_active_sidebar( 'ad-single-bottom' ) ) : ?>
						<?php dynamic_sidebar( 'ad-single-bottom' ); ?>
					<?php endif; ?>
					<ul class="single_desc">
						<p class="single_date"><?php the_time('Y.m.d'); ?></p>
						<li class="single_category"><?php the_category(' ' , $parents); ?></li>
						<li class="single_tag"><?php the_tags('' , $parents); ?></li>
					</ul>
				</div>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
        <section class="related">
            <h2 class="related">Related Posts<span class="related">こんな記事も読まれています</span></h2>
            <ul class="related">
            <?php if( has_category() ) {
                $cats = get_the_category();
                $catkwds = array();
                foreach($cats as $cat) {
                    $catkwds[] = $cat->term_id;
                }
            } ?>
            <?php
            $myposts = get_posts( array(
                'post_type' => 'post',
                'posts_per_page' => '6',
                'post__not_in' => array( $post->ID ),
                'category__in' => $catkwds,
                'orderby' => 'rand'
            ) ); 
            if( $myposts ): ?>
            <?php foreach($myposts as $post):
            setup_postdata($post); ?>
                <li>
                    <a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
                    <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </li>
            <?php endforeach; ?>
            <?php else: ?>
                <p>関連記事はありませんでした</p>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
            </ul>
            </section>
        </main>
        <div class="paging">
            <?php previous_post_link('%link', '← PREV'); ?>
            <?php next_post_link('%link', 'NEXT →'); ?>
        </div>
<?php get_footer(); ?>



