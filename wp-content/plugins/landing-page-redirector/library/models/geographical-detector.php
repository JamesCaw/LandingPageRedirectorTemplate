<?php
	/*
	 * Essentially, this file is supposed to check the geographical location of each client (website visitor).
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	
	class Geographical_Detector {
				
		public function get_city() 
		{
			$return_string = "";
			
			$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
				
			$return_string = $array['geoplugin_city'];
			
			if ($return_string == "") {
				
				$return_string = "no data available";
			}
				
			return $return_string;
		}
		
		//This method captures your local region, also known as your province.
		public function get_territory() 
		{
			$return_string = "";
			
			$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
				
			$return_string = $array['geoplugin_regionName'];
			
			if ($return_string == "") {
				
				$return_string = "no data available";
			}
				
			return $return_string;
		}
		
		//This method captures your country.  I left this one in because you might want it.
		public function get_nation() 
		{
			$return_string = "";
			
			$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
				
			$return_string = $array['geoplugin_countryName'];
			
			if ($return_string == "") {
				
				$return_string = "no data available";
			}
				
			return $return_string;
		}
		
		public function get_latitude() 
		{
			$return_string = "";
			
			$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
				
			$return_string = $array['geoplugin_latitude'];
			
			if ($return_string == "") {
				
				$return_string = "no data available";
			}
				
			return $return_string;
		}
		
		public function get_longitude() 
		{
			$return_string = "";
			
			$array = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$_SERVER['REMOTE_ADDR']));
				
			$return_string = $array['geoplugin_longitude'];
			
			if ($return_string == "") {
				
				$return_string = "no data available";
			}
				
			return $return_string;
		}
		
		public function get_client_identification() 
		{
			return $_SERVER['HTTP_USER_AGENT'];
		}
		
		public function get_IP_address() 
		{
			return $_SERVER['REMOTE_ADDR'];
		}
		
		public function get_host_name()
		{
			return gethostbyaddr($_SERVER['REMOTE_ADDR']);
		}
		
		public function get_browser()
		{
			$client_ID = $_SERVER['HTTP_USER_AGENT'];

			$determine_browser = "";
			
			if (preg_match('/Firefox/', $client_ID)) {
				
				$determine_browser = "Firefox";
			} else if (preg_match('/Chrome/', $client_ID)) {
	
				$determine_browser = "Chrome";
			} else if (preg_match('/MSIE/', $client_ID)) {
	
				$determine_browser = "Internet Explorer";
			} else {
	
				$determine_browser = "Other Browser";
			}
			
			return $determine_browser;
		}
		
		public function get_client_hash()
		{
			return sha1(rand(0,1000));
		}
		
		public function get_date_accessed()
		{
			return date("m/d/y");
		}
		
		public function get_time_accessed()
		{
			return date("h:i A.", time());
		}
	}
