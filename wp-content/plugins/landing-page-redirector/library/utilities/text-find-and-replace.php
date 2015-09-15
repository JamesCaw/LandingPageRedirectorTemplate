<?php
	class Text_Find_And_Replace {
	
		public function filter_numeric_characters($attribute) {
			
			//Used for preventing garbage data input
			$Attribute = str_replace(",", "", $attribute);
			
			return $Attribute;			
		}
		
		public function filter_non_numeric_characters($attribute) {
			
			//Used for preventing SQL injections
			$find = array();
			$replace = array();
			
			$find[0] = "'"; $replace[0] = "&apos;";
			$find[1] = "<"; $replace[1] = " &lt;";
			$find[2] = ">"; $replace[2] = "&gt; ";
			
			$attribute = str_replace($find, $replace, $attribute);
			
			return $attribute;
		}
	}
?>
