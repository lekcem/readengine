<?php
/**
 * The format used to show the footer
 *
 * @package Pixel Ebook Store
 */

?>
	<footer id="colophon" class="site-footer">
		<div class="site-footer-inner">

			<?php if (get_theme_mod('pixel_ebook_store_footer_widgets_section_on_off_setting', true)) { ?>
				<div class="top-footer">
					<div class="wrap-footer-sidebar">
						<div class="container">
							<div class="footer-widget-wrap">
								<div class="row">
									<?php 
										get_template_part( 'template-parts/footer/footer-widget', 'one' );
									?>
									<h1>Hello World</h1>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>

			<?php
				get_template_part( 'template-parts/footer/footer', 'one' );
			?>
			<div class="return-to-header">
			    <a href="javascript:void(0);" id="return-to-top">
			        <i class="<?php echo esc_attr(get_theme_mod('scroll_top_icon', 'fa-solid fa-angles-up')); ?> return-to-top"></i>
			    </a>
			</div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>