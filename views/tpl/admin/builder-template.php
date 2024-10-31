<!-- @temperory -->
<style type="text/css">
	.rtpc-single-builder-continer {display: none;}
</style>

<div class="rtpc-single-builder-continer" id="rtpc-single-builder-continer">
	<div class="rtpc-new-sp-header">
		<span> 
			<?php esc_html_e( 'New Template', 'realty-pack-core' ); ?>
		</span>
	</div>
	<div class="rtpc-new-sp-content">
		<div class="rtp-col-md-6 rtpc-new-sp-content-data">
			<h3> 
				<?php esc_html_e( 'NEW TEMPLATE', 'realty-pack-core' ); ?>
			</h3>
			<h2>
				<?php esc_html_e( 'Template Help Your Work', 'realty-pack-core' ); ?>
			</h2>
			<p>
				<?php esc_html_e( 'Template builder, You can create and customize your single with elementor page builder which listed in right form and after that you can select your template to show in customizer.', 'realty-pack-core' ); ?>
			</p>
		</div>
		<div class="rtp-col-md-6 rtpc-new-sp-content-form-container">
			<div class="rtpc-new-sp-content-form">
				<div class="rtpc-new-sp-content-form-header">   
					<?php esc_html_e( 'Choose Template Type', 'realty-pack-core' ); ?>
				</div>
				<div class="rtpc-select-cointainer">
					<label for="rtpc-template-type" class="rtpc-template-type-select-label">
						<?php esc_html_e( 'Select the type of template you want to work on', 'realty-pack-core' ); ?>
					</label>
					<select id="rtpc-template-type" class="rtpc-template-type-select" required>
						<option value="">
							<?php esc_html_e( 'Select', 'realty-pack-core' ); ?>...
						</option>
						<option value="property_builder">
							<?php esc_html_e( 'Property', 'realty-pack-core' ); ?>
						</option>
						<option value="agency_builder">
							<?php esc_html_e( 'Agency', 'realty-pack-core' ); ?>
						</option>
						<option value="agent_builder">
							<?php esc_html_e( 'Agent', 'realty-pack-core' ); ?>
						</option>
						<option value="footer_builder">
							<?php esc_html_e( 'Footer', 'realty-pack-core' ); ?>
						</option>
					</select>
				</div>

				<div class="rtpc-post-title-container">

					<label for="rtpc-title-text" class="rtpc-title-label">
						<?php esc_html_e( 'Name your template', 'realty-pack-core' ); ?>
					</label>

					<div class="rtpc-post-title">
						<input type="text" name="rtpc-title-text" id="rtpc-title-text" placeholder="<?php esc_attr_e( 'Enter template name (optional)', 'realty-pack-core' ); ?>">
					</div>

				</div>

				<div class="rtpc-new-sp-button">
					<a href="#" id="rtpc-template-submit" class="">
						<span><?php esc_html_e( 'CREATE TEMPLATE', 'realty-pack-core' ); ?></span>
					</a>
				</div>

				<span class="rtpc-message"></span>
			</div>
		</div>
	</div>
</div>