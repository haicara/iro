<?php get_header(); ?>
<main>
	<section>
		<div class="inner">
			<?php if ( have_posts() ) : ?>
			<ul class="post-list">
				<?php while ( have_posts() ) : the_post(); ?>
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
							<h2><?php the_title(); ?></h2>
						</div>
					</a>
				</li>
				<?php endwhile ; ?>
			</ul>
			<?php endif ; ?>
		</div>
	</section>
	<?php if (function_exists("pagination")):
		pagination( $wp_query->max_num_pages);
	endif; ?>
</main>
<?php get_footer(); ?>