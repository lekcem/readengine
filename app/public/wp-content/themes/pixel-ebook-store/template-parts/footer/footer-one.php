<div class="bottom-footer">
	<div class="container">
		<?php get_template_part( 'template-parts/site', 'info' ); ?>
		<?php if ( has_nav_menu( 'menu-2' ) && !get_theme_mod( 'disable_footer_menu', false )){ ?>
			<div class="footer-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
					'depth'          => 1,
				) );
				?>
			</div>
		<?php } ?>
	</div>
</div>