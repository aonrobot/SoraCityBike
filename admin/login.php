<?php
require "config.php";
\Fr\LS::init();
if(isset($_POST['action_login'])){
    $identification = $_POST['login'];
    $password = $_POST['password'];
    if($identification == "" || $password == ""){
        $msg = array("Error", "Username / Password Wrong !");
    }else{
        $login = \Fr\LS::login($identification, $password, isset($_POST['remember_me']));
        if($login === false){
            $msg = array("Error", "Username / Password Wrong !");
        }else if(is_array($login) && $login['status'] == "blocked"){
            $msg = array("Error", "Too many login attempts. You can attempt login after ". $login['minutes'] ." minutes (". $login['seconds'] ." seconds)");
        }
    }
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

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger" role="alert">
                        <?php
                          if(isset($msg)){
                            echo "<p>$msg[1]</p>";
                          }
                        ?>
                        </div>
                        <form action="login.php" method="POST">
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="login" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember_me" type="checkbox">Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button name="action_login" class="btn btn-lg btn-success btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>
