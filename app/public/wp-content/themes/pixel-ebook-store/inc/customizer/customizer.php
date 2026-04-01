<?php
/**
 * Pixel Ebook Store Theme Customizer
 *
 * @package Pixel Ebook Store
 */

// Customize Controls.
require get_template_directory() . '/inc/custom-settings-control/customize-controls.php';

// Customize Controls.
require get_template_directory() . '/inc/custom-range-controls.php';

// Sanitization For Customize Controls.
require get_template_directory() . '/inc/custom-settings-control/sanitization.php';

/**
 * Provide postMessage support for the Theme Customizer's site title and description.
 */
function pixel_ebook_store_customize_register( $wp_customize ) {

    // General Settings Panel.
    $wp_customize->add_panel( 'pixel_ebook_store_general_settings_panel',
        array(
            'title'      => esc_html__( 'General Settings', 'pixel-ebook-store' ),
            'priority'   => 2,
            'capability' => 'edit_theme_options',
        )
    );

    // Header Settings Panel.
    $wp_customize->add_panel( 'pixel_ebook_store_header_settings_panel',
        array(
            'title'      => esc_html__( 'Header Settings', 'pixel-ebook-store' ),
            'priority'   => 2,
            'capability' => 'edit_theme_options',
        )
    );

    // Frontpage Sections Settings Panel.
    $wp_customize->add_panel( 'pixel_ebook_store_frontpage_sections_settings_panel',
        array(
            'title'      => esc_html__( 'Frontpage Sections Settings', 'pixel-ebook-store' ),
            'priority'   => 3,
            'capability' => 'edit_theme_options',
        )
    );

    // Footer Settings Panel.
    $wp_customize->add_panel( 'pixel_ebook_store_footer_settings_panel',
        array(
            'title'      => esc_html__( 'Footer Settings', 'pixel-ebook-store' ),
            'priority'   => 3,
            'capability' => 'edit_theme_options',
        )
    );

    // Site Identity

	$wp_customize->get_section( 'title_tagline' )->panel = 'pixel_ebook_store_header_settings_panel';

	$wp_customize->add_setting(
		'pixel_ebook_store_site_logo',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new pixel_ebook_store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_site_logo',
			array(
				'label'    => esc_html__( 'ON / OFF Site Logo', 'pixel-ebook-store' ),
				'section'  => 'title_tagline',
				'settings' => 'pixel_ebook_store_site_logo',
			)
		)
	);

	$wp_customize->add_setting(
		'pixel_ebook_store_site_title_text',
		array(
			'default'           => true,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new pixel_ebook_store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_site_title_text',
			array(
				'label'    => esc_html__( 'ON / OFF Site Title', 'pixel-ebook-store' ),
				'section'  => 'title_tagline',
				'settings' => 'pixel_ebook_store_site_title_text',
			)
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_site_title_font_size',
        array(
            'default'   => 30,
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number_range',
        )
    );

    $wp_customize->add_control(
        new pixel_ebook_store_Slider(
            $wp_customize,
            'pixel_ebook_store_site_title_font_size',
            array(
                'label'    => esc_html__( 'Site Title Font Size', 'pixel-ebook-store' ),
                'section'  => 'title_tagline',
                'label' => esc_html__('Site Title Font Size', 'pixel-ebook-store'),
                'input_attrs' => array(
                    'reset'            => 30,
                    'step'             => 1,
                    'min'              => 0,
                    'max'              => 50,
                ),
            )
        )
    );

	$wp_customize->add_setting(
		'pixel_ebook_store_site_tagline_text',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new pixel_ebook_store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_site_tagline_text',
			array(
				'label'    => esc_html__( 'ON / OFF Site Tagline', 'pixel-ebook-store' ),
				'section'  => 'title_tagline',
				'settings' => 'pixel_ebook_store_site_tagline_text',
			)
		)
	);

$wp_customize->add_setting(
        'pixel_ebook_store_site_tagline_font_size',
        array(
            'default'   => 15,
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number_range',
        )
    );

    $wp_customize->add_control(
        new pixel_ebook_store_Slider(
            $wp_customize,
            'pixel_ebook_store_site_tagline_font_size',
            array(
                'label'    => esc_html__( 'Site Tagline Font Size', 'pixel-ebook-store' ),
                'section'  => 'title_tagline',
                'label' => esc_html__('Site Tagline Font Size', 'pixel-ebook-store'),
                'input_attrs' => array(
                    'reset'            => 15,
                    'step'             => 1,
                    'min'              => 0,
                    'max'              => 50,
                ),
            )
        )
    );

    //Woo Coomerce
    $wp_customize->add_setting('pixel_ebook_store_per_columns',array(
        'default'=> 3,
        'sanitize_callback' => 'pixel_ebook_store_sanitize_number_absint'
    ));
    $wp_customize->add_control('pixel_ebook_store_per_columns',array(
        'label' => __('Product Per Row','pixel-ebook-store'),
        'section'=> 'woocommerce_product_catalog',
        'type'=> 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 6,
            'step' => 1,
        ),
    ));
    $wp_customize->add_setting('pixel_ebook_store_product_per_page',array(
        'default'=> 10,
        'sanitize_callback' => 'pixel_ebook_store_sanitize_number_absint'
    ));
    $wp_customize->add_control('pixel_ebook_store_product_per_page',array(
        'label' => __('Product Per Page','pixel-ebook-store'),
        'section'=> 'woocommerce_product_catalog',
        'type'=> 'number',
        'input_attrs' => array(
            'min' => 1,
            'max' => 20,
            'step' => 1,
        ),
    ));


    $wp_customize->add_section(
        'woocommerce_product_extra_section',
        array(
            'panel'      => 'woocommerce',
            'title'    => esc_html__( 'Extra WooCommerce Settings', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting( 'pixel_ebook_store_single_product_sidebar', array(
        'default'           => true,
        'transport'         => 'refresh',
        'sanitize_callback' => 'pixel_ebook_store_sanitize_checkbox',
    ) );
    $wp_customize->add_control( new pixel_ebook_store_On_Off_Custom_Control( $wp_customize, 'pixel_ebook_store_single_product_sidebar', array(
        'label'       => esc_html__( 'Show / Hide Product Page Sidebar', 'pixel-ebook-store' ),
        'section'     => 'woocommerce_product_extra_section',
        'type'        => 'toggle',
        'settings'    => 'pixel_ebook_store_single_product_sidebar',
    ) ) );

    // Header Options

    $wp_customize->add_section(
        'pixel_ebook_store_account_section',
        array(
			'panel'      => 'pixel_ebook_store_header_settings_panel',
            'title'    => esc_html__( 'Header Options', 'pixel-ebook-store' ),
        )
    );

    //MENU TYPOGRAPHY
    
    $wp_customize->add_setting('pixel_ebook_store_menu_font_weight',array(
        'default' => '',
        'sanitize_callback' => 'pixel_ebook_store_sanitize_choices'
    ));
    $wp_customize->add_control('pixel_ebook_store_menu_font_weight',array(
     'type' => 'radio',
     'label'     => __('Menu Font Weight', 'pixel-ebook-store'),
     'section' => 'pixel_ebook_store_account_section',
     'type' => 'select',
     'choices' => array(
         '100' => __('100','pixel-ebook-store'),
         '200' => __('200','pixel-ebook-store'),
         '300' => __('300','pixel-ebook-store'),
         '400' => __('400','pixel-ebook-store'),
         '500' => __('500','pixel-ebook-store'),
         '600' => __('600','pixel-ebook-store'),
         '700' => __('700','pixel-ebook-store'),
         '800' => __('800','pixel-ebook-store'),
         '900' => __('900','pixel-ebook-store')
     ),
    ) );
    
    $wp_customize->add_setting('pixel_ebook_store_menu_text_tranform',array(
        'default' => 'Capitalize',
        'sanitize_callback' => 'pixel_ebook_store_sanitize_choices'
    ));
    $wp_customize->add_control('pixel_ebook_store_menu_text_tranform',array(
        'type' => 'select',
        'label' => __('Menu Text Transform','pixel-ebook-store'),
        'section' => 'pixel_ebook_store_account_section',
        'choices' => array(
           'Uppercase' => __('Uppercase','pixel-ebook-store'),
           'Lowercase' => __('Lowercase','pixel-ebook-store'),
           'Capitalize' => __('Capitalize','pixel-ebook-store'),
        ),
    ) );
    $wp_customize->add_setting('pixel_ebook_store_menu_font_size', array(
        'default'   => 15,
        'sanitize_callback' => 'pixel_ebook_store_sanitize_number_range',
    ));
    $wp_customize->add_control(new pixel_ebook_store_Slider($wp_customize, 'pixel_ebook_store_menu_font_size', array(
        'section' => 'pixel_ebook_store_account_section',
        'label' => esc_html__('Menu Font Size', 'pixel-ebook-store'),
        'input_attrs' => array(
                    'reset'            => 15,
                    'step'             => 1,
                    'min'              => 0,
                    'max'              => 35,
                ),
    )));

    $wp_customize->add_setting(
        'pixel_ebook_store_sidebar_account',
        array(
            'default'           => 'Logout',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_sidebar_account',
        array(
            'label'           => sprintf( esc_html__( 'Add Account Text', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_account_section',
            'settings'        => 'pixel_ebook_store_sidebar_account' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_sidebar_account_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_sidebar_account_link',
        array(
            'label'           => sprintf( esc_html__( 'Add Account Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_account_section',
            'settings'        => 'pixel_ebook_store_sidebar_account_link' ,
            'type'            => 'url',
        )
    );

	// Header Menu Options

	$wp_customize->add_section(
		'pixel_ebook_store_header_section',
		array(
			'panel'      => 'pixel_ebook_store_header_settings_panel',
			'title'    => esc_html__( 'Menu1 Options', 'pixel-ebook-store' ),
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_sidebar_slot_heading',
        array(
            'default'           => 'News Feed',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_sidebar_slot_heading',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu 1 Heading', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_sidebar_slot_heading' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn1',
        array(
            'default'           => 'Browse',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot_btn1',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu1', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn1' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn1_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_slot_btn1_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu1 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn1_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn2',
        array(
            'default'           => 'Wish List',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot_btn2',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu2', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn2' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn2_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot_btn2_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu2 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn2_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn3',
        array(
            'default'           => 'Renting',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot_btn3',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu3', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn3' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot_btn3_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot_btn3_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu3 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_section',
            'settings'        => 'pixel_ebook_store_slot_btn3_url' ,
            'type'            => 'url',
        )
    );

    // Author Options

    $wp_customize->add_section(
        'pixel_ebook_store_author_section',
        array(
			'panel'      => 'pixel_ebook_store_header_settings_panel',
            'title'    => esc_html__( 'Author Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_sidebar_slot2_heading',
        array(
            'default'           => 'Following',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_sidebar_slot2_heading',
        array(
            'label'           => sprintf( esc_html__( 'Add Heading', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_author_section',
            'settings'        => 'pixel_ebook_store_sidebar_slot2_heading' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_author',
        array(
            'default'           => '1',
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_author',
        array(
            'label'       => esc_html__( 'No of Author', 'pixel-ebook-store' ),
            'section'     => 'pixel_ebook_store_author_section',
            'settings'    => 'pixel_ebook_store_author',
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 1,
                'max' => 5,
            ),
        )
    );

    $pixel_ebook_store_author = get_theme_mod( 'pixel_ebook_store_author');
    for ( $i = 1; $i <= $pixel_ebook_store_author; $i++ ){
        $wp_customize->add_setting(
            'pixel_ebook_store_author_btn'.$i,
            array(
                'default'           => 'Ann Chovey',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_author_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Author Name 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_author_section',
                'settings'        => 'pixel_ebook_store_author_btn'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_author_button_link'.$i,
            array(
                'default'           => '#',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_author_button_link'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Author Page Link 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_author_section',
                'settings'        => 'pixel_ebook_store_author_button_link'.$i,
                'type'            => 'url',
            )
        );
        
        $wp_customize->add_setting(
            'pixel_ebook_store_author_image'.$i,
            array(
                'default'           => get_template_directory_uri() . '/assets/images/author1.png',
                'sanitize_callback' => 'pixel_ebook_store_sanitize_image',

            )
        );
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 'pixel_ebook_store_author_image'.$i, 
                array(
                    'label'           => sprintf( esc_html__( 'Author Image 0', 'pixel-ebook-store' ).$i, ),
                    'settings'  => 'pixel_ebook_store_author_image'.$i,
                    'section'   => 'pixel_ebook_store_author_section'
                ) 
            )
        );
    }

    // Header Menu Options

    $wp_customize->add_section(
        'pixel_ebook_store_header_menu_section',
        array(
			'panel'      => 'pixel_ebook_store_header_settings_panel',
            'title'    => esc_html__( 'Menu2 Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_sidebar_slot3_heading',
        array(
            'default'           => 'Quick Links',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_sidebar_slot3_heading',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu 1 Heading', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_sidebar_slot3_heading' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn1',
        array(
            'default'           => 'Coming Soon',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn1',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu1', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn1' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn1_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn1_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu1 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn1_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn2',
        array(
            'default'           => 'Useful Links',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn2',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu2', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn2' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn2_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn2_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu2 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn2_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn3',
        array(
            'default'           => 'Privacy Policy',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn3',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu3', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn3' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_slot3_btn3_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_slot3_btn3_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Menu3 Url', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_header_menu_section',
            'settings'        => 'pixel_ebook_store_slot3_btn3_url' ,
            'type'            => 'url',
        )
    );


	// Social Options

	$wp_customize->add_section(
		'pixel_ebook_store_social_section',
		array(
			'panel'      => 'pixel_ebook_store_header_settings_panel',
			'title'    => esc_html__( 'Social Options', 'pixel-ebook-store' ),
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_facebook_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_facebook_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Facebook Link', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_social_section',
            'settings'        => 'pixel_ebook_store_facebook_url' ,
            'type'            => 'url',
        )
    );

	$wp_customize->add_setting(
        'pixel_ebook_store_twitter_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_twitter_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Twitter Link', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_social_section',
            'settings'        => 'pixel_ebook_store_twitter_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_instagram_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_instagram_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Instagram Link', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_social_section',
            'settings'        => 'pixel_ebook_store_instagram_url' ,
            'type'            => 'url',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_youtube_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_youtube_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Youtube Link', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_social_section',
            'settings'        => 'pixel_ebook_store_youtube_url' ,
            'type'            => 'url',
        )
    );

	$wp_customize->add_setting(
        'pixel_ebook_store_whatsapp_url',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

	$wp_customize->add_control(
        'pixel_ebook_store_whatsapp_url',
        array(
            'label'           => sprintf( esc_html__( 'Add Whatsapp Link', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_social_section',
            'settings'        => 'pixel_ebook_store_whatsapp_url' ,
            'type'            => 'url',
        )
    );
	
	// Banner Options

	$wp_customize->add_section(
		'pixel_ebook_store_banner_section',
		array(
			'panel'      => 'pixel_ebook_store_frontpage_sections_settings_panel',
			'title'    => esc_html__( 'Banner Options', 'pixel-ebook-store' ),
		)
	);

    $wp_customize->add_setting(
		'pixel_ebook_store_banner_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new Pixel_Ebook_Store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_banner_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Banner Section', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_banner_section',
				'settings' => 'pixel_ebook_store_banner_section_on_off_setting',
			)
		)
	);

	$wp_customize->add_setting(
	    'pixel_ebook_store_slider',
	    array(
	        'default'           => '',
	        'sanitize_callback' => 'pixel_ebook_store_sanitize_number',
	    )
	);

	$wp_customize->add_control(
	    'pixel_ebook_store_slider',
	    array(
	        'label'       => esc_html__( 'No of banner', 'pixel-ebook-store' ),
	        'section'     => 'pixel_ebook_store_banner_section',
	        'settings'    => 'pixel_ebook_store_slider',
	        'type'        => 'number',
	        'input_attrs' => array(
	            'min' => 1,
	            'max' => 3,
	        ),
	    )
	);

	$pixel_ebook_store_banner = get_theme_mod( 'pixel_ebook_store_slider');
	for ( $i = 1; $i <= $pixel_ebook_store_banner; $i++ ){
		$wp_customize->add_setting(
			'pixel_ebook_store_banner_heading'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			'pixel_ebook_store_banner_heading'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Heading 0', 'pixel-ebook-store' ).$i, ),
				'section'         => 'pixel_ebook_store_banner_section',
				'settings'        => 'pixel_ebook_store_banner_heading'.$i,
				'type'            => 'text',
			)
		);

        $wp_customize->add_setting(
            'pixel_ebook_store_banner_btn'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_banner_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Banner Button 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_banner_section',
                'settings'        => 'pixel_ebook_store_banner_btn'.$i,
                'type'            => 'text',
            )
        );

		$wp_customize->add_setting(
			'pixel_ebook_store_banner_button_link'.$i,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			'pixel_ebook_store_banner_button_link'.$i,
			array(
				'label'           => sprintf( esc_html__( 'Banner Button Link 0', 'pixel-ebook-store' ).$i, ),
				'section'         => 'pixel_ebook_store_banner_section',
				'settings'        => 'pixel_ebook_store_banner_button_link'.$i,
				'type'            => 'url',
			)
		);
		
		$wp_customize->add_setting(
			'pixel_ebook_store_banner_image'.$i,
			array(
	        	'default'           => '',
	        	'sanitize_callback' => 'pixel_ebook_store_sanitize_image',

	    	)
	    );
	    
	    $wp_customize->add_control(
	     	new WP_Customize_Image_Control(
	    		$wp_customize, 'pixel_ebook_store_banner_image'.$i, 
	    		array(
	    			'label'           => sprintf( esc_html__( 'Banner Image 0', 'pixel-ebook-store' ).$i, ),
			        'settings'  => 'pixel_ebook_store_banner_image'.$i,
			        'section'   => 'pixel_ebook_store_banner_section'
	    		) 
	    	)
	    );
	}

    // Category Options

    $wp_customize->add_section(
        'pixel_ebook_store_category_section',
        array(
			'panel'      => 'pixel_ebook_store_frontpage_sections_settings_panel',
            'title'    => esc_html__( 'Category Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
		'pixel_ebook_store_category_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new Pixel_Ebook_Store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_category_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Category Section', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_category_section',
				'settings' => 'pixel_ebook_store_category_section_on_off_setting',
			)
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_category_heading',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_category_heading'.$i,
        array(
            'label'           => sprintf( esc_html__( 'Category Title', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_category_section',
            'settings'        => 'pixel_ebook_store_category_heading',
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_category_slider',
        array(
            'default'           => '',
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_category_slider',
        array(
            'label'       => esc_html__( 'No of category', 'pixel-ebook-store' ),
            'section'     => 'pixel_ebook_store_category_section',
            'settings'    => 'pixel_ebook_store_category_slider',
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 1,
                'max' => 8,
            ),
        )
    );

    $pixel_ebook_store_category = get_theme_mod( 'pixel_ebook_store_category_slider');
    for ( $i = 1; $i <= $pixel_ebook_store_category; $i++ ){        
        $wp_customize->add_setting(
            'pixel_ebook_store_category_box_heading'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_category_box_heading'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Category Heading 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_category_section',
                'settings'        => 'pixel_ebook_store_category_box_heading'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_category_box_heading_link'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_category_box_heading_link'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Category Heading Link 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_category_section',
                'settings'        => 'pixel_ebook_store_category_box_heading_link'.$i,
                'type'            => 'url',
            )
        );
        
        $wp_customize->add_setting(
            'pixel_ebook_store_category_image'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'pixel_ebook_store_sanitize_image',

            )
        );
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 'pixel_ebook_store_category_image'.$i,
                array(
                    'label'           => sprintf( esc_html__( 'Category Image 0', 'pixel-ebook-store' ).$i, ),
                    'settings'  => 'pixel_ebook_store_category_image'.$i,
                    'section'   => 'pixel_ebook_store_category_section'
                ) 
            )
        );
    }

    // Subscriber Options

    $wp_customize->add_section(
        'pixel_ebook_store_subscriber_section',
        array(
			'panel'      => 'pixel_ebook_store_frontpage_sections_settings_panel',
            'title'    => esc_html__( 'Subscribe Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
		'pixel_ebook_store_subscriber_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new Pixel_Ebook_Store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_subscriber_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Subscriber Section', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_subscriber_section',
				'settings' => 'pixel_ebook_store_subscriber_section_on_off_setting',
			)
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_subscriber_slider',
        array(
            'default'           => '',
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_subscriber_slider',
        array(
            'label'       => esc_html__( 'No of subscriber', 'pixel-ebook-store' ),
            'section'     => 'pixel_ebook_store_subscriber_section',
            'settings'    => 'pixel_ebook_store_subscriber_slider',
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 1,
                'max' => 3,
            ),
        )
    );

    $pixel_ebook_store_subscriber = get_theme_mod( 'pixel_ebook_store_subscriber_slider');
    for ( $i = 1; $i <= $pixel_ebook_store_subscriber; $i++ ){        
        $wp_customize->add_setting(
            'pixel_ebook_store_subscriber_heading'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_subscriber_heading'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Heading 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_subscriber_section',
                'settings'        => 'pixel_ebook_store_subscriber_heading'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_subscriber_text'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_subscriber_text'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Text 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_subscriber_section',
                'settings'        => 'pixel_ebook_store_subscriber_text'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_subscriber_btn'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_subscriber_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Button Text 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_subscriber_section',
                'settings'        => 'pixel_ebook_store_subscriber_btn'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_subscriber_btn_link'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_subscriber_btn_link'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Button Link 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_subscriber_section',
                'settings'        => 'pixel_ebook_store_subscriber_btn_link'.$i,
                'type'            => 'url',
            )
        );
        
        $wp_customize->add_setting(
            'pixel_ebook_store_subscriber_image'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'pixel_ebook_store_sanitize_image',

            )
        );
        
        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize, 'pixel_ebook_store_subscriber_image'.$i,
                array(
                    'label'           => sprintf( esc_html__( 'Add Image 0', 'pixel-ebook-store' ).$i, ),
                    'settings'  => 'pixel_ebook_store_subscriber_image'.$i,
                    'section'   => 'pixel_ebook_store_subscriber_section'
                ) 
            )
        );
    }


    // Variety Books Options

    $wp_customize->add_section(
        'pixel_ebook_store_variety_section',
        array(
			'panel'      => 'pixel_ebook_store_frontpage_sections_settings_panel',
            'title'    => esc_html__( 'Variety Books Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
		'pixel_ebook_store_variety_section_on_off_setting',
		array(
			'default'           => false,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new Pixel_Ebook_Store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_variety_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Variety Section', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_variety_section',
				'settings' => 'pixel_ebook_store_variety_section_on_off_setting',
			)
		)
	);

    $wp_customize->add_setting(
        'pixel_ebook_store_variety_slider',
        array(
            'default'           => '',
            'sanitize_callback' => 'pixel_ebook_store_sanitize_number',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_variety_slider',
        array(
            'label'       => esc_html__( 'No of variety', 'pixel-ebook-store' ),
            'section'     => 'pixel_ebook_store_variety_section',
            'settings'    => 'pixel_ebook_store_variety_slider',
            'type'        => 'number',
            'input_attrs' => array(
                'min' => 1,
                'max' => 3,
            ),
        )
    );

    $pixel_ebook_store_variety = get_theme_mod( 'pixel_ebook_store_variety_slider');
    for ( $i = 1; $i <= $pixel_ebook_store_variety; $i++ ){
        $wp_customize->add_setting(
            'pixel_ebook_store_variety_extra_heading'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_variety_extra_heading'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Extra Heading 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_variety_section',
                'settings'        => 'pixel_ebook_store_variety_extra_heading'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_variety_heading'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_variety_heading'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Heading 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_variety_section',
                'settings'        => 'pixel_ebook_store_variety_heading'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_variety_text'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_variety_text'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Text 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_variety_section',
                'settings'        => 'pixel_ebook_store_variety_text'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_variety_btn'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_variety_btn'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Button Text 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_variety_section',
                'settings'        => 'pixel_ebook_store_variety_btn'.$i,
                'type'            => 'text',
            )
        );

        $wp_customize->add_setting(
            'pixel_ebook_store_variety_btn_link'.$i,
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_url_raw',
            )
        );

        $wp_customize->add_control(
            'pixel_ebook_store_variety_btn_link'.$i,
            array(
                'label'           => sprintf( esc_html__( 'Add Button Link 0', 'pixel-ebook-store' ).$i, ),
                'section'         => 'pixel_ebook_store_variety_section',
                'settings'        => 'pixel_ebook_store_variety_btn_link'.$i,
                'type'            => 'url',
            )
        );        
    }

    // Global Color Options

	$wp_customize->add_section(
		'pixel_ebook_store_global_color_section',
		array(
			'panel'      => 'pixel_ebook_store_general_settings_panel',
			'title'    => esc_html__( 'Global Color Options', 'pixel-ebook-store' ),
		)
	);

	$wp_customize->add_setting(
		'pixel_ebook_store_global_color',
		array(
			'default'           => '#f3c432',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'pixel_ebook_store_global_color',
			array(
				'label'    => __( 'Global Color One', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_global_color_section',
			)
		)
	);

	// Global Font Family Options

	$wp_customize->add_section(
		'pixel_ebook_store_global_font_section',
		array(
			'panel'      => 'pixel_ebook_store_general_settings_panel',
			'title'    => esc_html__( 'Global Font Family Options', 'pixel-ebook-store' ),
		)
	);

	$wp_customize->add_setting(
		'pixel_ebook_store_global_font_setting',
		array(
			'default'           => '',
			'sanitize_callback' => 'pixel_ebook_store_sanitize_google_fonts',
		)
	);
	
	$wp_customize->add_control(
		'pixel_ebook_store_global_font_setting',
		array(
			'label'    => esc_html__( 'Global Font Family', 'pixel-ebook-store' ),
			'section'  => 'pixel_ebook_store_global_font_section',
			'settings' => 'pixel_ebook_store_global_font_setting',
			'type'     => 'select',
			'choices'  => pixel_ebook_store_get_all_google_font_families(),
		)
	);	

	$wp_customize->add_setting(
		'pixel_ebook_store_global_font_settingone',
		array(
			'default'           => '',
			'sanitize_callback' => 'pixel_ebook_store_sanitize_google_fonts',
		)
	);
	
	$wp_customize->add_control(
		'pixel_ebook_store_global_font_settingone',
		array(
			'label'    => esc_html__( 'Global Heading Font Family', 'pixel-ebook-store' ),
			'section'  => 'pixel_ebook_store_global_font_section',
			'settings' => 'pixel_ebook_store_global_font_settingone',
			'type'     => 'select',
			'choices'  => pixel_ebook_store_get_all_google_font_families(),
		)
	);

    // Footer Options

	$wp_customize->add_section(
        'pixel_ebook_store_footer_widgets_section',
        array(
            'panel'      => 'pixel_ebook_store_footer_settings_panel',
            'title'    => esc_html__( 'Footer Widgets Options', 'pixel-ebook-store' ),
        )
    );

	$wp_customize->add_setting(
		'pixel_ebook_store_footer_widgets_section_on_off_setting',
		array(
			'default'           => true,
			'sanitize_callback' => 'pixel_ebook_store_sanitize_on_off',
		)
	);

	$wp_customize->add_control(
		new pixel_ebook_store_On_Off_Custom_Control(
			$wp_customize,
			'pixel_ebook_store_footer_widgets_section_on_off_setting',
			array(
				'label'    => esc_html__( 'ON / OFF Footer Widgets', 'pixel-ebook-store' ),
				'section'  => 'pixel_ebook_store_footer_widgets_section',
				'settings' => 'pixel_ebook_store_footer_widgets_section_on_off_setting',
			)
		)
	);

    $wp_customize->add_setting( 'pixel_ebook_store_footer_widget_background_color', array(
            'default' => '',
            'sanitize_callback' => 'sanitize_hex_color'
        ));
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pixel_ebook_store_footer_widget_background_color', array(
            'label'     => __('Footer Widget Background Color', 'pixel-ebook-store'),
            'description' => __('It will change the complete footer widget background color.', 'pixel-ebook-store'),
            'section' => 'pixel_ebook_store_footer_widgets_section',
            'settings' => 'pixel_ebook_store_footer_widget_background_color',
        )));

        $wp_customize->add_setting('pixel_ebook_store_footer_widget_background_image',array(
            'default'   => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'pixel_ebook_store_footer_widget_background_image',array(
            'label' => __('Footer Widget Background Image','pixel-ebook-store'),
            'section' => 'pixel_ebook_store_footer_widgets_section'
        )));
        
	$wp_customize->add_section(
        'pixel_ebook_store_copyright_section',
        array(
            'panel'      => 'pixel_ebook_store_footer_settings_panel',
            'title'    => esc_html__( 'Copyright Options', 'pixel-ebook-store' ),
        )
    );

    $wp_customize->add_setting(
        'pixel_ebook_store_footer_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        'pixel_ebook_store_footer_text',
        array(
            'label'           => sprintf( esc_html__( 'Edit Copyright Text', 'pixel-ebook-store' ), ),
            'section'         => 'pixel_ebook_store_copyright_section',
            'settings'        => 'pixel_ebook_store_footer_text' ,
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting( 'pixel_ebook_store_footer_copyright_background_color', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'pixel_ebook_store_footer_copyright_background_color', array(
		'label'     => __('Copyright Background Color', 'pixel-ebook-store'),
		'description' => __('It will change the complete copyright background color.', 'pixel-ebook-store'),
		'section' => 'pixel_ebook_store_copyright_section',
		'settings' => 'pixel_ebook_store_footer_copyright_background_color',
	)));

	$wp_customize->add_setting('pixel_ebook_store_copyright_text_position',array(
        'default' => 'Center',
        'sanitize_callback' => 'pixel_ebook_store_sanitize_choices'
    ));
    $wp_customize->add_control('pixel_ebook_store_copyright_text_position',array(
        'type' => 'radio',
        'label'     => __('Copyright Position', 'pixel-ebook-store'),
        'description'   => __('This option work for copyright', 'pixel-ebook-store'),
		'section' => 'pixel_ebook_store_copyright_section',
		'choices' => array(
            'Right' => __('Right','pixel-ebook-store'),
            'Left' => __('Left','pixel-ebook-store'),
            'Center' => __('Center','pixel-ebook-store')
     ),
    ) );

    // Add Settings and Controls for Scroll top
    $wp_customize->add_setting('pixel_ebook_store_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'pixel_ebook_store_sanitize_choices'
    ));
    $wp_customize->add_control('pixel_ebook_store_scroll_top_position',array(
        'type' => 'radio',
        'label'     => __('Scroll to top Position', 'pixel-ebook-store'),
        'description'   => __('This option work for scroll to top', 'pixel-ebook-store'),
       'section' => 'pixel_ebook_store_copyright_section',
       'choices' => array(
            'Right' => __('Right','pixel-ebook-store'),
            'Left' => __('Left','pixel-ebook-store'),
            'Center' => __('Center','pixel-ebook-store')
     ),
    ) );

}
add_action( 'customize_register', 'pixel_ebook_store_customize_register' );

/**
 * Create the site title for the partial selective refresh.
 *
 * @return void
 */
function pixel_ebook_store_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Create the website's slogan for the partial selective refresh.
 *
 * @return void
 */
function pixel_ebook_store_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Pixel_Ebook_Store_Customize_Buttons {
	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function Pixel_Ebook_Store_get_instance() {

		static $pixel_ebook_store_instance = null;

		if ( is_null( $pixel_ebook_store_instance ) ) {
			$pixel_ebook_store_instance = new self;
			$pixel_ebook_store_instance->Pixel_Ebook_Store_setup_actions();
		}

		return $pixel_ebook_store_instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function Pixel_Ebook_Store_setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $pixel_ebook_store_manager
	 * @return void
	*/
	public function sections( $pixel_ebook_store_manager ) {
		load_template( trailingslashit( get_template_directory() ) . '/inc/pixel-ebook-store-section-pro.php' );

		$pixel_ebook_store_manager->register_section_type( 'Pixel_Ebook_Store_Customize_Section_Pro' );

		$pixel_ebook_store_manager->add_section( new Pixel_Ebook_Store_Customize_Section_Pro( $pixel_ebook_store_manager,'pixel_ebook_store_buy_now', array(
			'priority'   => 1,
			'title'    => esc_html__( 'Buy Pixel Ebook Store Pro', 'pixel-ebook-store' ),
			'pro_text' => esc_html__( 'Buy Pro Theme', 'pixel-ebook-store' ),
			'pro_url'    => esc_url( PIXEL_EBOOK_STORE_BUY_NOW ),
		) )	);

		$pixel_ebook_store_manager->add_section( new Pixel_Ebook_Store_Customize_Section_Pro( $pixel_ebook_store_manager, 'pixel_ebook_store_live_demo', array(
		    'priority'   => 1,
		    'title'      => esc_html__( 'Preview Pro Theme', 'pixel-ebook-store' ),
		    'pro_text'   => esc_html__( 'View Live Demo', 'pixel-ebook-store' ),
		    'pro_url'    => esc_url( PIXEL_EBOOK_STORE_LIVE_DEMO ),
		) ) );	
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'pixel-ebook-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'pixel-ebook-store-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}
Pixel_Ebook_Store_Customize_Buttons::Pixel_Ebook_Store_get_instance();