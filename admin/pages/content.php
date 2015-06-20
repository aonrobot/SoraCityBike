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
                                            <th>Action</th>
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
                                            <td>
                                                <button type="button" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"> Edit</i>
                                                <button type="button" class="btn btn-danger"  style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i>
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
				    
				<?php }?> 
				
				
				
				<?php if(!strcmp($_GET['a'], 'add')){?>				
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="index.php?p=query&a=addContent">
                                    	
                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Content Name">
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
                                            <select name="status" class="form-control">
                                                <option>Published</option>
                                                <option>Future</option>
                                                <option>Draft</option>
                                                <option>Pending</option>
                                                <option>Private</option>
                                                <option>Trash</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control">
                                                <option>content</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Category</label><br>
                                            <?php 
                                                $datas = $database->select("category", "*");
                                            ?>
                                            <?php foreach ($datas as $data) { ?>
                                            <div class="checkbox">
                                                <label>
                                                    <input name="category[]" type="checkbox" value="<?php echo $data['cat_id'];?>"> <?php echo $data['name'];?>
                                                </label>
                                            </div>
                                            <?php }?>
                                            
                                        </div>
                                          
                                        <div class="form-group">
                                                <?php 
                                                    $count = $database->count("language", "*");
                                                    $datas = $database->select("language", "*");
                                                ?> 
                                                <!-- Pull in Database from language list -->
                                                <label>Language</label>
                                                <select name="lang" class="form-control">
                                                <?php foreach ($datas as $data) { ?>
                                                <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>
                                                <?php } ?>
                                                </select>
                                        </div>    
                                        
                                        <div class="form-group">
                                                <label>Content</label>
	                                            <div id="canvas">
												    <div class="row">
												        <!-- Pull in Database from english language content -->
												    </div>
												</div>										
                                        </div>    
                                         
                                        <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>
                                        <button type="submit" class="btn btn-primary save_btn">Create Content</button>
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
<!-- / #page-wrapper -->

<script type="text/javascript">

    $(document).ready(function(){ 
           $("#canvas").gridmanager({
               debug: 1
           });    
    });
    
    $(document).ready(function(){ 
        var gm = jQuery("#canvas").data('gridmanager');
        $(".save_btn").on("click", function(e){
            gm.getContent();
        });
    });
    
	<?php if(!strcmp($_GET['a'], 'list')){?> 
    	//DataTable
    	$('#dataTables-example').DataTable({
                    responsive: true
        });
    <?php }?>
	
</script>