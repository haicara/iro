<?php get_header(); ?>
<main>
	<section>
		<?php if ( have_posts() ) : ?>
		<ul class="post-list">
			<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<a href="<?php the_permalink(); ?>">
					<div class="post-list-thumb">
						<?php the_post_thumbnail('medium'); ?>
					</div>
					<div class="post-list-desc">
						<p><?php $category = get_the_category(); echo $category[0]->cat_name; ?></p>
						<span><?php the_time('Y.m.d'); ?></span>
						<h3><?php the_title(); ?></p>
					</div>
				</a>
			</li>
			<?php endwhile ; ?>
		</ul>
		<?php endif ; ?>
	</section>
</main>
<?php get_footer(); ?>