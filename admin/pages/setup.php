<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-plus-circle fa-1x"></i> Site Setup</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		<!-- ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
				<?php
                if (isset($_POST['submit'])) {
                    
                            //Setup Site
                           $database->update("site_meta", array(
                           
                                        'meta_value' => $_POST['site_name']
                                        
                           ),array('meta_key' => 'site_name'));
                           
                           $database->update("site_meta", array(
                           
                                        'meta_value' => $_POST['site_title']
                                        
                           ),array('meta_key' => 'site_title'));
                           
                           $database->update("site_meta", array(
                           
                                        'meta_value' => $_POST['admin_template']
                                        
                           ),array('meta_key' => 'admin_template'));
                }
				?>
			</div>
		</div>
		<!-- END ERROR ZONE -->
		<div class="row">
			<div class="col-lg-12">
			    
			    <?php
			    
			        $site_name = $database->select("site_meta","meta_value",array("meta_key" => 'site_name'));
    			    $site_title = $database->select("site_meta","meta_value",array("meta_key" => 'site_title'));
                    $admin_template = $database->select("site_meta","meta_value",array("meta_key" => 'admin_template'));
                ?>
                
				<div class="panel panel-default">
                    <div class="panel-heading">
                        Site Setup
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="index.php?p=setup" method="POST">
                                    <div class="form-group">
                                        <label>Site Name</label>
                                        <input class="form-control" name="site_name" placeholder="Site Name" value="<?php echo $site_name[0];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Site Title</label>
                                        <input class="form-control" name="site_title" placeholder="Site Title" value="<?php echo $site_title[0];?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Admin Template Url</label>
                                        <input class="form-control" name="admin_template" placeholder="Company Email" value="<?php echo $admin_template[0];?>">
                                    </div>
                                    <button name="submit" type='submit' class="btn btn-success">
                                        Update
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
                
                
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

