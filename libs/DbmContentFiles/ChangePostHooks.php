<?php
	namespace DbmContentFiles;
	
	use \WP_Query;
	
	// \DbmContentFiles\ChangePostHooks
	class ChangePostHooks {
		
		function __construct() {
			//echo("\DbmContentFiles\ChangePostHooks::__construct<br />");
			
			
		}
		
		protected function register_hook_for_type($type, $hook_name) {
			add_action('wprr/admin/change_post/'.$type, array($this, $hook_name), 10, 2);
		}
		
		public function register() {
			//echo("\DbmContentFiles\ChangePostHooks::register<br />");
			
			$this->register_hook_for_type('dbm/file/name', 'hook_set_file_name');
			$this->register_hook_for_type('dbm/file/contents', 'hook_set_file_contents');
			
		}
		
		protected function create_folders_and_save_file($full_path, $content) {
			
			$parts = explode('/', $full_path);
			$file = array_pop($parts);
			$dir = '';
			
			foreach($parts as $part) {
				if(!is_dir($dir .= "/$part")) {
					mkdir($dir);
				}
			}
			
			return file_put_contents($full_path, $content);
		}
		
		public function hook_set_file_name($data, $post_id) {
			//echo("\DbmContentFiles\ChangePostHooks::hook_set_file_name<br />");
			
			//METODO: move existing files
			
			update_post_meta($post_id, 'dbm_content_files_path', $data['value']);
		}
		
		public function hook_set_file_contents($data, $post_id) {
			//echo("\DbmContentFiles\ChangePostHooks::hook_set_file_contents<br />");
			
			$path = get_post_meta($post_id, 'dbm_content_files_path', true);
			
			if($path) {
				$upload_dir = wp_upload_dir(null, false);
			
				$write_path = $upload_dir['basedir'].'/'.$path;
			
				$this->create_folders_and_save_file($write_path, $data['value']);
			}
			else {
				//METODO: log error
			}
		}
		
		public static function test_import() {
			echo("Imported \DbmContentFiles\ChangePostHooks<br />");
		}
	}
?>