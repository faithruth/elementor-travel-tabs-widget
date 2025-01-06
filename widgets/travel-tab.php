<?php
class Elementor_Travel_Tabs_Widget extends \Elementor\Widget_Base {

	public function get_name(): string {
		return 'travel_tabs';
	}

	public function get_title(): string {
		return esc_html__( 'Travel Tabs', 'elementor-addon' );
	}

	public function get_icon(): string {
		return 'eicon-tabs';
	}

	public function get_categories(): array {
		return [ 'general' ];
	}

	public function get_keywords(): array {
		return [ 'tabs', 'tourism', 'event', 'travel' ];
	}

	protected function register_controls(): void {

		// Content Tab Start

		$this->start_controls_section(
			'summary_tab',
			[
				'label' => __( 'Summary Tab', 'elementor-travel-tabs-widget' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'summary_title',
			[
				'type' => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Title', 'elementor-travel-tabs-widget' ),
				'placeholder' => esc_html__( 'Enter tab title', 'elementor-travel-tabs-widget' ),
                'default' => 'At a glance',
			]
		);
		$this->add_control(
			'activity_map',
			[
				'label' => esc_html__( 'Activity Map', 'elementor-travel-tabs-widget' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$summary_repeater = new \Elementor\Repeater();

		$summary_repeater->add_control(
			'day',
			[
				'label' => __( 'Day', 'elementor-travel-tabs-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Monday', 'elementor-travel-tabs-widget' ),
				'label_block' => true,
			]
		);

		$summary_repeater->add_control(
			'title',
			[
				'label' => __( 'Title', 'elementor-travel-tabs-widget' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Sample Title', 'elementor-travel-tabs-widget' ),
				'label_block' => true,
			]
		);

		$summary_repeater->add_control(
			'description',
			[
				'label' => __( 'Description', 'elementor-travel-tabs-widget' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'Sample description text here.', 'elementor-travel-tabs-widget' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'summary_items',
			[
				'label' => __( 'Summary Items', 'elementor-travel-tabs-widget' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $summary_repeater->get_controls(),
				'title_field' => '{{{ day }}} - {{{ title }}}',
			]
		);

		$this->end_controls_section();


		$this->tab_section( 'itinerary' );
		$this->tab_section( 'accommodation' );

		// Content Tab End

	}

    private function tab_section( $tab ) {
	    $this->start_controls_section(
		    $tab. '_tab',
		    [
			    'label' => __( ucfirst( $tab ) . ' Tab', 'elementor-travel-tabs-widget' ),
			    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
		    ]
	    );
	    $this->add_control(
		    $tab. '_title',
		    [
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'label' => esc_html__( 'Title', 'elementor-travel-tabs-widget' ),
			    'placeholder' => esc_html__( 'Enter tab title', 'elementor-travel-tabs-widget' ),
			    'default' => ucfirst( $tab ),
		    ]
	    );

	    $tab_repeater = new \Elementor\Repeater();

	    $tab_repeater->add_control(
		    'day',
		    [
			    'label' => __( 'Day', 'elementor-travel-tabs-widget' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'label_block' => true,
		    ]
	    );

	    $tab_repeater->add_control(
		    'title',
		    [
			    'label' => __( 'Title', 'elementor-travel-tabs-widget' ),
			    'type' => \Elementor\Controls_Manager::TEXT,
			    'label_block' => true,
		    ]
	    );
	    $tab_repeater->add_control(
		    'galley',
		    [
			    'label' => esc_html__( 'Add Images', 'elementor-travel-tabs-widget' ),
			    'type' => \Elementor\Controls_Manager::GALLERY,
			    'default' => [],
		    ]
	    );
	    $tab_repeater->add_control(
		    'details',
		    [
			    'label' => __( 'Details', 'elementor-travel-tabs-widget' ),
			    'type' => \Elementor\Controls_Manager::WYSIWYG,
			    'label_block' => true,
		    ]
	    );

	    $this->add_control(
		    $tab. '_items',
		    [
			    'label' => __( ucfirst( $tab ) . ' Items', 'elementor-travel-tabs-widget' ),
			    'type' => \Elementor\Controls_Manager::REPEATER,
			    'fields' => $tab_repeater->get_controls(),
			    'title_field' => '{{{ day }}} - {{{ title }}}',
		    ]
	    );

	    $this->end_controls_section();
    }
	protected function render(): void {
		$settings = $this->get_settings_for_display();
		?>
        <div id="travel-tab">
            <div class="travel-tab__nav">
                <ul class="travel-tab__nav-list">
                <?php
                if ( ! empty( $settings['summary_title'] ) ) {
                    ?>
                    <li class="travel-tab__nav-item"><a href="#summary_details"  class="travel-tab__nav-button" id="at-a-glance"> At a glance </a></li>
                    <?php
                }
                ?>
                <?php
                if ( ! empty( $settings['itinerary_title'] ) ) {
	                ?>
                    <li class="travel-tab__nav-item"><a href="#itinerary_details"  class="travel-tab__nav-button" id="itinerary"> <?php echo esc_attr__($settings['itinerary_title'] ); ?> </a></li>
	                <?php
                }
                ?>
                <?php
                if ( ! empty( $settings['accommodation_title'] ) ) {
	                ?>
                    <li class="travel-tab__nav-item"><a href="#accommodation_details"  class="travel-tab__nav-button" id="accommodation"> <?php echo esc_attr__($settings['accommodation_title'] ); ?> </a></li>
	                <?php
                }
                ?>
            </ul>
            </div>
            <div id="summary_details">
                <?php $this->summary_section( $settings['summary_items'], $settings['activity_map'], 'itinerary' ); ?>
            </div>
            <div id="itinerary_details">
            <?php $this->itinerary_section( $settings['itinerary_items'], 2,'accommodation' ); ?>
            </div>
            <div id="accommodation_details">
                <?php $this->itinerary_section( $settings['accommodation_items'],  3,'' ); ?>
            </div>
        </div>
		<?php
	}

    private function summary_section( $summary_items, $activity_map, $next_tab ) {
        ?>
        <div class="travel-tab__at-a-glance">
            <div class="travel-tab__at-a-glance-copy">
            <ul class="travel-tab__panel-list">
            <?php foreach ( $summary_items as $summary_item ) {
                ?>
               <li class="travel-tab__panel-item travel-tab__panel-item--glance">
                    <div class="travel-tab__day-wrap">
                        <span class="travel-tab__day travel-tab__day--glance"><?php echo $summary_item['day']; ?></span>
                    </div>
                    <div class="travel-tab__details">
                        <span class="travel-tab__place">
                            <?php echo $summary_item['title']; ?>
                        </span>
                        <?php echo $summary_item['description']; ?>
                    </div>
                </li>
               <?php
            }
            ?>
            </ul>
            <button class="button button--reversed next-tab" data-next="1" data-show=" . $next_tab . "><?php echo $next_tab; ?></button>
            </div>
            <div>
                <figure class="travel-tab__activity_map"><img src="<?php echo $activity_map['url']; ?>" alt="<?php echo $activity_map['alt']; ?>"></figure>
            </div>
        </div>
        <?php
    }

    private function itinerary_section( $tab_items, $tab_index, $next_tab ) {
        ?>
        <div class="travel-tab__accom-itin" id="details-tab">
            <ul class="travel-tab__panel-list">
                <?php foreach ( $tab_items as $tab_item ) { ?>
                <li class="travel-tab__panel-item">
                    <div class="travel-tab__day-wrap">
                        <span class="travel-tab__day"><?php echo $tab_item['day']; ?></span>
                    </div>
                    <div class="travel-tab__info">
                        <div class="travel-tab__accom-itin-header">
                            <p class="travel-tab__place">
                                <?php echo $tab_item['title']; ?>
                            </p>
                        </div>
                        <div class="travel-tab__accom-itin-copy">
                            <div class="travel-tab__slider">
                                <div class="travel-tab__slider-tns">
                                <?php
                                foreach ( $tab_item['galley']  as $image ) {
                                    ?>
	                                <figure class="travel-tab__slider-figure"><img class="travel-tab__slider-img" src="<?php echo $image['url']; ?>" alt="Lounge"></figure>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                            <div class="travel-tab__main">
                                <?php echo $tab_item['details']; ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php
                }
            ?>
            </ul>
            <?php
            if ( ! empty( $next_tab ) ) {
	            echo '<button class="button button--reversed next-tab" data-next="' . $tab_index . '" data-show=" . $next_tab . ">' . $next_tab . '</button>';
            }
            ?>
        </div>
        <?php
    }

	protected function content_template(): void {
		?>
        <#
        // Check if any of the titles are set; if not, do not render the widget.
        if ( '' === settings.summary_title && '' === settings.itinerary_title && '' === settings.accommodation_title ) {
        return;
        }
        #>

        <div id="travel-tab">
            <ul>
                <# if ( settings.summary_title ) { #>
                <li><a href="#summary_details">{{ settings.summary_title }}</a></li>
                <# } #>
                <# if ( settings.itinerary_title ) { #>
                <li><a href="#itinerary_details">{{ settings.itinerary_title }}</a></li>
                <# } #>
                <# if ( settings.accommodation_title ) { #>
                <li><a href="#accommodation_details">{{ settings.accommodation_title }}</a></li>
                <# } #>
            </ul>

            <div id="summary_details">
                <# if ( settings.summary_items.length ) { #>
                <div class="travel-tab__at-a-glance">
                    <div class="travel-tab__at-a-glance-copy">
                        <ul class="travel-tab__panel-list">
                            <# _.each( settings.summary_items, function( item ) { #>
                            <li class="travel-tab__panel-item travel-tab__panel-item--glance">
                                <div class="travel-tab__day-wrap">
                                    <span class="travel-tab__day travel-tab__day--glance">{{ item.day }}</span>
                                </div>
                                <div class="travel-tab__details">
                                    <span class="travel-tab__place">{{ item.title }}</span>
                                    {{{ item.description }}}
                                </div>
                            </li>
                            <# }); #>
                        </ul>
                    </div>
                </div>
                <# } #>
            </div>

            <div id="itinerary_details">
                <# if ( settings.itinerary_items.length ) { #>
                <div class="travel-tab__accom-itin">
                    <ul class="travel-tab__panel-list">
                        <# _.each( settings.itinerary_items, function( item ) { #>
                        <li class="travel-tab__panel-item">
                            <div class="travel-tab__day-wrap">
                                <span class="travel-tab__day">{{ item.day }}</span>
                            </div>
                            <div class="travel-tab__info">
                                <div class="travel-tab__accom-itin-header">
                                    <p class="travel-tab__place">{{ item.title }}</p>
                                </div>
                                <div class="travel-tab__accom-itin-copy">
                                    <div class="travel-tab__slider">
                                        <# _.each( item.gallery, function( image ) { #>
                                        <figure class="travel-tab__slider-figure">
                                            <img class="travel-tab__slider-img" src="{{ image.url }}" alt="">
                                        </figure>
                                        <# }); #>
                                    </div>
                                    <div class="travel-tab__main">
                                        {{{ item.details }}}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <# }); #>
                    </ul>
                </div>
                <# } #>
            </div>

            <div id="accommodation_details">
                <# if ( settings.accommodation_items.length ) { #>
                <div class="travel-tab__accom-itin">
                    <ul class="travel-tab__panel-list">
                        <# _.each( settings.accommodation_items, function( item ) { #>
                        <li class="travel-tab__panel-item">
                            <div class="travel-tab__day-wrap">
                                <span class="travel-tab__day">{{ item.day }}</span>
                            </div>
                            <div class="travel-tab__info">
                                <div class="travel-tab__accom-itin-header">
                                    <p class="travel-tab__place">{{ item.title }}</p>
                                </div>
                                <div class="travel-tab__accom-itin-copy">
                                    <div class="travel-tab__slider">
                                        <# _.each( item.gallery, function( image ) { #>
                                        <figure class="travel-tab__slider-figure">
                                            <img class="travel-tab__slider-img" src="{{ image.url }}" alt="">
                                        </figure>
                                        <# }); #>
                                    </div>
                                    <div class="travel-tab__main">
                                        {{{ item.details }}}
                                    </div>
                                </div>
                            </div>
                        </li>
                        <# }); #>
                    </ul>
                </div>
                <# } #>
            </div>
        </div>
		<?php
	}

}