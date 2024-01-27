<?php
class Elementor_Repeater_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'hello_world_widget_1';
    }

    public function get_title()
    {
        return esc_html__('Repeater Raju', 'elementor-addon');
    }

    public function get_icon()
    {
        return 'eicon-code';
    }

    public function get_categories()
    {
        return ['basic'];
    }

    public function get_keywords()
    {
        return ['hello', 'world'];
    }

    protected function _register_controls()
    {
        // Categories Section
        $this->start_controls_section(
            'section_categories',
            [
                'label' => __('Categories', 'elementor'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'category_title',
            [
                'label' => __('Category Title', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Category Title', 'elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'categories',
            [
                'label' => __('Categories List', 'elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ category_title }}}',
            ]
        );

        $this->end_controls_section();

        // Services Section
        $this->start_controls_section(
            'section_services',
            [
                'label' => __('Services', 'elementor'),
            ]
        );

        $serviceRepeater = new \Elementor\Repeater();

        $serviceRepeater->add_control(
            'category_title',
            [
                'label' => __('Category', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('category-name', 'elementor'),
                'label_block' => true,
            ]
        );

        $serviceRepeater->add_control(
            'service_title',
            [
                'label' => __('Service Title', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Service Title', 'elementor'),
                'label_block' => true,
            ]
        );

        $serviceRepeater->add_control(
            'service_price',
            [
                'label' => __('Price', 'elementor'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('40,00', 'elementor'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'services',
            [
                'label' => __('Services List', 'elementor'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $serviceRepeater->get_controls(),
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if ($settings['categories']) {
            foreach ($settings['categories'] as $category) {
                echo '<div class="category">';
                echo '<h3> <b>Category Title:</b> ' . $category['category_title'] . '</h3>';

                foreach ($settings['services'] as $service) {
                    if ($category['category_title'] === $service['category_title']) {
                        echo '<div class="service">';
                        echo '<p> <b>Service Details:</b> ' . $service['service_title'] . ' - ' . $service['service_price'] . '</p>';
                        echo '</div>';
                    }
                }

                echo '</div>';
            }
        }
    }

    protected function content_template()
    {
        ?>
        <# if ( settings.categories.length ) { #>
            <div class="categories-container">
                <# _.each( settings.categories, function( category ) { #>
                    <div class="category">
                        <h3>{{{ category.category_title }}}</h3>
                        <# _.each( settings.services, function( service ) { #>
                            <# if ( category.category_title===service.category_title ) { #>
                                <div class="service">
                                    <p>{{{ service.service_title }}} - {{{ service.service_price }}}</p>
                                </div>
                                <# } #>
                                    <# }); #>
                    </div>
                    <# }); #>
            </div>
            <# } #>
                <?php
    }
}
