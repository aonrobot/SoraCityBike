<!DOCTYPE html>
	<html>
	
	<head>
	
		<title><?php echo $page . ' | ' .' Admin '. $site_title; ?></title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		
		<!-- Font CSS -->
        <link href="css/CustomFonts/fonts.css" rel="stylesheet">
        
        <!------------------------------------------------------------------------------->
		
		<!-- Bootstrap Core CSS -->
		<link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Editable CSS -->
        <link href="components/Editablecss/css/bootstrap-editable.css" rel="stylesheet">
        
		
		<!-- MetisMenu CSS -->
		<link href="components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
		
		<!-- GridManager CSS -->
		<link href="components/grid_manager/dist/css/jquery.gridmanager.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link href="<?php echo $D_TEMPLATE; ?>dist/css/sb-admin-2.css" rel="stylesheet">
		
		<!-- Custom Fonts -->
		<link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
		<!-- File Upload CSS -->
		<link href="components/bootstrap-fileinput-master/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
		
		<!-- Menu Nestable 
        <link href="components/menu-nestable/jquery.nestable.css" rel="stylesheet" type="text/css"> -->
        
        <!-- Menu Nestable II -->
        <link href="components/nestedSortable/jquery.mjs.nestedSortable.css" rel="stylesheet" type="text/css">
        
        <!-- Jquery UI -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />
        
        <!-- Notification -->
        <link href="components/notification/toastr.css" rel="stylesheet"/>
        
        <!-- animsition CSS (Loading Effect)-->
        <link rel="stylesheet" href="components/animsition/dist/css/animsition.min.css">
        
		
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
    	
    	<script src="components/ckeditor/ckeditor.js"></script> 
  		<script src="components/ckeditor/adapters/jquery.js"></script> 
    	
    	<!-- Grid Manager JavaScript -->
		<script src="components/grid_manager/dist/js/jquery.gridmanager.js"></script>
		
		<!-- Metis Menu Plugin JavaScript -->
		<script src="components/metisMenu/dist/metisMenu.min.js"></script>	
		
		<!-- Import Only Page has s table -->
		<!-- DataTables JavaScript -->
		<?php //if(!strcmp($_GET['a'], 'list')){?> 		
    		<link href="components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    		<link href="components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    		<script src="components/datatables/media/js/jquery.dataTables.min.js"></script>
    		<script src="components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
		<?php //}?>
		
		<!-- Chained Selection JavaScript -->
		<script src="components/jquery_chained/jquery.chained.min.js"></script>
		
		<!-- File Upload JavaScript -->
		<script src="components/bootstrap-fileinput-master/js/fileinput.min.js" type="text/javascript"></script>
		
		<!-- Custom Theme JavaScript -->
		<script src="<?php echo $D_TEMPLATE; ?>dist/js/sb-admin-2.js"></script>
		
		<!-- Notification JS -->
		<script src="components/notification/toastr.js"></script>

	</head>
	
	<body>
	
		<div id="wrapper" class="animsition">
		
		<?php include ($D_TEMPLATE . 'navigation.php'); ?>