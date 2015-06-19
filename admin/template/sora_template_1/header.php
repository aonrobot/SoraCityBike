<!DOCTYPE html>
	<html>
	
	<head>
	
		<title><?php echo $page . ' | ' . $site_title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- Bootstrap Core CSS -->
		<link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
		
		<!-- MetisMenu CSS -->
		<link href="components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
		
		<!-- GridManager CSS -->
		<link href="components/grid_manager/dist/css/jquery.gridmanager.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="<?php echo $D_TEMPLATE; ?>dist/css/sb-admin-2.css" rel="stylesheet">
		
		<!-- Custom Fonts -->
		<link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<!------------------------    JS     ----------------------------------------->
		
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->	
		
		<!-- jQuery -->
		<script src="components/jquery/dist/jquery.min.js"></script>
		
		<!-- jQuery UI -->
		<script src="components/jquery-ui/jquery-ui.js"></script>
		
		<!-- Bootstrap Core JavaScript -->
		<script src="components/bootstrap/dist/js/bootstrap.min.js"></script>
		
		<?php //include('config/tiny.php'); ?>
		
		<!-- Tiny Editoe 
		
		<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.2/tinymce.min.js"></script>
    	<script src="//cdnjs.cloudflare.com/ajax/libs/tinymce/4.1.2/jquery.tinymce.min.js"></script> -->
    	
    	<!-- CKEditor -->
    	
    	<script src="//cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script> 
  		<script src="//cdn.ckeditor.com/4.4.3/standard/adapters/jquery.js"></script> 
    	
    	<!-- Grid Manager JavaScript -->
		<script src="components/grid_manager/dist/js/jquery.gridmanager.js"></script>
		
		<!-- Metis Menu Plugin JavaScript -->
		<script src="components/metisMenu/dist/metisMenu.min.js"></script>	
		
		<!-- Import Only Page has s table -->
		<!-- DataTables JavaScript -->
		<?php if(!strcmp($_GET['a'], 'list')){?> 		
		<link href="components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
		<link href="components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
		<script src="components/datatables/media/js/jquery.dataTables.min.js"></script>
		<script src="components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
		<?php }?>
		
		<!-- Custom Theme JavaScript -->
		<script src="<?php echo $D_TEMPLATE; ?>dist/js/sb-admin-2.js"></script>
		
		
	
	</head>
	
	<body>
	
		<div id="wrapper">
		
		<?php include ($D_TEMPLATE . 'navigation.php'); ?>