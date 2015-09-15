<?php
	/*
	 * This file is supposed to conduct a geographical detection,
	 * search for an associated landing page (related to the geographical findings), 
	 * and redirect to the associated landing page, based on such findings.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/models/landing-page-redirector.php';
	 
	class Trigger_Redirect extends Landing_Page_Redirector {
		
		private $geographical_detector;
		private $show_redirect;
		
		public function __construct() 
		{
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/models/geographical-detector.php';
			
			$this->geographical_detector = new Geographical_Detector();
			
			include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/views/show-redirect.php';
			
			$this->show_redirect = new Show_Redirect();
		}
		
		//The get_territory() method stands for the function, in charge of tracking the visitor's province.
		public function control_landing_page_redirect($current_page_url)
		{	
			if ($current_page_url != "" && !(ctype_space($current_page_url))) {
			
				echo $this->show_redirect->redirect_to($this->search_location($this->geographical_detector->get_territory(), $current_page_url));
			}
		}
	}
