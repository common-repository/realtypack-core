<div class="rtpc-admin">
	<header class="rtpc-admin-header">
		<div class="rtpc-admin-container">
	  		<div class="rtpc-admin-header-title">
	  			<img class="rtpc-admin-logo" src="<?php echo esc_url($logo); ?>" alt="">
		  		<h1 class="rtpc-admin-title"><?php esc_html_e( 'Welcome to RealtyPack', 'realty-pack-core' ); ?></h1>
		  		<div class="rtpc-admin-subtitle"><?php esc_html_e( 'Let’s convert your imaginations website in realt estate to real things on the web!', 'realty-pack-core' ); ?></div>
		  		<div class="rtpc-admin-version"><?php esc_html_e( 'Version', 'realty-pack-core' ); ?> <span><?php esc_html_e( RTPC_VERSION ); ?></span></div>
	  		</div>

			<ul class="rtpc-admin-nav rtpc-admin-clearfix">
				<li class="<?php if($page == 'realty-pack-core') echo "active" ?>">
					<a href="<?php echo admin_url( 'admin.php?page=realty-pack-core', 'admin' ) ?>"><?php esc_html_e( 'Dashboard', 'realty-pack-core' ); ?></a>
				</li>
				<li class="<?php if($page == 'realty-pack-core-importer') echo "active" ?>">
					<a href="<?php echo admin_url( 'admin.php?page=realty-pack-core-importer', 'admin' ) ?>"><?php esc_html_e( 'Demo Importer', 'realty-pack-core' ); ?></a>
				</li>				
				<li class="">
					<a href="<?php echo esc_url( admin_url( 'customize.php' ) ) ?>" target="_blank"><?php esc_html_e( 'Customizer', 'realty-pack-core' ); ?></a>
				</li>				
				<li class="<?php if($page == 'realtypack_builder') echo "active" ?>">
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=realtypack_builder', 'admin' ) ) ?>" ><?php esc_html_e( 'Single Builder', 'realty-pack-core' ); ?></a>
				</li>
				<li class="<?php if($page == 'realty-pack-core-plugins') echo "active" ?>">
					<a href="<?php echo admin_url( 'admin.php?page=realty-pack-core-plugins', 'admin' ) ?>"><?php esc_html_e( 'Plugins', 'realty-pack-core' ); ?></a>
				</li>
				<li class="<?php if($page == 'realty-pack-core-tutorials') echo "active" ?>">
					<a href="<?php echo admin_url( 'admin.php?page=realty-pack-core-tutorials', 'admin' ) ?>"><?php esc_html_e( 'Tutorials', 'realty-pack-core' ); ?></a>
				</li>
				<li class="<?php if($page == 'realty-pack-core-system-status') echo "active" ?>">
					<a href="<?php echo admin_url( 'admin.php?page=realty-pack-core-system-status', 'admin' ) ?>"><?php esc_html_e( 'System Status', 'realty-pack-core' ); ?></a>
				</li>
			</ul>
		</div>	
	</header>
	<div class="rtpc-admin-body">
		<div class="rtpc-admin-container">



