<?php
/**
 * @link       https://eightqueens.pro
 * @since      1.0.0
 *
 * @package    RealtyPack Core
 */
namespace RTPC\Models\Admin\Dashboard;

use RTPC\Models\RTPC_Models_Model;
use RTPC\Models\RTPC_Models_DB;

class RTPC_Models_Admin_Dashboard_Importer extends RTPC_Models_Model {

	public $message;
	public $error_flag;
	public $theme_options_file;
    public $widgets;
    public $content_demo;
    private static $instance;

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	protected function __construct() {
		$this->register_hook_callbacks();
	}

	public function register_hook_callbacks() {}

    public function set_demo_data( $file, $attachment = false ) {

    	if(!defined('WP_LOAD_IMPORTERS')) define('WP_LOAD_IMPORTERS', true);

    	require_once ABSPATH . 'wp-admin/includes/import.php';

    	if( ! class_exists( 'WP_Importer' ) ) {
    		$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

    		if( file_exists( $class_wp_importer ) ) {
    			require_once( $class_wp_importer );
    		} else {
    			$this->message = __( 'Error while including WP Importer class.', 'realty-pack' ); 
    			$this->error_flag = true;
    		}
    	}

    	if( ! class_exists( 'WP_Import' ) ) {

    		$class_wp_import = RTPC_PATH .'app/importer/wordpress-importer.php';

    		if( file_exists( $class_wp_import ) ) {
    			require_once($class_wp_import);
    		} else {
    			$this->message = __( 'Error while including WP Import class.', 'realty-pack' ); 
    			$this->error_flag = true;
    		}
    	}

    	if( $this->error_flag ) {
            return;
        } else {
    		if( is_file( $file ) ) {
    			@set_time_limit(0);
    			$wp_import = new \WP_Import();
    			$wp_import->fetch_attachments = $attachment;
                ob_start();
                $wp_import->import( $file );   
                ob_end_clean();
                $this->message = __( 'Files are imported successfully.', 'realty-pack' ); 
                $this->error_flag = false;
    		}
    	}

    	return;
    }

    public function set_demo_menus() {

    }

    function process_widget_import_file( $file_json ){
	    // Does the File exist?
    	if( file_exists( $file_json ) ) {
	        // Get file contents and decode
    		$data = file_get_contents( $file_json );
    		$data = json_decode( $data );
    		$results = $this->import_widgets( $data );

    		return array( 'error' => $this->error_flag, 'message' => $this->message );

    	} else {
    		return array( 'error' => false, 'message' => esc_html_e( 'Widgets could not import.', 'realty-pack' ) );
    	}
    }

    public function import_widgets( $data ) {
    	global $wp_registered_sidebars;

    	$widget_message = $widget_message_type = ''; 
        // Have valid data?
    	if( empty( $data ) || !is_object( $data ) ){
    		return false;
    	}

        // Get all available widgets site supports
    	$available_widgets = $this->available_widgets();

        // Get all existing widget instances
    	$widget_instances = array();
    	foreach( $available_widgets as $widget_data ) {
    		$widget_instances[ $widget_data[ 'id_base' ] ] = get_option( 'widget_' . $widget_data[ 'id_base' ] );
    	}

    	// Remove default widgets
    	$widgets = get_option( 'sidebars_widgets' );
    	$widgets['wp_inactive_widgets'] = $widgets['sidebar_primary'];
    	$widgets['sidebar_primary'] 	= array();
    	update_option( 'sidebars_widgets', $widgets );

        // Begin results
    	$results = array();

        // Loop import data's sidebars
    	foreach( $data as $sidebar_id => $widgets ) {
            // Skip inactive widgets
    		if( 'wp_inactive_widgets' == $sidebar_id ) { 
    			continue;
    		}

            // Check if sidebar is available on this site
    		if( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
    			$sidebar_available = true;
    			$use_sidebar_id = $sidebar_id;
    			$sidebar_message_type = 'success';
    			$sidebar_message = '';
    		} else {
    			$sidebar_available = false;
                $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                $sidebar_message_type = 'error';
                $sidebar_message = __('Sidebar does not exist in theme (using Inactive)', 'radium');
            }

            // Result for sidebar
            $results[$sidebar_id]['name'] = !empty( $wp_registered_sidebars[ $sidebar_id ][ 'name'] ) ? $wp_registered_sidebars[ $sidebar_id ][ 'name' ] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
            $results[ $sidebar_id ][ 'message_type' ]	= $sidebar_message_type;
            $results[ $sidebar_id ][ 'message' ] 		= $sidebar_message;
            $results[ $sidebar_id ][ 'widgets' ]		= array();

            // Loop widgets
            foreach( $widgets as $widget_instance_id => $widget ) {
            	$fail = false;

                // Get id_base (remove -# from end) and instance ID number
            	$id_base = preg_replace('/-[0-9]+$/', '', $widget_instance_id);
            	$instance_id_number = str_replace($id_base . '-', '', $widget_instance_id);

                // Does site support this widget?
            	if( !$fail && ! isset( $available_widgets[ $id_base ] ) ) {
            		$fail = true;
            		$widget_message_type = 'error';
                    $widget_message = __('Site does not support widget', 'radium'); // explain why widget not imported
                }

                // Does widget with identical settings already exist in same sidebar?
                if( !$fail && isset( $widget_instances[ $id_base ] ) ) {
                    // Get existing widgets in this sidebar
                	$sidebars_widgets = get_option('sidebars_widgets');
                    $sidebar_widgets = isset($sidebars_widgets[$use_sidebar_id]) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go

                    // Loop widgets with ID base
                    $single_widget_instances = !empty($widget_instances[$id_base]) ? $widget_instances[$id_base] : array();
                    foreach( $single_widget_instances as $check_id => $check_widget ) {
                        // Is widget in same sidebar and has identical settings?
                    	if( in_array( "$id_base-$check_id", $sidebar_widgets ) && json_decode( json_encode( $widget ), true ) == $check_widget ) {
                    		$fail = true;
                    		$widget_message_type = 'warning';
                            $widget_message = __( 'Widget already exists', 'radium' ); // explain why widget not imported

                            break;
                        }
                    }
                }

                // No failure
                if( !$fail ) {
                    // Add widget instance
                    $single_widget_instances = get_option('widget_' . $id_base); // all instances for that widget ID base, get fresh every time

                    $single_widget_instances = !empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to

                    $single_widget_instances[] = json_decode( json_encode( $widget ), true ); // add it

                    // Get the key it was given
                    end( $single_widget_instances );
                    $new_instance_id_number = key( $single_widget_instances );

                    // If key is 0, make it 1
                    // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                    if( '0' === strval( $new_instance_id_number ) ) {
                    	$new_instance_id_number = 1;
                    	$single_widget_instances[ $new_instance_id_number ] = $single_widget_instances[0];
                    	unset( $single_widget_instances[0] );
                    }

                    // Move _multiwidget to end of array for uniformity
                    if( isset( $single_widget_instances[ '_multiwidget' ] ) ) {
                    	$multiwidget = $single_widget_instances[ '_multiwidget' ];
                    	unset( $single_widget_instances[ '_multiwidget' ] );
                    	$single_widget_instances[ '_multiwidget' ] = $multiwidget;
                    }

                    // Update option with new widget
                    update_option( 'widget_' . $id_base, $single_widget_instances );

                    // Assign widget instance to sidebar
                    $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time

                    $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance

                    $sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar

                    update_option('sidebars_widgets', $sidebars_widgets); // save the amended data

                    // Success message
                    if( $sidebar_available ) {
                    	$this->message = __( 'Widgets imported successfully.', 'realty-pack' ); 
                    	$this->error_flag = false;
                    } else {
                    	$this->message = __( 'Widgets could not import successfully.', 'realty-pack' ); 
                    	$this->error_flag = false;
                    }
                }

                // Result for widget instance
                $results[ $sidebar_id ][ 'widgets' ][ $widget_instance_id ][ 'name' ] = isset( $available_widgets[ $id_base ][ 'name' ] ) ? $available_widgets[ $id_base ][ 'name' ] : $id_base; // widget name or ID if name not available (not supported by site)

                $results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : __('No Title', 'radium'); // show "No Title" if widget instance is untitled

                $results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;

                $results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
            }
        }

    	return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

	/**
	 * Available widgets
	 */
	function available_widgets() {
		global $wp_registered_widget_controls;
		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();
		foreach( $widget_controls as $widget ) {
			if( ! empty( $widget[ 'id_base' ] ) && !isset( $available_widgets[ $widget[ 'id_base' ] ] ) ) {
				$available_widgets[ $widget[ 'id_base' ] ][ 'id_base' ] = $widget[ 'id_base' ];
				$available_widgets[ $widget[ 'id_base' ] ][ 'name' ] 	= $widget[ 'name' ];
			}
		}

		return $available_widgets;
	}

    public function general_download_start( $url, $ext ) {
    	// Simple check
    	if ( !$url ) {
    		return false;
    	}

        // Download file first
    	$download_file = $this->download_to_temp( $url );
    	$content_file = $this->read( $download_file );

        // make directory
    	$dir = $this->create_temp_directory() . '/import.'. $ext;

    	if ( $content_file && $dir ) {

    		$write = $this->write( $dir, $content_file );

    		if ( false === $this->error_flag ) {
    			$this->message = $dir; 
    			$this->error_flag = false;
    			return array( 'error' => $this->error_flag, 'message' => $this->message );
    		}

    	}

        $this->message = __( 'Error while downloading process', 'realty-pack' ); 
    	$this->error_flag = true;

        // Unlink temp
        @unlink( $download_file );

    	return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function import_revslider( $file ) {

    	if ( file_exists( $file ) ) {
    		$slider = new \RevSlider();
    		$slider->importSliderFromPost( true, true, $file );

    		$this->message = __( 'Error while downloading process', 'realty-pack' ); 
    		$this->error_flag = false;

    	} else {
    		$this->message = __( 'Error while downloading process', 'realty-pack' ); 
    		$this->error_flag = true;
    	}


    	return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function start_download_zip( $url, $slug ) {
        // Simple check
        if ( !$url ) {
            return false;
        }

        // Download file first
        $download_file = $this->download_to_temp( $url );
        $unpack = $this->unpack_package( $download_file, $slug );

        if ( $download_file && $unpack ) {
        	$this->message = $unpack; 
        	$this->error_flag = false;
        	return array( 'error' => $this->error_flag, 'message' => $this->message );
        }

        $this->message = __( 'Error while downloading and unpacking process.', 'realty-pack' ); 
        $this->error_flag = true;

        return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function unpack_package( $package, $slug ) {
        global $wp_filesystem;
        // Initialize the WP filesystem, no more using 'file-put-contents' function
        if (empty($wp_filesystem)) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        // make directory
        $dir = trailingslashit( wp_upload_dir()['basedir'] ) . $slug;
        wp_mkdir_p( $dir );


        // Unzip package to working directory
        $result = unzip_file( $package, $dir );

        @unlink( $package );

        if ( is_wp_error( $result ) ) {
            $wp_filesystem->delete( $dir, true );
            if ( 'incompatible_archive' == $result->get_error_code() ) {
                return false;
            }
            return $result;
        }

        return $dir;
    }

    public function start_import_xml( $file, $attachment = false ) {
        if ( is_plugin_active('wordpress-importer/wordpress-importer.php') ) {
            deactivate_plugins( '/wordpress-importer/wordpress-importer.php' );
        }

        // Hello world
        wp_delete_post( 1, false );

        $result = $this->set_demo_data( $file, $attachment );

        return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function start_import_customizer( $file ) {

    	global $wp_customize;

    	if ( ! file_exists( $file ) ) {
    		$this->message = __( 'Import file is not exist.', 'realty-pack' ); 
    		$this->error_flag = true;
    	}

    	// Require class for import cusstomizer setting
    	require_once( RTPC_PATH .'app/importer/customizer.php' );

		// Get the upload data.
    	$raw  = file_get_contents( $file );
    	$data = @unserialize( $raw );

		// Import custom options.
    	if ( isset( $data['options'] ) ) {

    		foreach ( $data['options'] as $option_key => $option_value ) {

    			$cusomizer_option = new \RTPC_customizer_importer( $wp_customize, $option_key, array(
    				'default'		=> '',
    				'type'			=> 'option',
    				'capability'	=> 'customize'
    			) );

    			$cusomizer_option->import( $option_value );

    			$this->message = __( 'Import customizer option done.', 'realty-pack' ); 
    			$this->error_flag = false;
    		}
    	}

    	foreach ( $data['mods'] as $key => $val ) {

    		do_action( 'customize_save_' . $key, $wp_customize );

    		set_theme_mod( $key, $val );
    	}

    	return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function download_to_temp( $url ) {

        $download_file = download_url( $url );

        if( is_wp_error( $download_file ) ) {

        	$this->message = $download_file->get_error_message(); 
        	$this->error_flag = true;
            return false;

        } elseif ( file_exists( $download_file ) ) {

        	$this->error_flag = false;
        	$this->message = $download_file; 
            return $download_file;
        }

        $this->message = __( 'Error while downloading process', 'realty-pack' ); 
        $this->error_flag = true;
        return false;

    }

    public function create_temp_directory() {

        // make random name folder
        $random = 'tmp_'.md5( microtime( true ) );
        $directory = RTPC_ASSETS_PATH .'assets/admin/tmp/'. $random;

        $result = wp_mkdir_p( $directory );

        if ( $result ) {
            return $directory;
        }

        $this->message = __( 'Error while creating directory', 'realty-pack' ); 
        $this->error_flag = true;
        return false;
    }

    public function write( $path, $content ) {

    	$file = file_put_contents($path, $content);

    	if ( false === $file ) {
    		$this->message = __( 'Error while writing file', 'realty-pack' ); 
    		$this->error_flag = true;
    	}

    	return $file;
    }

    public function read( $path ) {

    	$file = file_get_contents( $path );

    	if ( false === $file ) {
    		$this->message = __( 'Error while reading file', 'realty-pack' ); 
    		$this->error_flag = true;
    	}

    	return $file;
    }

    public function import_wpl_properties() {
        global $wp_filesystem;
        // Initialize the WP filesystem, no more using 'file-put-contents' function
        if ( empty( $wp_filesystem ) ) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        // Check if wpl is not activate
        if ( ! defined('_WPLEXEC') ) {
            $this->message = __( 'Error while importing wpl properties.', 'realty-pack' ); 
            $this->error_flag = true;
            return array( 'error' => $this->error_flag, 'message' => $this->message );
        }

        $upload_path = get_option( 'realty_pack_importer_WPL_properties' );
        if ( file_exists( $upload_path . '/wpl.sql' ) ) {
            // Import properties
            $import = RTPC_Models_DB::process_sql( $upload_path . '/wpl.sql' );
            if ( $import ) {
                $this->message = __( 'Wpl Properties imported successfully.', 'realty-pack' ); 
                $this->error_flag = false;
                $delete = $wp_filesystem->delete( $upload_path . '/wpl.sql' );
            } else {
                $this->message = __( 'Wpl Properties can not import.', 'realty-pack' ); 
                $this->error_flag = true;
            }
        } else {
            $this->message = __( 'Import file dose not exist.', 'realty-pack' ); 
            $this->error_flag = true;
        }

        return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function import_wpl_agents_profile() {
        global $wp_filesystem;
        // Initialize the WP filesystem, no more using 'file-put-contents' function
        if ( empty( $wp_filesystem ) ) {
            require_once (ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        // Check if wpl is not activate
        if ( ! defined('_WPLEXEC') ) {
            $this->message = __( 'Error while importing WPL agents.', 'realty-pack' ); 
            $this->error_flag = true;
            return array( 'error' => $this->error_flag, 'message' => $this->message );
        }

        $upload_path = get_option( 'realty_pack_importer_WPL_agent' );

        if ( file_exists( $upload_path . '/users/wpl.sql' ) ) {
            // Import properties
            $import = RTPC_Models_DB::process_sql( $upload_path . '/users/wpl.sql' );
            if ( $import ) {
                $this->message = __( 'WPL agents imported successfully.', 'realty-pack' ); 
                $this->error_flag = false;
                $delete = $wp_filesystem->delete( $upload_path . '/users/wpl.sql' );
            } else {
                $this->message = __( 'WPL agents can not import.', 'realty-pack' ); 
                $this->error_flag = true;
            }
        } else {
            $this->message = __( 'Import file dose not exist.', 'realty-pack' ); 
            $this->error_flag = true;
        }

        return array( 'error' => $this->error_flag, 'message' => $this->message );
    }

    public function last_steps( $items ) {
    	global $wp_filesystem;
        // Initialize the WP filesystem, no more using 'file-put-contents' function
    	if ( empty( $wp_filesystem ) ) {
    		require_once (ABSPATH . '/wp-admin/includes/file.php');
    		WP_Filesystem();
    	}

    	// Set home page
    	$this->set_hom_page();
    	// Set permalinks
    	$this->set_permalinks();
    	// Flush rewrite rules
    	flush_rewrite_rules();
    	// Remove options and files
    	foreach ( $items as $field ) {
    		$file = '';
    		if ( isset( $field['type'] ) && !strpos( $field['type'], 'media' ) ) {
    			$file = get_option( 'realty_pack_importer_' . $field['type'] , false );
    		}
    		// delete file
    		if ( $wp_filesystem->exists( $file ) ) {
    			$delete = $wp_filesystem->rmdir( $file , true );
    		} else {
    			$delete = $wp_filesystem->delete( $file );
    		}
    		// delete option
    		if ( $delete ) {
    			delete_option( 'realty_pack_importer_' . $field['type'] );
    		}
    	}

    	// Remove folder
    	if ( is_dir( RTPC_ASSETS_PATH .'assets/admin/tmp' ) ) {
    		$wp_filesystem->rmdir( RTPC_ASSETS_PATH .'assets/admin/tmp', true );
    	}

    	return true;
    }

    public function set_hom_page() {

    	$home_page = get_page_by_title( 'home' );
    	if ( isset( $home_page->ID ) ) {
    		update_option( 'page_on_front', $home_page->ID );
    		update_option( 'show_on_front', 'page' );
    	}

    }

    function set_permalinks() {
    	global $wp_rewrite;
    	$wp_rewrite->set_permalink_structure( '/%postname%/' );
    }

}