<div class="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">
	<span class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<meta itemprop="position" content="1" />
		<a href="<?php echo home_url(); ?>" itemprop="item">
		<span itemprop="name">ホーム</span>
		</a>
	</span>
	<?php if (is_single()) :?>
	<span class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<meta itemprop="position" content="2" />
		<a href="<?php $cat = get_the_category(); echo get_category_link($cat[0]->cat_ID); ?>" itemprop="item">
		<span itemprop="name"><?php echo $cat[0]->name; ?></span>
		</a>
	</span>
	<span class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
		<meta itemprop="position" content="3" />
		<span itemprop="name"><?php the_title(); ?></span>
	</span>
	<?php endif; ?>
</div>