<?php
	class Application_Sessions {
	
		//Get methods
		public function get_active_session() {
			
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/text-find-and-replace.php';
			$text_find_and_replace = new Text_Find_And_Replace();
			
			$active_session = "";
	
			if (isset($_SESSION['special_app_session'])) {
		
				$active_session = $_SESSION['special_app_session'];
			}
			
			//Sanitize data
			$active_session = $text_find_and_replace->filter_non_numeric_characters($active_session);
			
			return $active_session;
		}
		
		public function inactive_session($active_session, $url) {
		
			if (!(isset($active_session))) {
					
				echo "<script language='javascript' type='text/javascript'>\n";
				echo "window.location = '$url'\n";
				echo "</script>\n";
			}
		}
	}
