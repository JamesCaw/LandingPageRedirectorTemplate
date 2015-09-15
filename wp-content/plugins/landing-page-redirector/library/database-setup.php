<?php
	abstract class Database_Setup {
		
		//The database server is called here.
		protected function get_database_server() {
			
			$database_server = @mysqli_connect("localhost", "payneer_wp630", "-31D@x1tSP")
			Or die("<h1>The website had a hiccup.  Try reloading this page.</h1>");
			
			return $database_server;
		}
	}
