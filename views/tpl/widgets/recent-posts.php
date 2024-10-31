<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-our-blog-container">
    <?php
    foreach ( $recent_posts->posts as $post ):
        $image_url 	=	wp_get_attachment_image_url( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
        $image      =   \RTP_Image::edit_attachment_media( null, $image_url, array( 640, 450 ) );
        $usermeta 	=	get_user_meta( $post->post_author );
        $fname    	=	$usermeta['first_name'][0];
        $lname    	=	$usermeta['last_name'][0];
        $nname    	=	$usermeta['nickname'][0];
        $full_name	=	'';

        if ( empty( $fname ) ) {
            $full_name = $fname;
        }

        if ( empty( $lname ) ) {
            $full_name = $full_name . ' ' . $lname;
        }

        if ( empty( $lname ) && empty( $fname ) ) {
            //both first name and last name are present
            $full_name = $nname;
        }

        $category = get_the_category( $post->ID );
        ?>
		<div class="rtpc-our-blog-post">
			<div class="rtpc-our-blog-post-image">
				<img src="<?php echo esc_url_raw( $image ); ?>"  alt="<?php echo esc_attr( get_the_title( $post->ID ) ); ?>"/>
			</div>
			<div class="rtpc-our-blog-post-details">
				<div class="rtpc-our-blog-post-details-header">
					<?php
					if ( $settings['show_date'] ) {
						echo '<span>' . get_the_time('F j, Y') . '</span>';
					}
					if ( $settings['show_category'] ) {
						echo '<span>' . $category[0]->name . '</span>';
					}
					if ( $settings['show_author'] ) {
						echo '<span>' . ucfirst ( $full_name ) . '</span>';
					}
					?>

				</div>
				<?php
				if ( $settings['show_shape'] ) {
					echo ('<span class="rtpc-our-blog-post-divider"></span>');
				}
				?>
				<div class="rtpc-our-blog-post-title">
					<a href="<?php echo get_post_permalink( $post->ID ); ?>">
						<?php echo get_the_title( $post->ID ) ?>
					</a>
				</div>
			</div>
		</div>
    <?php
    endforeach;
    wp_reset_postdata();
    ?>
</div>