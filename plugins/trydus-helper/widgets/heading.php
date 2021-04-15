<?php
namespace Elementor;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Trydus_Heading extends Widget_Base
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
        return 'trydus-heading';
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
        return __('Trydus Heading', 'trydus-hp');
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
        return 'eicon-t-letter';
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
    public function get_keywords()
    {
        return [ 'heading', 'title', 'text' ];
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
        return ['trydus-addons'];
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
                'label' => __('Content', 'trydus-hp'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_page_title',
            [
                'label' => __('Show Page Title', 'plugin-domain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'your-plugin'),
                'label_off' => __('Hide', 'your-plugin'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'trydus-hp'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'trydus-hp'),
                'default' => __('Add Your Heading Text Here', 'trydus-hp'),
                'condition' => [
                    'show_page_title!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'trydus-hp'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'header_size',
            [
                'label' => __('HTML Tag', 'trydus-hp'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'trydus-hp'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'trydus-hp'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'trydus-hp'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'trydus-hp'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'trydus-hp'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Title', 'trydus-hp'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Text Color', 'trydus-hp'),
                'type' => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
    
                'selector' => '{{WRAPPER}} .trydus-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'text_shadow',
                'selector' => '{{WRAPPER}} .trydus-heading-title',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label' => __('Blend Mode', 'trydus-hp'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __('Normal', 'trydus-hp'),
                    'multiply' => 'Multiply',
                    'screen' => 'Screen',
                    'overlay' => 'Overlay',
                    'darken' => 'Darken',
                    'lighten' => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation' => 'Saturation',
                    'color' => 'Color',
                    'difference' => 'Difference',
                    'exclusion' => 'Exclusion',
                    'hue' => 'Hue',
                    'luminosity' => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_line_style',
			[
				'label' => __( 'Line Style', 'trydus-hp' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_control(
            'enable_line',
            [
                'label' => __('Enable Line?', 'trydus-hp'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'trydus-hp'),
                'label_off' => __('No', 'trydus-hp'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'line_color',
            [
                'label' => __('Line Color', 'trydus-hp'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title:after' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'line_width',
            [
                'label' => __('Line Width', 'trydus-hp'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title:after'  => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'line_height',
            [
                'label' => __('Line height', 'trydus-hp'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
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
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title:after'  => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'line_x_position',
            [
                'label' => __('Shape Y Position', 'trydus-hp'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title:after'  => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'line_y_position',
            [
                'label' => __('Shape X Position', 'trydus-hp'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'devices' => ['desktop', 'tablet', 'mobile'],
                'selectors' => [
                    '{{WRAPPER}} .trydus-heading-title:after'  => 'left: {{SIZE}}{{UNIT}};',
                    'body.rtl {{WRAPPER}} .trydus-heading-title:after'  => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'enable_line' => 'yes',
                ]
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
        $settings = $this->get_settings_for_display();

        if ('' === $settings['title']) {
            return;
        }
  
        if ('yes' == $settings['show_page_title']) {
            $title = get_the_title();
        } else {
            $title = $settings['title'];
        }

        $this->add_render_attribute('title', 'class', 'trydus-heading-title');
        $this->add_render_attribute( 'title', 'class', 'show-line-'. $settings['enable_line'] );



        $this->add_inline_editing_attributes('title');



        if (! empty($settings['link']['url'])) {
            $this->add_link_attributes('link_url', $settings['link']);

            $title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('link_url'), $title);
        }

        $title_html = sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $title);

        echo $title_html;
    }
}
