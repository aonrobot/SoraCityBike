<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><i class="fa fa-user fa-1x"></i> Manage Admin User</h1>
			</div>
			<!-- /.col-lg-12 -->
		</div>
		<!-- /.row -->
		
		<div class="row">
		    
		    
			<div class="col-lg-12">
			    
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Admin User</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>Name</th>
                                            <th>E-mail</th>
                                            <th>Password</th>
                                            <th>Created</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("users", "*");
                                            
                                            foreach ($datas as $data) {


                                    ?>
                                        <tr>
                                                                                        
                                            <td><?php echo $data['id'];?></td>
                                            <td><?php echo $data['username'];?></td>
                                            <td><?php echo $data['name'];?></td>
                                            <td><?php echo $data['email'];?></td>
                                            <td><?php echo $data['password'];?></td>
                                            <td><?php echo $data['created'];?></td>
                                            <td>
                                                <?php if($data['id'] != $details['id']){?>
                                                    <a href="query.php?a=del&w=user&i=<?php echo $data['id'];?>" class="btn btn-danger"  style="margin-right: 8px;" ><i class="fa fa-trash-o"></i></a>
                                                <?php };?>
                                            </td>
                                        </tr>

                                            <?php } ?>
                                    </tbody>
                                </table>
                               
                         </div>
                          <!-- /.table-responsive -->
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

