<?php
/**
 * @package Free Demo Content
 * @since 1.0.0
 */

class PixelEbookStoreThemeWhizzie {

	protected $version = '1.1.0';

	/** @var string Current theme name, used as namespace in actions. */
	protected $pixel_ebook_store_theme_name = '';
	protected $pixel_ebook_store_theme_title = '';

	/** @var string Free Demo Content page slug and title. */
	protected $pixel_ebook_store_page_slug = '';
	protected $pixel_ebook_store_page_title = '';

	/** @var array Free Demo Content steps set by user. */
	protected $pixel_ebook_store_config_steps = array();

	/**
	 * Relative plugin url for this plugin folder
	 * @since 1.0.0
	 * @var string
	*/
	protected $pixel_ebook_store_plugin_url = '';
	protected $pixel_ebook_store_plugin_path = '';
	public $pixel_ebook_store_parent_slug;
	/**
	 * TGMPA instance storage
	 *
	 * @var object
	*/
	protected $pixel_ebook_store_tgmpa_instance;

	/**
	 * TGMPA Menu slug
	 *
	 * @var string
	*/
	protected $pixel_ebook_store_tgmpa_menu_slug = 'tgmpa-install-plugins';

	/**
	 * TGMPA Menu url
	 *
	 * @var string
	*/
	protected $pixel_ebook_store_tgmpa_url = 'themes.php?page=tgmpa-install-plugins';
	/**
	 * Constructor
	 *
	 * @param $pixel_ebook_store_config	Our config parameters
	*/
	public function __construct( $pixel_ebook_store_config ) {
		$this->set_vars( $pixel_ebook_store_config );
		$this->init();

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	/**
	 * Set some settings
	 * @since 1.0.0
	 * @param $pixel_ebook_store_config	Our config parameters
	*/
	public function set_vars( $pixel_ebook_store_config ) {

		require_once trailingslashit( WHIZZIE_DIR ) . 'tgm/tgm.php';

		if( isset( $pixel_ebook_store_config['pixel_ebook_store_page_slug'] ) ) {
			$this->pixel_ebook_store_page_slug = esc_attr( $pixel_ebook_store_config['pixel_ebook_store_page_slug'] );
		}
		if( isset( $pixel_ebook_store_config['pixel_ebook_store_page_title'] ) ) {
			$this->pixel_ebook_store_page_title = esc_attr( $pixel_ebook_store_config['pixel_ebook_store_page_title'] );
		}
		if( isset( $pixel_ebook_store_config['steps'] ) ) {
			$this->pixel_ebook_store_config_steps = $pixel_ebook_store_config['steps'];
		}

		$this->pixel_ebook_store_plugin_path = trailingslashit( dirname( __FILE__ ) );
		$relative_url = str_replace( get_template_directory(), '', $this->pixel_ebook_store_plugin_path );
		$this->pixel_ebook_store_plugin_url = trailingslashit( get_template_directory_uri() . $relative_url );
		$current_theme = wp_get_theme();
		$this->pixel_ebook_store_theme_title = $current_theme->get( 'Name' );
		$this->pixel_ebook_store_theme_name = strtolower( preg_replace( '#[^a-zA-Z]#', '', $current_theme->get( 'Name' ) ) );
		$this->pixel_ebook_store_page_slug = apply_filters( $this->pixel_ebook_store_theme_name . '_theme_setup_wizard_pixel_ebook_store_page_slug', $this->pixel_ebook_store_theme_name . '-freedemocontent' );
		$this->pixel_ebook_store_parent_slug = apply_filters( $this->pixel_ebook_store_theme_name . '_theme_setup_wizard_parent_slug', '' );
	}

	/**
	 * Hooks and filters
	 * @since 1.0.0
	*/
	public function init() {

		if ( class_exists( 'TGM_Plugin_Activation' ) && isset( $GLOBALS['tgmpa'] ) ) {
			add_action( 'init', array( $this, 'get_tgmpa_instance' ), 30 );
			add_action( 'init', array( $this, 'set_tgmpa_url' ), 40 );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		// add_action( 'admin_menu', array( $this, 'menu_page' ) );
		add_action( 'admin_init', array( $this, 'get_plugins' ), 30 );
		add_filter( 'tgmpa_load', array( $this, 'tgmpa_load' ), 10, 1 );
		add_action( 'wp_ajax_setup_plugins', array( $this, 'setup_plugins' ) );
		add_action( 'wp_ajax_setup_widgets', array( $this, 'setup_widgets' ) );
	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'pixel-ebook-store-free-demo-content-style', get_template_directory_uri() . '/inc/free-demo-content/css-and-js/free-demo-content-style.css');
		wp_register_script( 'pixel-ebook-store-free-demo-content-script', get_template_directory_uri() . '/inc/free-demo-content/css-and-js/free-demo-content-script.js', array( 'jquery' ), time() );
		wp_localize_script(
			'pixel-ebook-store-free-demo-content-script',
			'pixel_ebook_store_whizzie_params',
			array(
				'ajaxurl' 		=> admin_url( 'admin-ajax.php' ),
				'wpnonce' 		=> wp_create_nonce( 'whizzie_nonce' ),
				'verify_text'	=> esc_html( 'verifying', 'pixel-ebook-store' )
			)
		);
		wp_enqueue_script( 'pixel-ebook-store-free-demo-content-script' );
	}

	public function tgmpa_load( $status ) {
		return is_admin() || current_user_can( 'install_themes' );
	}

	/**
	 * Get configured TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	*/
	public function get_tgmpa_instance() {
		$this->pixel_ebook_store_tgmpa_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
	}

	/**
	 * Update $pixel_ebook_store_tgmpa_menu_slug and $tgmpa_parent_slug from TGMPA instance
	 *
	 * @access public
	 * @since 1.1.2
	*/
	public function set_tgmpa_url() {
		$this->pixel_ebook_store_tgmpa_menu_slug = ( property_exists( $this->pixel_ebook_store_tgmpa_instance, 'menu' ) ) ? $this->pixel_ebook_store_tgmpa_instance->menu : $this->pixel_ebook_store_tgmpa_menu_slug;
		$this->pixel_ebook_store_tgmpa_menu_slug = apply_filters( $this->pixel_ebook_store_theme_name . '_theme_setup_wizard_tgmpa_menu_slug', $this->pixel_ebook_store_tgmpa_menu_slug );
		$tgmpa_parent_slug = ( property_exists( $this->pixel_ebook_store_tgmpa_instance, 'pixel_ebook_store_parent_slug' ) && $this->pixel_ebook_store_tgmpa_instance->pixel_ebook_store_parent_slug !== 'themes.php' ) ? 'admin.php' : 'themes.php';
		$this->pixel_ebook_store_tgmpa_url = apply_filters( $this->pixel_ebook_store_theme_name . '_theme_setup_wizard_tgmpa_url', $tgmpa_parent_slug . '?page=' . $this->pixel_ebook_store_tgmpa_menu_slug );
	}


	/**  Make a modal screen for the wizard **/
	// public function menu_page() {
	// 	add_theme_page( esc_html( $this->pixel_ebook_store_page_title ), esc_html( $this->pixel_ebook_store_page_title ), 'manage_options', $this->pixel_ebook_store_page_slug, array( $this, 'pixel_ebook_store_guide' ) );
	// }

	/*** Make an interface for the wizard ***/
	public function Pixel_Ebook_Store_Demo_Content_Page() {

		tgmpa_load_bulk_installer();

		// install plugins with TGM.
		if ( ! class_exists( 'TGM_Plugin_Activation' ) || ! isset( $GLOBALS['tgmpa'] ) ) {
			die( 'Failed to find TGM' );
		}
		$pixel_ebook_store_url = wp_nonce_url( add_query_arg( array( 'plugins' => 'go' ) ), 'whizzie-setup' );

		// copied from TGM
		$pixel_ebook_store_method = ''; // Leave blank so WP_Filesystem can populate it as necessary.
		$pixel_ebook_store_fields = array_keys( $_POST ); // Extra fields to pass to WP_Filesystem.
		if ( false === ( $creds = request_filesystem_credentials( esc_url_raw( $pixel_ebook_store_url ), $pixel_ebook_store_method, false, false, $pixel_ebook_store_fields ) ) ) {
			return true; // Stop the normal page form from displaying, credential request form will be shown.
		}
		// Now we have some credentials, setup WP_Filesystem.
		if ( ! WP_Filesystem( $creds ) ) {
			// Our credentials were no good, ask the user for them again.
			request_filesystem_credentials( esc_url_raw( $pixel_ebook_store_url ), $pixel_ebook_store_method, true, false, $pixel_ebook_store_fields );
			return true;
		}

		/* If we arrive here, we have the filesystem */ ?>
		<div class="wrap">
			<?php echo '<div class="whizzie-wrap">';
				// The wizard is a list with only one item visible at a time
				$pixel_ebook_store_steps = $this->get_steps();
				echo '<div class="abcd">';

					echo '<ul class="whizzie-nav wizard-icon-nav nav-tab-wrapper clearfix">';?>

					<?php
						$pixel_ebook_store_stepI=1;
						foreach( $pixel_ebook_store_steps as $pixel_ebook_store_step ) {
							$pixel_ebook_store_stepAct=($pixel_ebook_store_stepI ==1)? 1 : 0;
							if( isset( $pixel_ebook_store_step['icon_text'] ) && $pixel_ebook_store_step['icon_text'] ) {
								echo '<li class="commom-cls nav-step-' . esc_attr( $pixel_ebook_store_step['id'] ) . '" wizard-steps="step-'.esc_attr( $pixel_ebook_store_step['id'] ).'" data-enable="'.$pixel_ebook_store_stepAct.'">
								<a class="nav-tab upgrade-button">'.esc_attr( $pixel_ebook_store_step['icon_text'] ).'</a>
								</li>';
							}
						$pixel_ebook_store_stepI++;}

					echo '</ul>';
			 	echo '</div>';

				echo '<div class="second-div">';
					echo '<ul class="whizzie-menu wizard-menu-page theme-details">';
					foreach( $pixel_ebook_store_steps as $pixel_ebook_store_step ) {
						$pixel_ebook_store_class = 'step step-' . esc_attr( $pixel_ebook_store_step['id'] );
						echo '<li data-step="' . esc_attr( $pixel_ebook_store_step['id'] ) . '" class="' . esc_attr( $pixel_ebook_store_class ) . '" >';

							$pixel_ebook_store_content = call_user_func( array( $this, $pixel_ebook_store_step['view'] ) );
							if( isset( $pixel_ebook_store_content['summary'] ) ) {
								printf(
									'<div class="summary">%s</div>',
									wp_kses_post( $pixel_ebook_store_content['summary'] )
								);
							}
							if( isset( $pixel_ebook_store_content['detail'] ) ) {
								// Add a link to see more detail
								printf( '<div class="wz-require-plugins">');
								printf(
									'<div class="detail">%s</div>',
									$pixel_ebook_store_content['detail'] // Need to escape this
								);
								printf('</div>');
							}
							printf('<div class="wizard-button-wrapper">');
								// The next button
								if( isset( $pixel_ebook_store_step['button_text'] ) && $pixel_ebook_store_step['button_text'] ) {
									printf(
										'<div class="button-wrap"><a href="#" class="button button-primary do-it" data-callback="%s" data-step="%s">%s</a></div>',
										esc_attr( $pixel_ebook_store_step['callback'] ),
										esc_attr( $pixel_ebook_store_step['id'] ),
										esc_html( $pixel_ebook_store_step['button_text'] )
									);
								}

								if( isset( $pixel_ebook_store_step['button_text_one'] )) {
									printf(
										'<div class="button-wrap button-wrap-one">
											<a href="#" class="button button-primary do-it" data-callback="install_widgets" data-step="widgets"><p class="demo-type-text">%s</p></a>
										</div>',
										esc_html( $pixel_ebook_store_step['button_text_one'] )
									);
								}
							printf('</div>');
						echo '</li>';
					}
					echo '</ul>';

				echo '</div>';
				?>
			<?php echo '</div>';?>
		</div>
	<?php }

	/**
	 * Set options for the steps
	 * @return Array
	*/
	public function get_steps() {
		$pixel_ebook_store_dev_steps = $this->pixel_ebook_store_config_steps;
		$pixel_ebook_store_steps = array(
			'plugins' => array(
				'id'			=> 'plugins',
				'title'			=> __( 'Plugins', 'pixel-ebook-store' ),
				'icon'			=> 'admin-plugins',
				'view'			=> 'get_step_plugins',
				'callback'		=> 'install_plugins',
				'button_text'	=> __( 'Install Plugins', 'pixel-ebook-store' ),
				'can_skip'		=> true,
				'icon_text'      => 'Plugins'
			),
			'widgets' => array(
				'id'			=> 'widgets',
				'title'			=> __( 'Customizer', 'pixel-ebook-store' ),
				'icon'			=> 'welcome-widgets-menus',
				'view'			=> 'get_step_widgets',
				'callback'		=> 'install_widgets',
				'button_text_one'	=> __( 'Import Demo Content', 'pixel-ebook-store' ),

				'can_skip'		=> true,
				'icon_text'      => 'Import Demo Content'
			),
			'done' => array(
				'id'			=> 'done',
				'title'			=> __( 'All Done', 'pixel-ebook-store' ),
				'icon'			=> 'yes',
				'view'			=> 'get_step_done',
				'callback'		=> '',
				'icon_text'      => 'Done'
			)
		);

		// Iterate through each step and replace with dev config values
		if( $pixel_ebook_store_dev_steps ) {
			// Configurable elements - these are the only ones the dev can update from config.php
			$can_config = array( 'title', 'icon', 'button_text', 'can_skip' );
			foreach( $pixel_ebook_store_dev_steps as $dev_step ) {
				// We can only proceed if an ID exists and matches one of our IDs
				if( isset( $dev_step['id'] ) ) {
					$id = $dev_step['id'];
					if( isset( $pixel_ebook_store_steps[$id] ) ) {
						foreach( $can_config as $element ) {
							if( isset( $dev_step[$element] ) ) {
								$pixel_ebook_store_steps[$id][$element] = $dev_step[$element];
							}
						}
					}
				}
			}
		}
		return $pixel_ebook_store_steps;
	}

	/*** Print the content for the intro step ***/
		public function get_step_importer() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('Thank you for choosing this Pixel Ebook Store Theme. Using this quick setup wizard, you will be able to configure your new website and get it running in just a few minutes. Just follow these simple steps mentioned in the wizard and get started with your website.','pixel-ebook-store'); ?>
			</p>
		</div>
	<?php }

	/**
	 * Get the content for the plugins step
	 * @return $pixel_ebook_store_content Array
	*/
	public function get_step_plugins() {
		$plugins = $this->get_plugins();
		$pixel_ebook_store_content = array(); ?>
			<div class="summary">
				<p>
					<?php esc_html_e('Install Recommended Plugins:	','pixel-ebook-store') ?>
				</p>
			</div>
		<?php // The detail element is initially hidden from the user
		$pixel_ebook_store_content['detail'] = '<span class="wizard-plugin-count">'.count($plugins['all']).'</span><ul class="whizzie-do-plugins">';
		// Add each plugin into a list
		foreach( $plugins['all'] as $slug=>$plugin ) {
			$pixel_ebook_store_content['detail'] .= '<li data-slug="' . esc_attr( $slug ) . '">' . esc_html( $plugin['name'] ) . '<div class="wizard-plugin-title">';

			$pixel_ebook_store_content['detail'] .= '<span class="wizard-plugin-status">Installation Required</span><i class="spinner"></i></div></li>';
		}
		$pixel_ebook_store_content['detail'] .= '</ul>';

		return $pixel_ebook_store_content;
	}

	/**    Print the content for the intro step     **/
	public function get_step_widgets() { ?>
		<div class="summary">
			<p>
				<?php esc_html_e('This theme allows you to Import Demo Content content and add widgets. Install them using the button below. You can also update or deactivate them using the Customizer.','pixel-ebook-store'); ?>
			</p>
		</div>
	<?php }

	/***  Print the content for the final step  ***/
	public function get_step_done() { ?>

		<div class="setup-finish">
			<p>
				<?php echo esc_html('Your demo content has been imported successfully. Click the finish button for more information.'); ?>
			</p>
			<div class="finish-buttons">
				<a href="<?php echo esc_url( admin_url( 'themes.php?page=pixel-ebook-store-themeinfo-page' ) ); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Pixel Ebook Store Info','pixel-ebook-store') ?></a>
				<a href="<?php echo esc_url(admin_url('/customize.php')); ?>" class="wz-btn-customizer" target="_blank"><?php esc_html_e('Customizer Settings','pixel-ebook-store') ?></a>
				<a href="" class="wz-btn-builder" target="_blank"><?php esc_html_e('Customize Your Demo','pixel-ebook-store'); ?></a>
				<a href="<?php echo esc_url(home_url()); ?>" class="wz-btn-visit-site" target="_blank"><?php esc_html_e('Visit Your Site','pixel-ebook-store'); ?></a>
			</div>
			<div class="finish-buttons">
				<a href="<?php echo esc_url(admin_url()); ?>" class="button button-primary"><?php esc_html_e('Finish','pixel-ebook-store'); ?></a>
			</div>
		</div>

	<?php }

	/***  Get the plugins registered with TGMPA  ***/
	public function get_plugins() {
		$instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );
		$plugins = array(
			'all' 		=> array(),
			'install'	=> array(),
			'update'	=> array(),
			'activate'	=> array()
		);
		foreach( $instance->plugins as $slug=>$plugin ) {
			if( $instance->is_plugin_active( $slug ) && false === $instance->does_plugin_have_update( $slug ) ) {
				// Plugin is installed and up to date
				continue;
			} else {
				$plugins['all'][$slug] = $plugin;
				if( ! $instance->is_plugin_installed( $slug ) ) {
					$plugins['install'][$slug] = $plugin;
				} else {
					if( false !== $instance->does_plugin_have_update( $slug ) ) {
						$plugins['update'][$slug] = $plugin;
					}
					if( $instance->can_plugin_activate( $slug ) ) {
						$plugins['activate'][$slug] = $plugin;
					}
				}
			}
		}
		return $plugins;
	}

	public function setup_plugins() {
		if ( ! check_ajax_referer( 'whizzie_nonce', 'wpnonce' ) || empty( $_POST['slug'] ) ) {
			wp_send_json_error( array( 'error' => 1, 'message' => esc_html__( 'No Slug Found','pixel-ebook-store' ) ) );
		}
		$json = array();
		// send back some json we use to hit up TGM
		$plugins = $this->get_plugins();

		// what are we doing with this plugin?
		foreach ( $plugins['activate'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->pixel_ebook_store_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->pixel_ebook_store_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-activate',
					'action2'       => - 1,
					'message'       => esc_html__( 'Activating Plugin','pixel-ebook-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['update'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->pixel_ebook_store_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->pixel_ebook_store_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-update',
					'action2'       => - 1,
					'message'       => esc_html__( 'Updating Plugin','pixel-ebook-store' ),
				);
				break;
			}
		}
		foreach ( $plugins['install'] as $slug => $plugin ) {
			if ( $_POST['slug'] == $slug ) {
				$json = array(
					'url'           => admin_url( $this->pixel_ebook_store_tgmpa_url ),
					'plugin'        => array( $slug ),
					'tgmpa-page'    => $this->pixel_ebook_store_tgmpa_menu_slug,
					'plugin_status' => 'all',
					'_wpnonce'      => wp_create_nonce( 'bulk-plugins' ),
					'action'        => 'tgmpa-bulk-install',
					'action2'       => - 1,
					'message'       => esc_html__( 'Installing Plugin','pixel-ebook-store' ),
				);
				break;
			}
		}
		if ( $json ) {
			$json['hash'] = md5( serialize( $json ) ); // used for checking if duplicates happen, move to next plugin
			wp_send_json( $json );
		} else {
			wp_send_json( array( 'done' => 1, 'message' => esc_html__( 'Success','pixel-ebook-store' ) ) );
		}
		exit;
	}


	//. - . - . - . - . - . - . - . - . - . - . - . - . MENUS . - . - . - . - . - . - . - . - . - . - . - . - .//
	
	public function Pixel_Ebook_Store_Customizer_Header_Menu() {
		// ------- Create Primary Menu --------
		$pixel_ebook_store_themename = 'Pixel Ebook Store'; // Ensure the theme name is set
		$pixel_ebook_store_menuname = $pixel_ebook_store_themename . ' Primary Menu';
		$pixel_ebook_store_menulocation = 'menu-1';
		$pixel_ebook_store_menu_exists = wp_get_nav_menu_object($pixel_ebook_store_menuname);

		if (!$pixel_ebook_store_menu_exists) {
			$pixel_ebook_store_menu_id = wp_create_nav_menu($pixel_ebook_store_menuname);

			// Home
			wp_update_nav_menu_item($pixel_ebook_store_menu_id, 0, array(
				'menu-item-title' => __('Home', 'pixel-ebook-store'),
				'menu-item-classes' => 'home',
				'menu-item-url' => home_url('/'),
				'menu-item-status' => 'publish'
			));

			// About
			$pixel_ebook_store_page_about = get_page_by_path('about');
			if($pixel_ebook_store_page_about){
				wp_update_nav_menu_item($pixel_ebook_store_menu_id, 0, array(
					'menu-item-title' => __('About', 'pixel-ebook-store'),
					'menu-item-classes' => 'about',
					'menu-item-url' => get_permalink($pixel_ebook_store_page_about),
					'menu-item-status' => 'publish'
				));
			}

			// Page
			$pixel_ebook_store_page_Page = get_page_by_path('Page');
			if($pixel_ebook_store_page_Page){
				wp_update_nav_menu_item($pixel_ebook_store_menu_id, 0, array(
					'menu-item-title' => __('Page', 'pixel-ebook-store'),
					'menu-item-classes' => 'Page',
					'menu-item-url' => get_permalink($pixel_ebook_store_page_Page),
					'menu-item-status' => 'publish'
				));
			}

			// Blog
			$pixel_ebook_store_page_blog = get_page_by_path('blog');
			if($pixel_ebook_store_page_blog){
				wp_update_nav_menu_item($pixel_ebook_store_menu_id, 0, array(
					'menu-item-title' => __('Blog', 'pixel-ebook-store'),
					'menu-item-classes' => 'blog',
					'menu-item-url' => get_permalink($pixel_ebook_store_page_blog),
					'menu-item-status' => 'publish'
				));
			}

			// Contact Us
			$pixel_ebook_store_page_contact = get_page_by_path('contact');
			if($pixel_ebook_store_page_contact){
				wp_update_nav_menu_item($pixel_ebook_store_menu_id, 0, array(
					'menu-item-title' => __('Contact Us', 'pixel-ebook-store'),
					'menu-item-classes' => 'contact',
					'menu-item-url' => get_permalink($pixel_ebook_store_page_contact),
					'menu-item-status' => 'publish'
				));
			}

			// Assign menu to location if not set
			if (!has_nav_menu($pixel_ebook_store_menulocation)) {
				$pixel_ebook_store_locations = get_theme_mod('nav_menu_locations');
				$pixel_ebook_store_locations[$pixel_ebook_store_menulocation] = $pixel_ebook_store_menu_id; // Use $pixel_ebook_store_menu_id here
				set_theme_mod('nav_menu_locations', $pixel_ebook_store_locations);
			}
		}
	}


	/**
	* Imports the Demo Content
	* @since 1.1.0
	*/
	public function setup_widgets() {

		//. - . - . - . - . - . - . - . - . - . - . - . - . MENU PAGES . - . - . - . - . - . - . - . - . - . - . - . - .//
		
			$pixel_ebook_store_home_id='';
			$pixel_ebook_store_home_content = '';

			$pixel_ebook_store_home_title = 'Home';
			$pixel_ebook_store_home = array(
					'post_type' => 'page',
					'post_title' => $pixel_ebook_store_home_title,
					'post_content'  => $pixel_ebook_store_home_content,
					'post_status' => 'publish',
					'post_author' => 1,
					'post_slug' => 'home'
			);
			$pixel_ebook_store_home_id = wp_insert_post($pixel_ebook_store_home);

			//Set the home page template
			add_post_meta( $pixel_ebook_store_home_id, '_wp_page_template', 'default-home.php' );

			//Set the static front page
			$pixel_ebook_store_home = get_page_by_title( 'Home' );
			update_option( 'page_on_front', $pixel_ebook_store_home->ID );
			update_option( 'show_on_front', 'page' );


			// Create a posts page and assign the template
			$pixel_ebook_store_blog_title = 'Blog';
			$pixel_ebook_store_blog_check = get_page_by_path('blog');
			if (!$pixel_ebook_store_blog_check) {
				$pixel_ebook_store_blog = array(
					'post_type'    => 'page',
					'post_title'   => $pixel_ebook_store_blog_title,
					'post_status'  => 'publish',
					'post_author'  => 1,
					'post_name'    => 'blog'
				);
				$pixel_ebook_store_blog_id = wp_insert_post($pixel_ebook_store_blog);

				// Set the posts page
				if (!is_wp_error($pixel_ebook_store_blog_id)) {
					update_option('page_for_posts', $pixel_ebook_store_blog_id);
				}
			}

			// Create a Contact Us page and assign the template
			$pixel_ebook_store_contact_title = 'Contact Us';
			$pixel_ebook_store_contact_check = get_page_by_path('contact');
			if (!$pixel_ebook_store_contact_check) {
				$pixel_ebook_store_contact = array(
					'post_type'    => 'page',
					'post_title'   => $pixel_ebook_store_contact_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'contact'
				);
				wp_insert_post($pixel_ebook_store_contact);
			}

			// Create a About page and assign the template
			$pixel_ebook_store_about_title = 'About';
			$pixel_ebook_store_about_check = get_page_by_path('about');
			if (!$pixel_ebook_store_about_check) {
				$pixel_ebook_store_about = array(
					'post_type'    => 'page',
					'post_title'   => $pixel_ebook_store_about_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'about'
				);
				wp_insert_post($pixel_ebook_store_about);
			}

			// Create a Page page and assign the template
			$pixel_ebook_store_Page_title = 'Page';
			$pixel_ebook_store_Page_check = get_page_by_path('Page');
			if (!$pixel_ebook_store_Page_check) {
				$pixel_ebook_store_Page = array(
					'post_type'    => 'page',
					'post_title'   => $pixel_ebook_store_Page_title,
					'post_status'  => 'publish',
					'post_content'   => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
					'post_author'  => 1,
					'post_name'    => 'Page'
				);
				wp_insert_post($pixel_ebook_store_Page);
			}

			
		//. - . - . - . - . - . - . - . - . - . - . - . - . FRONTPAGE CONTENT . - . - . - . - . - . - . - . - . - . - . - . - .//

			set_theme_mod('pixel_ebook_store_sidebar_account','Logout');
			set_theme_mod('pixel_ebook_store_sidebar_account_link','#');
			

			set_theme_mod('pixel_ebook_store_sidebar_slot_heading','News Feed');
			set_theme_mod('pixel_ebook_store_slot_btn1','Browse');
			set_theme_mod('pixel_ebook_store_slot_btn1_url','#');
			set_theme_mod('pixel_ebook_store_slot_btn2','Wish list');
			set_theme_mod('pixel_ebook_store_slot_btn2_url','#');
			set_theme_mod('pixel_ebook_store_slot_btn3','Renting');
			set_theme_mod('pixel_ebook_store_slot_btn3_url','#');


			set_theme_mod('pixel_ebook_store_sidebar_slot3_heading','Quick Links');
			set_theme_mod('pixel_ebook_store_slot3_btn1','Coming Soon');
			set_theme_mod('pixel_ebook_store_slot3_btn1_url','#');
			set_theme_mod('pixel_ebook_store_slot3_btn2','Useful Links');
			set_theme_mod('pixel_ebook_store_slot3_btn2_url','#');
			set_theme_mod('pixel_ebook_store_slot3_btn3','Privacy Policy');
			set_theme_mod('pixel_ebook_store_slot3_btn3_url','#');


			set_theme_mod('pixel_ebook_store_sidebar_slot2_heading','Following ');

			set_theme_mod('pixel_ebook_store_author',5);
	
			$pixel_ebook_store_author_btn = array(
				'Ann Chovey',
				'Chris P. Bacon',
				'Olive Yew',
				'Barb Akew',
				'Marsha Mellow'
			);

			for($pixel_ebook_store_i=1;$pixel_ebook_store_i<=5;$pixel_ebook_store_i++){
				set_theme_mod('pixel_ebook_store_author_btn'.$pixel_ebook_store_i, $pixel_ebook_store_author_btn[$pixel_ebook_store_i - 1]);
				set_theme_mod( 'pixel_ebook_store_author_button_link'.$pixel_ebook_store_i, '#' );
				set_theme_mod('pixel_ebook_store_author_image' . $pixel_ebook_store_i, get_template_directory_uri() . '/assets/images/author' . $pixel_ebook_store_i . '.png');
			}


			set_theme_mod('pixel_ebook_store_facebook_url','#');
			set_theme_mod('pixel_ebook_store_twitter_url','#');
			set_theme_mod('pixel_ebook_store_instagram_url','#');
			set_theme_mod('pixel_ebook_store_youtube_url','#');
			set_theme_mod('pixel_ebook_store_whatsapp_url','#');


			set_theme_mod('pixel_ebook_store_banner_section_on_off_setting',true);
			set_theme_mod('pixel_ebook_store_category_section_on_off_setting',true);
			set_theme_mod('pixel_ebook_store_subscriber_section_on_off_setting',true);
			set_theme_mod('pixel_ebook_store_variety_section_on_off_setting',true);


			set_theme_mod('pixel_ebook_store_slider',3);
	
			$pixel_ebook_store_diff_headings = array(
				'Best Seller',
				'Top Seller',
				'Whole Seller'
			);

			for($pixel_ebook_store_i=1;$pixel_ebook_store_i<=3;$pixel_ebook_store_i++){
				set_theme_mod('pixel_ebook_store_banner_heading'.$pixel_ebook_store_i, $pixel_ebook_store_diff_headings[$pixel_ebook_store_i - 1]);
				set_theme_mod( 'pixel_ebook_store_banner_btn'.$pixel_ebook_store_i, 'Order Now' );
				set_theme_mod( 'pixel_ebook_store_banner_button_link'.$pixel_ebook_store_i, '#' );
				set_theme_mod( 'pixel_ebook_store_banner_image'.$pixel_ebook_store_i,get_template_directory_uri().'/assets/images/slider.png' );
			}


			set_theme_mod('pixel_ebook_store_category_heading','Categories');

			set_theme_mod('pixel_ebook_store_category_slider','8');

			$pixel_ebook_store_category_box_heading = array(
				'Fiction',
				'Non Fiction',
				'Drama',
				'Horror & Thriller',
				'Romantic',
				'Sci-Fi',
				'Bollywood',
				'Action'
			);

			for($pixel_ebook_store_i=1;$pixel_ebook_store_i<=8;$pixel_ebook_store_i++){
				set_theme_mod('pixel_ebook_store_category_box_heading'.$pixel_ebook_store_i, $pixel_ebook_store_category_box_heading[$pixel_ebook_store_i - 1]);
				set_theme_mod( 'pixel_ebook_store_category_box_heading_link'.$pixel_ebook_store_i, '#' );
				set_theme_mod('pixel_ebook_store_category_image' . $pixel_ebook_store_i, get_template_directory_uri() . '/assets/images/category' . $pixel_ebook_store_i . '.png');
			}


			set_theme_mod('pixel_ebook_store_subscriber_slider','3');

			$pixel_ebook_store_subscriber_heading = array(
				'Exclusive Sale on New Books',
				'Subscribe for Weekly Book Deals',
				'Join Our Reader Community Today'
			);

			for($pixel_ebook_store_i=1;$pixel_ebook_store_i<=3;$pixel_ebook_store_i++){
				set_theme_mod('pixel_ebook_store_subscriber_heading'.$pixel_ebook_store_i, $pixel_ebook_store_subscriber_heading[$pixel_ebook_store_i - 1]);
				set_theme_mod( 'pixel_ebook_store_subscriber_text'.$pixel_ebook_store_i, 'Lorem ipsum dolor sit amet consectetur adipiscing elit, sest da siusmod tempor incididunt ut labo' );
				set_theme_mod( 'pixel_ebook_store_subscriber_btn'.$pixel_ebook_store_i, 'Subscribe Now' );
				set_theme_mod( 'pixel_ebook_store_subscriber_btn_link'.$pixel_ebook_store_i, '#' );
				set_theme_mod('pixel_ebook_store_subscriber_image' . $pixel_ebook_store_i, get_template_directory_uri() . '/assets/images/subscriber' . $pixel_ebook_store_i . '.png');
			}


			set_theme_mod('pixel_ebook_store_variety_slider','3');

			$pixel_ebook_store_variety_extra_heading = array(
				'Variety Of Books Genres',
				'Top Trending Titles',
				'New & Noteworthy Releases'
			);

			$pixel_ebook_store_variety_heading = array(
				'Book Wave Has A Millions Of Books To choose From Online',
				'Explore What Everyone’s Reading This Week',
				'Discover the Latest Releases Handpicked for You'
			);

			for($pixel_ebook_store_i=1;$pixel_ebook_store_i<=3;$pixel_ebook_store_i++){
				set_theme_mod('pixel_ebook_store_variety_extra_heading'.$pixel_ebook_store_i, $pixel_ebook_store_variety_extra_heading[$pixel_ebook_store_i - 1]);
				set_theme_mod('pixel_ebook_store_variety_heading'.$pixel_ebook_store_i, $pixel_ebook_store_variety_heading[$pixel_ebook_store_i - 1]);
				set_theme_mod( 'pixel_ebook_store_variety_text'.$pixel_ebook_store_i, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam' );
				set_theme_mod( 'pixel_ebook_store_variety_btn'.$pixel_ebook_store_i, 'Read More' );
				set_theme_mod( 'pixel_ebook_store_variety_btn_link'.$pixel_ebook_store_i, '#' );
			}


		$this->Pixel_Ebook_Store_Customizer_Header_Menu();
	}

	//guidline for about theme
	public function pixel_ebook_store_guide() {
		$display_string = '';
		//custom function about theme customizer
		$return = add_query_arg( array()) ;
		$theme = wp_get_theme( 'pixel-ebook-store' );
		?>
		<div class="wrapper-info wrap about-wrap access-wrap">
			<div class="tab-sec theme-option-tab">
				<div id="demo_offer" class="tabcontent open">
					<?php $this->Pixel_Ebook_Store_Demo_Content_Page(); ?>
				</div>
			</div>
		</div>
		
	<?php }
}