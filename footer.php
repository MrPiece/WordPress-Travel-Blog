<footer class="footer">
	<div class="container">
		<div class="footer__row">
			<ul class="footer__column footer__list">
				<h3><span class="link-title">Contacts</span></h3>
				<li><a href="<?= get_custom('facebook_link') ?>" class="link">Facebook</a></li>
				<li><a href="<?= get_custom('instagram_link') ?>" class="link">Instagram</a></li>
				<li><a href="<?= get_custom('twitter_link') ?>" class="link">Twitter</a></li>
				<li><a href="<?= get_custom('pinterest_link') ?>" class="link">Pinterest</a></li>
				<li><a href="<?= get_home_url() . '/contact/' ?>" class="link"><?php bloginfo('admin_email') ?></a></li>
			</ul>

			<?php
			$menu_args = [
				'theme_location'  => 'footer-about',
				'menu'            => 'footer_about',
				'menu_class'      => 'footer__column footer__list',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'echo'            => true,
			];
			wp_nav_menu($menu_args);

			$menu_args = [
				'theme_location'  => 'footer-blog',
				'menu'            => 'footer_blog',
				'menu_class'      => 'footer__column footer__list',
				'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
				'echo'            => true,
			];
			wp_nav_menu($menu_args);
			?>

			<ul class="footer-column social-links">
				<a href="<?= get_custom('facebook_link') ?>"><i class="fab fa-facebook-f"></i></a>
				<a href="<?= get_custom('twitter_link') ?>"><i class="fab fa-twitter"></i></a>
				<a href="<?= get_custom('instagram_link') ?>"><i class="fab fa-instagram"></i></a>
				<a href="<?= get_custom('pinterest_link') ?>"><i class="fab fa-pinterest-p"></i></a>
				<a href="<?= get_home_url() . '/contact/' ?>"><i class="fas fa-envelope"></i></a>
			</ul>

			<form action="#" method="post" class="footer__column footer__subscription">
				<label for="email">Email</label>
				<input type="email" name="email" id="email">

				<button type="submit" class="action-button">Subscribe on updates</button>
			</form>
		</div>

		<div class="footer__copyright">Copyright © <a href="<?= get_home_url() ?>">Travel Blog</a> 2020 - All Rights Reserved</div>
	</div>
</footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/slideout/1.0.1/slideout.min.js"></script>
<script>
var slideout = new Slideout({
	'panel': document.getElementById('slideout-panel'),
	'menu': document.getElementById('slideout-menu'),
	'padding': 256,
	'tolerance': 70
});

document.querySelector('.header__menu-icon').addEventListener('click', function() {
	slideout.toggle();
});
</script>
<?php wp_footer() ?>
</body>
</html>