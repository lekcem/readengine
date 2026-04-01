<?php
/**
 * Section of the template that displays the site's identity.
 *
 * @since Pixel Ebook Store 1.0.0
 */

?>

<div class="site-branding text-center text-md-left">
	<?php
		if (get_theme_mod('pixel_ebook_store_site_logo', false)) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( pixel_ebook_store_get_custom_logo_url() ); ?>" id="headerLogo">
			</a>
			<?php
		}
	?>
	<?php
		if (get_theme_mod('pixel_ebook_store_site_title_text', true)) { ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php
		}
		$pixel_ebook_store_description = get_bloginfo( 'description', 'display' );
		if (get_theme_mod('pixel_ebook_store_site_tagline_text', false)) {
			if ( $pixel_ebook_store_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo esc_html($pixel_ebook_store_description); /* WPCS: xss ok. */ ?></p>
			<?php endif;
		}
	?>
</div>