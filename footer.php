<a class="back_to_top" href="#"></a>
<footer>
    <p class="copyright">© 2018 <?php bloginfo('name'); ?></p>
</footer>
<?php wp_footer(); ?>
<script>

	jQuery(function($){
		$(document).ready(function() {
			var to_top = $('.back_to_top');
			$(window).scroll(function () {
				if ($(this).scrollTop() > 200) {
					to_top.fadeIn();
				} else {
					to_top.fadeOut();
				}
			});
			pagetop.click(function () {
				$('body, html').animate({ scrollTop: 0 }, 700);
				return false;
			});
		});
	});

</script>
</body>
</html>