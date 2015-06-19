<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->
				
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Content Management</h1>
				
				<?php if(!strcmp($_GET['a'], 'list')){?>
				    
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>All Content</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Author</th>
                                            <th>Slug</th>
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Modified</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array('cont_title','cont_name','cont_author','cont_slug','cont_status','cont_type','cont_modified'));           
                                            foreach ($datas as $data) {
                                    ?>            
                                        <tr>
                                            <td><?php echo $data['cont_title'];?></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td><?php echo $data['cont_author'];?></td>
                                            <td><?php echo $data['cont_slug'];?></td>
                                            <td class="center"><?php echo $data['cont_status'];?></td>
                                            <td class="center"><?php echo $data['cont_type'];?></td>
                                            <td class="center"><?php echo $data['cont_modified'];?></td>
                                        </tr>
                                        
                                            <?php }?>
                                    </tbody>
                                </table>
                         </div>
                          <!-- /.table-responsive -->
                    </div>
                      <!-- /.panel-body -->
                        <?php //echo 'data -> '.print_r($datas); ?>
                </div>
                 <!-- /.panel -->
				    
				<?php }?> 
				
				
				
				<?php if(!strcmp($_GET['a'], 'add')){?>				
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="index.php?p=TestContent">
                                    	
                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" class="form-control" placeholder="Enter Author Name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Slug Name">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control">
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control">
                                                <option>Normal</option>
                                                <option>Story</option>
                                                <option>News</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Category</label><br>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Checkbox 1
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Checkbox 2
                                                </label>
                                            </div>
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" value="">Checkbox 3
                                                </label>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group">
                                            <h2>Content</h2>
                                            <!-- Pull in Database from language list -->
                                            <label>English</label>
	                                            <div id="mycanvas">
												    <div class="row">
												        <!-- Pull in Database from english language content -->
												    </div>
												</div>
											<label>Thai</label>
	                                            <div id="mycanvas2">
												    <div class="row">
												        <!-- Pull in Database from thai language content -->
												    </div>
												</div>
											
                                        </div>                          
                   
                                        <button type="submit" class="btn btn-default">Submit Button</button>
                                        <button type="reset" class="btn btn-default">Reset Button</button>
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
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<script>

	//Loop to create
    $(document).ready(function(){
        $("#mycanvas").gridmanager();  
    });
    $(document).ready(function(){
        $("#mycanvas2").gridmanager();  
    });
    //
    
    $( "#save_content" ).click(function() {
	  alert( "Handler for .click() called." );
	});
	
	//DataTable
	$('#dataTables-example').DataTable({
                responsive: true
    });
	
</script> 

