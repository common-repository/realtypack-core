<?php
/**
 * Add widget.
 *
 * @package EightQueens\Framework\Admin
 *
 * @since   1.0.0
 */
namespace RTPC\Controllers\Admin\Widgets;

class RTPC_Controllers_Admin_Widgets_Posts extends \WP_Widget {

    public function __construct() {
        parent::__construct( false, $name = 'RealtyPack - Recent posts' );
    }

    public function widget($args, $instance) {
        extract($args);
        $title  = $instance['title'];
        $number = $instance['number'];
        $date   = $instance['date'];
        $image  = $instance['image'];

        $args = array(
            'number' => $number,
            'date'   => $date,
            'image'  => $image,
        );
        
        $query = array(
            'posts_per_page'      => $args['number'],
			'no_found_rows'       => true,
			'post_status'         => 'publish',
            'ignore_sticky_posts' => true,
            'order'               => 'DESC',

        );

        $recent_posts = new \WP_Query($query);
        
        if ( ! $recent_posts->have_posts() ) {
			return;
		}

        rtp_open_markup_e('rtp_widget_container', 'div', array('class' => 'rtp-widget-container'));

        if ( !empty( $instance['title'] ) ) {

            $w_title = $instance['title'];

            rtp_open_markup_e('rtp_widget_title', 'h3', array('class' => 'rtp-widget-title'));

                rtp_output_e('rtp_widget_title', $w_title);

                rtp_open_markup_e('rtp_widget_divider', 'span', array('class' => 'rtp-widget-divider'));
                rtp_close_markup_e('rtp_widget_divider', 'span');

            rtp_close_markup_e('rtp_widget_title', 'h3');

        }


        rtp_open_markup_e('rtp_recent_post_container', 'div', array('class' => 'rtp-recent-posts-container'));

        foreach ($recent_posts->posts as $post) {

            rtp_open_markup_e('rtp_recent_post', 'div', array('class' => 'rtp-recent-post'));

            if ( has_post_thumbnail() && $args['image'] ) {
                $image_small = RTP_Image::rtp_get_post_attachment($post->ID, 'thumbnail');
                rtp_selfclose_markup_e(
                    'rtp_recent_post_image',
                    'img',
                    $image_small
                );
            }

            rtp_open_markup_e('rtp_recent_post_section', 'div', array('class' => 'rtp-recent-post-section'));

            if ($args['date']) {
                rtp_open_markup_e('rtp_recent_post_date', 'span', array('class' => 'rtp-recent-post-date'));
                rtp_output_e('rtp_recent_post_date', the_time('F j, Y'));
                rtp_close_markup_e('rtp_recent_post_date', 'span');
            }

            rtp_open_markup_e('rtp_recent_post_title', 'a', array(
                'class' => 'rtp-recent-post-title',
                'href'  => get_post_permalink($post->ID),
            ));

            rtp_output_e('rtp_recent_post_title', the_title());
            rtp_close_markup_e('rtp_recent_post_title', 'a');

            rtp_close_markup_e('rtp_recent_post_section', 'div');

            rtp_close_markup_e('rtp_recent_post', 'div');
        }

        rtp_close_markup_e('rtp_recent_post_container', 'div');
        rtp_close_markup_e('rtp_widget_container', 'div');
        wp_reset_postdata();

    }

    public function update($new_instance, $old_instance) {
        $instance           = $old_instance;
        $instance['title']  = strip_tags($new_instance['title']);
        $instance['number'] = strip_tags($new_instance['number']);
        $instance['date']   = strip_tags($new_instance['date']);
        //$instance['author'] = strip_tags($new_instance['author']);
        $instance['image'] = strip_tags($new_instance['image']);

        return $instance;
    }

    public function form($instance) {
        $instance = wp_parse_args((array) $instance, array(
            'title'  => __('Latest from blog','realtypack'),
            'date'  => true,
            'number' => '4',
            'image' => true,
        ));

        $date   = esc_attr($instance['date']);
        $image  = esc_attr($instance['image']);

        ?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>">
			<?php _e('Title:','realtypack');?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>"
			name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('number') ); ?>">
			<?php _e('Number of posts to display','realtypack');?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('number') ); ?>"
			name="<?php echo esc_attr( $this->get_field_name('number') ); ?>" type="text" value="<?php echo esc_attr( $instance['number'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('date') ); ?>">
			<?php _e('Display post date:','realtypack');?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('date') ); ?>"
			name="<?php echo esc_attr( $this->get_field_name('date') ); ?>" type="checkbox" <?php if ($date) {echo "checked" ;};?> />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id('image') ); ?>">
			<?php _e('Display post image:','realtypack');?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id('image') ); ?>"
			name="<?php echo esc_attr( $this->get_field_name('image') ); ?>" type="checkbox" <?php if ($image) {echo "checked" ;};?> />
		</p>

	<?php
	}

}