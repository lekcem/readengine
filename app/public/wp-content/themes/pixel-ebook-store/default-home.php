<?php
/**
 * Template Name: Default Home Page
 */

get_header();
?>

<main id="primary">

    <?php if (get_theme_mod('pixel_ebook_store_banner_section_on_off_setting', false)) { ?>
        <section id="main-banner-wrap">
            <div class="owl-carousel owl-theme">
                <?php
                    $pixel_ebook_store_banner = get_theme_mod( 'pixel_ebook_store_slider');
                    for ( $i = 1; $i <= $pixel_ebook_store_banner; $i++ ){ ?>
                    <div class="item">
                        <div class="container">
                            <div id="banner-area">
                                <?php
                                    $pixel_ebook_store_banner_heading = get_theme_mod( 'pixel_ebook_store_banner_heading'.$i, '' );
                                    if ( ! empty( $pixel_ebook_store_banner_heading ) ) { ?>
                                    <h3><?php echo esc_html( $pixel_ebook_store_banner_heading ); ?></h3>
                                <?php } ?>
                                <div class="main-banner-inner-box">
                                    <?php
                                        $pixel_ebook_store_banner_image = get_theme_mod( 'pixel_ebook_store_banner_image'.$i, '' );
                                        if ( ! empty( $pixel_ebook_store_banner_image ) ) { ?>
                                        <img src="<?php echo esc_url( $pixel_ebook_store_banner_image ); ?>">
                                    <?php } ?>
                                    <div class="main-banner-content-box">
                                        <?php
                                            $pixel_ebook_store_banner_btn = get_theme_mod( 'pixel_ebook_store_banner_btn'.$i, '' );
                                            $pixel_ebook_store_banner_button_link = get_theme_mod( 'pixel_ebook_store_banner_button_link'.$i, '' );
                                            if ( ! empty( $pixel_ebook_store_banner_btn ) ) { ?>
                                            <a href="<?php echo esc_url( $pixel_ebook_store_banner_button_link ); ?>"><?php echo esc_html( $pixel_ebook_store_banner_btn ); ?></a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }?>
            </div>
        </section>
    <?php } ?>

    <?php if (get_theme_mod('pixel_ebook_store_category_section_on_off_setting', false)) { ?>
        <section id="main-category-wrap" class="my-5">
            <div class="container">
                <?php
                    $pixel_ebook_store_category_heading = get_theme_mod( 'pixel_ebook_store_category_heading', '' );
                    if ( ! empty( $pixel_ebook_store_category_heading ) ) { ?>
                    <h3><?php echo esc_html( $pixel_ebook_store_category_heading ); ?></h3>
                <?php } ?>
                <div class="owl-carousel owl-theme">
                    <?php
                        $pixel_ebook_store_category = get_theme_mod( 'pixel_ebook_store_category_slider');
                        for ( $i = 1; $i <= $pixel_ebook_store_category; $i++ ){ ?>
                        <div class="item">                    
                            <div id="category-area">
                                <div class="main-category-inner-box">
                                    <?php
                                        $pixel_ebook_store_category_image = get_theme_mod( 'pixel_ebook_store_category_image'.$i, '' );
                                        if ( ! empty( $pixel_ebook_store_category_image ) ) { ?>
                                        <img src="<?php echo esc_url( $pixel_ebook_store_category_image ); ?>">
                                    <?php } ?>
                                    <div class="main-category-content-box">
                                        <?php
                                            $pixel_ebook_store_category_box_heading = get_theme_mod( 'pixel_ebook_store_category_box_heading'.$i, '' );
                                            $pixel_ebook_store_category_box_heading_link = get_theme_mod( 'pixel_ebook_store_category_box_heading_link'.$i, '' );
                                            if ( ! empty( $pixel_ebook_store_category_box_heading ) ) { ?>
                                            <h4 class="mb-0"><a href="<?php echo esc_url( $pixel_ebook_store_category_box_heading_link ); ?>"><?php echo esc_html( $pixel_ebook_store_category_box_heading ); ?></a></h4>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }?>
                </div>
            </div>
        </section>
    <?php } ?>

        <section id="main-box-wrap" class="my-5">
            <div class="container">
                <div class="row">
                    <?php if (get_theme_mod('pixel_ebook_store_subscriber_section_on_off_setting', false)) { ?>
                        <div class="col-lg-7 col-md-7 subscriber-box align-self-center">
                            <div class="owl-carousel owl-theme">
                                <?php
                                    $pixel_ebook_store_subscriber = get_theme_mod( 'pixel_ebook_store_subscriber_slider');
                                    for ( $i = 1; $i <= $pixel_ebook_store_subscriber; $i++ ){ ?>
                                    <div class="item">
                                        <div id="subscriber-area">
                                            <div class="main-subscriber-inner-box">
                                                <?php
                                                    $pixel_ebook_store_subscriber_image = get_theme_mod( 'pixel_ebook_store_subscriber_image'.$i, '' );
                                                    if ( ! empty( $pixel_ebook_store_subscriber_image ) ) { ?>
                                                    <img src="<?php echo esc_url( $pixel_ebook_store_subscriber_image ); ?>">
                                                <?php } ?>
                                                <div class="main-subscriber-content-box">
                                                    <?php
                                                        $pixel_ebook_store_subscriber_heading = get_theme_mod( 'pixel_ebook_store_subscriber_heading'.$i, '' );
                                                        if ( ! empty( $pixel_ebook_store_subscriber_heading ) ) { ?>
                                                        <h3><?php echo esc_html( $pixel_ebook_store_subscriber_heading ); ?></h3>
                                                    <?php } ?>
                                                    <?php
                                                        $pixel_ebook_store_subscriber_text = get_theme_mod( 'pixel_ebook_store_subscriber_text'.$i, '' );
                                                        if ( ! empty( $pixel_ebook_store_subscriber_text ) ) { ?>
                                                        <p><?php echo esc_html( $pixel_ebook_store_subscriber_text ); ?></p>
                                                    <?php } ?>
                                                    <?php
                                                        $pixel_ebook_store_subscriber_btn = get_theme_mod( 'pixel_ebook_store_subscriber_btn'.$i, '' );
                                                        $pixel_ebook_store_subscriber_btn_link = get_theme_mod( 'pixel_ebook_store_subscriber_btn_link'.$i, '' );
                                                        if ( ! empty( $pixel_ebook_store_subscriber_btn ) ) { ?>
                                                        <a href="<?php echo esc_url( $pixel_ebook_store_subscriber_btn_link ); ?>"><?php echo esc_html( $pixel_ebook_store_subscriber_btn ); ?></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                    
                    <?php if (get_theme_mod('pixel_ebook_store_variety_section_on_off_setting', false)) { ?>
                        <div class="col-lg-5 col-md-5 variety-box align-self-center">
                            <div class="owl-carousel owl-theme">
                                <?php
                                    $pixel_ebook_store_variety = get_theme_mod( 'pixel_ebook_store_variety_slider');
                                    for ( $i = 1; $i <= $pixel_ebook_store_variety; $i++ ){ ?>
                                    <div class="item">
                                        <div class="main-variety-content-box">
                                            <?php
                                                $pixel_ebook_store_variety_extra_heading = get_theme_mod( 'pixel_ebook_store_variety_extra_heading'.$i, '' );
                                                if ( ! empty( $pixel_ebook_store_variety_extra_heading ) ) { ?>
                                                <h4><?php echo esc_html( $pixel_ebook_store_variety_extra_heading ); ?></h4>
                                            <?php } ?>
                                            <?php
                                                $pixel_ebook_store_variety_heading = get_theme_mod( 'pixel_ebook_store_variety_heading'.$i, '' );
                                                if ( ! empty( $pixel_ebook_store_variety_heading ) ) { ?>
                                                <h3><?php echo esc_html( $pixel_ebook_store_variety_heading ); ?></h3>
                                            <?php } ?>
                                            <?php
                                                $pixel_ebook_store_variety_text = get_theme_mod( 'pixel_ebook_store_variety_text'.$i, '' );
                                                if ( ! empty( $pixel_ebook_store_variety_text ) ) { ?>
                                                <p><?php echo esc_html( $pixel_ebook_store_variety_text ); ?></p>
                                            <?php } ?>
                                            <?php
                                                $pixel_ebook_store_variety_btn = get_theme_mod( 'pixel_ebook_store_variety_btn'.$i, '' );
                                                $pixel_ebook_store_variety_btn_link = get_theme_mod( 'pixel_ebook_store_variety_btn_link'.$i, '' );
                                                if ( ! empty( $pixel_ebook_store_variety_btn ) ) { ?>
                                                <a href="<?php echo esc_url( $pixel_ebook_store_variety_btn_link ); ?>"><?php echo esc_html( $pixel_ebook_store_variety_btn ); ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>

</main>

<?php
get_footer();