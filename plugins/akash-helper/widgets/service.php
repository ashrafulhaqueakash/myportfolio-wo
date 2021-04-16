<?php
namespace Elementor;

/**
 * Elementor oEmbed Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Akash_Service extends Widget_Base
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
        return 'akash-service';
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
        return __('Akash Service', 'akash-hp');
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
        return ['akash-addons'];
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

        $the_query = new \WP_Query(array(
            // 'posts_per_page' => $settings['posts_per_page'],
            'post_type' => 'service',
            // 'orderby' => $settings['orderby'],
            // 'order' => $settings['order'],
        ));
        
        if ($the_query->have_posts()) : ?>
                <div class="row justify-content-center">
                
                <?php while ($the_query->have_posts()) : $the_query->the_post(); 
                    $idd = get_the_ID();

                ?>
                    <div class="col-md-3">
                    <div class="akash-service-widget-item">

                        <?php if (!empty( get_post_meta( $idd, 'svg_icon', true ) ) ) : ?>
                            <div class="service-thumbnail-wrapper">
                                <div class="service-thumbnail">
                                    <span class="image-shape"></span>
                                    <?php
                                        $thumb_icon_id = get_post_meta( $idd, 'svg_icon', true );
                                        $thumb_icon_url = wp_get_attachment_image( $thumb_icon_id, 'full' );
                                        $image =  [
                                        'value' => [
                                            'url' => $thumb_icon_url,
                                            'id' => $thumb_icon_id,
                                        ],
                                        'library' => 'svg'
                                    ];
                                        Icons_Manager::render_icon($image, ['aria-hidden' => 'true']);
                                ?>

                                </div>
                            </div>
                        <?php endif; ?>


                        <div class="service-content-wrap">
                            <div class="service-content">
                                <a href="<?php the_permalink() ?>" class="service-link">
                                    <?php the_title('<h3>', '</h3>'); ?>
                                </a>
                                <?php printf('<p>%s</p>', get_the_excerpt()); ?>
                            </div>
                            <div class="service-btn-wrape">
                                <a href="<?php the_permalink() ?>" class="service-btn"><?php echo esc_html('READ MORE') ?>  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><g clip-path="url(#clip0)"><path d="M0.666672 8H15" stroke="#233AFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/><path d="M10.3333 3.33337L15 8.00004L10.3333 12.6667" stroke="#233AFF" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/></g><defs><clipPath id="clip0"><rect width="16" height="16" fill="white"/></clipPath></defs></svg></a>
                            </div>
                        </div>
                    </div>
                    </div>

                <?php
                endwhile;
        wp_reset_query(); ?>
           
                </div>
            <?php
            endif;
    }
}
