<?php get_header(); ?>
<div id="container">
	<div class="breadcrumb">
		<div class="inner">
			<?php if(function_exists("the_breadcrumb")){the_breadcrumb();} ?>
		</div>
	</div>
    <main>
        <?php if ( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
        <?php
            setPostViews(get_the_ID()); 
        ?>
        <article>
			<div class="inner">
			<h1 class="single_title"><?php the_title(); ?></h1>
			<?php $post_title = get_the_title();
				the_post_thumbnail('full',array(
				'alt' => $post_title,
				'title' => $post_title
			)); ?>
			</div>
            <div class="content">	
            	<div class="text"><?php the_content(); ?></div>
				<h2 class="single">案件詳細</h2>
				<?php if(get_field('work_client')): ?>
					<p><?php the_field('work_client'); ?></p>
				<?php else : ?>
					<p class="work_alert">※依頼主の意向により詳細非公開</p>
				<?php endif; ?>
				<h3 class="single">作業内容</h3>
				<p>使用されているCMSや言語、要素などは下記の通りです。</p>
				<?php
					$field = get_field_object('work_element');
					$works = $field['value'];
					if( $works ): 
				?>
				<ul class="work_element_list">
				<?php foreach( $works as $work ): ?>
					<li class="work_element_list"><?php echo $field['choices'][ $work ]; ?></li>
				<?php endforeach; ?>
				</ul>
				<?php endif; ?>
				<?php the_time('Y.m.d'); ?>
            </div>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
	</main>
	<div class="paging">
		<?php previous_post_link('%link', '← PREV'); ?>
		<?php next_post_link('%link', 'NEXT →'); ?>
	</div>
</div>
<?php get_footer(); ?>



