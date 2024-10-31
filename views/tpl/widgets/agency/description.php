<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agency-description">
	<?php echo wp_kses( 
		$description, 
		array(
			'a' => array(
				'href' => array(),
				'title' => array()
			),
			'p' => array(),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
		)
	); 
	?>
</div>

