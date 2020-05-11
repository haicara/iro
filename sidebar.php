<?php if (!wp_is_mobile()) :?>
    <?php if ( is_home() || is_front_page() ) : ?>
        <?php if ( is_active_sidebar( 'ad-pc-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'ad-pc-sidebar' ); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'sidebar' ); ?>
<?php endif; ?>