<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Controllers\Admin;
use RTPC\RTPC_Lib_Actions as Actions;

class RTPC_Controllers_Admin_Rating extends RTPC_Controllers_Admin_Admin {

    /**
     * Constructor
     *
     * @since    1.0.0
     */
    protected function __construct() {
        Actions::add_action( 'wp', $this, 'register_hook_callbacks' );
    }

    /**
     * Register callbacks for actions and filters
     *
     * @since    1.0.0
     */
    public function register_hook_callbacks() {

        global $post;

        if ( get_post_type() === 'agency' ) {

            add_action( 'comment_form_logged_in_after', array( $this, 'RTPC_show_rating_input' ), 10, 1 );
            add_action( 'comment_form_after_fields', array( $this, 'RTPC_show_rating_input' ), 10, 1);
            add_action( 'comment_post', array( $this, 'RTPC_save_rating' ), 10, 1 );
            // add_filter('comment_form_top', array($this, 'RTPC_display_rating'), 10, 1);
        }

    }

    /**
     * [RTPC_show_rating_input Create the rating interface]
     * @return [null]
     */
    public function RTPC_show_rating_input() {
		?>
		<label for="rating">Rating<span class="required">*</span></label>
		<fieldset class="comments-rating">
			<span class="rating-container">
				<?php for ($i = 5; $i >= 1; $i--): ?>
					<input type="radio" id="rating-<?php echo esc_attr($i); ?>" name="rating"
					value="<?php echo esc_attr($i); ?>" /><label
					for="rating-<?php echo esc_attr($i); ?>"><?php echo esc_html($i); ?></label>
				<?php endfor;?>
				<input type="radio" id="rating-0" class="star-cb-clear" name="rating" value="0" /><label
				for="rating-0">0</label>
			</span>
		</fieldset>
		<?php
    }

    /**
     * [RTPC_save_rating Save the rating submitted by the user]
     * @param  [int] $comment_id [comment id]
     * @return [null]
     */
    public function RTPC_save_rating( $comment_id ) {

        if ( ( isset( $_POST['rating'] ) ) && ('' !== $_POST['rating'] ) ) {
            $rating = intval( $_POST['rating'] );
        }

        add_comment_meta($comment_id, 'RTPC_rating', $rating);
    }
}