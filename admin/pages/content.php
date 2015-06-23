<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->
				
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Content Management</h1>
				
				<?php if(!strcmp($_GET['s'], 'show')){?>
				    
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
                                            <th>Status</th>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Modified</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array(
                                            
                                            "[<]content_translation" => array("id" => "cont_id"),
                                            
                                            ), array('id','cont_lang_id','cont_name','cont_title','cont_author','cont_slug','cont_status','cont_type','cont_modified'));           
                                            
                                            foreach ($datas as $data) {
                                    ?>            
                                        <tr>
                                            <td><?php echo $data['cont_title'];?></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td class="center"><?php echo $data['cont_status'];?></td>
                                            <td class="center"><?php echo $data['cont_type'];?></td>
                                            <td>
                                                <?php   $cats = $database->select("category_relationships",array("[>]category" => array("cat_id" => "cat_id")),array("cat_name"),array("cont_id" => $data['id'],)); 
                                                        
                                                        foreach ($cats as $cat) {
                                                ?>
                                                
                                                    <code><?php echo $cat['cat_name'];?></code>&nbsp;
                                                
                                                <?php }?>
                                            </td>
                                            <td class="center"><?php echo $data['cont_modified'];?></td>
                                            <td>
                                                <a href="index.php?p=content&a=edit&id=<?php echo $data['id'];?>&lang=<?php echo $data['cont_lang_id'];?>" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"> Edit</i>
                                                <a href="query.php?a=del&w=content&i=<?php echo $data['id'];?>" class="btn btn-danger"  style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i>
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
				
				<?php if(!strcmp($_GET['s'], 'create')){?>				
				
				<form method="post" role="form" action="query.php?a=addContent">
				
				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Content Info</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div class="form-group">
                                                <?php 
                                                    $count = $database->count("language", "*");
                                                    $datas = $database->select("language", "*");
                                                ?> 
                                                <!-- Pull in Database from language list -->
                                                <label>Default Language</label>
                                                <select name="lang" class="form-control">
                                                <?php foreach ($datas as $data) { ?>
                                                    <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>
                                                <?php } ?>
                                                </select>
                                        </div>
                                        
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
                                                <option value="published">Published</option>
                                                <option value="future">Future</option>
                                                <option value="draft">Draft</option>
                                                <option value="pending">Pending</option>
                                                <option value="private">Private</option>
                                                <option value="trash">Trash</option>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control">
                                                <option value="content">Content</option>
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
                                                    <input name="category[]" type="checkbox" value="<?php echo $data['cat_id'];?>"> <?php echo $data['cat_name'];?>
                                                </label>
                                            </div>
                                            <?php }?>
                                            
                                        </div>
                                        
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
                            <b>Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">                                                                              
                                        
                                        <div class="form-group">
                                                <div id="canvas">
                                                    <div class="row">
                                                        <!-- Pull in Database from english language content -->
                                                    </div>
                                                </div>                                      
                                        </div>    
                                         
                                        <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>
                                        
                                </div>
                                <!-- /.col-lg-12 (nested) -->
                               
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <button type="submit" class="btn btn-primary save_btn">Create Content</button>
                    
                    </form>
                    
                    
                <?php }?>
				
				<?php if(!strcmp($_GET['a'], 'edit')){?>              
                
                    <?php
                            //Important Parameter 
                            
                            $id = $_GET['id'];      // Content Id
                            $lang = $_GET['lang'];  // Default Language Id
                            
                            // Language Select
                            $count = $database->count("language", "*");
                            $languages = $database->select("language", "*");
                            
                            //Content Select
                            $contents = $database->select("content", array(
                                            
                            "[<]content_translation" => array("id" => "cont_id"),
                                            
                            ), array('id','cont_lang_id','cont_name','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_title','cont_content','lang_id'
                            ), array("AND" => array("id" => $id, "lang_id" => $lang)) // Where
                            );
                            
                            
                    ?>
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=updateContent">
                                                                                    
                                        <div class="form-group">
                                            
                                                <!-- Pull in Database from language list -->
                                                <label>Language</label>
                                                <select name="lang" class="form-control" onchange="location = 'index.php?p=content&a=edit&id=1&lang='+this.options[this.selectedIndex].value";>
                                                    
                                                <?php foreach ($languages as $data) { 
                                                        if($data['lang_id'] == $lang) {?>
                                                            
                                                            <option value="<?php echo $data['lang_id'];?>" selected><?php echo $data['lang_name'];?></option>    
                                                            
                                                <?php } else { ?>
                                                            
                                                            <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>    
                                                            
                                                <?php } } ?>
                                                                                                                                                                            
                                                </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title" value="<?php echo $contents[0]['cont_title'];?>">
                                        </div>    
                                        
                                        <div class="form-group">
                                                <label>Content</label>
                                                <div id="canvas">
                                                        <?php echo $contents[0]['cont_content'];?>
                                                </div>                                      
                                        </div>    
                                         
                                        <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>
                                        
                                        <input name="content_id" type="hidden" value="<?php echo $id;?>" />
                                        
                                        <button type="submit" class="btn btn-primary save_btn">Update Content</button>
                    
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
                                <b>Content Info</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                    <form method="post" role="form" action="query.php?a=updateContentInfo">
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" class="form-control" placeholder="Enter Content Name" value="<?php echo $contents[0]['cont_name'];?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Author</label>
                                                <input name="author" class="form-control" placeholder="Enter Author Name" value="<?php echo $contents[0]['cont_author'];?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input name="slug" class="form-control" placeholder="Enter Slug Name" value="<?php echo $contents[0]['cont_slug'];?>">
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="published"   <?php if(!strcmp($contents[0]['cont_status'], "published"))echo "selected";?> >Published</option>
                                                    <option value="future"      <?php if(!strcmp($contents[0]['cont_status'], "future"))echo "selected";?> >Future</option>
                                                    <option value="draft"       <?php if(!strcmp($contents[0]['cont_status'], "draft"))echo "selected";?> >Draft</option>
                                                    <option value="pending"     <?php if(!strcmp($contents[0]['cont_status'], "pending"))echo "selected";?> >Pending</option>
                                                    <option value="private"     <?php if(!strcmp($contents[0]['cont_status'], "private"))echo "selected";?> >Private</option>
                                                    <option value="trash"       <?php if(!strcmp($contents[0]['cont_status'], "trash"))echo "selected";?> >Trash</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" class="form-control">
                                                    <option value="content"     <?php if(!strcmp($contents[0]['cont_type'], "content"))echo "selected";?> >Content</option>
                                                </select>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label>Category</label><br>
                                                <?php 
                                                    $datas = $database->select("category", "*");
                                                    $cats = $database->select("category_relationships", "cat_id", array("cont_id" => $id));  
                                                ?>
                                                <?php foreach ($datas as $data) { ?>
                                                <div class="checkbox">
                                                    <label>
                                                        <input name="category[]" type="checkbox" value="<?php echo $data['cat_id'];?>"      <?php if(in_array($data['cat_id'], $cats)) echo"checked";?> > <?php echo $data['cat_name'];?>
                                                    </label>
                                                </div>
                                                <?php }?>
                                                
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                        
                                         <input name="content_id" type="hidden" value="<?php echo $id;?>" />
                                         
                                         <input name="lang" type="hidden" value="<?php echo $lang;?>" />
                                        
                                         <button type="submit" class="btn btn-primary save_btn">Update Content Info</button>
                    
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
				
				<?php if(!strcmp($_GET['s'], 'language')){?>
				    		    
				    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Language</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addlang">
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Language Code</label>
                                            <input name="code" class="form-control" placeholder="Enter Language Code Name">
                                        </div>
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Language Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Language Name">
                                        </div>
                                        
                                        <div class="col-lg-2">
                                            <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Add Language</button>
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
                                <b>All Language</b>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="dataTable_wrapper">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>id</th>
                                                <th>Code</th>
                                                <th>Language Name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                                $datas = $database->select("language","*");           
                                                foreach ($datas as $data) {
                                        ?>            
                                            <tr>
                                                <td><?php echo $data['lang_id'];?></td>
                                                <td><?php echo $data['lang_code'];?></td>
                                                <td><?php echo $data['lang_name'];?></td>
                                                <td>
                                                    <a href="#" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"> Edit</i>
                                                    <?php if($data['lang_id'] != 1){?>
                                                    <a href="query.php?a=del&w=lang&i=<?php echo $data['lang_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i>
                                                    <?php };?>
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