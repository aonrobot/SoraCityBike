<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid" id="fakeLoader">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->

			    <?php if(strcmp($_GET['a'], 'edit')){?>

                    <h1 class="page-header"><i class="fa fa-cubes fa-1x"></i> Category Management</h1>
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Create Category</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="post" role="form" action="query.php?a=addCategory" data-toggle="validator">
                                            
                                            <div class="col-lg-12 form-group">
                                                <?php
                                                    $count = $database->count("language", "*");
                                                    $datas = $database->select("language", "*");
                                                    $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang'));
                                                ?>
                                                <!-- Pull in Database from language list -->
                                                <label>Language</label>
                                                <select name="lang" class="form-control">
                                                <?php foreach ($datas as $data) { ?>
                                                    <option value="<?php echo $data['lang_id'];?>" <?php  if(!strcmp($data['lang_id'], $default_lang[0]))echo 'selected';?>> <?php echo $data['lang_name'];?> <?php  if(!strcmp($data['lang_id'], $default_lang[0]))echo '(Default Language)';?></option>
                                                <?php } ?>
                                                </select>
                                            </div>
                                        
                                            <div class="col-lg-6 form-group">
                                                <label>Title</label>
                                                <input name="title" class="form-control" placeholder="Enter Category Name" required>
                                            </div>
    
                                            <div class="col-lg-6 form-group">
                                                <label>Name</label>
                                                <input name="name" class="form-control" placeholder="Enter Category Name" required>
                                            </div>
    
                                            <div class="col-lg-6 form-group">
                                                <label>Slug</label>
                                                <input name="slug" class="form-control" placeholder="Enter Category Slug" required>
                                            </div>
    
                                            <div class="col-lg-4 form-group">
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
                                                <th>Slug</th>
                                                <th>Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!------------------------------ bite and aon was here ------------------------------------------------------------------->
                                        <tbody>
                                        <?php
                                                $datas = $database->select("category","*",array("ORDER" => "cat_id"));
                                                $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang')); // Get Defalut Language
                                                
                                                foreach ($datas as $data) {
                                                $link_edit = "index.php?p=category&a=edit&id=".$data['cat_id']."&lang=".$default_lang[0];
                                        ?>
                                            
                                            <tr>
                                                <td><?php echo $data['cat_id'];?></td>
                                                <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['cat_id'];?>" data-url="query.php?a=editvaluecat&c=cat_name" data-title="Edit below here" ><?php echo $data['cat_name'];?></a></td>
                                                <td><a href="#" class="slug" data-type="text" data-pk="<?php echo $data['cat_id'];?>" data-url="query.php?a=editvaluecat&c=cat_slug" data-title="Edit below here" ><?php echo $data['cat_slug'];?></a></td>
                                                <td><a href="#" class="type" data-type="select" data-pk="<?php echo $data['cat_id'];?>" data-url="query.php?a=editvaluecat&c=cat_type" data-title="Edit below here" ><?php echo $data['cat_type'];?><a></td>
                                                <td>
                                                    <a href="<?php echo $link_edit;?>" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"></i></a>
                                                    <a href="query.php?a=del&w=category&i=<?php echo $data['cat_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-trash-o"></i></a>
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


                <?php if(!strcmp($_GET['a'], 'edit')){?>

                    <?php
                            //Important Parameter

                            $cat_id = $_GET['id'];      // Cat Id
                            
                            // Default Language Id
                            $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang')); // Get Defalut Language
                            if(!isset($_GET['lang'])) $lang = $default_lang[0];
                            else $lang = $_GET['lang']; 
                            
                            $lang_name = $database->select("language", "lang_name" , array("lang_id" => $lang));
                            $lang_name = $lang_name[0];
                            
                            // Language Select
                            $count = $database->count("language", "*");
                            $languages = $database->select("language", "*");
                            
                            // Check Did it have language in category_relationships
                            $chk_lang = $database->count("category_translation", array(
                                "AND" => array("cat_id" => $cat_id, "lang_id" => $lang)
                            ));
                            
                            //All Available Language
                            $available_langs = $database->select("category_translation",array("[>]language" => array("lang_id" => "lang_id")),array("lang_name"),array("cat_id" => $cat_id,));

                            //Category Select
                            $categorys = $database->select("category", array(

                            "[><]category_translation" => array("cat_id" => "cat_id"),

                            ), array('category.cat_id','cat_name','cat_title','lang_id'
                            ), array("AND" => array("category_translation.cat_id" => $cat_id, "lang_id" => $lang)) // Where
                            );
                            
                            //var_dump($categorys);
                            
                    ?>
                    <h1 class="page-header"><a href="index.php?p=category"><i class="fa fa-cubes fa-1x"></i></a> <?php echo $categorys[0]['cat_name'];?></h1>
                    
                    
                    <!-- ===================================== Favorite Content ========================================== -->
                    
                    <form method="post" role="form" action="query.php?a=updateCategory" data-toggle="validator">
                        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Category Info</b><br>
                        </div>
                        <div class="panel-body">                  
                           
                            <div class="row">
                                <div class="col-lg-12">
                                        <div class="form-group">

                                            <label><i class="fa fa-language fa-2x"></i> Available Language </label>
                                            <?php foreach ($available_langs as $available_lang) { ?>

                                                    <code><?php echo $available_lang['lang_name'];?></code>&nbsp;

                                            <?php }; ?>

                                        </div>

                                        <div class="form-group">

                                                <!-- Pull in Database from language list -->
                                                <label>Language</label>
                                                <select id="change_lang" name="lang" class="form-control" onchange="location = 'index.php?p=category&a=edit&id=<?php echo $cat_id;?>&lang='+this.options[this.selectedIndex].value";>

                                                <?php foreach ($languages as $data) {
                                                        if($data['lang_id'] == $lang) {?>

                                                            <option value="<?php echo $data['lang_id'];?>" selected><?php echo $data['lang_name'];?></option>

                                                <?php } else { ?>

                                                            <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>
                                                            
                                                <?php } } ?>

                                                </select>
                                                <script>
                                                
                                                    $('#change_lang').change(function(){
                                                        $('#create_new_lang').prop('disabled',true);
                                                    });
                                                  
                                                </script>
                                        </div>

                                        <?php if($chk_lang == 0){ ?>
                                                <input name="cat_id" type="hidden" value="<?php echo $cat_id;?>" />
                                                <button id="create_new_lang" type="submit" class="btn btn-success" style="margin-bottom: 15px;">Create <b><?php echo $lang_name;?></b> Language Category Title</button>

                                        <?php } else { ?>


                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title" value="<?php echo $categorys[0]['cat_title'];?>"/>
                                        </div>
                                        <br/>
                                       
                                        <?php }?>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Category Info</button>
                                        </div>
                                        

                                </div>
                                <!-- /.col-lg-12 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <input name="cat_id" type="hidden" value="<?php echo $cat_id;?>" />
                    
                    
                    
                    </form>
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b><i class="fa fa-star fa-1x" style="color: #f1c40f;"></i> Favorite Content</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="show-fav-content">
                                    <thead>
                                        <tr>
                                            <th>Un Favorite</th>

                                            <th>Title</th>
                                            <th>Name</th>

                                            <th>Type</th>
                                            <th>Category</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array(

                                            "[><]content_translation" => array("id" => "cont_id"),

                                            "[><]category_relationships" => "cont_id"

                                            ),

                                            array('id','cont_lang_id','cont_name','lang_id','cont_title','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_order'),

                                            array("AND" => array("cat_id" => $cat_id, "cont_order" => '-1'))

                                            );

                                            foreach ($datas as $data) {

                                                if(!strcmp($data['lang_id'], $data['cont_lang_id'])){

                                                    //echo $data['lang_id'] . " and " . $data['cont_lang_id'] . '<br>';
                                                    $link_edit = "index.php?p=content&a=edit&id=".$data['id']."&lang=".$data['cont_lang_id'];
                                    ?>
                                        <tr>
                                            <td><a href="query.php?a=delFav&i=<?php echo $data['id'];?>&cat_id=<?php echo $cat_id;?>" id="em-btn" class="btn btn-warning btn-circle btn-lg"><i id="em-star" class="fa fa-star fa-1x" style="color: #FFF0F0;"></i></td>
                                            <script>
                                                $("#em-btn").mouseover(function(){
                                                  $("#em-star").addClass("fa-star-o").removeClass("fa-star")
                                                })
                                                $("#em-btn").mouseleave(function(){
                                                  $("#em-star").addClass("fa-star").removeClass("fa-star-o")
                                                })
                                            </script>
																						
                                            <td><a href="<?php echo $link_edit?>"><?php echo $data['cont_title'];?></a></td>
                                            <td><?php echo $data['cont_name'];?></td>

                                            <td class="center"><?php echo $data['cont_type'];?></td>
                                            <td>
                                                <?php   $cats = $database->select("category_relationships",array("[>]category" => array("cat_id" => "cat_id")),array("cat_name"),array("cont_id" => $data['id'],));

                                                        foreach ($cats as $cat) {
                                                ?>

                                                    <code><?php echo $cat['cat_name'];?></code>&nbsp;

                                                <?php }?>
                                            </td>

                                            <td>
                                                <a href="query.php?a=del&w=content&i=<?php echo $data['id'];?>&cat_id=<?php echo $cat_id;?>" class="btn btn-danger"  style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i>
                                            </td>
                                        </tr>

                                            <?php continue;} }?>
                                    </tbody>
                                </table>
                             </div>
                              <!-- /.table-responsive -->
                        </div>
                          <!-- /.panel-body -->
                    </div>
                     <!-- /.panel -->
                     
                     
                     <!-- ===================================== Content ========================================== -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b><i class="fa fa-book fa-1x" style="color: #3498db;"></i> All Content</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="show-content">
                                    <thead>
                                        <tr>
                                            <th>Favorite</th>
											<th>Ordering</th>
                                            <th>Title</th>
                                            <th>Name</th>

                                            <th>Type</th>
                                            <th>Category</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array(

                                            "[><]content_translation" => array("id" => "cont_id"),

                                            "[><]category_relationships" => "cont_id"

                                            ),

                                            array('id','cont_lang_id','cont_name','lang_id','cont_title','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_order','cont_id','cat_id'),

                                            array("AND" => array("cat_id" => $cat_id, "cont_order[!]" => '-1'),"ORDER" => "cont_order")

                                            );
                                            

                                            foreach ($datas as $data) {

                                                if(!strcmp($data['lang_id'], $data['cont_lang_id'])){

                                                    //echo $data['lang_id'] . " and " . $data['cont_lang_id'] . '<br>';
                                                    $link_edit = "index.php?p=content&a=edit&id=".$data['id']."&lang=".$data['cont_lang_id'];
                                    ?>
                                        <tr>
                                            <td><a href="query.php?a=addFav&i=<?php echo $data['id'];?>&cat_id=<?php echo $cat_id;?>" id="em-btn" class="btn btn-warning btn-circle btn-lg"><i id="em-star" class="fa fa-star-o fa-1x" style="color: #FFF0F0;"></i></td>
                                            <script>
                                                $("#em-btn").mouseover(function(){
                                                  $("#em-star").addClass("fa-star").removeClass("fa-star-o")
                                                })
                                                $("#em-btn").mouseleave(function(){
                                                  $("#em-star").addClass("fa-star-o").removeClass("fa-star")
                                                })
                                            </script>
                                            
                                            <!------------------------ Ordering ----------------------------->
											<td>
											    <a class="ordering" data-type="text" data-pk="<?php echo $data['cont_id'];?>" data-url="query.php?a=editvaluecat&c=cont_order&cat_id=<?php echo $cat_id;?>" data-title="Edit below here" ><?php echo $data['cont_order'];?></a>
											</td>
											
                                            <td><a href="<?php echo $link_edit?>"><?php echo $data['cont_title'];?></a></td>
                                            <td><?php echo $data['cont_name'];?></td>

                                            <td class="center"><?php echo $data['cont_type'];?></td>
                                            <td>
                                                <?php   $cats = $database->select("category_relationships",array("[>]category" => array("cat_id" => "cat_id")),array("cat_name","category.cat_id"),array("cont_id" => $data['id'],));

                                                        foreach ($cats as $cat) {
                                                ?>

                                                    <a href="index.php?p=category&a=edit&id=<?php echo $cat['cat_id'];?>"><code><?php echo $cat['cat_name'];?></code></a>&nbsp;

                                                <?php }?>
                                            </td>

                                            <td>
                                                <a href="query.php?a=del&w=content&i=<?php echo $data['id'];?>" class="btn btn-danger"  style="margin-right: 8px;" ><i class="fa fa-recycle"> Delete</i>
                                            </td>
                                        </tr>

                                            <?php continue;} }?>
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

    <?php if(strcmp($_GET['a'], 'edit')){?>
        //DataTable
        $('#show-cat').DataTable({
            paging: false,
            responsive: true,
            "order": [[ 0, "desc" ]],
        });
    <?php }?>   

    //DataTable
    $('#show-content').DataTable({
        paging: false,
        responsive: true,

    });
    $('#show-fav-content').DataTable({
        paging: false,
        responsive: true,

    });


	$(document).ready(function(){
		$(function() {
		  $.fn.editable.defaults.mode = 'inline';
		
		  $('.name').editable({});
		  $('.slug').editable({});
		  $('.ordering').editable({
		      success: function() {
                    window.location = "index.php?p=category&a=edit&id=<?php echo $cat_id;?>&noti=SUpdateOrder";
              }
		  });
		  $('.type').editable({
				
			  	source: [
	            
	            {value: 'category', text: 'Category'},
	            {value: 'story', text: 'Story'},
	            {value: 'news', text: 'News'}
  
	        ]

			});

 		});
 			
 	 });

</script>
<script src="components/Editablecss/js/bootstrap-editable.js"></script>
