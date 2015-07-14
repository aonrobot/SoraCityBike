<?php
require 'class.logsys.php';
\Fr\LS::$config = array(
'db' => array(
'host' => 'localhost',
'port' => '3306',
'username' => 'root',
'password' => 'root',
'name' => 'sora_db',
),
'pages' => array(
 'no_login' => array(
 '',
 ),
'login_page' => '/SoraCityBike/admin/login.php',
'home_page' => '/SoraCityBike/admin/index.php'
 ));
?>
