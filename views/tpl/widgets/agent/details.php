<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
?>
<div class="rtpc-single-agent-details-container">
    <?php if ( 'yes' == $settings['agent_phone'] && '' !== $agent_phone ): ?>
        <div class="rtpc-single-agent-detail">
            <label>
                <?php esc_html_e('Phone :', 'realty-pack-core'); ?>
            </label>
            <span>
                <?php echo esc_html( $agent_phone ); ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( $settings['agent_email'] == 'yes' && '' !== $agent_email ): ?>
        <div class="rtpc-single-agent-detail">
            <label>
                <?php esc_html_e('Email :', 'realty-pack-core'); ?>
            </label>
            <span>
                <?php echo esc_html( $agent_email ); ?>
            </span>
        </div>
    <?php endif; ?>
    
    <?php if ( $settings['agent_mobile'] == 'yes' && '' !==  $agent_mobile ): ?>
        <div class="rtpc-single-agent-detail">
            <label>
                <?php esc_html_e('Mobile :', 'realty-pack-core'); ?>
            </label>
            <span>
                <?php echo $agent_mobile; ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( $settings['agent_fax'] == 'yes' && '' !== $agent_fax ): ?>
        <div class="rtpc-single-agent-detail">
            <label>
                <?php esc_html_e('Fax :', 'realty-pack-core'); ?>
            </label>
            <span>
                <?php echo $agent_fax; ?>
            </span>
        </div>            
    <?php endif; ?>

    <?php if ( $settings['agent_address'] == 'yes' && '' !== $agent_address ): ?>
        <div class="rtpc-single-agent-detail">
            <label>
                <?php esc_html_e('Address :', 'realty-pack-core'); ?>
            </label>
            <span>
                <?php echo $agent_address; ?>
            </span>
        </div>
    <?php endif; ?>

    <?php if ( $settings['listed_properties'] == 'yes' && '' !== $listed_properties ): ?>
        <a class="rtpc-single-agent-listed-properties">
            <?php echo sprintf( esc_html('%d Listed Properties', 'realty-pack-core'), $listed_properties); ?>
        </a>
    <?php endif; ?>

</div>

