<div class="slider swiper-container">
	<?php $args = array(
	'posts_per_page' => 5,
	'tag'            => 'pickup'
	);
	$my_query = new WP_Query( $args );?>
	<div class="swiper-wrapper">
		<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<div class="slider-box swiper-slide">
			<a class="thumbnail" href="<?php the_permalink(); ?>">
				<img src="<?php the_post_thumbnail_url( 'large' ); ?>" alt="<?php the_title_attribute(); ?>">
				<p><?php the_title(); ?></p>
			</a>
		</div>
		<?php endwhile ; ?>
	</div>
	<div class="swiper-button-next swiper-button-white"></div>
	<div class="swiper-button-prev swiper-button-white"></div>
	<div class="swiper-pagination swiper-pagination-white"></div>
	<?php wp_reset_query(); ?>
</div>
