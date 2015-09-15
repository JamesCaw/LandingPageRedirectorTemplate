<?php
	/*
	 * This file is supposed to conduct a geographical detection,
	 * search for an associated landing page (related to the geographical findings), 
	 * and redirect to the associated landing page, based on such findings.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/models/landing-page-redirector.php';
	 
	class Coordinate_Landing_Pages_Manager extends Landing_Page_Redirector {
		
		private $show_landing_pages_list;
		
		public function __construct() 
		{
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/views/show-landing-pages-list.php';
			
			$this->show_landing_pages_list = new Show_Landing_Pages_List();
		}
		
		public function get_admin_access_check() {
			
			return $this->search_for_admin();
		}
		
		public function get_state_province_menu_record_quantity() 
		{
			return @mysqli_num_rows($this->search_state_province_menu());
		}
		
		public function get_state_province_menu_options()
		{	
			$search_result = $this->search_state_province_menu();
			
			while ($extract_state_province_menu = @mysqli_fetch_assoc($search_result)) {
					
				echo "<option value='$extract_state_province_menu[state_or_province]'>$extract_state_province_menu[state_or_province]</option>\n";
			}
		}
		
		//This method is responsible for changing the data set, in the landing pages list.
		public function data_manipulation_attributes($choose_state_province, $indicate_original_page, $indicate_substitute_landing_page, $add_landing_page, $delete_selected) 
		{
			$this->add_landing_page($choose_state_province, $indicate_original_page, $indicate_substitute_landing_page, $add_landing_page);
			$this->erase_landing_page($delete_selected);
		}
		
		//This method essentially handles the list search results and presents them accordinally.
		public function get_final_output()
		{	
			$this->show_landing_pages_list->present_list($this->search_landing_pages_list());
		}
	}
