<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->
				
				
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Category Management</h1>
 
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create Category</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addCategory">
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Content Name">
                                        </div>
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Slug Name">
                                        </div>
                                        
                                        <div class="col-lg-2 form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control">
                                                <option value="category">Category</option>
                                                <option value="story">Story</option>
                                                <option value="news">News</option>
                                            </select>
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Create Category</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                               
                            </div>
                            <!-- /.row (nested) -->
                       </div>
                      <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
				    
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Category</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="show-cat">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("category","*");           
                                            foreach ($datas as $data) {
                                    ?>            
                                        <tr>
                                            <td><?php echo $data['cat_id'];?></td>
                                            <td><?php echo $data['cat_name'];?></td>
                                            <td><?php echo $data['cat_type'];?></td>
                                            <td>
                                                <a href="#" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"> Edit</i>
                                                <a href="query.php?a=del&w=category&i=<?php echo $data['cat_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i>
                                            </td>
                                        </tr>
                                        
                                    <?php }?>
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
<!-- / #page-wrapper -->

<script type="text/javascript">
    
    //DataTable
    $('#show-cat').DataTable({
        responsive: true
    });

	
</script>