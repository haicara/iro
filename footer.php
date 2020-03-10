<a class="back_to_top" href="#">TO TOP</a>
<footer>
    <div class="footer_widget">
        <dl class="footer_widget footer_about">
            <dt class="footer_about"><?php bloginfo(); ?></dt>
            <dd class="footer_widget">https://haicara.jp</dd>
        </dl>
        <?php if ( is_active_sidebar( 'footer-widget' ) ) : ?>
            <?php dynamic_sidebar( 'footer-widget' ); ?>
        <?php endif; ?>
    </div>
    <p id="copyright">© 2018 <?php bloginfo('name'); ?></p>
</footer>
<script>
$(document).ready(function() {
	$('.drawer').drawer({
		class: {
			nav: 'drawer-nav',
			toggle: 'drawer-toggle',
			overlay: 'drawer-overlay',
			open: 'drawer-open',
			close: 'drawer-close',
			dropdown: 'drawer-dropdown'
		},
		iscroll: {
			mouseWheel: true,
			preventDefault: false
		},
		showOverlay: true
	});
});
// smooth scroll
$('a[href^="#"]').click(function(){
	var speed = 800;
	var href= $(this).attr("href");
	var target = $(href == "#" || href == "" ? 'html' : href);
	var position = target.offset().top;
	$("html, body").animate({scrollTop:position}, speed, "swing");
	return false;
});
$(function () {
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 0) {
      $(".drawer-hamburger").fadeIn();
    } else {
      $(".drawer-hamburger").fadeOut();
    }
  });
});
</script>
<?php if ( is_home() || is_front_page() ) :
// Home ?>
<script>
// swiper
window.onload = function() {
	var swiper = new Swiper('.swiper-container', {
		slidesPerView: 2,
		centeredSlides: true,
		spaceBetween: 0,
		loop: true,
		autoplay: {
			delay: 2500,
			disableOnInteraction: false,
		},
		navigation: {
		nextEl: '.swiper-button-next',
		prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
		},
		breakpoints: {
			767: {
			  slidesPerView: 1,
			  spaceBetween: 0
			}
		}
	});
	AOS.init();
	jQuery(function($) {
	  	$(function() {
			$('.top-image').vegas({
				preload: true,
				timer: false,
				slides: [
					{ src: '<?php echo get_template_directory_uri(); ?>/img/top_image_1.jpg' },
					{ src: '<?php echo get_template_directory_uri(); ?>/img/top_image_2.jpg' },
					{ src: '<?php echo get_template_directory_uri(); ?>/img/top_image_3.jpg' }
				],
				animation: 'kenburns'
			});
		});
	});

}
</script>
<?php elseif (is_single()) :?>
a
<?php endif; ?>
<?php wp_footer(); ?>
</body>
</html>