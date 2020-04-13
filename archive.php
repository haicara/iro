<?php get_header(); ?>
<main>
	<div class="inner">
		<div class="archive-info">
			<h2><?php the_archive_title(); ?></h2>
			<?php if(category_description()): ?>
				<?php echo category_description(); ?>
			<?php endif; ?>
		</div>
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
						<h3><?php the_title(); ?></h3>
					</div>
				</a>
			</li>
			<?php endwhile ; ?>
		</ul>
		<?php endif ; ?>
		<?php if (function_exists("pagination")):
			pagination( $wp_query->max_num_pages);
		endif; ?>
	</div>
</main>
<?php get_footer(); ?>