<?php
	class Text_Formatter {
	
		//Breaks up consecutive and long, non-space characters
		public function chop_text($original_string, $chop_by_number) {
		
			$print_converted_string = "";
							
			foreach (explode(" ", $original_string) as $explode_original_string) {
					
				if (strlen($explode_original_string) > $chop_by_number) {
						
					$print_converted_string .= " " . chunk_split($explode_original_string, $chop_by_number, "<br />");
				} else {
									
					$print_converted_string .= " " . $explode_original_string;
				}
			}
			
			return $print_converted_string;
		}
	}
