<?php
/**
 * The theme's header
 *
 * @package Pixel Ebook Store
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php do_action( 'wp_body_open' ); ?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'pixel-ebook-store' ); ?></a>

	<header id="masthead" class="site-header header-one top-header-mobile">
		<div class="bottom-header header-image-wrap">
			<div class="toggle-menu menu text-center text-md-right">
				<button onclick="pixel_ebook_store_mobile_menu_open()" class="toggle p-2 mb-2"><i class="fa-solid fa-bars"></i></button>
			</div>
			<div id="responsive" class="nav side_nav">
				<nav id="top_menu" class="nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu', 'pixel-ebook-store' ); ?>">
					<?php
					    wp_nav_menu( array( 
							'theme_location' => 'menu-1',
							'container_class' => 'navigation clearfix' ,
							'menu_class' => 'clearfix',
							'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 px-0">%3$s</ul>',
							'fallback_cb' => 'wp_page_menu',
					    ) ); 
					?>
					<a href="javascript:void(0)" class="closebtn menu" onclick="pixel_ebook_store_mobile_menu_close()"><i class="fa-solid fa-xmark"></i></a>
				</nav>
			</div>
		</div>
	</header>

	<div class="bg-color">
		<div class="header">
			<?php
				get_template_part( 'template-parts/header/header', 'one' );
			?>
		</div>
	</div>

	<?php 
		$pixel_ebook_store_has_header_image = has_header_image();
		$pixel_ebook_store_header_image_url = $pixel_ebook_store_has_header_image ? esc_url(get_header_image()) : '';
		$pixel_ebook_store_header_style = '';
		if ($pixel_ebook_store_has_header_image) {
			$pixel_ebook_store_header_style = sprintf(
				'background-image: url(%s); background-position: center; background-attachment: fixed; background-size: cover;',
				$pixel_ebook_store_header_image_url
			);
		}
	?>

	<div class="outer-area">
    	<div class="scroll-box">
    		<div class="container" <?php if ($pixel_ebook_store_header_style) echo 'style="' . esc_attr($pixel_ebook_store_header_style) . '";'; ?>>
	    		<div class="right-side-header py-4">	
	    			<div class="row">
	    				<div class="col-lg-4 col-md-4 align-self-center">
	    					<div class="search-box">
	    						<?php get_search_form(); ?>
	    					</div>
	    				</div>
	    				<div class="col-lg-4 col-md-6 align-self-center">
	    					<div class="social-inner-box text-center text-md-right">
								<?php
								    $pixel_ebook_store_facebook_url = get_theme_mod( 'pixel_ebook_store_facebook_url', '#' );
								    $pixel_ebook_store_twitter_url = get_theme_mod( 'pixel_ebook_store_twitter_url', '#' );
								    $pixel_ebook_store_instagram_url = get_theme_mod( 'pixel_ebook_store_instagram_url', '#' );
								    $pixel_ebook_store_youtube_url = get_theme_mod( 'pixel_ebook_store_youtube_url', '#' );
								    $pixel_ebook_store_whatsapp_url = get_theme_mod( 'pixel_ebook_store_whatsapp_url', '#' );
								?>
							    <?php if ( ! empty( $pixel_ebook_store_facebook_url ) ) { ?>
							        <a href="<?php echo esc_url( $pixel_ebook_store_facebook_url ); ?>"><i class="fab fa-facebook-f mr-3"></i></a>
							    <?php } ?>

							    <?php if ( ! empty( $pixel_ebook_store_twitter_url ) ) { ?>
							        <a href="<?php echo esc_url( $pixel_ebook_store_twitter_url ); ?>"><i class="fab fa-twitter mr-3"></i></a>
							    <?php } ?>

							    <?php if ( ! empty( $pixel_ebook_store_instagram_url ) ) { ?>
							        <a href="<?php echo esc_url( $pixel_ebook_store_instagram_url ); ?>"><i class="fab fa-instagram mr-3"></i></a>
							    <?php } ?>

							    <?php if ( ! empty( $pixel_ebook_store_youtube_url ) ) { ?>
							        <a href="<?php echo esc_url( $pixel_ebook_store_youtube_url ); ?>"><i class="fab fa-youtube mr-3"></i></a>
							    <?php } ?>

							    <?php if ( ! empty( $pixel_ebook_store_whatsapp_url ) ) { ?>
							        <a href="<?php echo esc_url( $pixel_ebook_store_whatsapp_url ); ?>"><i class="fab fa-whatsapp"></i></a>
							    <?php } ?>
					        </div>
	    				</div>
	    				<div class="col-lg-4 col-md-2 align-self-center">
	    					<div class="offcanvas-div d-flex top-header-desktop">
								<button type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
									<i class="fas fa-bars"></i>
								</button>
								<div class="offcanvas offcanvas-end" id="demo">
									<div class="offcanvas-header"> 
										<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
									</div>
									<div class="offcanvas-body">
										<header id="masthead" class="site-header header-one">
											<div class="bottom-header header-image-wrap">
												<div class="toggle-menu menu text-center text-md-right">
													<button onclick="pixel_ebook_store_mobile_menu_open()" class="toggle p-2 mb-2"><i class="fa-solid fa-bars"></i></button>
												</div>
												<div id="responsive" class="nav side_nav">
													<nav id="top_menu" class="nav_menu" role="navigation" aria-label="<?php esc_attr_e( 'Menu', 'pixel-ebook-store' ); ?>">
														<?php
														    wp_nav_menu( array( 
																'theme_location' => 'menu-1',
																'container_class' => 'navigation clearfix' ,
																'menu_class' => 'clearfix',
																'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav m-0 px-0">%3$s</ul>',
																'fallback_cb' => 'wp_page_menu',
														    ) ); 
														?>
														<a href="javascript:void(0)" class="closebtn menu" onclick="pixel_ebook_store_mobile_menu_close()"><i class="fa-solid fa-xmark"></i></a>
													</nav>
												</div>
											</div>
										</header>
									</div>
								</div>
							</div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>