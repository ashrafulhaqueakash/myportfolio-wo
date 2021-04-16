<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Akash_Slider extends Widget_Base
{

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
    public function get_name()
    {
        return 'akash-slider';
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
    public function get_title()
    {
        return __('Hero Slide', 'akash-hp');
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
    public function get_icon()
    {
        return 'eicon-nav-menu';
    }

    /**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'slider', 'slide', 'hero' ];
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
    public function get_categories()
    {
        return ['akash-addons'];
    }

    /**
     * Retrieve the list of available menus.
     *
     * Used to get the list of available menus.
     *
     * @since 1.3.0
     * @access private
     *
     * @return array get WordPress menus list.
     */
    private function get_available_menus()
    {

        $menus = wp_get_nav_menus();

        $options = [];

        foreach ($menus as $menu) {
            $options[$menu->slug] = $menu->name;
        }

        return $options;
    }

    /**
     * Register oEmbed widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls()
    {

        /**
         * Style tab
         */

        $this->start_controls_section(
            'general',
            [
                'label' => __('Content', 'akash-hp'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


		$slide = new Repeater();

           
        $slide->add_responsive_control(
            'slide_grid',
            [
                'label' => __('Select Column', 'akash-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '4' => '4 Column',
                    '5' => '5 Column',
                    '6' => '6 Column',
                    '7' => '7 Column',
                    '8' => '8 Column',
                    '9' => '9 Column',
                    '10' => '10 Column',
                    '11' => '11 Column',
                    '12' => '12 Column',
                ),
                'default'            => 6,
                'tablet_default'     => 8,
                'mobile_default'     => 12,
            ]
        );
     
        $slide->add_responsive_control(
            'slide_grid_offset',
            [
                'label' => __('Select Offset', 'akash-hp'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '0' => 'None',
                    '1' => '1 Column',
                    '2' => '2 Column',
                    '3' => '3 Column',
                    '4' => '4 Column',
                    '5' => '5 Column',
                    '6' => '6 Column',
                    '7' => '7 Column',
                    '8' => '8 Column',
                    '9' => '9 Column',
                    '10' => '10 Column',
                ),
                'condition'    => [
                    'slide_grid!' => '12'
                ]
            ]
        );



        $slide->add_control(
			'slide_image',
			[
				'label' => __( 'Choose Slide Image', 'plugin-domain' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$slide->add_control(
			'slide_title', [
				'label' => __( 'Title', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Slide Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$slide->add_control(
			'slide_content', [
				'label' => __( 'Content', 'plugin-domain' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => __( 'Slide Content' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

        $slide->add_control(
			'btn_text', [
				'label' => __( 'Button Text', 'plugin-domain' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Contact Us' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

        $slide->add_control(
			'btn_link',
			[
				'label' => __( 'Url', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'plugin-domain' ),
				'show_external' => true,
			]
		);

        $slide->add_control(
			'btn_icon',
			[
				'label' => __( 'Button Icon', 'akash-hp' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-angle-right',
					'library' => 'solid',
				],
			]
		);


		$this->add_control(
			'slides',
			[
				'label' => __( 'Slider Items', 'plugin-domain' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $slide->get_controls(),
				'default' => [
					[
						'slide_title' => __( 'Title #1', 'plugin-domain' ),
						'slide_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
					[
						'slide_title' => __( 'Title #2', 'plugin-domain' ),
						'slide_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
					[
						'slide_title' => __( 'Title #2', 'plugin-domain' ),
						'slide_content' => __( 'Item content. Click the edit button to change this text.', 'plugin-domain' ),
					],
				],
				'title_field' => '{{{ slide_title }}}',
			]
		);

        $this->end_controls_section();
            /*Style Tab section start */


            $this->start_controls_section(
                'slider_navigation',
                [
                    'label' => __('Slider Navigation', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );
  
            $this->add_control(
                'next_icon',
                [
                    'label' => __( 'Next Icon', 'akash-hp' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-right',
                        'library' => 'solid',
                    ],
                ]
            );
  
            $this->add_control(
                'prev_icon',
                [
                    'label' => __( 'Prev Icon', 'akash-hp' ),
                    'type' => \Elementor\Controls_Manager::ICONS,
                    'default' => [
                        'value' => 'fas fa-angle-left',
                        'library' => 'solid',
                    ],
                ]
            );
    
            $this->end_controls_section();
            /*Style Tab section start */


            $this->start_controls_section(
                'wrapper_style',
                [
                    'label' => __('Slider Wrapper Style', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
    
    
            $this->add_responsive_control(
                'wrapper_padding',
                [
                    'label' => __('Slider Wrapper Padding', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'wrapper_margin',
                [
                    'label' => __('Slider wrapper Margin', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->end_controls_section();
    
    
    
            /*Style Heading section start */
    
            $this->start_controls_section(
                'heading_style',
                [
                    'label' => __('Slider Heading Style', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
    
    
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'heading_typography',
                    'label' => __('Heading', 'grayic'),
                    'selector' => '{{WRAPPER}} .akash-slider-content h4',
                ]
            );
            $this->add_control(
                'heading_color',
                [
                    'label' => __('Heading Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content h4' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'heading_padding',
                [
                    'label' => __('Heading Padding', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content h4' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'heading_margin',
                [
                    'label' => __('Heading Margin', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->end_controls_section();
    
            /*Style Heading section end */
    
    
    
            /*Style Content section start */
    
            $this->start_controls_section(
                'content_style',
                [
                    'label' => __('Slider Content Style', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
    
    
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __('Content', 'grayic'),
                    'selector' => '{{WRAPPER}} .akash-slider-content p',
                ]
            );
            $this->add_control(
                'content_color',
                [
                    'label' => __('Content Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content p' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
    
            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __('Content Padding', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __('Content Margin', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
    
    
            $this->end_controls_section();
    
            /*Style Content section end */
    
    
    
    
            /*Style Button section start */
    
            $this->start_controls_section(
                'btn_style',
                [
                    'label' => __('Button Style', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
            $this->start_controls_tabs(
                'btn_tabs'
            );
            
    /*Normal Tab part */
    
            $this->start_controls_tab(
                'btn_normal_tab',
                [
                    'label' => __( 'Normal', 'plugin-name' ),
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'btn_typography',
                    'label' => __('Button Typography', 'grayic'),
                    'selector' => '{{WRAPPER}} .akash-slider-btn',
                ]
            );
    
            $this->add_control(
                'btn_width',
                [
                    'label' => __('Button Width', 'plugin-domain'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 600,
    
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
    
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_control(
                'btn_height',
                [
                    'label' => __('Button Height', 'plugin-domain'),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => ['px', '%'],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 600,
    
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
    
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'btn_padding',
                [
                    'label' => __('Button Padding', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'btn_margin',
                [
                    'label' => __('Button Margin', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
            $this->add_control(
                'btn_color',
                [
                    'label' => __('Button Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'color: {{VALUE}}',
                    ],
                ]
            );
            $this->add_control(
                'btn_bg',
                [
                    'label' => __('Button BG Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'background: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'btn_radius',
                [
                    'label' => __('Button Radius', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
           
            $this->end_controls_tab();
                 
     /*Normal Tab part End*/
    
    
             /*Hover Tab part */
    
            $this->start_controls_tab(
                'btn_hover_tab',
                [
                    'label' => __( 'Hover', 'plugin-name' ),
                ]
            );
            $this->add_control(
                'btn_hover_color',
                [
                    'label' => __('Button Text Hover Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_control(
                'btn_bg_hover',
                [
                    'label' => __('Button Hover BG Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn:hover' => 'background: {{VALUE}}',
                    ],
                ]
            );
    
           
            $this->end_controls_tab();
    
           /*Hover Tab part End*/       
    
            $this->end_controls_tabs();
    
    /*Button Tab main part End*/ 
    
            
    
            $this->end_controls_section();
    
            /*Style Button section end */
    
    
    
            /*Style Icon section start */
    
            $this->start_controls_section(
                'icon_style',
                [
                    'label' => __('Button Icon Style', 'grayic'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                ]
            );
    
     /*Icon normal & hover tab section start */
    
            $this->start_controls_tabs(
                'item_tabs'
            );
            
    /*Normal Tab part */
    
            $this->start_controls_tab(
                'icon_normal_tab',
                [
                    'label' => __( 'Normal', 'plugin-name' ),
                ]
            );
    
            $this->add_control(
                'icon_color',
                [
                    'label' => __('Icon Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn-con i' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_responsive_control(
                'icon_margin',
                [
                    'label' => __('Icon Margin', 'grayic'),
                    'type' => \Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', '%', 'em'],
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn-con i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
    
    
    
    
            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'icon_typography',
                    'label' => __('Icon Typography', 'grayic'),
                    'selector' => '{{WRAPPER}} .akash-slider-btn-con i',
                ]
            );
    
    
           
            $this->end_controls_tab();
            
    
            
     /*Normal Tab part End*/
    
    
             /*Hover Tab part */
    
            $this->start_controls_tab(
                'icon_hover_tab',
                [
                    'label' => __( 'Hover', 'plugin-name' ),
                ]
            );
    
    
            $this->add_control(
                'icon_hover_color',
                [
                    'label' => __('Icon Hover Color', 'grayic'),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .akash-slider-btn:hover i' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
           
            $this->end_controls_tab();
    
           /*Hover Tab part End*/       
    
      
    
            $this->end_controls_tabs();
           
            /* Icon normal  & hover main tab end */
          
            $this->end_controls_section();
    
            /*Style Icon section end */
    
    
    
            /*Style Tab section End */
    
    
    
    
       /*Style Slider nav image section start */
    
       $this->start_controls_section(
        'nav_style',
        [
            'label' => __('Slider Nav Style', 'grayic'),
            'tab' => \Elementor\Controls_Manager::TAB_STYLE,
        ]
    );
    
    
    
    $this->start_controls_tabs(
        'nav_tabs'
    );        
    /*Normal Tab part */
    $this->start_controls_tab(
        'item_normal_tab',
        [
            'label' => __( 'Normal', 'plugin-name' ),
        ]
    );
    
    
    
    $this->add_control(
        'left_position',
        [
            'label' => __( 'Slider Nav left position', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 50,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-nav' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    
    $this->add_control(
        'bottom_position',
        [
            'label' => __( 'Slider Nav Bottom position', 'plugin-domain' ),
            'type' => \Elementor\Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                    'step' => 1,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'unit' => '%',
                'size' => 50,
            ],
            'selectors' => [
                '{{WRAPPER}} .owl-nav' => 'bottom: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    
    $this->add_control(
        'nav_bg',
        [
            'label' => __('Nav Icon BG', 'grayic'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .akash-hero-slider-wrap .owl-nav img' => 'background: {{VALUE}}',
            ],
        ]
    );
    $this->add_responsive_control(
        'nav_margin',
        [
            'label' => __('Nav Margin', 'grayic'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .akash-hero-slider-wrap .owl-nav img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
    $this->add_responsive_control(
        'nav_padding',
        [
            'label' => __('Nav Padding', 'grayic'),
            'type' => \Elementor\Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .akash-hero-slider-wrap .owl-nav img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );
    
    $this->end_controls_tab();
    /*Normal Tab part End*/
     /*Hover Tab part */
    $this->start_controls_tab(
        'nav_hover_tab',
        [
            'label' => __( 'Hover', 'plugin-name' ),
        ]
    );
    
    $this->add_control(
        'nav_bg_hover',
        [
            'label' => __('Nav Icon BG Hover', 'grayic'),
            'type' => \Elementor\Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .akash-hero-slider-wrap .owl-nav img:hover' => 'background: {{VALUE}}',
            ],
        ]
    );
    
    $this->end_controls_tab();
    /*Hover Tab part End*/       
    /*Active Tab part */
    $this->start_controls_tab(
        'nav_active_tab',
        [
            'label' => __( 'Active', 'plugin-name' ),
        ]
    );
    $this->end_controls_tab();
    /*Active Tab part End*/  
    $this->end_controls_tabs();
    
    
    
    
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
    protected function render()
    {
        $popular_post_key = array();
        $popular_meta_value_num = array();
        $settings = $this->get_settings_for_display();

        $slider_settings = [
            'next_icon' => $this->get_render_icon($settings['next_icon']),
            'prev_icon' => $this->get_render_icon($settings['prev_icon']),

        ];

        $this->add_render_attribute(
            'slider_settings',
            [
                'data-slider-setting' => json_encode($slider_settings),
            ]
        );

        ?>

            <div class="akash-hero-slider-wrap" <?php echo $this->get_render_attribute_string( 'slider_settings' ); ?>>
                <div class="akash-hero-slider owl-carousel">
                    <?php 
                    
                        if ( $settings['slides'] ) :
           
                            foreach (  $settings['slides'] as $slide ) :

                                $slide_grid_desktop = $slide['slide_grid'];
                                $slide_grid_tablet  = $slide['slide_grid_tablet'];
                                $slide_grid_mobile  = $slide['slide_grid_mobile'];
                                $slide_grid = sprintf(
                                    'col-lg-%s col-md-%s col-%s',
                                     esc_attr($slide_grid_desktop), 
                                     esc_attr($slide_grid_tablet), 
                                     esc_attr($slide_grid_mobile)
                                );
                          
                                $slide_grid_offset_desktop = $slide['slide_grid_offset'];
                                $slide_grid_offset_tablet  = $slide['slide_grid_offset_tablet'];
                                $slide_grid_offset_mobile  = $slide['slide_grid_offset_mobile'];
                                $slide_grid_offset = sprintf(
                                    'offset-lg-%s offset-md-%s offset-%s',
                                     esc_attr($slide_grid_offset_desktop), 
                                     esc_attr($slide_grid_offset_tablet), 
                                     esc_attr($slide_grid_offset_mobile)
                                );
                            
                            ?>
                                <div class="akash-hero-slide-item" style="background-image: url(<?php echo esc_url( $slide['slide_image']['url'] ) ?> ) ">
                                    <div class="container">
                                        <div class="row">
                                            <div class="<?php printf( '%s %s ', $slide_grid, $slide_grid_offset )   ; ?>">
                                                <div class="akash-slider-content">
                                                    <h4><?php echo esc_html( $slide['slide_title'] ) ?></h4>
                                                    <h4><?php echo esc_html( $slide['slide_content'] ) ?></h4>
                                                    <?php 
                                                        $target = $slide['btn_link']['is_external'] ? ' target="_blank"' : '';
                                                        $nofollow = $slide['btn_link']['nofollow'] ? ' rel="nofollow"' : '';

                                                        printf(
                                                            '<a href="%s" %s class="akash-btn">%s <span class="akash-btn-icon">%s</span></a>',
                                                            $slide['btn_link']['url'],
                                                            $target . $nofollow,
                                                            esc_html($slide['btn_text']),
                                                            $this->get_render_icon( $slide['btn_icon'] )
                                                        );
                                                    
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                           <?php
                            endforeach;
                        endif;
                    ?>
                </div>
            </div>
        <?php 

        
    }

    protected function get_render_icon( $icon ){
         ob_start();

        Icons_Manager::render_icon( $icon, [ 'aria-hidden' => 'true' ] );

        return ob_get_clean();
    }
}
