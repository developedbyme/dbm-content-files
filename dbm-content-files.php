<?php
/*
	Plugin Name: DBM content files
	Plugin URI: http://developedbyme.com
	Description: Files functionality for DBM content
	Version: 0.1.0
	Author: Mattias Ekenedahl
	Author URI: http://developedbyme.com
	License: MIT
*/



/* ====================================================================
|  SETUP AND GENERAL
|  General features and setup actions
'---------------------------------------------------------------------- */

define("DBM_CONTENT_FILES_VERSION", "0.1.0");
define("DBM_CONTENT_FILES_DOMAIN", "dbm-content-files");
define("DBM_CONTENT_FILES_TEXTDOMAIN", "dbm-content-files");
define("DBM_CONTENT_FILES_MAIN_FILE", __FILE__);
define("DBM_CONTENT_FILES_DIR", untrailingslashit( dirname( __FILE__ )  ) );
define("DBM_CONTENT_FILES_URL", untrailingslashit( plugins_url('',  __FILE__ )  ) );

// Plugin textdomain: dbm-content-files
function dbm_content_files_load_textdomain() {
	
	load_plugin_textdomain( DBM_CONTENT_FILES_TEXTDOMAIN, false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );

}
add_action( 'plugins_loaded', 'dbm_content_files_load_textdomain' );

require_once( DBM_CONTENT_FILES_DIR . "/libs/DbmContentFiles/bootstrap.php" );
//require_once('vendor/autoload.php');

global $DbmContentFilesPlugin;
$DbmContentFilesPlugin = new \DbmContentFiles\Plugin();

require_once( DBM_CONTENT_FILES_DIR . "/external-functions.php" );

function dbm_content_files_plugin_activate() {
	global $DbmContentFilesPlugin;
	$DbmContentFilesPlugin->activation_setup();
}
register_activation_hook( __FILE__, 'dbm_content_files_plugin_activate' );

?>