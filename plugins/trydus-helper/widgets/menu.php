<?php
namespace Elementor;
/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Akash_Menu extends Widget_Base
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
        return 'akash-menu';
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
        return __('Primary Menu', 'akash-hp');
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

        $this->add_control(
			'menu_style',
			[
				'label' => __( 'Border Style', 'akash-hp' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'inline',
				'options' => [
					'inline' => __( 'Inline', 'akash-hp' ),
					'flyout' => __( 'Flyout', 'akash-hp' ),
				],
			]
        );
        
        $this->add_control(
			'trigger_label',
			[
				'label' => __( 'Trigger Label', 'akash-hp' ),
                'type' => Controls_Manager::TEXT,
			]
        );
        
        $this->add_control(
			'trigger_open_icon',
			[
				'label' => __( 'Trigger Icon', 'text-domain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa fa-align-justify',
					'library' => 'solid',
                ],
                
			]
        );
        
        $this->add_control(
			'trigger_close_icon',
			[
				'label' => __( 'Trigger Close Icon', 'text-domain' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-window-close',
					'library' => 'solid',
				],
			]
		);

        $this->add_responsive_control(
            'menu_align',
            [
                'label' => __('Align', 'akash-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => __('Left', 'akash-hp'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('top', 'akash-hp'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'flex-end' => [
                        'title' => __('Right', 'akash-hp'),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => 'left',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .akash-main-menu-wrap.navbar' => 'justify-content: {{VALUE}}'
					] 
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
			'header_infos_section',
			[
				'label' => __( 'Header Info', 'akash-hp' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        
        $this->add_control(
			'show_infos',
			[
				'label' => __( 'Show Title', 'akash-hp' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'akash-hp' ),
				'label_off' => __( 'Hide', 'akash-hp' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'info_title', [
				'label' => __( 'Title', 'akash-hp' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'info Title' , 'akash-hp' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'info_content', [
				'label' => __( 'Content', 'akash-hp' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'info Content' , 'akash-hp' ),
				'show_label' => false,
			]
        );
        
        $repeater->add_control(
			'info_url',
			[
				'label' => __( 'Link', 'akash-hp' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'akash-hp' ),
				'show_external' => true,
			]
        );
        
		$this->add_control(
			'header_infos',
			[
				'label' => __( 'Repeater info', 'akash-hp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'info_title' => __( 'Call us:', 'akash-hp' ),
						'info_content' => __( '(234) 567 8901', 'akash-hp' ),
					],
				],
                'title_field' => '{{{ info_title }}}',
                'condition' => [
                    'show_infos' => 'yes',
                ]
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu_style',
            [
                'label' => __('Menu Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ]
            ]
        );



		$this->start_controls_tabs(
			'menu_items_tabs'
        );
        
		$this->start_controls_tab(
			'menu_normal_tab',
			[
				'label' => __( 'Normal', 'akash-hp' ),
			]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'menu_typography',
                'label' => __('Menu Typography', 'akash-hp'),
                'selector' => '{{WRAPPER}} .main-navigation ul.navbar-nav>li>a',
            ]
        );

        $this->add_control(
            'menu_color',
            [
                'label' => __('Item Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a, 
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',

                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
    
                ],
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'item_gap',
            [
                'label' => __('Menu Gap', 'akash-hp'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'margin-left: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'margin-right: {{SIZE}}{{UNIT}};margin-right: {{SIZE}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => __('Item Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],

            ]
        );

        $this->add_responsive_control(
            'item_readius',
            [
                'label' => __('Item Radius', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li>a' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'menu_hover_tab',
			[
				'label' => __( 'Hover', 'akash-hp' ),
			]
		);

        $this->add_control(
            'menu_hover_color',
            [
                'label' => __('Menu Hover Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li>a:hover, 
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'menu_bg_hover_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav>li:hover>a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'dropdown_style',
            [
                'label' => __('Dropdown Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'menu_style' => 'inline',
                ]
            ]
        );

		$this->start_controls_tabs(
			'dropdown_items_tabs'
		);
		$this->start_controls_tab(
			'dropdown_normal_tab',
			[
				'label' => __( 'Normal', 'akash-hp' ),
			]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dripdown_typography',
                'label' => __('Menu Typography', 'akash-hp'),
                'selector' => '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav>li .sub-menu a',
            ]
        );
        
        $this->add_control(
            'dropdown_item_color',
            [
                'label' => __('Item Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a,
                        {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_bg_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'ddown_menu_border_color',
            [
                'label' => __('Menu Border Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_item_radius',
            [
                'label' => __('Menu radius', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label' => __('Item Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'dropdown_hover_tab',
			[
				'label' => __( 'Hover', 'akash-hp' ),
			]
		);

        $this->add_control(
            'dropdown_item_hover_color',
            [
                'label' => __('Item Hover Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover,
                     {{WRAPPER}} .menu-style-inline.navbar:not(.active) .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_bg_hover_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-inline .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_flyout_style',
            [
                'label' => __('Flyout/Mobile Menu Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


		$this->start_controls_tabs(
			'flyout_items_tabs'
        );
        
		$this->start_controls_tab(
			'flyout_menu_normal_tab',
			[
				'label' => __( 'Normal', 'akash-hp' ),
			]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flyout_menu_typography',
                'label' => __('Item Typography', 'akash-hp'),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a',
            ]
        );

        $this->add_control(
            'flyout_menu_color',
            [
                'label' => __('Item Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a, 
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a .dropdownToggle' => 'color: {{VALUE}}',

                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'flyout_item_padding',
            [
                'label' => __('Item Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px) {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li>a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>.menu-item-has-children>a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} calc({{RIGHT}}{{UNIT}} + 20px);',
                ],

            ]
        );

        $this->add_responsive_control(
            'flyout_menu_padding',
            [
                'label' => __('Menu Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
             
                ],

            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'flyout_menu_hover_tab',
			[
				'label' => __( 'Hover', 'akash-hp' ),
			]
		);

        $this->add_control(
            'flyout_menu_hover_color',
            [
                'label' => __('Menu Hover Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav>li>a:hover, 
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav > .menu-item-has-children > a:hover .dropdownToggle,
                     {{WRAPPER}} .menu-style-flyout .menu-style-flyout .main-navigation ul.navbar-nav li.current-menu-item>a' => 'color: {{VALUE}}',
                ],
            ]
        );


		$this->end_controls_tab();

        $this->end_controls_tabs();
    
        $this->end_controls_section();

        $this->start_controls_section(
            'flyout_dropdown_style',
            [
                'label' => __('Flyout/Mobile Dropdown Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs(
			'flyout_dropdown_items_tabs'
		);
		$this->start_controls_tab(
			'flyout_dropdown_normal_tab',
			[
				'label' => __( 'Normal', 'akash-hp' ),
			]
		);
                
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'flyout_dripdown_typography',
                'label' => __('Dropdown Typography', 'akash-hp'),
                'selector' => '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav>li .sub-menu a',
            ]
        );

        $this->add_control(
            'flyout_dropdown_item_color',
            [
                'label' => __('Item Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a,
                        {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children > a  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'flyout_dropdown_item_bg_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'flyout_dropdown_item_padding',
            [
                'label' => __('Item Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    'body:not(.rtl) {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],

            ]
        );

		$this->end_controls_tab();

		$this->start_controls_tab(
			'flyout_dropdown_hover_tab',
			[
				'label' => __( 'Hover', 'akash-hp' ),
			]
		);

        $this->add_control(
            'flyout_dropdown_item_hover_color',
            [
                'label' => __('Item Hover Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover,
                     {{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .sub-menu .menu-item-has-children > a:hover  .dropdownToggle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'flyout_dropdown_item_bg_hover_color',
            [
                'label' => __('Item Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .main-navigation ul.navbar-nav .menu-item-has-children .sub-menu a:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'trigger_style',
            [
                'label' => __('Trigger Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->start_controls_tabs(
            'trigger_style_tabs'
        );
        
        $this->start_controls_tab(
            'trigger_style_normal_tab',
            [
                'label' => __('Normal', 'akash-hp'),
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'trigger_typography',
                'label' => __('Trigger Typography', 'akash-hp'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );

        $this->add_control(
            'trigger_color',
            [
                'label' => __('Trigger Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'trigger_background',
            [
                'label' => __('Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trigger_border',
                'label' => __('Border', 'akash-hp'),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu',
            ]
        );

        $this->add_control(
			'trigger_icon_size',
			[
				'label' => __( 'Icon size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'trigger_icon_gap',
			[
				'label' => __( 'Icon Gap', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .navbar-toggler.open-menu .navbar-toggler-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'trigger_radius',
            [
                'label' => __('Border Radius', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );

        $this->add_responsive_control(
            'trigger_padding',
            [
                'label' => __('Button Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'trigger_style_hover_tab',
            [
                'label' => __('Hover', 'akash-hp'),
            ]
        );
        

        $this->add_control(
            'trigger_hover_color',
            [
                'label' => __('Trigger Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'trigger_hover_background',
            [
                'label' => __('Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'trigger_hover_border',
                'label' => __('Border', 'akash-hp'),
                'selector' => '{{WRAPPER}} .navbar-toggler.open-menu:hover',
            ]
        );

        $this->add_control(
            'trigger_hover_animation',
            [
                'label' => __('Hover Animation', 'akash-hp'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->add_responsive_control(
            'trigger_hover_radius',
            [
                'label' => __('Border Radius', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.open-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .navbar-toggler.open-menu:hover' => 'border-radius: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}}
                    ;',
                ],
            ]
        );
       
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
       
        $this->start_controls_section(
            'infos_style_section',
            [
                'label' => __('Info Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_infos' => 'yes',
                ]
            ]
        );

        $this->start_controls_tabs(
            'info_style_tabs'
        );
        
        $this->start_controls_tab(
            'info_style_normal_tab',
            [
                'label' => __('Normal', 'akash-hp'),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_title_typography',
                'label' => __('Title Typography', 'akash-hp'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .header-info span',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'info_typography',
                'label' => __('Info Typography', 'akash-hp'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .header-info h3 ',
            ]
        );

        $this->add_control(
            'info_title_color',
            [
                'label' => __('Info Title Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-info span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_color',
            [
                'label' => __('Info Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .header-info h3' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'info_box_border',
                'label' => __('Box Border', 'akash-hp'),
                'selector' => '{{WRAPPER}} .akash-header-infos',
            ]
        );

        $this->add_control(
			'info_title_gap',
			[
				'label' => __( 'Info Title Gap', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .header-info span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'ifno_item_padding',
            [
                'label' => __('Info item Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .header-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

                    'body.rtl {{WRAPPER}} .header-info' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'info_style_hover_tab',
            [
                'label' => __('Hover', 'akash-hp'),
            ]
        );
        
        $this->add_control(
            'info_title_color_hover',
            [
                'label' => __('Info Title Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .header-info:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'info_color_hover',
            [
                'label' => __('Info Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .header-info:hover h3' => 'color: {{VALUE}}',
                ],
            ]
        );
        
       
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

        $this->end_controls_section();
        $this->start_controls_section(
            'panel_style',
            [
                'label' => __('Panel Style', 'akash-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'panel_label_typography',
                'label' => __('Label Typography', 'akash-hp'),
                'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler',
            ]
        );

      
        $this->add_control(
            'panel_label_color',
            [
                'label' => __('Label Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'close_trigger_color',
            [
                'label' => __('Close Trigger Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler i' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'close_trigger_fill_color',
            [
                'label' => __('Close Trigger Fill Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner .navbar-toggler svg path' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'close_label_background',
            [
                'label' => __('Label Background Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .navbar-toggler.close-menu' => 'background-color: {{VALUE}}',
                ],
            ]
        );
 
        $this->add_control(
            'panel_background',
            [
                'label' => __('Panel Color', 'akash-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
			'trigger_cloxe_icon_size',
			[
				'label' => __( 'Close Icon size', 'plugin-domain' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],

				'selectors' => [
					'{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon svg' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .menu-style-flyout .navbar-toggler.close-menu .navbar-toggler-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
      
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'panel_shadow',
                'label' => __('Panel Shadow', 'akash-hp'),
                'selector' => '{{WRAPPER}}  .navbar-inner',
            ]
        );

        $this->add_responsive_control(
            'close_label_padding',
            [
                'label' => __('Label Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}  .menu-style-flyout .navbar-toggler.close-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}}  .navbar-toggler.close-menu' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
                ],
            ]
        );
  
        $this->add_responsive_control(
            'panel_padding',
            [
                'label' => __('Panel Padding', 'akash-hp'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .menu-style-flyout .navbar-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .menu-style-flyout  .navbar-inner' => 'padding: {{TOP}}{{UNIT}} {{LEFT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{RIGHT}}{{UNIT}};',
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
    protected function render()
    {
        $popular_post_key = array();
        $popular_meta_value_num = array();
        $settings = $this->get_settings_for_display();


        $args = [
            'theme_location'        => 'main-menu',
            'menu_class'            => 'navbar-nav',
            'menu_id'               => 'navbar-nav',
            'container_class'       => 'akash-menu-container',
        ];
        $menu_align_desktop  = $settings['menu_align'];
        $menu_align_tablet   = $settings['menu_align_tablet'];
        $menu_align_mobile   = $settings['menu_align_mobile'];
        $menu_align = sprintf('menu-align-%s menu-align-tablet-%s menu-align-mobile-%s', esc_attr($menu_align_desktop), esc_attr($menu_align_tablet), esc_attr($menu_align_mobile));
       
?>
        <div class="akash-main-menu-wrap navbar menu-style-<?php printf($settings['menu_style'] ) ?>">
            <button class="navbar-toggler open-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <?php Icons_Manager::render_icon( $settings['trigger_open_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
                <?php if( !empty($settings['trigger_label']) ) {
                        printf('<span cla ss="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '' ); 
                    }
                     ?>
            </button>
            <!-- end of Nav toggler -->
            <div class="navbar-inner">
                <div class="akash-mobile-menu"></div>
                <button class="navbar-toggler close-menu" type="button" data-toggle="navbarToggler" aria-label="Toggle navigation">
                    <?php if( !empty($settings['trigger_label']) ) {
                        printf('<span cla ss="trigger-label"> %s </span>', $settings['trigger_label'] ? $settings['trigger_label'] : '' ); 
                    }
                     ?>
                    <span class="navbar-toggler-icon close">
                    <?php Icons_Manager::render_icon( $settings['trigger_close_icon'], [ 'aria-hidden' => 'true' ] ); ?>

                    </span>
                </button>
                <nav id="site-navigation" class="main-navigation ">
                    <?php
                    if (has_nav_menu('main-menu') ) {
                        wp_nav_menu($args);
                    }

                    ?>
                </nav><!-- #site-navigation -->

                <?php if ( 'yes' == $settings['show_infos'] ): ?>
                       <div class="akash-header-infos">
                           <?php  
                                foreach (  $settings['header_infos'] as $info ) : 
                                    $target = $info['info_url']['is_external'] ? ' target="_blank"' : '';
                                    $nofollow = $info['info_url']['nofollow'] ? ' rel="nofollow"' : '';
                                    $info_url_attr = $info['info_url']['url'] ? "href='{$info['info_url']['url']}' {$target} {$nofollow}": '';
                                    $info_tag = ! empty( $info['info_url']['url'] ) ? 'a' : 'div'; 

                                    printf(
                                        '<%1$s %2$s class="header-info"> 
                                        <span> %3$s </span>
                                        <h3>  %4$s</h3>
                                        </%1$s>',
                                        $info_tag,
                                        $info_url_attr,
                                        esc_html( $info['info_title'] ),
                                        esc_html( $info['info_content'] )
                                        )
                            ?>
                            <?php endforeach; ?>
                       </div>
                <?php endif; ?>
                
            </div>
        </div>
<?php
    }
}
