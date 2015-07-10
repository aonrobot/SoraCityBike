<?php

if (!isset($_GET['step'])){
    header('Location: install.php?step=1');    
    exit();
}

$keys = array(

      "cookie" => "ckxc436jd*^30f840v*9!@#$",

      "salt" => "^#$4%9f+1^p9)M@4M)V$"
    );

function rand_string($length) {
    $random_str = "";
    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars) - 1;
    for($i = 0;$i < $length;$i++) {
      $random_str .= $chars[rand(0, $size)];
    }
    return $random_str;
 }
function validEmail($email = ""){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>sora city bike | Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<html>
  <div class="container">
      <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-institution fa-1x"></i> Installation</h1>
            </div>
            <!-- /.col-lg-12 -->
      </div>
      <!-- ERROR ZONE -->
        <div class="row">
            <div class="col-lg-12">
                <?php
                if (isset($_POST['submit'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['pass'];
                    $retyped_password = $_POST['retyped_password'];
                    $name = $_POST['name'];
                    if ($username == "" || $email == "" || $password == '' || $retyped_password == '' || $name == '') {
                        echo "<h3 class='text-warning'>Fields Left Blank</h3>", "<p class='text-danger'>Some Fields were left blank. Please fill up all fields.</p>";
                    } elseif (!validEmail($email)) {
                        echo "<h3 class='text-warning'>E-Mail Is Not Valid</h3>", "<p class='text-danger'>The E-Mail you gave is not valid</p>";
                    } elseif (!ctype_alnum($username)) {
                        echo "<h3 class='text-warning'>Invalid Username</h3>", "<p class='text-danger'>The Username is not valid. Only ALPHANUMERIC characters are allowed and shouldn't exceed 10 characters.</p>";
                    } elseif ($password != $retyped_password) {
                        echo "<h3 class='text-warning'>Passwords Don't Match</h3>", "<p class='text-danger'>The Passwords you entered didn't match</p>";
                    } else {
                        $filename = '../config/db_connect.php';
                        if(filesize($filename) == 0){
                            header('Location: install.php');    
                            exit();
                        }
                        include('../config/db_connect.php');
                        $chk_exists = $database->count("users", array("username" => $username));
                        if ($chk_exists > 0) {
                            echo "<label class='text-danger'>User Exists.</label>";
                        } elseif ($chk_exists == 0) {
                            $randomSalt  = rand_string(20);
                            $saltedPass  = hash('sha256', $password. $keys['salt'] . $randomSalt);
                            //Create Admin User
                            $database->insert("users", array(
                                "username" => $username,
                                "email" => $email,
                                "password" => $saltedPass,
                                "password_salt" => $randomSalt,
                                "name" => $name,
                                "created" => date("Y-m-d H:i:s"),
                           ));
                           //Setup Site
                           $database->insert("site_meta", array(
                                array(
                                        'meta_key' => 'site_name',
                                        'meta_value' => $_POST['site_name']
                                ),
                                array(
                                        'meta_key' => 'site_title',
                                        'meta_value' => $_POST['site_title']
                                ),
                                array(
                                        'meta_key' => 'site_path',
                                        'meta_value' => $_POST['site_path']
                                ),
                                array(
                                        'meta_key' => 'company_email',
                                        'meta_value' => $_POST['company_email']
                                ),
                                array(
                                        'meta_key' => 'admin_template',
                                        'meta_value' => $_POST['admin_template']
                                ),
                           ));

                           header('Location: login.php');    
                           exit();
                        }
                    }
                }

                if (isset($_POST['chk_db'])) {
                    $servername = $_POST['db_server'];
                    $db_port = $_POST['db_port'];
                    $db_name = $_POST['db_name'];
                    $username = $_POST['db_username'];
                    $password = $_POST['db_password'];
                    $site_path = $_POST['site_path'];
                    
                    if ($servername == "" || $db_port == "" || $db_name == "" || $username == "" || $password == "") 
                            echo "<h3 class='text-warning'>Fields Left Blank</h3>", "<p class='text-danger'>Some Fields were left blank. Please fill up all fields.</p>";
                    else{
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password);
                        
                        // Check connection
                        if ($conn->connect_error) {
                            echo "<h3 class='text-warning'>Can't connect to database</h3>";
                            echo "<p class='text-danger'>Connection failed : " . $conn->connect_error."</p>";                        
                        } 
                        else{
                            
                            $myfile = fopen("../config/db_connect.php", "w") or die("Unable to open file!");
                            
                            $txt = "<?php\n";
                            fwrite($myfile, $txt);
                            $txt = "require_once '../components/medoo.min.php';\n";
                            fwrite($myfile, $txt);
                            $txt = '$database = new medoo(array(';
                            fwrite($myfile, $txt);
                            $txt = "\n'database_type' => 'mysql',\n";
                            fwrite($myfile, $txt);
                            $txt = "'database_name' => '".$db_name."',\n";
                            fwrite($myfile, $txt);
                            $txt = "'server' => '".$servername."',\n";
                            fwrite($myfile, $txt);
                            $txt = "'username' => '".$username."',\n";
                            fwrite($myfile, $txt);
                            $txt = "'password' => '".$password."',\n";
                            fwrite($myfile, $txt);
                            $txt = "'charset' => 'utf8'\n";
                            fwrite($myfile, $txt);
                            $txt = "));\n";
                            fwrite($myfile, $txt);
                            $txt = "?>\n";
                            fwrite($myfile, $txt);
                            
                            fclose($myfile);
                            
                           //Create Config
                           
                           $configfile = fopen("config.php", "w") or die("Unable to open file!");
                            
                           $txt = "<?php\n";
                           fwrite($configfile, $txt);
                           $txt = "require 'class.logsys.php';\n";
                           fwrite($configfile, $txt);
                           $txt = '\Fr\LS::$config = array(';
                           fwrite($configfile, $txt);
                           $txt = "\n'db' => array(\n";
                           fwrite($configfile, $txt);
                           $txt = "'host' => '".$servername."',\n";
                           fwrite($configfile, $txt);
                           $txt = "'port' => '".$db_port."',\n";
                           fwrite($configfile, $txt);
                           $txt = "'username' => '".$username."',\n";
                           fwrite($configfile, $txt);
                           $txt = "'password' => '".$password."',\n";
                           fwrite($configfile, $txt);
                           $txt = "'name' => '".$db_name."',\n";
                           fwrite($configfile, $txt);
                           $txt = "),\n";
                           fwrite($configfile, $txt);
                           
                           $txt = "'pages' => array(\n";
                           fwrite($configfile, $txt);
                           $txt = " 'no_login' => array(\n";
                           fwrite($configfile, $txt);
                           $txt = " '',\n";
                           fwrite($configfile, $txt);
                           $txt = " ),\n";
                           fwrite($configfile, $txt);
                           
                           $txt = "'login_page' => '".$site_path."/admin/login.php',\n";
                           fwrite($configfile, $txt);
                           $txt = "'home_page' => '".$site_path."/admin/index.php'\n";
                           fwrite($configfile, $txt);
                           
                           $txt = " ));\n";
                           fwrite($configfile, $txt);
                           
                           $txt = "?>\n";
                           fwrite($configfile, $txt);
                            
                           fclose($configfile);
                           
                           header('Location: install.php?step=2');    
                           exit();                    
                        } 
                    }               
                }
                ?>
            </div>
        </div>
      <!-- END ERROR ZONE -->
      <div class="row">
            <div class="col-lg-12">
                
                <?php if(!strcmp($_GET['step'], '1')){?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Database Setup
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="install.php?step=1" method="POST"> 
                                    <div class="form-group">
                                        <label>Site Path</label>
                                        <input class="form-control" name="site_path" placeholder="Root Is Emtry" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Database Server</label>
                                        <input class="form-control" name="db_server" placeholder="Database Server">
                                    </div>
                                    <div class="form-group">
                                        <label>Database Port</label>
                                        <input class="form-control" name="db_port" placeholder="Database Port" value="3306"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Database Name</label>
                                        <input class="form-control" name="db_name" placeholder="Database Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Database Username</label>
                                        <input class="form-control" name="db_username" placeholder="Database Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Database Password</label>
                                        <input class="form-control" name="db_password" placeholder="Database Password">
                                    </div>
                                    <button name="chk_db" type='submit' class="btn btn-success">
                                        Next Step
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        Reset
                                    </button>
                                </form>
                            </div>
                            <!-- /.col-lg-12 (nested) -->

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <?php }?>
                
                
                <?php if(!strcmp($_GET['step'], '2')){?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Admin Setup
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="install.php?step=2" method="POST">
                                    <div class="form-group">
                                        <label>Site Name</label>
                                        <input class="form-control" name="site_name" placeholder="Site Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input class="form-control" name="site_title" placeholder="Site Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Site Path</label>
                                        <input class="form-control" name="site_path" placeholder="Root Is Emtry" value="">
                                    </div>
                                    <div class="form-group">
                                        <label>Company Email</label>
                                        <input class="form-control" name="company_email" placeholder="Company Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Admin Template Url</label>
                                        <input class="form-control" name="admin_template" placeholder="Company Email" value="sora_template_1">
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" placeholder="E-Mail">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="pass" type="password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Retype Password Again</label>
                                        <input class="form-control" name="retyped_password" type="password" placeholder="Retype Password">
                                    </div>
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input class="form-control" name="name" placeholder="Name">
                                    </div>
                                    <button name="submit" type='submit' class="btn btn-success">
                                        Finish Install :)
                                    </button>
                                    <button type="reset" class="btn btn-primary">
                                        Reset
                                    </button>
                                </form>
                            </div>
                            <!-- /.col-lg-12 (nested) -->

                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                <?php }?>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
</html>