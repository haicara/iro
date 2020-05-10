<?php get_header(); ?>
    <main>
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <article>
			<?php if (has_post_thumbnail()) : ?>
				<div class="eyecatch">
					<img src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" />
					<div class="caption">
						<h1><?php the_title(); ?></h1>
						<p><?php the_time('Y.m.d'); ?></p>
					</div>
				</div>
			<?php else : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif ; ?>
			<?php if ( is_active_sidebar( 'ad-single-top' ) ) : ?>
				<?php dynamic_sidebar( 'ad-single-top' ); ?>
			<?php endif; ?>
			<div class="content">
				<?php the_content(); ?>
			</div>
			<aside>
				<div class="desc">
					<p class="category"><?php the_category(' ' , $parents); ?></p>
					<p class="tag"><?php the_tags('' , $parents); ?></p>
					<p class="date"><?php the_time('Y.m.d'); ?></p>
				</div>
				<div class="share">
					<p class="title">SHARE !</p>
				</div>
			</aside>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
		<div class="paging">
			<div class="prev">
				<?php previous_post_link('%link'); ?>
			</div>
			<div class="next">
				<?php next_post_link('%link'); ?>
			</div>
		</div>
        <section>
			<div class="inner">
				<h2 data-text="RELATED POSTS">こんな記事も読まれています</h2>
				<ul class="post-list">
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
					<a href="<?php the_permalink(); ?>">
						<div class="thumbnail">
						<?php
							$post_title = get_the_title();
							the_post_thumbnail('large',
							 array(
								'loading' => 'lazy',
								'alt' => $post_title,
							 )
						); ?>
						</div>
						<div class="description">
							<p><?php $category = get_the_category(); echo $category[0]->cat_name; ?></p>
							<span><?php the_time('Y.m.d'); ?></span>
							<h3><?php the_title(); ?></h3>
						</div>
					</a>
				</li>
				<?php endforeach; ?>
				<?php else: ?>
					<p>関連記事はありませんでした</p>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>
	</main>
<?php get_footer(); ?>



