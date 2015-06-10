<?php

	#Template Path
	$GLOBALS['D_TEMPLATE'] = 'template/sora_template_1/';

	// Setup File:
	error_reporting(0);
	# Database Connection:
	#include ('../config/connection.php');
	
	# Functions:

	
	# Site Setup:
	$site_title = 'SORA City Bike Admin';
	
	if (isset($_GET['p'])) {
	
		$page = $_GET['p'];
		// Set $pageid to equal the value given in the URL
	
	} else {
	
		$page = 'dashboard';
		// Set $pageid equal to 1 or the Home Page.
	
	}
	
	# Page Setup:
	
	
	# User Setup:

	
?>