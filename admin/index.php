<?php

$filename = '../config/db_connect.php';

//If Don't Have Any User First Use
if(filesize($filename) == 0){
    header('Location: install.php');    
    exit();
}

require "config.php"; 
\Fr\LS::init();

include('../config/admin_config.php');

include($D_TEMPLATE.'header.php'); // Page Header 

include('pages/'.$page.'.php'); // View Type 

include($D_TEMPLATE.'footer.php'); // Page Footer 

?>	