<?php
/**
 * Add widget.
 *
 * @package EightQueens\Framework\Admin
 *
 * @since   1.0.0
 */
namespace RTPC\Controllers\Admin\Widgets;

class RTPC_Controllers_Admin_Widgets_Social extends \WP_Widget {

	public function __construct() {
		parent::__construct( false, $name = 'RealtyPack - Social' );
	}

	function widget($args, $instance) {
		extract($args);
		$title  	= $instance['title'];
		$facebook 	= $instance['facebook'];
		$instagram  = $instance['instagram'];
		$twitter  	= $instance['twitter'];

		$args = array(
			'facebook' 	=> $facebook,
			'instagram'  => $instagram,
			'twitter'  	=> $twitter,
		);

		rtp_open_markup_e('rtp_widget_container', 'div', array('class' => 'rtp-widget-container'));

		if ( ! empty( $instance['title'] ) ) {

			$w_title = $instance['title'];

			rtp_open_markup_e('rtp_widget_title', 'h3', array('class' => 'rtp-widget-title'));
			rtp_output_e('rtp_widget_title', $w_title);
			rtp_open_markup_e('rtp_widget_divider', 'span', array('class' => 'rtp-widget-divider'));
			rtp_close_markup_e('rtp_widget_divider', 'span');
			rtp_close_markup_e('rtp_widget_title', 'h3');

		}


		rtp_open_markup_e('rtp_social_container', 'div', array('class' => 'rtp-social-widget-container'));

		if ( $args['facebook'] ){
			rtp_open_markup_e('rtp_social_box', 'div', array('class' => 'rtp-social-widget'));

			rtp_open_markup_e(
				'rtp_social_facebook_link',
				'a',
				array(
                    'href'  => $args['facebook'], // Automatically escaped.
                    'title' => 'facebook',
                    'class' => 'rtp-social-facebook-link'

                )
			); 

			rtp_output_e('rtp_social_facebook_link', __('Facebook', 'realtypack'));
			rtp_open_markup_e('rtp_social_box_icon', 'i', array('class' => 'rtpf-facebook-square'));
			rtp_close_markup_e('rtp_social_box_icon', 'i');

			rtp_close_markup_e('rtp_social_facebook_link', 'a');

			rtp_close_markup_e('rtp_social_box', 'div');	

		}
		// Twitter
		if ( $args['twitter'] ){

			rtp_open_markup_e('rtp_social_box', 'div', array('class' => 'rtp-social-widget'));

			rtp_open_markup_e(
				'rtp_social_twitter_link',
				'a',
				array(
                    'href'  => $args['twitter'], // Automatically escaped.
                    'title' => 'twitter',
                    'class' => 'rtp-social-twitter-link'
                )
			);  
			rtp_output_e('rtp_social_twitter_link', __('Twitter', 'realtypack'));
			rtp_open_markup_e('rtp_social_box_icon', 'i', array('class' => 'rtpf-twitter'));
			rtp_close_markup_e('rtp_social_box_icon', 'i');

			rtp_close_markup_e('rtp_social_twitter_link', 'a');

			rtp_close_markup_e('rtp_social_box', 'div');	

		}

		if ( $args['instagram'] ){

			rtp_open_markup_e('rtp_social_box', 'div', array('class' => 'rtp-social-widget'));

			rtp_open_markup_e(
				'rtp_social_instagram_link',
				'a',
				array(
                    'href'  => $args['instagram'], // Automatically escaped.
                    'title' => 'instagram',
                    'class' => 'rtp-social-instagram-link'
                )
			);

			rtp_output_e('rtp_social_instagram_link', __('Instagram', 'realtypack'));
			rtp_open_markup_e('rtp_social_box_icon', 'i', array('class' => 'rtpf-instagram'));
			rtp_close_markup_e('rtp_social_box_icon', 'i');

			rtp_close_markup_e('rtp_social_instagram_link', 'a');
			rtp_close_markup_e('rtp_social_box', 'div');	
		}

		rtp_close_markup_e('rtp_social_container', 'div');		
		rtp_close_markup_e('rtp_widget_container', 'div');

	}

	function update($new_instance, $old_instance) {

		$instance           = $old_instance;
		$instance['title']  = strip_tags($new_instance['title']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['instagram']   = strip_tags($new_instance['instagram']);
        //$instance['author'] = strip_tags($new_instance['author']);
		$instance['twitter']  = strip_tags($new_instance['twitter']);

		return $instance;
	}

	function form($instance) {

		$instance = wp_parse_args((array) $instance, array(
			'title'  => __('Social','realtypack'),
			'facebook'  => __('Facebook link','realtypack'),
			'instagram'  => __('Instagram link','realtypack'),
			'twitter'  => __('Twitter link','realtypack'),

		));

		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
				<?php esc_html_e('Title:','realtypack');?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>">
				<?php esc_html_e('Facebook link:','realtypack');?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" type="text" value="<?php echo esc_attr( $instance['facebook'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>">
				<?php esc_html_e( 'Instagram link:','realtypack' );?>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram') ); ?>" type="text" value="<?php echo esc_attr( $instance['instagram'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>">
				<?php esc_html_e('Twitter link:','realtypack');?>
			</label>

			<input class="widefat" id="<?php echo esc_attr(  $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" type="text" value="<?php echo esc_attr( $instance['twitter'] ); ?>" />
			</p>
		<?php
	}

}

?>