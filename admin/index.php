<?php

include ('../config/db_connect.php');
//If Don't Have Any User First Use
$chk_users = $database->count("users");
if($chk_users == 0){
    header('Location: install.php');    
    exit();
}


require "config.php"; 
\Fr\LS::init();

include('../config/admin_config.php');

//If Don't Have Any User First Use
$chk_users = $database->count("users");
if($chk_users == 0){
    header('Location: install.php');    
    exit();
}

include($D_TEMPLATE.'header.php'); // Page Header 

$details = \Fr\LS::getUser(); //User Info

include('pages/'.$page.'.php'); // View Type 

include($D_TEMPLATE.'footer.php'); // Page Footer 

?>	