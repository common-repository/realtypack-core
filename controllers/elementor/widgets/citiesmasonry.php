<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Elementor\Widgets;

use RTPC\controllers\RTPC_Controllers_Public as controller;

/**
 * Elementor Listing Search widget.
 *
 * @since 1.0.0
 */
class RTPC_Controllers_Elementor_Widgets_CitiesMasonry extends \Elementor\Widget_Base {

    /**
     * [$locations for storing locations]
     * @var [array]
     */
    protected $locations;


    /**
     * Get cities masonty name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
    	return 'cities_masonry';
    }

    /**
     * Get cities masonty title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
    	return __( 'Cities Masonry', 'realty-pack-core' );
    }

    /**
     * Get cities masonty icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
    	return 'eicon-gallery-grid realtypack-flag';
    }

    /**
     * Get cities masonty keywords.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
    	return ['search'];
    }

    /**
     * Get cities masonty category.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_categories() {
    	return array('RTPC_catergory');
    }

    /**
     * Register cities masonry controls.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function _register_controls() {

    	$this->start_controls_section(
    		'content_section',
    		array(
    			'label' => __( 'Cities Configuration', 'realty-pack-core' ),
    			'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    		)
    	);

	    	$this->add_control( 
	    		'kind', 
	    		array(
	    			'label' => esc_html__('Kind', 'realty-pack-core'),
	    			'type' => \Elementor\Controls_Manager::SELECT,
	    			'options' => array(
	    				'country'  => __( 'Country', 'realty-pack-core' ),
	    				'state'    => __( 'State', 'realty-pack-core' ),
	    			),
	    			'default' => 0,
	    		)
	    	);

	    	$this->add_control(
	    		'country_selection',
	    		array(
	    			'label' => __( 'Choose Country', 'realty-pack-core' ),
	    			'type' => \Elementor\Controls_Manager::SELECT2,
	    			'multiple' => true,
	    			'options' => $this->get_location('location1_name'),
	    			'default' => '',
	    			'condition'    => array (
	    				'kind' => 'country',
	    			),
	    		)
	    	);        

	    	$this->add_control(
	    		'state_selection',
	    		array(
	    			'label' => __( 'Choose State', 'realty-pack-core' ),
	    			'type' => \Elementor\Controls_Manager::SELECT2,
	    			'multiple' => true,
	    			'options' => $this->get_location('location2_name'),
	    			'default' => '',
	    			'condition'    => array(
	    				'kind' => 'state',
	    			),
	    		)
	    	);

	    	$this->add_control(
	    		'items',
	    		array(
	    			'label'       => __('Number of Items to Show', 'realty-pack-core'),
	    			'label_block' => true,
	    			'type'        => \Elementor\Controls_Manager::NUMBER,
	    			'default'     => '6',
	    			'min'         => 1,
	    			'step'        => 1
	    		)
	    	);

    	$this->end_controls_section();

    }

    /**
     * Render listing search widget output on the frontend.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
    	$settings = $this->get_settings_for_display();

    	$kind               = isset( $settings['kind'] )                ?   $settings['kind']               : '';
    	$country_selection  = isset( $settings['country_selection'] )   ?   $settings['country_selection']  : '';
    	$state_selection    = isset( $settings['state_selection'] )     ?   $settings['state_selection']    : '';
    	$items              = isset( $settings['items'] )               ?   $settings['items']              : '';

    	echo controller::render_template(
    		'widgets/cities-masonry.php',
    		array(
    			'kind'              =>  $kind,
    			'country_selection' =>  $country_selection,
    			'state_selection'   =>  $state_selection,
    			'items'             =>  $items,
    		),
    		'always'
    	);

    }

    protected function _content_template() {
    	?>
    	<p>{{{ settings.item_description }}}</p>
    	<?php
    }    

    public function get_location( $type ) {

    	if ( isset( $this->locations[$type] ) ) {
    		return $this->locations[$type];
    	}

    	$locations = \wpl_db::select("SELECT `$type` FROM `#__wpl_properties`" , 'loadAssocList');

    	$location_list = array();

    	foreach ( $locations as $locationkey => $location ) {
    		if ( $location[$type] !== null ) {
    			$location_list[$location[$type]] = $location[$type];
    		}
    	}

    	$this->locations[$type] = array_unique( $location_list );

    	return $this->locations[$type];
    }

}