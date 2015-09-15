<?php
	/*
	 * This file handles the form, for adding landing pages.
	 * A user, with administrator privileges, is also permitted to
	 * delete any landing pages.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	session_start();
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>KHFinancial | Landing page redirector wizard</title>
		<link rel="shortcut icon" href="http://khfinancial.ca/wp-content/uploads/2014/08/KHF-Stamp3.jpg"/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/style.css" type='text/css'/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/bootstrap-responsive.min.css" type='text/css'/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/bootstrap-responsive.min.rtl.css" type='text/css'/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/bootstrap.min.css" type='text/css'/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/colorbox.css" type='text/css'/>
		<link rel='stylesheet' href="https://khfinancial.ca/wp-content/themes/probusiness/css/flexslider.css" type='text/css'/>
		<script type="text/javascript" src="https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/javascript/jquery.min.js"></script>
		<script type="text/javascript" src="https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/javascript/jquery.backstretch.js"></script>
		<script type="text/javascript" src="https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/javascript/page-redirector-server-side-call.js"></script>
	</head>
	<body style="text-align: left; background-color: transparent">
		<form style="text-align: left" id="landing_page_redirect_wizard_form" method="post" action="https://khfinancial.ca/wp-content/plugins/landing-page-redirector/">
			<?php
				include_once '/home/payneer/public_html/KHFinancial.ca/wp-content/plugins/landing-page-redirector/library/controllers/coordinate-landing-pages-manager.php';
				
				$coordinate_landing_pages_manager = new Coordinate_Landing_Pages_Manager();
				
				if (isset($_SESSION['special_app_session']) && $coordinate_landing_pages_manager->get_admin_access_check() == 'a:1:{s:13:"administrator";b:1;}' && $coordinate_landing_pages_manager->get_state_province_menu_record_quantity() >= 1) {
					
					$delete_selected = $_GET['delete'];
					
					echo "<div style='text-align: left; width: 80%; padding-left: 15px; padding-right: 15px; padding-bottom: 15px; padding-top: 15px'>\n";
					echo "<div style='text-align: left'><input type='button' class='log_out' value='Log out' /></div>\n";
					echo "<div style='text-align: left'><h3><b>Landing page redirector wizard</b></h3></div>\n";
					echo "<div style='text-align: left'><label>* indicates required field.</label></div>\n";
					echo "<div style='text-align: left'><label>This tool is designed for managing your website page redirects.  There might be a scenario, when you want a particular geographical location (province/state) of users to be redirected, as they otherwise would have browsed your original given website page.  You can target the combined scenario of your located visitors and the original page that they are trying to access, dictating the substitute landing page for them to go to.</label></div>\n";
					echo "<div style='text-align: left'><label>Choose state or province * <i>This indicates the targeted location.</i></label></div>\n";
					echo "<div style='text-align: left'>\n";
					echo "<br /><select id='choose_state_province' style='width: 100%; height: 32px'>\n";
					echo "<option value='Choose state or province'>Choose state or province</option>\n";
					
					$coordinate_landing_pages_manager->get_state_province_menu_options();
					
					echo "</select><br />\n";
					echo "</div>\n";
					echo "<div style='text-align: left'><label>Indicate original page * <i>This indicates the page that the targeted location is to be redirected from.</i>&nbsp;&nbsp;<b>URL's must be spelled correctly, otherwise visitors will <u>not</u> be redirected properly.</b></label></div>\n";
					echo "<div style='text-align: left'>\n";
					echo "<br /><input type='text' id='indicate_original_page' placeholder='i.e. https://khfinancial.ca/' style='width: 100%; height: 32px' /><br />\n";
					echo "</div>\n";
					echo "<div style='text-align: left'><label>Indicate substitute landing page * <i>This indicates the page that the targeted location is to be redirected towards.</i>&nbsp;&nbsp;<b>URL's must be spelled correctly, otherwise visitors will <u>not</u> be redirected properly.</b></label></div>\n";
					echo "<div style='text-align: left'>\n";
					echo "<br /><input type='text' id='indicate_substitute_landing_page' placeholder='i.e. https://khfinancial.ca/vancouver/' style='width: 100%; height: 32px' /><br /><br />\n";
					echo "</div>\n";
					echo "<div style='text-align: left'>\n";
					echo "<input type='button' id='add_landing_page' value='Add landing page' /><br /><br />\n";
					echo "</div>\n";
					echo "<div style='text-align: left'>\n";
					echo "<input type='button' class='log_out' value='Log out' />\n";
					echo "</div>\n";
					echo "<input type='hidden' id='delete_selected' value='$delete_selected' />\n";
					echo "<div id='request_manage_landing_pages' style='text-align: left'></div>\n";
					echo "</div>\n";					
				} else {
				
					echo "<div style='text-align: left; width: 80%; padding-left: 15px; padding-right: 15px; padding-bottom: 15px; padding-top: 15px'>\n";
					echo "<div style='text-align: left'><label>You are not allowed to view this page.  You could try <a href='https://khfinancial.ca/login/'>logging</a> in.</label></div>\n";
					echo "</div>\n";
				}
			?>
		</form>
	</body>
</html>
