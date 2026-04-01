<?php

	$pixel_ebook_store_pix_theme_css = "";


	// site title and tagline font size option
	$pixel_ebook_store_site_title_font_size = get_theme_mod('pixel_ebook_store_site_title_font_size', 30);{
		$pixel_ebook_store_pix_theme_css .='h1.site-title a {';
	$pixel_ebook_store_pix_theme_css .='font-size: '.esc_attr($pixel_ebook_store_site_title_font_size).'px;!important';
		$pixel_ebook_store_pix_theme_css .='}';
	}

	// site title and tagline font size option
	$pixel_ebook_store_site_tagline_font_size = get_theme_mod('pixel_ebook_store_site_tagline_font_size', 15);{
		$pixel_ebook_store_pix_theme_css .='p.site-description {';
	$pixel_ebook_store_pix_theme_css .='font-size: '.esc_attr($pixel_ebook_store_site_tagline_font_size).'px;!important';
		$pixel_ebook_store_pix_theme_css .='}';
	}

	//Font Weight
	$pixel_ebook_store_menu_font_weight = get_theme_mod( 'pixel_ebook_store_menu_font_weight','');
	if($pixel_ebook_store_menu_font_weight == '100'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 100;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '200'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 200;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '300'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 300;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '400'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 400;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '500'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 500;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '600'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 600;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '700'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 700;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '800'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 800;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_font_weight == '900'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a {';
		$pixel_ebook_store_pix_theme_css .='font-weight: 900;';
	$pixel_ebook_store_pix_theme_css .='}';
	}

	// menu text transform
	$pixel_ebook_store_menu_text_tranform = get_theme_mod( 'pixel_ebook_store_menu_text_tranform','Capitalize');
	if($pixel_ebook_store_menu_text_tranform == 'Uppercase'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a  {';
		$pixel_ebook_store_pix_theme_css .='text-transform: uppercase;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_menu_text_tranform == 'Lowercase'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a  {';
		$pixel_ebook_store_pix_theme_css .='text-transform: lowercase;';
	$pixel_ebook_store_pix_theme_css .='}';
	}
	else if($pixel_ebook_store_menu_text_tranform == 'Capitalize'){
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a  {';
		$pixel_ebook_store_pix_theme_css .='text-transform: capitalize;';
	$pixel_ebook_store_pix_theme_css .='}';
	}

	//menu font size
	$pixel_ebook_store_menu_font_size = get_theme_mod('pixel_ebook_store_menu_font_size', 15);{
	$pixel_ebook_store_pix_theme_css .='.nav_menu li a ,.main-navigation li.page_item_has_children:after, .main-navigation li.menu-item-has-children:after{';
		$pixel_ebook_store_pix_theme_css .='font-size: '.esc_attr($pixel_ebook_store_menu_font_size).'px;';
	$pixel_ebook_store_pix_theme_css .='}';
	}

	//Add Settings and Controls for copyright
	$pixel_ebook_store_copyright_text_position = get_theme_mod( 'pixel_ebook_store_copyright_text_position','Center');
	if($pixel_ebook_store_copyright_text_position == 'Right'){
	$pixel_ebook_store_pix_theme_css .='.bottom-footer{';
	    $pixel_ebook_store_pix_theme_css .='text-align: right;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_copyright_text_position == 'Left'){
	$pixel_ebook_store_pix_theme_css .='.bottom-footer{';
	    $pixel_ebook_store_pix_theme_css .='text-align: left;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_copyright_text_position == 'Center'){
	$pixel_ebook_store_pix_theme_css .='.bottom-footer{';
	    $pixel_ebook_store_pix_theme_css .='text-align: center;';
	$pixel_ebook_store_pix_theme_css .='}';
	}

	//Add Settings and Controls for Scroll top
	$pixel_ebook_store_scroll_top_position = get_theme_mod( 'pixel_ebook_store_scroll_top_position','Right');
	if($pixel_ebook_store_scroll_top_position == 'Right'){
	$pixel_ebook_store_pix_theme_css .='#return-to-top{';
	    $pixel_ebook_store_pix_theme_css .='right: 20px;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_scroll_top_position == 'Left'){
	$pixel_ebook_store_pix_theme_css .='#return-to-top{';
	    $pixel_ebook_store_pix_theme_css .='left: 20px;';
	$pixel_ebook_store_pix_theme_css .='}';
	}else if($pixel_ebook_store_scroll_top_position == 'Center'){
	$pixel_ebook_store_pix_theme_css .='#return-to-top{';
	    $pixel_ebook_store_pix_theme_css .='right: 50%;left: 50%;';
	$pixel_ebook_store_pix_theme_css .='}';
	}


	// footer widget option 

	$pixel_ebook_store_footer_widget_background_color = get_theme_mod('pixel_ebook_store_footer_widget_background_color');
	if ($pixel_ebook_store_footer_widget_background_color) {
		$pixel_ebook_store_pix_theme_css .= "
			.top-footer {
				background-color: ". esc_attr($pixel_ebook_store_footer_widget_background_color) .";
			}
		";
	}

	$pixel_ebook_store_footer_copyright_background_color = get_theme_mod('pixel_ebook_store_footer_copyright_background_color');
	if ($pixel_ebook_store_footer_copyright_background_color) {
		$pixel_ebook_store_pix_theme_css .= "
			.bottom-footer {
				background-color: ". esc_attr($pixel_ebook_store_footer_copyright_background_color) .";
			}
		";
	}

	$pixel_ebook_store_footer_widget_background_image = get_theme_mod('pixel_ebook_store_footer_widget_background_image');
	if ($pixel_ebook_store_footer_widget_background_image) {
		$pixel_ebook_store_pix_theme_css .= "
			.top-footer {
				background-image: url(" . esc_url($pixel_ebook_store_footer_widget_background_image) . ");
			}
		";
	}