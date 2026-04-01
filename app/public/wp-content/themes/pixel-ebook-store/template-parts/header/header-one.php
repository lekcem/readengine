<div class="header-row-area">
	<div class="container">
		
	</div>
</div>

<div class="header-main-area py-2">
	<?php get_template_part( 'template-parts/site', 'branding' ); ?>

	<div class="header-slot-1 my-4">
		<?php
            $pixel_ebook_store_sidebar_slot_heading = get_theme_mod( 'pixel_ebook_store_sidebar_slot_heading', 'News Feed' );
            if ( ! empty( $pixel_ebook_store_sidebar_slot_heading ) ) { ?>
            <h3><?php echo esc_html( $pixel_ebook_store_sidebar_slot_heading ); ?></h3>
        <?php } ?>
        <div class="header-slot-menu">
			<?php
			    $pixel_ebook_store_slot_btn1 = get_theme_mod( 'pixel_ebook_store_slot_btn1', 'Browse' );
			    $pixel_ebook_store_slot_btn1_url = get_theme_mod( 'pixel_ebook_store_slot_btn1_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot_btn1 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot_btn1_url ); ?>"> <i class="fas fa-life-ring me-2"></i><?php echo esc_html( $pixel_ebook_store_slot_btn1 ); ?></a>
		    <?php } ?>
		    <?php
			    $pixel_ebook_store_slot_btn2 = get_theme_mod( 'pixel_ebook_store_slot_btn2', 'Wish List' );
			    $pixel_ebook_store_slot_btn2_url = get_theme_mod( 'pixel_ebook_store_slot_btn2_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot_btn2 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot_btn2_url ); ?>"><i class="fas fa-heart me-2"></i><?php echo esc_html( $pixel_ebook_store_slot_btn2 ); ?></a>
		    <?php } ?>
		    <?php
			    $pixel_ebook_store_slot_btn3 = get_theme_mod( 'pixel_ebook_store_slot_btn3', 'Renting' );
			    $pixel_ebook_store_slot_btn3_url = get_theme_mod( 'pixel_ebook_store_slot_btn3_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot_btn3 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot_btn3_url ); ?>"><i class="fas fa-calendar-alt me-2"></i><?php echo esc_html( $pixel_ebook_store_slot_btn3 ); ?></a>
		    <?php } ?>
		</div>
	</div>

	<div class="header-slot-2 my-4">
		<?php
            $pixel_ebook_store_sidebar_slot2_heading = get_theme_mod( 'pixel_ebook_store_sidebar_slot2_heading', 'Following' );
            if ( ! empty( $pixel_ebook_store_sidebar_slot2_heading ) ) { ?>
            <h3><?php echo esc_html( $pixel_ebook_store_sidebar_slot2_heading ); ?></h3>
        <?php } ?>
        <div class="header-slot-menu">
			<?php
            $pixel_ebook_store_author = get_theme_mod( 'pixel_ebook_store_author','1');
            for ( $i = 1; $i <= $pixel_ebook_store_author; $i++ ){ ?>
                <div class="author-box mb-2">
                    <?php
                        $pixel_ebook_store_author_image = get_theme_mod( 'pixel_ebook_store_author_image'.$i, get_template_directory_uri() . '/assets/images/author1.png' );
                        if ( ! empty( $pixel_ebook_store_author_image ) ) { ?>
                        <img src="<?php echo esc_url( $pixel_ebook_store_author_image ); ?>">
                    <?php } ?>
                    <?php
                        $pixel_ebook_store_author_btn = get_theme_mod( 'pixel_ebook_store_author_btn'.$i, 'Ann Chovey' );
                        $pixel_ebook_store_author_button_link = get_theme_mod( 'pixel_ebook_store_author_button_link'.$i, '#' );
                        if ( ! empty( $pixel_ebook_store_author_btn ) ) { ?>
                        <a href="<?php echo esc_url( $pixel_ebook_store_author_button_link ); ?>"><?php echo esc_html( $pixel_ebook_store_author_btn ); ?></a>
                    <?php } ?>
       	 		</div>
            <?php }?>
		</div>
	</div>

	<div class="header-slot-3 my-4">
		<?php
            $pixel_ebook_store_sidebar_slot3_heading = get_theme_mod( 'pixel_ebook_store_sidebar_slot3_heading', 'Quick Links' );
            if ( ! empty( $pixel_ebook_store_sidebar_slot3_heading ) ) { ?>
            <h3><?php echo esc_html( $pixel_ebook_store_sidebar_slot3_heading ); ?></h3>
        <?php } ?>
        <div class="header-slot-menu">
			<?php
			    $pixel_ebook_store_slot3_btn1 = get_theme_mod( 'pixel_ebook_store_slot3_btn1', 'Coming Soon' );
			    $pixel_ebook_store_slot3_btn1_url = get_theme_mod( 'pixel_ebook_store_slot3_btn1_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot3_btn1 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot3_btn1_url ); ?>"> <i class="fas fa-video me-2"></i><?php echo esc_html( $pixel_ebook_store_slot3_btn1 ); ?></a>
		    <?php } ?>
		    <?php
			    $pixel_ebook_store_slot3_btn2 = get_theme_mod( 'pixel_ebook_store_slot3_btn2', 'Useful Links' );
			    $pixel_ebook_store_slot3_btn2_url = get_theme_mod( 'pixel_ebook_store_slot3_btn2_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot3_btn2 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot3_btn2_url ); ?>"><i class="fas fa-camera me-2"></i><?php echo esc_html( $pixel_ebook_store_slot3_btn2 ); ?></a>
		    <?php } ?>
		    <?php
			    $pixel_ebook_store_slot3_btn3 = get_theme_mod( 'pixel_ebook_store_slot3_btn3', 'Privacy Policy' );
			    $pixel_ebook_store_slot3_btn3_url = get_theme_mod( 'pixel_ebook_store_slot3_btn3_url', '#' );
			?>
		    <?php if ( ! empty( $pixel_ebook_store_slot3_btn3 ) ) { ?>
		        <a href="<?php echo esc_url( $pixel_ebook_store_slot3_btn3_url ); ?>"><i class="fas fa-photo-video me-2"></i><?php echo esc_html( $pixel_ebook_store_slot3_btn3 ); ?></a>
		    <?php } ?>
		</div>
	</div>

	<div class="header-slot-4 my-4">
		<?php
            $pixel_ebook_store_sidebar_account = get_theme_mod( 'pixel_ebook_store_sidebar_account', 'Logout' );
            $pixel_ebook_store_sidebar_account_link = get_theme_mod( 'pixel_ebook_store_sidebar_account_link', '#' );
            if ( ! empty( $pixel_ebook_store_sidebar_account ) ) { ?>
            <a href="<?php echo esc_url( $pixel_ebook_store_sidebar_account_link ); ?>"><i class="fas fa-power-off me-2"></i><?php echo esc_html( $pixel_ebook_store_sidebar_account ); ?></a>
        <?php } ?>
    </div>
</div>