<?php
	/*
	 * This file is only responsible for instantiating the usage of the classes and methods.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<body>
		<form id="landing_page_redirect_wizard_form" method="post" action="https://khfinancial.ca/wp-content/plugins/landing-page-redirector/">
			<?php
				include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/controllers/coordinate-landing-pages-manager.php';
				
				$coordinate_landing_pages_manager = new Coordinate_Landing_Pages_Manager();
				
				include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/utilities/application-sessions.php';
			
				$application_sessions = new Application_Sessions();
				
				if (isset($_SESSION['special_app_session']) && $coordinate_landing_pages_manager->get_admin_access_check() == 'a:1:{s:13:"administrator";b:1;}' && $coordinate_landing_pages_manager->get_state_province_menu_record_quantity() >= 1) {
					
					$choose_state_province = $_POST['choose_state_province'];
					$indicate_original_page = $_POST['indicate_original_page'];
					$indicate_substitute_landing_page = $_POST['indicate_substitute_landing_page'];
					$add_landing_page = $_POST['add_landing_page'];
					$delete_selected = $_POST['delete_selected'];
					$log_out = $_POST['log_out'];
					
					if ($log_out) {

						if (isset($_SESSION['special_app_session'])) {
		
							$special_app_session = $_SESSION['special_app_session'];
		
							unset($_SESSION['special_app_session']);
					
							echo "<script language='javascript' type='text/javascript'>\n";
							echo "window.location = 'http://khfinancial.ca/login/?login=logout'\n";
							echo "</script>\n";
						}
					}
					
					$coordinate_landing_pages_manager->data_manipulation_attributes($choose_state_province, $indicate_original_page, $indicate_substitute_landing_page, $add_landing_page, $delete_selected);
					
					$coordinate_landing_pages_manager->get_final_output();
				}
			?>
		</form>
	</body>
</html>
