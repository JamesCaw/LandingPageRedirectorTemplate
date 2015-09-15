<?php
	/*
	 * This file is supposed to conduct a geographical detection,
	 * search for an associated landing page (related to the geographical findings), 
	 * and redirect to the associated landing page, based on such findings.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	 include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/controllers/trigger-redirect.php';
	 
	 $trigger_redirect = new Trigger_Redirect();
	 
	 $current_page_url = $_POST['current_page_url'];
	 
	 $trigger_redirect->control_landing_page_redirect($current_page_url);
