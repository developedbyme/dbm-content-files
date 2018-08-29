<?php
	namespace DbmContentFiles;

	class CustomRangeFilters {
		
		protected $_photo_credits_parent_term_id = -1;

		function __construct() {
			//echo("\DbmContentFiles\CustomRangeFilters::__construct<br />");
		}
		
		public function encode_file($return_object, $post_id) {
			$path = get_post_meta($post_id, 'dbm_content_files_path', true);
			
			if($path) {
				$upload_dir = wp_upload_dir(null, false);
				$full_path = $upload_dir['baseurl'].'/'.$path;
			
				$return_object['path'] = $full_path;
				
				$read_path = $upload_dir['basedir'].'/'.$path;
				if(file_exists($read_path)) {
					$return_object['file'] = file_get_contents($read_path);
				}
				else {
					$return_object['file'] = null;
				}
			}
			else {
				$return_object['path'] = null;
				$return_object['file'] = null;
			}
			
			return $return_object;
		}
		
		public static function test_import() {
			echo("Imported \DbmContentFiles\CustomRangeFilters<br />");
		}
	}
?>
