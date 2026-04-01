<?php
/**
 * Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Toggle Switch Custom Control
	 */
	class Pixel_Ebook_Store_On_Off_Custom_Control extends WP_Customize_Control {
		public $type = 'toggle_on_off';
		public function render_content() {
			?>
			<div class="pixel-ebook-store-on-off-custom-control">
				<div class="toggle-on-off">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-on-off-tickbox" value="<?php echo esc_attr( $this->value() ); ?>" 
					<?php
						$this->link();
						checked( $this->value() );
					?>
					>
					<label class="toggle-on-off-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-on-off-inner-span"></span>
						<span class="toggle-on-off-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

}