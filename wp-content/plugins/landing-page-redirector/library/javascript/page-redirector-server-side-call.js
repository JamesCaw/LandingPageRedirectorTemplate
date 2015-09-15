	/*
	 * This file loads the server-side scripts and passes information to the backend.
	 * Last modified by Timothy van der Graaff on 8/1/2015
	 */
	$(document).ready(function() {

		$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-page-redirector.php', '&show=', function(data) {

			$("#request_page_redirector").html(data);
		});
		
		$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-manage-landing-pages.php', '&show=', function(data) {

			$("#request_manage_landing_pages").html(data);
		});
		
		$(function() {
		
			$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-page-redirector.php', {
				
				current_page_url: window.location.href
			
			}, function(data, textStatus) {
			
				$("#request_page_redirector").html(data);
			});
		});
		
		$(function() {
		
			$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-manage-landing-pages.php', {
				
				delete_selected: $("#delete_selected").val()
			
			}, function(data, textStatus) {
			
				$("#request_manage_landing_pages").html(data);
			});
		});
		
		$("#add_landing_page").click(function() {
			
			$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-manage-landing-pages.php', {
				
				choose_state_province: $("#choose_state_province").val(),
				indicate_original_page: $("#indicate_original_page").val(),
				indicate_substitute_landing_page: $("#indicate_substitute_landing_page").val(),
				add_landing_page: $("#add_landing_page").val()
			
			}, function(data, textStatus) {
			
				$("#request_manage_landing_pages").html(data);
			});			
		});
		
		$(".log_out").click(function() {
		
			$.post('https://khfinancial.ca/wp-content/plugins/landing-page-redirector/library/corridors/request-manage-landing-pages.php', {
				
				log_out: $(".log_out").val()
			
			}, function(data, textStatus) {
			
				$("#request_manage_landing_pages").html(data);
			});
		});
	});
