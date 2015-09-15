<?php
	/*
	 * This file checks to see if a landing page is found, based on an associated geographical search. (website visitor).
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	 
	class Show_Redirect {
		
		public function redirect_to($get_search_result)
		{	
			$print_value = "";
			
			if (@mysqli_num_rows($get_search_result) == 1) {
				
				$extract_field = @mysqli_fetch_assoc($get_search_result);
				
				$print_value .= "<script type='text/javascript'>\n";
				$print_value .= "window.location = '$extract_field[redirect_to]'\n";
				$print_value .= "</script>\n";
			}
			
			return $print_value;
		}
	}
