<?php
/**
 * Site information display template section
 *
 * @package Pixel Ebook Store
 */

?>

<div class="site-info">
	<?php
    $pixel_ebook_store_footer_text = get_theme_mod('pixel_ebook_store_footer_text', '');

	if (!empty($pixel_ebook_store_footer_text)) {
        $pixel_ebook_store_text = esc_html($pixel_ebook_store_footer_text);
    } else {
		$theme = wp_get_theme();
		$pixel_ebook_store_text = sprintf(
			/* translators: 1: Theme author with link, 2: Copyright year, 3: Theme name with link */
			esc_html__('Theme design by %1$s | Copyright @ %2$s %3$s', 'pixel-ebook-store'),
			'<a href="' . esc_url($theme->get('AuthorURI')) . '" target="_blank">' . esc_html($theme->get('Author')) . '</a>',
			esc_html(date('Y')),
			'<a href="' . esc_url($theme->get('ThemeURI')) . '" target="_blank">' . esc_html($theme->get('Name')) . '</a>'
		);
    }
	?>
	<p><?php echo $pixel_ebook_store_text; ?></p>
</div>