<?php
class Elementor_Travel_Pricing_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'pricing_widget';
	}

	public function get_title() {
		return __('Pricing Widget', 'plugin-name');
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return ['general'];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('Content', 'plugin-name'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'duration',
			[
				'label' => __('Duration', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('9', 'plugin-name'),
			]
		);

		$this->add_control(
			'period',
			[
				'label' => __('Period', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('days', 'plugin-name'),
			]
		);

		$this->add_control(
			'price_prefix',
			[
				'label' => __('Price Prefix', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('from', 'plugin-name'),
			]
		);

		$this->add_control(
			'price',
			[
				'label' => __('Price', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('$10,755 USD', 'plugin-name'),
			]
		);

		$this->add_control(
			'per_person_label',
			[
				'label' => __('Per Person Label', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __('per person', 'plugin-name'),
			]
		);

		$this->add_control(
			'layout',
			[
				'label' => __('Layout', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'horizontal' => __('Horizontal', 'plugin-name'),
					'vertical' => __('Vertical', 'plugin-name'),
				],
				'default' => 'horizontal',
			]
		);

		$this->end_controls_section();

		// START STYLE SECTION
		$this->start_controls_section(
			'style_section',
			[
				'label' => __('Style', 'plugin-name'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		// GENERAL TEXT COLOR
		$this->add_control(
			'text_color',
			[
				'label' => __('Text Color', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-widget' => 'color: {{VALUE}};',
				],
			]
		);

		// GENERAL BORDER
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .pricing-widget',
			]
		);

		// GENERAL BACKGROUND COLOR
		$this->add_control(
			'background_color',
			[
				'label' => __('Background Color', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .pricing-widget' => 'background-color: {{VALUE}};',
				],
			]
		);

		// TYPOGRAPHY CONTROLS FOR EACH FIELD
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'duration_typography',
				'label' => __('Duration Typography', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-duration',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'duration_border',
				'label' => __('Duration border', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-duration',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'period_typography',
				'label' => __('Period Typography', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-period',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_prefix_typography',
				'label' => __('Price Prefix Typography', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-price-prefix',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'label' => __('Price Typography', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-price',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'per_person_label_typography',
				'label' => __('Per Person Label Typography', 'plugin-name'),
				'selector' => '{{WRAPPER}} .pricing-label',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$layout_class = $settings['layout'] === 'horizontal' ? 'pricing-widget-horizontal' : 'pricing-widget-vertical';

		echo '<div class="pricing-widget ' . esc_attr($layout_class) . '">';
		echo '<div class="pricing-duration">' . esc_html($settings['duration']) . '<span class="pricing-period"> ' . esc_html($settings['period']) . '</span></div> ';
		echo '<div class="pricing-price-prefix">' . esc_html($settings['price_prefix']) . '</div> ';
		echo '<div class="pricing-price">' . esc_html($settings['price']) . '</div> ';
		echo '<div class="pricing-label">' . esc_html($settings['per_person_label']) . '</div>';
		echo '</div>';
	}
}
