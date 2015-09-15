<?php
	/*
	 * This file just displays a list of landing pages that you are storing.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	 
	class Show_Landing_Pages_List {
		
		private $text_formatter;
		
		public function __construct() {
			
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/text-formatter.php';
			$this->text_formatter = new Text_Formatter();
		}
		
		public function present_list($get_search_result)
		{
			if (@mysqli_num_rows($get_search_result) >= 1) {
				
				while ($extract_field = @mysqli_fetch_assoc($get_search_result)) {
				
					echo "<div style='text-align: left'><label>Province/State: " . $this->text_formatter->chop_text($extract_field['province'], 60) . "</label></div>\n";
					echo "<div style='text-align: left'><label>Original page: " . $this->text_formatter->chop_text($extract_field['redirect_from'], 60) . "</label></div>\n";
					echo "<div style='text-align: left'><label>Landing page: " . $this->text_formatter->chop_text($extract_field['redirect_to'], 60) . "</label></div>\n";
					echo "<div style='text-align: left'><label><a href='https://khfinancial.ca/wp-content/plugins/landing-page-redirector/?delete=$extract_field[id]'>Delete</a></label><br /><br /></div>\n";
				}
			} else {
				
				echo "<div style='text-align: left'><label>You are not storing any landing pages.</label></div>\n";
			}
		}
	}
