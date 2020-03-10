<?php get_header(); ?>
<main>
	<div class="top-image">
		<ul class="top-menu">
			<li><a href="#home" data="HOME">ホーム</a></li>
			<li><a href="#service" data="SERVICE">サービス</a></li>
			<li><a href="#work" data="WORK">制作実績</a></li>
			<li><a href="#column" data="COLUMN">コラム</a></li>
			<li><a href="#contact" data="CONTACT">お問い合わせ</a></li>
		</ul>
		<div class="inner">
			<h1 class="top-image-logo">HAICARA</h1>
			<p class="top-image-sub">Web design&Create.</p>
			<p>ウェブサイト制作から、<br>ちょっとしたカスタマイズまで。</p>
		</div>
		<dl class="top-update">
			<dt>UPDATE</dt>
			<?php
				$arg = array(
					'posts_per_page' => 4,
					'orderby' => 'date',
					'order' => 'DESC',
					'category_name' => 'update'
				);
				$posts = get_posts( $arg );
			if( $posts ): ?>
			<?php
			foreach ( $posts as $post ) :
			setup_postdata( $post ); ?>
				<dd><span><?php the_time( 'Y.m.d' ); ?></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></dd>
			<?php endforeach; ?>
			<?php
			endif;
			wp_reset_postdata();
			?>
			<a class="top-update-readmore" href="https://haicara.jp/article/category/update">もっと見る</a>
		</dl>
	</div>
	<section class="top-problem">
		<p data-aos="fade">ウェブの世界で、「らしさ」を伝える。</p>
	</section>
	<section class="top-service">
		<div class="inner">
			<h2 class="top-heading" data="SERVICE" data-aos="fade">サービス</h2>
			<ul data-aos="fade-up">
				<li>
					<img src="<?php echo get_template_directory_uri(); ?>/img/top_webdesign.png">
					<h3>WEBデザイン／コーディング</h3>
					<p>実用的なデザインと無駄の少ないコーディングを意識。目的に対してより効果的にユーザーを誘導できるようなUI/UXを心がけています。</p>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri(); ?>/img/top_seo.png">
					<h3>SEO</h3>
					<p>WEBマーケティングの一部として重要視される検索エンジン。良質なコンテンツを支える基礎として重要なサイト内のSEO「内部対策」を制作時に行っています。</p>
				</li>
				<li>
					<img src="<?php echo get_template_directory_uri(); ?>/img/top_maintenance.png">
					<h3>運用・保守</h3>
					<p>サーバーやドメインの管理、記事の更新を任せたい場合にも相談可能。事業や別の業務に集中できます。</p>
				</li>
			</ul>
		</div>
		<div class="box-link" data-aos="fade">
			<a href="#contact">お見積りのご依頼はこちらから</a>
		</div>
	</section>
	<section class="top-work">
		<div class="inner">
		<h2 class="top-heading" data="WORK" data-aos="fade">制作事例</h2>
			<?php
				$arg = array(
					'post_type' => 'work',
					'posts_per_page' => 4,
					'orderby' => 'date',
					'order' => 'DESC',
				);
				$posts = get_posts( $arg );
				if( $posts ): ?>
				<ul data-aos="fade-up">
				<?php
				foreach ( $posts as $post ) :
				setup_postdata( $post ); ?>
                    <li>
                        <a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail('large'); ?>
							<h3><?php the_title(); ?></h3>
						</a>
                    </li>
				<?php endforeach; ?>
				</ul>
			<?php
			endif;
			wp_reset_postdata();
			?>
		</div>
		<div class="box-link" data-aos="fade">
				<a href="./work">制作事例をもっと見る</a>
		</div>
	</section>
	<section class="top-column">
		<div class="inner">
			<h2 class="top-heading" data="COLUMN">コラム</h2>
			<?php
				$arg = array(
					'posts_per_page' => 12,
					'orderby' => 'date',
					'order' => 'DESC',
					'cat' => -1
				);
				$posts = get_posts( $arg );
				if( $posts ): ?>
				<ul class="archive-list" data-aos="fade-up">
				<?php
				foreach ( $posts as $post ) :
				setup_postdata( $post ); ?>
                    <li>
                        <a class="thumbnail" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
						<div class="description">
							<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
							<div class="date"><?php the_time('Y.m.d'); ?></div>
						</div>
                        <a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </li>
				<?php endforeach; ?>
				</ul>
			<?php
			endif;
			wp_reset_postdata();
			?>
		</div>
		<div class="box-link" data-aos="fade">
				<a href="./article">コラムをもっと見る</a>
		</div>
	</section>
	<section class="top-contact" id="contact">
		<div class="inner">
			<h2 data-aos="fade-up" class="top-heading" data="CONTACT">お問い合わせ</h2>
			<?php echo do_shortcode( '[contact-form-7 id="267" title="お問い合わせ"]' ); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>