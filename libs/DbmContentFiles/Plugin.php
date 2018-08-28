<?php
	namespace DbmContentFiles;
	
	use \DbmContentFiles\OddCore\PluginBase;
	
	class Plugin extends PluginBase {
		
		function __construct() {
			//echo("\DbmContentFiles\Plugin::__construct<br />");
			
			$this->_default_hook_priority = 20;
			
			parent::__construct();
			
			//$this->add_javascript('dbm-content-files-main', DBM_CONTENT_FILES_URL.'/assets/js/main.js');
		}
		
		protected function create_pages() {
			//echo("\DbmContentFiles\Plugin::create_pages<br />");
			
		}
		
		protected function create_custom_post_types() {
			//echo("\DbmContentFiles\Plugin::create_custom_post_types<br />");
			
		}
		
		public function register_hooks() {
			parent::register_hooks();
			
			add_action('dbm_content/parse_dbm_content', array($this, 'hook_parse_dbm_content'), 10, 3);
		}
		
		public function hook_parse_dbm_content($dbm_content, $post_id, $post) {
			//echo("\DbmContentFiles\Plugin::hook_parse_dbm_content<br />");
			
			
		}
		
		protected function create_additional_hooks() {
			//echo("\DbmContentFiles\Plugin::create_additional_hooks<br />");
			
			
		}
		
		protected function create_rest_api_end_points() {
			//echo("\DbmContentFiles\Plugin::create_rest_api_end_points<br />");
			
			$api_namespace = 'dbm-content-files';
			
			$current_end_point = new \DbmContentFiles\OddCore\RestApi\ReactivatePluginEndpoint();
			$current_end_point->set_plugin($this);
			$current_end_point->add_headers(array('Access-Control-Allow-Origin' => '*'));
			$current_end_point->setup('reactivate-plugin', $api_namespace, 1, 'GET');
			$this->_rest_api_end_points[] = $current_end_point;
			
			
		}
		
		protected function create_filters() {
			//echo("\DbmContentFiles\Plugin::create_filters<br />");

			$custom_range_filters = new \DbmContentFiles\CustomRangeFilters();
			
		}
		
		protected function create_shortcodes() {
			//echo("\DbmContentFiles\OddCore\PluginBase::create_shortcodes<br />");
			
			$current_shortcode = new \DbmContentFiles\Shortcode\WprrShortcode();
			$this->add_shortcode($current_shortcode);
		}
		
		
		public function hook_admin_enqueue_scripts() {
			//echo("\DbmContentFiles\Plugin::hook_admin_enqueue_scripts<br />");
			
			parent::hook_admin_enqueue_scripts();
			
		}
		
		public function activation_setup() {
			\DbmContentFiles\Admin\PluginActivation::run_setup();
		}
		
		public static function test_import() {
			echo("Imported \DbmContentFiles\Plugin<br />");
		}
	}
?>