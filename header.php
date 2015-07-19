            <!DOCTYPE html>
            
            <html lang="en">

            <head>

              <meta charset="utf-8">
              <meta http-equiv="X-UA-Compatible" content="IE=edge">
              <meta name="viewport" content="width=device-width, initial-scale=1">
              <meta name="description" content="">
              <meta name="author" content="">
              <link rel="shortcut icon" href="/components/img/favicon2.png">
              <link rel="icon" href="/components/img/favicon2.png">

              <title>Sora City Bike</title>
              
              <link href="/components/css/bootstrap.css" rel="stylesheet">
              <link href="/components/css/sora-default.css" rel="stylesheet">
              <link href="/components/css/leo.css" rel="stylesheet">
              <script src="/components/js/jquery.js"></script>
			  <link rel="stylesheet" type="text/css" href="/components/css/cobox.css">

            </head>

            <?php



            $top_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[=]" => 0]);
            $sub_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[>]" => 0]);
            $lang=$database->select("language",'*');


            // foreach ($lang as $key ) {
            //     if (isset($_GET['lang'])) {  
            //          if($_GET['lang']==$key['lang_code']) {
            //             $_SESSION['lang_session'] = $key['lang_id'];
            //         }
            //     }
            //     else
            //         if($_SESSION['def_lang']==$key['lang_code']) {
            //             $_SESSION['lang_session'] = $key['lang_id'];
            //         }
            // }
            // //echo  $_SESSION['lang_session'];
            ?>

            <body> 
                <div class="row row_navbar">
                <div class="col-xs-4 brand-time " align="center">
                        <?php 
                        echo '<span class=" pero-font uppercase time_text">'.date('D j M').'</span>';

                        

                     ?>
                 </div>
                    <div class="col-xs-4 col-xs-offset-4 brand-social" align="center">
                        <a href="https://www.facebook.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-fb')" 
                        onmouseout="logo_mouseout('icon-fb')" id="icon-fb" src="/components/img/icon/icon-fb-type2.png"/></a>
                         <a href="https://www.instragram.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ig')" 
                        onmouseout="logo_mouseout('icon-ig')" id="icon-ig" src="/components/img/icon/icon-ig-type2.png"/></a>
                         <a href="https://www.pinterest.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-pt')" 
                        onmouseout="logo_mouseout('icon-pt')" id="icon-pt" src="/components/img/icon/icon-pt-type2.png"/></a>
                        <a href="https://www.vimeo.com/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ve')" 
                        onmouseout="logo_mouseout('icon-ve')" id="icon-ve" src="/components/img/icon/icon-ve-type2.png"/></a>
                        <?php
                        foreach ($lang as $a) {

                        echo '<a href="index.php?lang='.$a['lang_code'].'"><button class="time_text bg-gray pero-font btn btn-default lowercase" > '.$a['lang_code'].' </button></a>';


                     }    
                        ?>
                    </div>
                </div>

                <div class="brand row">
                
                    
                    <div class="col-xs-4 col-xs-offset-4 brand-logo ">
                        <a href="index.php"><img class="logo_img" src="/components/img/LOGO-(with-cloud)2.png"/></a>
                    </div>
                 

             </div>
             <hr class="top_line">
            
             <nav class="bg-gray navbar navbar-default " role="navigation" id="stickyheader">
                <div class="bg-gray container top-menu ">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header" align="center">

                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>

                        </button>
                        <a class="pero-font navbar-brand" href="index.html"><b>Sora City Bike</b></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">

                        <ul class="nav navbar-nav">

                            <?php foreach ($top_menu as $menu ) { 
                                echo '<li id="menu_'.$menu['menu_id'].'">';
                                if ($menu['obj_type'] == 'content') {
                                  
                                  $link = "'index.php?p=".$menu['obj_type']."&id=".$menu['obj_url']."'";
                                  
                                }
                                elseif ($menu['obj_type'] == 'link') {
                                 $link ="'".$menu['obj_url']."'";  
                                } 
                                else {
                                  $link = "";
                                }    

                               echo '<div class="bg-gray pero-bold-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" onclick="window.location.href='.$link.'">';?>
                               <?php echo $menu['obj_name']; ?>
                               <?php if ($menu['obj_type'] == 'category') echo '<span><img class="dropdown-span" src="/components/img/down-btn.png"/></span>'; ?>
                           </div>
                           <?php if ($menu['obj_type'] == 'category') { ?>
                           <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <?php
                            foreach ($sub_menu as $a ) {
                                $sub=$a['parent_id'];
                                $top=$menu['obj_id'];
                                if ($sub==$top) {

                                    echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php?p='.$a['obj_type']."&id=".$a['obj_url'].'">'.$a['obj_name'].'</a></li>' ;


                                }
                            }

                            ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>



                </ul>

            </div>
            <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
            </nav>

            <div id="stickyalias"></div>


            <script>
           
        $(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('#stickyheader').offset().top;
        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('#stickyheader').css({position: 'fixed',width:'100%'});

                        $('#stickyalias').css('display', 'block');
                } else {
                        $('#stickyheader').css({position: 'static', top: '0px'});
                        $('#stickyalias').css('display', 'none');
                }
        });
    });

          </script>
           