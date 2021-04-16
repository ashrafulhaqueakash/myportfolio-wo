<?php 

add_action( 'elementor/element/text-editor/section_style/after_section_start', function( $element, $args ) {
	/** @var \Elementor\Element_Base $element */
	$element->add_control(
		'custom_control',
		[
			'type' => \Elementor\Controls_Manager::NUMBER,
			'label' => __( 'Custom Control', 'plugin-name' ),
		]
	);
}, 10, 2 );


// add_action( 'elementor/element/text-editor/section_editor/before_section_start', function( $element, $args ) {
//     /** @var \Elementor\Element_Base $element */
//     $element->start_controls_section(
//         'style_section',
//         [
//             'label' => __( 'Extra', 'akash-hp' ),
//             'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
//         ]
//     );

// 	$element->add_control(
// 		'custom_control',
// 		[
// 			'type' => \Elementor\Controls_Manager::NUMBER,
// 			'label' => __( 'Custom Control', 'plugin-name' ),
// 		]
//     );
//     $element->end_controls_section();
// }, 10, 2 );