<?php
require_once '../components/medoo.min.php';
$database = new medoo(array(
'database_type' => 'mysql',
'database_name' => 'sora_db',
'server' => 'localhost',
'username' => 'root',
'password' => 'root',
'charset' => 'utf8'
));
?>
