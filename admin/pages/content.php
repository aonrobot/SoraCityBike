<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->

				<?php $users = \Fr\LS::getUser();?>

				<?php if(!strcmp($_GET['s'], 'show')){?>
				    
				<h1 class="page-header"><i class="fa fa-book fa-1x"></i> Content Management</h1>

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
                                            <th><input type="checkbox" id="checkAll"/></th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>By</th>
                                            <th>Modified</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array(

                                            "[<]content_translation" => array("id" => "cont_id"),)
                                            
                                            ,array('id','user_id','cont_lang_id','cont_name','lang_id','cont_title','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_id')
                                            
                                            );
                                            
                                            foreach ($datas as $data) {

                                                if(!strcmp($data['lang_id'], $data['cont_lang_id'])){

                                                    //echo $data['lang_id'] . " and " . $data['cont_lang_id'] . '<br>';
                                                    $link_edit = "index.php?p=content&a=edit&id=".$data['id']."&lang=".$data['cont_lang_id'];
                                    ?>
                                        <tr>
                                            
                                            <td style="text-align: center;">
                                                <div class="checkbox">
                                                    <label>
                                                        <input id="checkItem" name="checkItem[]" type="checkbox" value="<?php echo $data['id'];?>">
                                                    </label>
                                                </div>
                                            </td>
                                            
                                            <td><?php echo $data['cont_id'];?></td>
                                            <td><a href="<?php echo $link_edit?>"><?php echo $data['cont_title'];?></a></td>
                                            <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue&c=cont_name" data-title="Edit below here" ><?php echo $data['cont_name'];?></a></td>
                                            <td class="center"><a href="#" class="status" data-type="select" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue&c=cont_status" data-title="Edit below here"  >  	
                                            <?php echo $data['cont_status'];?>	</a></td>
                                            <?php   
                                                        $cats = $database->select("category_relationships",array("[>]category" => array("cat_id" => "cat_id")),array("cat_name"),array("cont_id" => $data['id'],));
                                                        $str_cat = "";
                                                                                                                
                                                        foreach ($cats as $cat) {
                                                            $str_cat = $str_cat.'&ordm; <code>'.$cat['cat_name'].'</code><br>';
                                                        }
                                            ?>
                                                
                                            <td>
                                                 <a href="#" class="category" data-type="checklist" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue2&c=cat_name" data-title="Edit below here" ><p><?php echo $str_cat;?></p></a>
                                            </td>
                                            <?php $by = $database->select("users",'username',array('id'=>$data['user_id']));?>
                                            <td><?php echo $by[0];?></td>
                                            <td class="center"><?php echo $data['cont_modified'];?></td>
                                            <td>
                                                <a href="index.php?p=content&a=edit&id=<?php echo $data['id'];?>&lang=<?php echo $data['lang_id'];?>" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"></i></a>
                                                <a href="query.php?a=del&w=content&i=<?php echo $data['id'];?>" class="btn btn-danger"  style="margin-right: 8px;" ><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>

                                            <?php continue;} }?>
                                    </tbody>
                                </table>
                                
                                <!-- Multi Action -->

                                <div class="row">
                                    <div class="col col-lg-4">
                                        <select name="cont_action" class="form-control">
                                            <option value="delete">Delete Content</option>
                                        </select>
                                    </div>
                                    <div class="col col-lg-4">
                                        <button id="cont_action_btn" class="btn btn-success">
                                            Action All Select
                                        </button>
                                    </div>
                                </div>
                                
                                <script>
                                    $("#checkAll").click(function() {
                                        $('input:checkbox').not(this).prop('checked', this.checked);
                                    });
                                
                                    $("#cont_action_btn").click(function() {
                                        
                                        var checked = []
                                        $("input[name='checkItem[]']:checked").each(function ()
                                        {
                                            checked.push(parseInt($(this).val()));
                                        });
                                                                                
                                        var formData = {
                                            'a' : 'multiActionCont',
                                            'checkItem' : checked,
                                            'action' : $('select[name=cont_action]').val(),
                                        };

                                        $.ajax({
                                            type : "POST",
                                            url : 'functions/ajaxQuery.php',
                                            data : formData,
                                            success : function(data) {
                                                window.location.href = "index.php?p=content&s=show&noti=SDelMultiContent";
                                            }
                                        });
                                
                                    });
                                
                                </script>
                                
                                <!-- /Multi Action -->

                         </div>
                          <!-- /.table-responsive -->
                    </div>
                      <!-- /.panel-body -->
                </div>
                 <!-- /.panel -->

				<?php }?>

				<?php if(!strcmp($_GET['s'], 'create')){?>
				
				<h1 class="page-header"><a href="index.php?p=content&s=show"><i class="fa fa-book fa-1x"></i></a> Create Content</h1>

				<form method="post" role="form" action="query.php?a=addContent" enctype="multipart/form-data" data-toggle="validator">

				<div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Content Info</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select name="type" class="form-control">
                                                <option value="content">Content</option>
                                            </select>
                                        </div>

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
                                            <label>Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Content Name" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Author</label>
                                            <input name="author" class="form-control" placeholder="Enter Author Name" value="<?php echo $users['name'];?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input name="slug" class="form-control" placeholder="Enter Slug Name" required>
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
                                        
                                        <div class="form-group" id="category_list">
                                            <a href="index.php?p=category" target="_blank"><label>Category </label></a><a class="btn btn-success btn-xs" style="margin-left: 6px;" data-toggle='modal' data-target='#add_cat_modal'><i class="fa fa-plus fa-lg"></i></a><br>
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
                                        
                                        <div class="form-group">
                                            <label>Thumbnail </label><a id="rest_thumb" class="btn btn-danger btn-xs" style="margin-left: 8px;">Reset Thumbnail</a><br>
                                            
                                            
                                            
                                            <input id="thumb" name="thumb" type="hidden" value="<?php echo $site_path[0]?>/sora_blank_thumb.png">
                                            
                                            <a class="modalButton" data-toggle="modal" data-src="components/fileman_custom/index.html?integration=custom" data-height=450 data-width=100% data-target="#file_modal"><img src="../sora_blank_thumb.png" id="customRoxyImage" style="width:400px; height: 300px;"></a>
                                                
                                                <div class="modal fade" id="file_modal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Select Thumbnail</h4>
                                                           </div>
                                                         <div class="modal-body">
                                                              <iframe frameborder="0"></iframe>
                                                         </div>
                                                        </div><!-- /.modal-content -->
                                                     </div><!-- /.modal-dialog -->
                                                  </div><!-- /.modal -->
                                        </div>
                                            
                                        </div>
                                        <script>
                                            $('a.modalButton').on('click', function(e) {
                                                var src = $(this).attr('data-src');
                                                var height = $(this).attr('data-height') || 300;
                                                var width = $(this).attr('data-width') || 400;
                                            
                                                $("#file_modal iframe").attr({'src':src,
                                                                           'height': height,
                                                                           'width': width});
                                            });
                                            function closeCustomRoxy(){
                                              $('#file_modal').modal('hide');
                                            }
                                            
                                        </script>

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Default Language Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="description" name="description" class="form-control" rows="3" style="resize: none;"></textarea>
                                        </div>
                                        <script>
                                                
                                                CKEDITOR.replace( 'description', {
                                                    customConfig: '<?php echo $site_path[0];?>/admin/js/ck_config.js' ,                                                   
                                                    wordcount: {
                                                        showCharCount: true,
                                                        maxWordCount: 4000,
                                                        maxCharCount: 100,

                                                    },      
                                                                                                
                                                    toolbar: [
                                                      [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ],
                                                     ]
                                                     
                                                    }
                                                );
                                            </script>

                                        <div class="form-group">
                                            <label>Content</label>
                                                <div id="canvas">
                                                </div>
                                        </div>

                                        <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>

                                </div>
                                <!-- /.col-lg-12 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                            <input name="user_id" type="hidden" value="<?php echo $users['id'];?>">
                            <button type="submit" class="btn btn-primary save_btn">Create Content</button>

                        

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->

                </form>


                <?php }?>

				<?php if(!strcmp($_GET['a'], 'edit')){?>

                    <?php
                            //Important Parameter

                            $id = $_GET['id'];      // Content Id
                            $lang = $_GET['lang'];  // Default Language Id
                            $lang_name = $database->select("language", "lang_name" , array("lang_id" => $lang));
                            $lang_name = $lang_name[0];

                            // Language Select
                            $count = $database->count("language", "*");
                            $languages = $database->select("language", "*");

                            // Check Did it have language in category_relationships
                            $chk_lang = $database->count("content_translation", array(
                                "AND" => array("cont_id" => $id, "lang_id" => $lang)
                            ));

                            //All Available Language
                            $available_langs = $database->select("content_translation",array("[>]language" => array("lang_id" => "lang_id")),array("lang_name"),array("cont_id" => $id,));

                            //Content Select
                            $contents = $database->select("content", array(

                            "[><]content_translation" => array("id" => "cont_id"),

                            ), array('id','cont_lang_id','cont_name','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_title','cont_content','cont_description','cont_thumbnail','lang_id'
                            ), array("AND" => array("id" => $id, "lang_id" => $lang)) // Where
                            );


                    ?>
                    
                    <h1 class="page-header"><a href="index.php?p=content&s=show"><i class="fa fa-book fa-1x"></i></a> <?php echo $contents[0]['cont_title'];?></h1>
                    
                    <form method="post" role="form" action="query.php?a=updateContent" data-toggle="validator">
                         
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Multilanguage Content </b><br>
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
                                                <select name="lang" class="form-control" onchange="location = 'index.php?p=content&a=edit&id=<?php echo $id;?>&lang='+this.options[this.selectedIndex].value";>

                                                <?php foreach ($languages as $data) {
                                                        if($data['lang_id'] == $lang) {?>

                                                            <option value="<?php echo $data['lang_id'];?>" selected><?php echo $data['lang_name'];?></option>

                                                <?php } else { ?>

                                                            <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>

                                                <?php } } ?>

                                                </select>
                                        </div>

                                        <?php if($chk_lang == 0){ ?>
                                                <input name="content_id" type="hidden" value="<?php echo $id;?>" />
                                                <button type="submit" class="btn btn-success">Create <?php echo $lang_name;?> Language Content</button>

                                        <?php } else { ?>


                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title" value="<?php echo $contents[0]['cont_title'];?>"/>
                                        </div>
                                        <br />

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="description" name="description" class="form-control" rows="3" style="resize: none;"><?php echo $contents[0]['cont_description'];?></textarea>
                                        </div>
                                        <script>                                                
                                                CKEDITOR.replace( 'description', {
                                                    customConfig: '<?php echo $site_path[0];?>/admin/js/ck_config.js' ,                                                    
                                                    wordcount: {
                                                        showCharCount: true,
                                                        maxWordCount: 4000,
                                                        maxCharCount: 100,

                                                    },      
                                                                                                
                                                    toolbar: [
                                                      [ 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo' ],
                                                     ]
                                                     
                                                    }
                                                );
                                        </script>
                                        
                                        <div class="form-group">
                                            <label>Content</label>
                                                <div id="canvas">
                                                    <?php echo $contents[0]['cont_content'];?>
                                                </div>
                                        </div>

                                        <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>

                                        <?php }?>



                                </div>
                                <!-- /.col-lg-12 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <?php 
                            $content_info = $database->select("content",'*', array("id" => $id));
                    ?>

                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Content Info</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Thumbnail</label><a id="rest_thumb" class="btn btn-danger btn-xs" style="margin-left: 8px;">Reset Thumbnail</a><br>
                                                <!-- <input id="input-700" name="kartik-input-700[]" type="file" class="file-loading">
                                                <input name="thumb" type="hidden"> -->
                                                <a href="javascript:openCustomRoxy()"><img src="<?php echo $content_info[0]['cont_thumbnail'];?>" id="customRoxyImage" style="width:400px; height: 300px;"></a>
                                                <input id="thumb" name="thumb" type="hidden" value="<?php echo $content_info[0]['cont_thumbnail'];?>">
                                                <div id="roxyCustomPanel" style="display: none;">
                                                  <iframe src="components/fileman_custom/index.html?integration=custom" style="width:100%;height:100%" frameborder="0"></iframe>
                                                </div>
                                            </div>
                                            <script>
                                                function openCustomRoxy(){
                                                  $('#roxyCustomPanel').dialog({modal:true, width:875,height:600});
                                                }
                                                function closeCustomRoxy(){
                                                  $('#roxyCustomPanel').dialog('close');
                                                }
                                            </script>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input required name="name" class="form-control" placeholder="Enter Content Name" value="<?php echo $content_info[0]['cont_name'];?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Author</label>
                                                <input name="author" class="form-control" placeholder="Enter Author Name" value="<?php echo $content_info[0]['cont_author'];?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Slug</label>
                                                <input name="slug" class="form-control" placeholder="Enter Slug Name" value="<?php echo $content_info[0]['cont_slug'];?>">
                                            </div>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select name="status" class="form-control">
                                                    <option value="published"   <?php if(!strcmp($content_info[0]['cont_status'], "published"))echo "selected";?> >Published</option>
                                                    <option value="future"      <?php if(!strcmp($content_info[0]['cont_status'], "future"))echo "selected";?> >Future</option>
                                                    <option value="draft"       <?php if(!strcmp($content_info[0]['cont_status'], "draft"))echo "selected";?> >Draft</option>
                                                    <option value="pending"     <?php if(!strcmp($content_info[0]['cont_status'], "pending"))echo "selected";?> >Pending</option>
                                                    <option value="private"     <?php if(!strcmp($content_info[0]['cont_status'], "private"))echo "selected";?> >Private</option>
                                                    <option value="trash"       <?php if(!strcmp($content_info[0]['cont_status'], "trash"))echo "selected";?> >Trash</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Type</label>
                                                <select name="type" class="form-control">
                                                    <option value="content"     <?php if(!strcmp($content_info[0]['cont_type'], "content"))echo "selected";?> >Content</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Category</label><br>
                                                <?php
                                                    $datas = $database->select("category", "*" ,array("ORDER" => "cat_name"));
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

                                         <div class="col-lg-12">

                                                <input name="content_id" type="hidden" value="<?php echo $id;?>" />

                                                <button type="submit" class="btn btn-primary save_btn">Update Content</button>

                                                
                                         </div>

                                    </div>
                                    <!-- /.col-lg-12 (nested) -->

                                </div>
                                <!-- /.row (nested) -->
                                
                                
                                
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                </form>

                <?php }?>

				<?php if(!strcmp($_GET['s'], 'language')){?>

				    <h1 class="page-header"><i class="fa fa-language fa-1x"></i> Language Management</h1>
				    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Language</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addlang" data-toggle="validator">

                                        <div class="col-lg-4 form-group">
                                            <label>Language Code</label>
                                            <input name="code" class="form-control" placeholder="Enter Language Code Name" required>
                                        </div>

                                        <div class="col-lg-4 form-group">
                                            <label>Language Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Language Name" required>
                                        </div>

                                        <div class="col-lg-2">
                                            <button style="margin-top: 20px;" type="submit" class="btn btn-primary">Add Language</button>
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
                                <b>Set Site Default Language</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                <div class="col-lg-12">
                                    
                                    <form method="post" role="form" action="query.php?a=addDefaultLang" data-toggle="validator">
                                        <div class="col-lg-3 form-group">                            
                                            <select name="lang" class="form-control">
                                                 <?php
                                                    $datas = $database->select("language","*");
                                                    foreach ($datas as $data) {
                                                ?>
                                                <option value="<?php echo $data['lang_id'];?>">( <?php echo $data['lang_code'];?> ) <?php echo $data['lang_name'];?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 form-group">
                                            <button id="cont_action_btn" class="btn btn-success">
                                                Set
                                            </button>
                                        </div>
                                    </form>
                                    
                                </div>
                                </div>                                                                 
                            </div>
                    </div>

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
                                                $site_default_lang_id = $database->select("site_meta",'meta_value',array('meta_key'=>'site_default_lang'));
                                                foreach ($datas as $data) {
                                        ?>
                 <!-- Bite did hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
                                            <tr>
                                                <td><?php echo $data['lang_id'];?></td>
                                                <td>
                                                    <a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_code" data-title="Edit below here" >
                                                        <?php echo $data['lang_code'];?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_name" data-title="Edit below here" >
                                                        <?php echo $data['lang_name'];?>
                                                    </a><?php if($site_default_lang_id[0] == $data['lang_id']) echo "&nbsp;&nbsp;.<a class='btn btn-warning btn-xs'>Site Default Language</a>";?>
                                                </td>
                                                <td>
                                                    
                                                    <?php if($data['lang_id']){?>
                                                    <a href="query.php?a=del&w=lang&i=<?php echo $data['lang_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-trash-o"></i>
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

<!------------------------------------------------------------------------------------------------------------------------------------->

<!-- Modal -->

<div class="modal fade" id="add_cat_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="add_cat_modal_label">Add New Category</h4>
          </div>
          
          <div class="modal-body">
          <div class="container-fluid">
          <div class="row">
              
            <form data-toggle="validator" role="form" action="javascript: void(0)">
            
                <div class="col-lg-12 form-group">
                    <label>Name</label>
                    <input name="add_cat_name" class="form-control" placeholder="Enter Content Name" required>
                </div>
            
                <div class="col-lg-12 form-group">
                    <label>Slug</label>
                    <input name="add_cat_slug" class="form-control" placeholder="Enter Slug Name" required>
                </div>
            
                <div class="col-lg-12 form-group">
                    <label>Type</label>
                    <select name="add_cat_type" class="form-control">
                        <option value="category">Category</option>
                        <option value="story">Story</option>
                        <option value="news">News</option>
                    </select>
                </div>

            </form>
          
          </div>    <!-- Row -->
          </div>    <!-- container-fluid -->  
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="add-cat-btn" class="btn btn-success" type="button">Add New Category</button>
          </div>
          
     </div>
  </div>
</div>

<!--/Modal-->

<script>

    <?php if(!strcmp($_GET['s'], 'show') || !strcmp($_GET['s'], 'language')){?>
        //DataTable
        $('#dataTables-example').DataTable({
            paging: false,
            responsive: true,
            "order": [[ 1, "desc" ]],
            "columnDefs": [
                { "width": "3px", "targets": 0 },
                { "orderable": false, "targets": 0 }
            ]
        });
    <?php }?>    
    
    $(document).ready(function() {
        
        $('#rest_thumb').click(function() {
            $('#customRoxyImage').attr('src', '../sora_blank_thumb.png');
            $('#thumb').attr('value', '/sora_blank_thumb.png');
        });
        
        $("#canvas").gridmanager({
            debug : 1
        });
        
        $("#add-cat-btn").click(function(){
                        
            var formData = {
                'a'                     : 'addCategoryInContent',
                'name'                  : $('input[name=add_cat_name]').val(),
                'slug'                  : $('input[name=add_cat_slug]').val(),
                'type'                  : $('select[name=add_cat_type]').val(),
            };
            
            console.log(formData);
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/ajaxQuery.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {     
                    var cat_id = data[0]['cat_id'];                         
                    var cat_name = data[0]['cat_name'];  
                                     
                    $("#category_list").append(
                        
                        "<div class='checkbox'>"+
                        "<label>"+
                        "<input name='category[]' type='checkbox' value='"+cat_id+"'> "+cat_name+
                        "</label>"+
                        "</div>"
                        
                    );
                    
                    $('#add_cat_modal').modal('hide');
                    
                    toastr["success"]("Add Success","Add New Category");
              } 
            });

         });

    });
    
    $(document).ready(function() {
        var gm = jQuery("#canvas").data('gridmanager');
        $(".save_btn").on("click", function(e) {
            gm.getContent();
    
        });
        
        <?php if(!strcmp($_GET['s'], 'show') || !strcmp($_GET['s'], 'language')){?>
        //bite was here
        var cat_src = [];
    
        $.ajax({
    
            url : 'pages/query_category.php',
            dataType : 'json',
    
            success : function(data) {
    
                for ( i = 0; i < data.length; i++) {
    
                    var cat_obj = {};
                    cat_obj["value"] = data[i]['cat_id'];
                    cat_obj["text"] = data[i]['cat_name'];
    
                    cat_src.push(cat_obj);
    
                }
    
                //console.log(cat_src);
    
            }
        });
    
        $(function() {
            $.fn.editable.defaults.mode = 'inline';
    
            $('.name').editable({});
            $('.status').editable({
    
                source : [{
                    text : 'draft',
                    value : 'draft'
                }, {
                    value : 'future',
                    text : 'future'
                }, {
                    value : 'pending',
                    text : 'pending'
                }, {
                    value : 'private',
                    text : 'private'
                }, {
                    value : 'published',
                    text : 'published'
                }, {
                    value : 'trash',
                    text : 'trash'
                }]
    
            });
    
            $('.category').editable({
    
                source : cat_src
    
            });
    
        });
        <?php }?> 
    
    });

    
</script>

<script type="text/javascript" src="js/functions.js"></script>
<script src="components/Editablecss/js/bootstrap-editable.js"></script>
