<?php
	/*
	 * This file searches for a landing page, based on the geographical location obtained from each client (website visitor).
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/database-setup.php';
	
	abstract class Landing_Page_Redirector extends Database_Setup {
		
		//This method checks if user has administration privileges.
		protected function search_for_admin() 
		{	
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/application-sessions.php';
			
			$application_sessions = new Application_Sessions();
		
			$get_database_server = $this->get_database_server();
			$get_active_session = $application_sessions->get_active_session();
			
			$final_result = "";
			
			@mysqli_select_db($get_database_server, "test");
			
			$search_id_records = "SELECT user_id FROM usermeta WHERE meta_value = '$get_active_session' ORDER BY umeta_id ASC LIMIT 1";
			
			$id_search_result = @mysqli_query($get_database_server, $search_id_records)
			Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
			
			if (@mysqli_num_rows($id_search_result) >= 1) {
				
				$extract_id = @mysqli_fetch_assoc($id_search_result);
				
				$search_records_by_obtained_id = "SELECT meta_value FROM usermeta WHERE user_id = $extract_id[user_id]";
				
				$search_records_by_obtained_id_result = @mysqli_query($get_database_server, $search_records_by_obtained_id)
				Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
				
				if (@mysqli_num_rows($search_records_by_obtained_id_result) >= 1) {
					
					while ($extract_by_obtained_id_result = @mysqli_fetch_assoc($search_records_by_obtained_id_result)) {
						
						if ($extract_by_obtained_id_result['meta_value'] == 'a:1:{s:13:"administrator";b:1;}') {
							
							$final_result = $extract_by_obtained_id_result['meta_value'];
						}
					}
				}
			}
			
			return $final_result;
		}
		
		//This method retrives all the options in the drop down menu.
		protected function search_state_province_menu() 
		{
			$get_database_server = $this->get_database_server();
			
			@mysqli_select_db($get_database_server, "test");

			$search_records = "SELECT state_or_province FROM select_state_or_province ORDER BY state_or_province ASC";
			
			$result = @mysqli_query($get_database_server, $search_records)
			Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
			
			return $result;
		}
		
		protected function search_location($detected_province, $current_page_url) 
		{	
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/text-find-and-replace.php';
			
			$text_find_and_replace = new Text_Find_And_Replace();
			
			$get_database_server = $this->get_database_server();
			$current_page_url = $text_find_and_replace->filter_non_numeric_characters($current_page_url);
			
			@mysqli_select_db($get_database_server, "test");
			
			$check_visitor = "SELECT redirect_to FROM kh_financial_landing_pages WHERE province = '$detected_province' AND redirect_from LIKE '%$current_page_url%'";
			
			$search_result = @mysqli_query($get_database_server, $check_visitor)
			Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
			
			return $search_result;
		}
		
		protected function add_landing_page($choose_state_province, $indicate_original_page, $indicate_substitute_landing_page, $add_landing_page)
		{
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/text-find-and-replace.php';
			
			$text_find_and_replace = new Text_Find_And_Replace();
			
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/application-sessions.php';
			
			$application_sessions = new Application_Sessions();
		
			$get_database_server = $this->get_database_server();
			$get_active_session = $application_sessions->get_active_session();
			$indicate_substitute_landing_page = $text_find_and_replace->filter_non_numeric_characters($indicate_substitute_landing_page);
			
			@mysqli_select_db($get_database_server, "test");
			
			if ($add_landing_page) {
				
				$application_sessions->inactive_session($get_active_session, "https://khfinancial.ca/wp-content/plugins/landing-page-redirector/");
				
				if ($choose_state_province != "Choose state or province" && $indicate_original_page != "" && !(ctype_space($indicate_original_page)) && $indicate_substitute_landing_page != "" && !(ctype_space($indicate_substitute_landing_page))) {
					
					$add_record = "INSERT INTO kh_financial_landing_pages VALUES(NULL, '$choose_state_province', '$indicate_original_page', '$indicate_substitute_landing_page')";
					
					@mysqli_query($get_database_server, $add_record)
					Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
				} else {
					
					echo "<label>Please correct the following:</label><br />\n";
					echo "<label>\n";
					echo "<ul>\n";
				
					if ($choose_state_province == "Choose state or province") {
					
						echo "<li>You must choose a state or province.</li>\n";
					}
				
					if ($indicate_original_page == "" || ctype_space($indicate_original_page)) {
					
						echo "<li>You must indicate your original page.</li>\n";
					}
				
					if ($indicate_substitute_landing_page == "" || ctype_space($indicate_substitute_landing_page)) {
					
						echo "<li>You must indicate your substitute landing page.</li>\n";
					}
				
					echo "</ul>\n";
					echo "</label>\n";
				}
			}
		}
		
		protected function erase_landing_page($delete_selected)
		{
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/text-find-and-replace.php';
			
			$text_find_and_replace = new Text_Find_And_Replace();
			
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/application-sessions.php';
			
			$application_sessions = new Application_Sessions();
		
			$get_database_server = $this->get_database_server();
			$get_active_session = $application_sessions->get_active_session();
			$delete_selected = $text_find_and_replace->filter_non_numeric_characters(round($text_find_and_replace->filter_numeric_characters($delete_selected), 0));
			
			@mysqli_select_db($get_database_server, "test");
			
			if ($delete_selected) {
				
				$application_sessions->inactive_session($get_active_session, "https://khfinancial.ca/wp-content/plugins/landing-page-redirector/");
				
				$search_records = "SELECT id FROM kh_financial_landing_pages WHERE id = $delete_selected";
					
				$result = @mysqli_query($get_database_server, $search_records)
				Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
					
				if (@mysqli_num_rows($result) == 1) {
						
					$erase_record = "DELETE FROM kh_financial_landing_pages WHERE id = $delete_selected";
						
					@mysqli_query($get_database_server, $erase_record)
					Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
					
					echo "<label>You successfully deleted your entry!</label>\n";
				}
			}
		}
		
		protected function search_landing_pages_list()
		{	
			$get_database_server = $this->get_database_server();
			
			@mysqli_select_db($get_database_server, "test");
			
			$search_records = "SELECT id, province, redirect_from, redirect_to FROM kh_financial_landing_pages ORDER BY id DESC";
			
			$result = @mysqli_query($get_database_server, $search_records)
			Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
			
			return $result;
		}
	}
