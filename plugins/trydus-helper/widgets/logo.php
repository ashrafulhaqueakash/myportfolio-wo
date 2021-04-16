<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Akash_Logo extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve oEmbed widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'akash-logo';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve oEmbed widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Akash Logo', 'akash-hp' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve oEmbed widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-code';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the oEmbed widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'akash-addons' ];
	}

	/**
	 * Register oEmbed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'akash-hp' ),
			]
        );
		
		$this->add_control(
			'logo_type',
			[
				'label' => __( 'Logo Type', 'akash-hp' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'normal',
				'options' => [
					'normal'  => __( 'Normal Logo', 'akash-hp' ),
					'white' => __( 'White Logo', 'akash-hp' ),
					'custom' => __( 'Custom Logo', 'akash-hp' ),
				],
			]
		);

        $this->add_control(
			'custom_logo',
			[
				'label' => __( 'Choose Logo', 'tryds-hp' ),
				'type' => Controls_Manager::MEDIA,
				'condition' => [
					'logo_type' => 'custom'
				],
			]
		);

        $this->end_controls_section();
        
        $this->start_controls_section(
			'style_section',
			[
				'label' => __( 'Logo Style', 'akash-hp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
        );

        $this->add_control(
			'width',
			[
				'label' => __( 'Width', 'akash-hp' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .akash-site-logo img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
        );
        
        $this->end_controls_section();
        

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
?>
        <a class="akash-site-logo" href="<?php echo esc_url(home_url()) ?>">
            <?php
				$akash_option = get_option('akash');

                if( ! empty( $settings['custom_logo']['url'] && 'custom' == $settings['logo_type'] ) ){

					echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'custom_logo' );
					
                }else if ('normal' == $settings['logo_type'] && !empty( $akash_option['logo']['url'] ) ) {

						echo '<img src="' . esc_url( $akash_option['logo']['url'] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
						
                }else if ('white' == $settings['logo_type'] && !empty( $akash_option['white_logo']['url'] ) ) {

					echo '<img src="' . esc_url( $akash_option['white_logo']['url'] ) . '" alt="' . get_bloginfo( 'name' ) . '">';

				}else if ( has_custom_logo() ) {
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                        echo '<img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '">';
                } else {
                        echo '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                }
            ?>
        </a>
       <?php 
	}

}