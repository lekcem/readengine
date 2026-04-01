<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if( !class_exists( 'Pixel_Ebook_Store_Welcome' ) ) {

	class Pixel_Ebook_Store_Welcome {
		public $pixel_ebook_store_theme_fields;

		public function __construct( $pixel_ebook_store_fields = array() ) {
			$this->pixel_ebook_store_theme_fields = $pixel_ebook_store_fields;
			add_action ('admin_init' , array( $this, 'admin_scripts' ) );
			add_action('admin_menu', array( $this, 'pixel_ebook_store_themeinfo_page_menu' ));
		}

		public function admin_scripts() {
			global $pagenow;
			$pixel_ebook_store_file_dir = get_template_directory_uri() . '/themeinfo/assets/';

			if ( $pagenow === 'themes.php' && isset($_GET['page']) && $_GET['page'] === 'pixel-ebook-store-themeinfo-page' ) {

				wp_enqueue_style (
					'pixel-ebook-store-themeinfo-page-style',
					$pixel_ebook_store_file_dir . 'pixel_ebook_store_themeinfo_page.css',
					array(), '1.0.0'
				);

				wp_enqueue_script (
					'pixel-ebook-store-themeinfo-page-functions',
					$pixel_ebook_store_file_dir . 'pixel_ebook_store_themeinfo_page.js',
					array('jquery'),
					'1.0.0',
					true
				);
			}
		}

        public function pixel_ebook_store_theme_info($pixel_ebook_store_id, $pixel_ebook_store_screenshot = false) {
            $pixel_ebook_store_themedata = wp_get_theme();
            return ($pixel_ebook_store_screenshot === true) ? esc_url($pixel_ebook_store_themedata->get_screenshot()) : esc_html($pixel_ebook_store_themedata->get($pixel_ebook_store_id));
        }

        public function pixel_ebook_store_themeinfo_page_menu() {
            add_theme_page(
                /* translators: 1: Theme Name. */
                sprintf(esc_html__('%1$s Info', 'pixel-ebook-store'), $this->pixel_ebook_store_theme_info('Name')),
                sprintf(esc_html__('%1$s Info', 'pixel-ebook-store'), $this->pixel_ebook_store_theme_info('Name')),
                'edit_theme_options',
                'pixel-ebook-store-themeinfo-page',
                array( $this, 'pixel_ebook_store_themeinfo_page' )
            );
		}

        public function pixel_ebook_store_themeinfo_page() {
            // Define tabs with proper escaping and prefixes
            $pixel_ebook_store_tabs = array(
                'pixel_ebook_store_home'      => esc_html__('Home', 'pixel-ebook-store'),
                'pixel_ebook_store_free_demo_content'    => esc_html__('Click Here For Free Demo Content', 'pixel-ebook-store'),
                'pixel_ebook_store_free_pro'  => esc_html__('Free VS Pro', 'pixel-ebook-store'),
                'pixel_ebook_store_faqs'      => esc_html__('FAQs', 'pixel-ebook-store'),
                'pixel_ebook_store_support'   => esc_html__('Free Theme Supports', 'pixel-ebook-store'),
                'pixel_ebook_store_review'    => esc_html__('Please Rate Us', 'pixel-ebook-store'),
            );
            ?>
            <div class="wrap about-wrap access-wrap">
        
                <div class="abt-promo-wrap clearfix">
                    <div class="abt-theme-wrap">
                        <h1>
                            <?php
                                printf(
                                    /* translators: 1: Theme Name. */
                                    esc_html__('%1$s - Version %2$s', 'pixel-ebook-store'),
                                    esc_html($this->pixel_ebook_store_theme_info('Name')),
                                    esc_html($this->pixel_ebook_store_theme_info('Version'))
                                );
                            ?>
                        </h1>
                        <div class="doc-links">
                            <h4><?php echo esc_html__('Visit Sites :-', 'pixel-ebook-store'); ?></h4>
                            <a href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUY_NOW); ?>" target="_blank">
                                <span class="dashicons dashicons-admin-site-alt3"></span>
                                <span class="theme-pixel-tooltip"><?php echo esc_html__('View Website', 'pixel-ebook-store'); ?></span>
                            </a>
                            <a href="<?php echo esc_url(PIXEL_EBOOK_STORE_LIVE_DEMO); ?>" target="_blank">
                                <span class="dashicons dashicons-desktop"></span>
                                <span class="theme-pixel-tooltip"><?php echo esc_html__('View Demo Site', 'pixel-ebook-store'); ?></span>
                            </a>
                            <a href="<?php echo esc_url(PIXEL_EBOOK_STORE_THEME_SUPPORT); ?>" target="_blank">
                                <span class="dashicons dashicons-megaphone"></span>
                                <span class="theme-pixel-tooltip"><?php echo esc_html__('Contact Support', 'pixel-ebook-store'); ?></span>
                            </a>
                            <a href="<?php echo esc_url(PIXEL_EBOOK_STORE_FREE_DOC); ?>" target="_blank">
                                <span class="dashicons dashicons-pdf"></span>
                                <span class="theme-pixel-tooltip"><?php echo esc_html__('Documentation', 'pixel-ebook-store'); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
        
                <div class="test">
                    <div class="nav-tab-wrapper clearfix">
                        <?php
                        $tabHTML = '';
        
                        foreach ($pixel_ebook_store_tabs as $pixel_ebook_store_id => $pixel_ebook_store_label) :
        
                            $pixel_ebook_store_target = '';
                            $pixel_ebook_store_nav_class = 'nav-tab';
                            $pixel_ebook_store_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'pixel_ebook_store_home';
        
                            if ($pixel_ebook_store_id === $pixel_ebook_store_section) {
                                $pixel_ebook_store_nav_class .= ' nav-tab-active';
                            }
        
                            if ($pixel_ebook_store_id === 'pixel_ebook_store_free_pro') {
                                $pixel_ebook_store_nav_class .= ' upgrade-button';
                            }

                            if ($pixel_ebook_store_id === 'pixel_ebook_store_review') {
                                $pixel_ebook_store_nav_class .= ' review-button';
                            }

                            if ($pixel_ebook_store_id === 'pixel_ebook_store_free_demo_content') {
                                $pixel_ebook_store_nav_class .= ' demo-content-button';
                            }
        
                            switch ($pixel_ebook_store_id) {
        
                                case 'pixel_ebook_store_support':
                                    $pixel_ebook_store_target = 'target="_blank"';
                                    $pixel_ebook_store_url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->pixel_ebook_store_theme_info('TextDomain')));
                                break;
        
                                case 'pixel_ebook_store_review':
                                    $pixel_ebook_store_target = 'target="_blank"';
                                    $pixel_ebook_store_url = esc_url('https://wordpress.org/support/theme/' . esc_html($this->pixel_ebook_store_theme_info('TextDomain')) . '/reviews/#new-post');
                                break;

                                case 'pixel_ebook_store_home':
                                    $pixel_ebook_store_url = esc_url(admin_url('themes.php?page=pixel-ebook-store-themeinfo-page'));
                                break;
        
                                default:
                                    $pixel_ebook_store_url = esc_url(admin_url('themes.php?page=pixel-ebook-store-themeinfo-page&section=' . esc_attr($pixel_ebook_store_id)));
                                break;
        
                            }
        
                            $tabHTML .= '<a ';
                            $tabHTML .= $pixel_ebook_store_target;
                            $tabHTML .= ' href="' . esc_url($pixel_ebook_store_url) . '"';
                            $tabHTML .= ' class="' . esc_attr($pixel_ebook_store_nav_class) . '"';
                            $tabHTML .= '>';

                            if ($pixel_ebook_store_id === 'pixel_ebook_store_free_demo_content') {
                                $tabHTML .= '<span>' . esc_html($pixel_ebook_store_label) . '</span>';
                            } else {
                                $tabHTML .= esc_html($pixel_ebook_store_label);
                            }

                            if ($pixel_ebook_store_id === 'pixel_ebook_store_review') {
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                                $tabHTML .= ' <span class="dashicons dashicons-star-filled"></span>';
                            }

                            $tabHTML .= '</a>';
        
                        endforeach;
        
                        echo $tabHTML;
                        ?>
        
                        <div class="get-pro">
                            <h3><?php echo esc_html__('Pixel Ebook Store Pro', 'pixel-ebook-store'); ?></h3>
                            <p><?php echo esc_html__('Get all of the features that are infinite!!!', 'pixel-ebook-store'); ?></p>
                            <a class="theme-pixel-button-btn primary-btn" target="_blank" href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUY_NOW); ?>"><?php echo esc_html__('Upgrade To Pro', 'pixel-ebook-store'); ?></a>
                        </div>
                    </div>

                    <div class="second-div">
                        <div class="themeinfo-section-wrapper">
                            <div class="themeinfo-section pixel_ebook_store_home clearfix">
                                <?php
                                $pixel_ebook_store_section = isset($_GET['section']) ? sanitize_text_field($_GET['section']) : 'pixel_ebook_store_home';
                                switch ($pixel_ebook_store_section) {
            
                                    case 'pixel_ebook_store_free_pro':
                                        $this->pixel_ebook_store_free_pro();
                                    break;
            
                                    case 'pixel_ebook_store_faqs':
                                        $this->pixel_ebook_store_faqs();
                                    break;

                                    case 'pixel_ebook_store_free_demo_content':
                                        echo '<h3>' . esc_html__( 'FREE DEMO CONTENT', 'pixel-ebook-store' ) . '</h3>';

                                        echo '<div class="themeinfo-section pixel_ebook_store_free_demo_content clearfix">';
                                        
                                        // include the wizard file
                                        require_once get_template_directory() . '/inc/free-demo-content/free-content.php';
                                        
                                        global $pixel_ebook_store_config;
                                        
                                        if ( class_exists( 'PixelEbookStoreThemeWhizzie' ) ) {
                                            $pixel_ebook_store_wiz = new PixelEbookStoreThemeWhizzie( $pixel_ebook_store_config );
                                        
                                            // NOTE: Only render the wizard UI — NOT header/wrapper/tabs
                                            $pixel_ebook_store_wiz->Pixel_Ebook_Store_Demo_Content_Page();
                                        }
                                        
                                        echo '</div>';
                                        
                                    break;
            
                                    case 'pixel_ebook_store_home':
                                    default:
                                        $this->pixel_ebook_store_home();
                                    break;
            
                                }
                                ?>
                            </div>
                        </div>
            
                        <div class="theme-steps-list">

                            <div class="theme-steps highlight">
                                <h3><?php echo esc_html__('Buy Pixel Ebook Store Pro', 'pixel-ebook-store'); ?></h3>
                                <p><?php echo esc_html__('To get limitless features and improvements, buy the Pixel Ebook Store Theme Pro edition.', 'pixel-ebook-store'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUY_NOW); ?>"><?php echo esc_html__('Buy Pro Theme', 'pixel-ebook-store'); ?></a>
                            </div>

                            <div class="theme-steps">
                                <h3><?php echo esc_html__('Documentation', 'pixel-ebook-store'); ?></h3>
                                <p><?php echo esc_html__('Do you need additional information? You may find detailed instructions on how to use the Pixel Ebook Store Theme in our extensive documentation.', 'pixel-ebook-store'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(PIXEL_EBOOK_STORE_FREE_DOC); ?>"><?php echo esc_html__('Go to Free Docs', 'pixel-ebook-store'); ?></a>
                            </div>
            
                            <div class="theme-steps">
                                <h3><?php echo esc_html__('Preview Pro Theme', 'pixel-ebook-store'); ?></h3>
                                <p><?php echo esc_html__('Explore our Pro Themes full potential! To see the stunning designs and high-end functionality, click the Live Demo button.', 'pixel-ebook-store'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(PIXEL_EBOOK_STORE_LIVE_DEMO); ?>"><?php echo esc_html__('View Live Demo', 'pixel-ebook-store'); ?></a>
                            </div>
            
                            <div class="theme-steps highlight">
                                <h3><?php echo esc_html__('Get the Bundle', 'pixel-ebook-store'); ?></h3>
                                <p><?php echo esc_html__('Introducing the WP Theme Bundle by Theme Pixel, a comprehensive collection of over 50 professionally designed WordPress themes tailored for various niches and businesses.', 'pixel-ebook-store'); ?></p>
                                <a target="_blank" class="button button-primary" href="<?php echo esc_url(PIXEL_EBOOK_STORE_BUNDLE); ?>"><?php echo esc_html__('Get All Themes', 'pixel-ebook-store'); ?></a>
                            </div>
            
                        </div>
                    </div>
                </div>
        
            </div>
            <?php
        }

        public function pixel_ebook_store_home() {
            ?>
            <div class="theme-info-top-wrap clearfix">
                <h3><?php esc_html_e( 'HOME', 'pixel-ebook-store' ); ?></h3>
                <div class="theme-details">
                    <div class="theme-screenshot">
                        <img src="<?php echo esc_url( $this->pixel_ebook_store_theme_info( 'Screenshot', true ) ); ?>" alt="<?php esc_attr_e( 'Theme screenshot', 'pixel-ebook-store' ); ?>" />
                    </div>
                    <div class="about-text"><?php echo esc_html( $this->pixel_ebook_store_theme_info( 'Description' ) ); ?></div>
                    <div class="clearfix"></div>
                </div>
                <div class="theme-pixel-settings">
                    <h2><?php esc_html_e( 'Quick Customizer Settings', 'pixel-ebook-store' ); ?></h2>
                    <div class="theme-pixel-button">
                        <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="theme-pixel-btn" target="_blank">
                            <?php esc_html_e( 'Go To Customizer', 'pixel-ebook-store' ); ?> <span class="dashicons dashicons-arrow-right-alt"></span>
                        </a>
                    </div>
                </div>
                <div class="theme-pixel-card customizer three-col">
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-admin-site-alt3"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Site Identity', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bcontrol%5D=site_identity' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-color-picker"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Color Settings', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=colors' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-screenoptions"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Layout Settings', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=layout_settings' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-format-image"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'General Settings', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=banner_option' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-align-full-width"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Frontpage Settings', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bpanel%5D=general_settings' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="theme-pixel-cardbody">
                        <div class="icon-box">
                            <span class="dashicons dashicons-admin-page"></span>
                        </div>
                        <div class="theme-pixel-text-wrap">
                            <h3 class="theme-pixel-heading"><?php esc_html_e( 'Footer Settings', 'pixel-ebook-store' ); ?></h3>
                            <div class="theme-pixel-button">
                                <a target="_blank" href="<?php echo esc_url( admin_url( 'customize.php?autofocus%5Bsection%5D=footer_option' ) ); ?>" class="theme-pixel-btn">
                                    <?php esc_html_e( 'Customize', 'pixel-ebook-store' ); ?>
                                    <span class="dashicons dashicons-arrow-right-alt"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }        

		public function pixel_ebook_store_free_pro() {
            ?>
            <h3><?php esc_html_e( 'FREE VS PRO', 'pixel-ebook-store' ); ?></h3>
            <div class="freeandpro">
                <table class="card table free-pro" cellspacing="0" cellpadding="0">
                    <tbody class="table-body">
                        <tr class="table-head">
                            <th class="large"><?php echo esc_html__( 'Features', 'pixel-ebook-store' ); ?></th>
                            <th class="indicator"><?php echo esc_html__( 'Free theme', 'pixel-ebook-store' ); ?></th>
                            <th class="indicator"><?php echo esc_html__( 'Pro Theme', 'pixel-ebook-store' ); ?></th>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Responsive Design', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Site Logo upload', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Footer Copyright text', 'pixel-ebook-store' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'Remove the copyright text from the Footer.', 'pixel-ebook-store' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Easy Customization', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Lightweight & Fast Loading', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Global Color', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Regular Bug Fixes', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>
                        
                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Premium Support', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Theme Sections', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="abc"><?php echo esc_html__( '2 Sections', 'pixel-ebook-store' ); ?></span></td>
                            <td class="indicator"><span class="abc"><?php echo esc_html__( '15+ Sections', 'pixel-ebook-store' ); ?></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Custom colors', 'pixel-ebook-store' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'Choose a color for links, buttons, icons and so on.', 'pixel-ebook-store' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Google fonts', 'pixel-ebook-store' ); ?></h4>
                                    <div class="feature-inline-row">
                                        <span class="info-icon dashicon dashicons dashicons-info"></span>
                                        <span class="feature-description">
                                            <?php echo esc_html__( 'You can choose and use over 600 different fonts, for the logo, the menu and the titles.', 'pixel-ebook-store' ); ?>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Compatible with Popular Plugins', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Translation & WPML Ready', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'SEO Optimized', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Premium Support', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Extensive Customization', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'Custom Post Types', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>

                        <tr class="feature-row">
                            <td class="large">
                                <div class="feature-wrap">
                                    <h4><?php echo esc_html__( 'High-Level Compatibility with Modern Browsers', 'pixel-ebook-store' ); ?></h4>
                                </div>
                            </td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-no-alt" size="30"></span></td>
                            <td class="indicator"><span class="dashicon dashicons dashicons-yes" size="30"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
        }

        public function pixel_ebook_store_faqs() {
            ?>
            <h3><?php esc_html_e( 'FAQs', 'pixel-ebook-store' ); ?></h3>
            <div class="faq-container">
                <div class="accordion" id="PixelEbookStoreFaqAccordion">
                    <!-- FAQ 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseOne" aria-expanded="true" aria-controls="PixelEbookStoreCollapseOne">
                                <?php echo esc_html__('What is the difference between Free and Pro?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseOne" class="accordion-collapse collapse show" aria-labelledby="PixelEbookStoreHeadingOne" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('The themes are well-made in both their free and premium versions. But there are a lot more features in the Pro edition.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('You may quickly alter the appearance and feel of your website with the Pro version. You can alter your websites color and typeface with a few clicks. With more customization choices, the premium version gives you greater control over the theme. In addition, the theme offers more layout options and sections than the free version.', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseTwo" aria-expanded="false" aria-controls="PixelEbookStoreCollapseTwo">
                                <?php echo esc_html__('What are the advantages of upgrading to the Premium version?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseTwo" class="accordion-collapse collapse" aria-labelledby="PixelEbookStoreHeadingTwo" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('In addition to the additional features and regular upgrades, the Premium version comes with premium support. Compared to the free assistance, you will receive a much faster response if you encounter any theme problems.', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseThree" aria-expanded="false" aria-controls="PixelEbookStoreCollapseThree">
                                <?php echo esc_html__('Upgrading to the Pro version- will I lose my changes?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseThree" class="accordion-collapse collapse" aria-labelledby="PixelEbookStoreHeadingThree" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('Your posts, pages, media, categories, and other data will all be preserved when you upgrade to the Pro theme.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('You will need to configure the extra features via the customizer, though, because the Pro edition has more features and options. It just takes a few minutes to complete this easy process.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('There is a lot of flexibility in the Pro version to accommodate future updates. As a result, it differs slightly from the free theme yet is incredibly versatile and user-friendly.', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseFour" aria-expanded="false" aria-controls="PixelEbookStoreCollapseFour">
                                <?php echo esc_html__('How do I change the copyright text?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseFour" class="accordion-collapse collapse" aria-labelledby="PixelEbookStoreHeadingFour" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('You can change the copyright text going to Appearance > Customize > Footer Option > And here you can find (Edit Footer Copyright Text)', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseFour" aria-expanded="false" aria-controls="PixelEbookStoreCollapseFour">
                                <?php echo esc_html__('Why is my theme not working well?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseFour" class="accordion-collapse collapse" aria-labelledby="PixelEbookStoreHeadingFour" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('It could be a plugin conflict if your customizer is not loading correctly or if you are experiencing problems with the theme.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Deactivate every plugin first, with the exception of those the theme suggests, to resolve the problem. After that, use "Ctrl+Shift+R" on Windows to force a new page load. Once the problems have been resolved, begin turning on each plugin individually, then refresh and verify your website each time. This will assist you in identifying the problematic plugin.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please get in touch with us if this was not helpful.', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- FAQ 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="PixelEbookStoreHeadingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#PixelEbookStoreCollapseFour" aria-expanded="false" aria-controls="PixelEbookStoreCollapseFour">
                                <?php echo esc_html__('How can I solve my issues quickly and get faster support?', 'pixel-ebook-store'); ?>
                            </button>
                        </h2>
                        <div id="PixelEbookStoreCollapseFour" class="accordion-collapse collapse" aria-labelledby="PixelEbookStoreHeadingFour" data-bs-parent="#PixelEbookStoreFaqAccordion">
                            <div class="accordion-body">
                                <p>
                                    <?php echo esc_html__('Please make sure you have updated the theme to the most recent version before sending us a support ticket for any problems. The theme update may have resolved the issue.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please try to include as much information as you can in your support ticket submission so that we can address your issue more quickly. We advise you to email us one or more screenshots that clearly illustrate the problems and include the URL of your website.', 'pixel-ebook-store'); ?>
                                </p>
                                <p>
                                    <?php echo esc_html__('Please be patient with us as we may have a delayed response time during the weekend.', 'pixel-ebook-store'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        
	}

}
new Pixel_Ebook_Store_Welcome();
?>