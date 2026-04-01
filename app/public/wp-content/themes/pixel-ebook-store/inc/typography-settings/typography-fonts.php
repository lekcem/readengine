<?php
/**
 * Particular Typography function for this theme
 *
 * Some of this functionality may eventually be superseded by essential features.
 *
 * @package Pixel Ebook Store
 */

 function pixel_ebook_store_get_all_google_fonts() {
    $pixel_ebook_store_webfonts_json = get_template_directory() . '/inc/typography-settings/google-webfonts.json';
    if ( ! file_exists( $pixel_ebook_store_webfonts_json ) ) {
        return array();
    }

    $pixel_ebook_store_fonts_json_data = file_get_contents( $pixel_ebook_store_webfonts_json );
    if ( false === $pixel_ebook_store_fonts_json_data ) {
        return array();
    }

    $pixel_ebook_store_all_fonts = json_decode( $pixel_ebook_store_fonts_json_data, true );
    if ( json_last_error() !== JSON_ERROR_NONE ) {
        return array();
    }

    $pixel_ebook_store_google_fonts = array();
    foreach ( $pixel_ebook_store_all_fonts as $pixel_ebook_store_font ) {
        $pixel_ebook_store_google_fonts[ $pixel_ebook_store_font['family'] ] = array(
            'family'   => $pixel_ebook_store_font['family'],
            'variants' => $pixel_ebook_store_font['variants'],
        );
    }
    return $pixel_ebook_store_google_fonts;
}

function pixel_ebook_store_get_all_google_font_families() {
    $pixel_ebook_store_google_fonts  = pixel_ebook_store_get_all_google_fonts();
    $pixel_ebook_store_font_families = array(
        '' => esc_html__( 'Default (Theme Font Family)', 'pixel-ebook-store' ),
    );

    foreach ( $pixel_ebook_store_google_fonts as $pixel_ebook_store_font ) {
        $pixel_ebook_store_font_families[ $pixel_ebook_store_font['family'] ] = $pixel_ebook_store_font['family'];
    }

    return $pixel_ebook_store_font_families;
}

function pixel_ebook_store_get_fonts_url() {
    $pixel_ebook_store_fonts_url = '';
    $pixel_ebook_store_all_fonts = pixel_ebook_store_get_all_google_fonts();
    $pixel_ebook_store_selected_fonts = array();

    $font_body    = get_theme_mod( 'pixel_ebook_store_global_font_setting', '' );
    $font_heading = get_theme_mod( 'pixel_ebook_store_global_font_settingone', '' );

    if ( ! empty( $font_body ) && isset( $pixel_ebook_store_all_fonts[ $font_body ] ) ) {
        $variants = $pixel_ebook_store_all_fonts[ $font_body ]['variants'];
        $pixel_ebook_store_selected_fonts[] = $font_body . ':' . implode( ',', $variants );
    }

    if ( ! empty( $font_heading ) && isset( $pixel_ebook_store_all_fonts[ $font_heading ] ) && $font_heading !== $font_body ) {
        $variants = $pixel_ebook_store_all_fonts[ $font_heading ]['variants'];
        $pixel_ebook_store_selected_fonts[] = $font_heading . ':' . implode( ',', $variants );
    }

    if ( ! empty( $pixel_ebook_store_selected_fonts ) ) {
        $query_args = array(
            'family' => urlencode( implode( '|', $pixel_ebook_store_selected_fonts ) ),
        );
        $pixel_ebook_store_fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return $pixel_ebook_store_fonts_url;
}

function pixel_ebook_store_sanitize_google_fonts( $pixel_ebook_store_input, $pixel_ebook_store_setting ) {
    $pixel_ebook_store_choices = $pixel_ebook_store_setting->manager->get_control( $pixel_ebook_store_setting->id )->choices;
    return ( array_key_exists( $pixel_ebook_store_input, $pixel_ebook_store_choices ) ? $pixel_ebook_store_input : $pixel_ebook_store_setting->default );
}

function pixel_ebook_store_dynamic_css() {
    $pixel_ebook_store_color         = get_theme_mod( 'pixel_ebook_store_global_color', '#f3c432' );
    $pixel_ebook_store_font_body     = get_theme_mod( 'pixel_ebook_store_global_font_setting', '' );
    $pixel_ebook_store_font_heading  = get_theme_mod( 'pixel_ebook_store_global_font_settingone', '' );

    // Enqueue Google Fonts if needed
    $pixel_ebook_store_fonts_url = pixel_ebook_store_get_fonts_url();
    if ( ! empty( $pixel_ebook_store_fonts_url ) ) {
        wp_enqueue_style( 'pixel-ebook-store-google-fonts', esc_url( $pixel_ebook_store_fonts_url ), array(), null );
    }

    // Build CSS variables
    $pixel_ebook_store_custom_css  = ':root {';
    $pixel_ebook_store_custom_css .= '--global-color: ' . esc_attr( $pixel_ebook_store_color ) . ';';

    if ( ! empty( $pixel_ebook_store_font_body ) ) {
        $pixel_ebook_store_custom_css .= '--global-font-family: "' . esc_attr( $pixel_ebook_store_font_body ) . '", sans-serif !important;';
    }

    if ( ! empty( $pixel_ebook_store_font_heading ) ) {
        $pixel_ebook_store_custom_css .= '--global-font-familyone: "' . esc_attr( $pixel_ebook_store_font_heading ) . '", sans-serif !important;';
    }

    $pixel_ebook_store_custom_css .= '}';

    wp_add_inline_style( 'pixel-ebook-store-style', $pixel_ebook_store_custom_css );
}
add_action( 'wp_enqueue_scripts', 'pixel_ebook_store_dynamic_css', 99 );