<!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" target="_blank" href="<?php echo $site_path[0];?>"><i class="fa fa-gear fa-fw"></i><?php echo ' '.$site_name; ?></a>
            </div>
            
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">           
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="index.php?p=addUser"><i class="fa fa-plus fa-fw"></i> Add New Admin User</a>
                        </li>
                        <li><a href="index.php?p=userInfo"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="index.php?p=reset"><i class="fa fa-refresh fa-fw"></i> Forget Password</a>
                        </li>
                        <li><a href="index.php?p=setup"><i class="fa fa-institution fa-fw"></i> Setup Site</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                    	
                 		<!-- Start A First Menu -->
                 		<?php $site_name = $database->select("site_meta","meta_value",array("meta_key" => 'site_name'));?>
                        <li>
                            <a href="index.php?p=dashboard"><i class="fa fa-bicycle fa-fw"></i> <?php echo $site_name[0];?></a>
                        </li>

                        <li>
                            <a href="index.php?p=category"><i class="fa fa-cubes fa-fw"></i> Category</a>
                        </li>
                        
                        <li>
                            <a href=""><i class="fa fa-book fa-fw"></i> Content</a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?p=content&s=show">Show All Content</a>
                                </li>
                                <li>
                                    <a href="index.php?p=content&s=create">Create Content</a>
                                </li>
                                <li>
                                    <a href="index.php?p=content&s=language">Language</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="index.php?p=menu"><i class="fa fa-bars fa-fw"></i> Menu</a>
                        </li>
                        
                        <li>
                            <a href="index.php?p=slide"><i class="fa fa-picture-o fa-fw"></i> Slide</a>
                        </li>
                        
                        <li>
                            <a href="index.php?p=TestContent"><i class="fa fa-terminal fa-fw"></i> TestContent</a>
                        </li>
                        
                        <li>
                            <a href="index.php?p=TestEdit"><i class="fa fa-terminal fa-fw"></i> TestEdit</a>
                        </li>
                        
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>