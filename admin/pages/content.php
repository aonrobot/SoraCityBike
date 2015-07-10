
<!-- Page Content -->
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<!-- Start Content -->

				

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
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Category</th>
                                            <th>Modified</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("content", array(

                                            "[<]content_translation" => array("id" => "cont_id"),)
                                            
                                            ,array('id','cont_lang_id','cont_name','lang_id','cont_title','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_id')
                                            
                                            );
                                            
                                            foreach ($datas as $data) {

                                                if(!strcmp($data['lang_id'], $data['cont_lang_id'])){

                                                    //echo $data['lang_id'] . " and " . $data['cont_lang_id'] . '<br>';
                                                    $link_edit = "index.php?p=content&a=edit&id=".$data['id']."&lang=".$data['cont_lang_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $data['cont_id'];?></td>
                                            <td><a href="<?php echo $link_edit?>"><?php echo $data['cont_title'];?></a></td>
                                            <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue&c=cont_name" data-title="Edit below here" ><?php echo $data['cont_name'];?></a></td>
                                            <td class="center"><a href="#" class="status" data-type="select" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue&c=cont_status" data-title="Edit below here"  >  	
                                            <?php echo $data['cont_status'];?>	</a></td>
                                            <?php   
                                                        $cats = $database->select("category_relationships",array("[>]category" => array("cat_id" => "cat_id")),array("cat_name"),array("cont_id" => $data['id'],));
                                                        $str_cat = "";
                                                                                                                
                                                        foreach ($cats as $cat) {
                                                            $str_cat = $str_cat.$cat['cat_name'].' ';
                                                        }
                                            ?>
                                                
                                            <td>
                                                 <code><a href="#" class="category" data-type="checklist" data-pk="<?php echo $data['id'];?>" data-url="query.php?a=editvalue2&c=cat_name" data-title="Edit below here" ><?php echo $str_cat;?></a></code><br>&nbsp;
                                            </td>
                                            <td class="center"><?php echo $data['cont_modified'];?></td>
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

				<?php if(!strcmp($_GET['s'], 'create')){?>
				
				<h1 class="page-header"><a href="index.php?p=content&s=show"><i class="fa fa-book fa-1x"></i></a> Create Content</h1>

				<form method="post" role="form" action="query.php?a=addContent" enctype="multipart/form-data">

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
                                        
                                        <div class="form-group">
                                            <label>Thumbnail</label>
                                            <input id="input-700" name="kartik-input-700[]" type="file" class="file-loading">
                                            <input name="thumb" type="hidden">
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
                            <b>Default Language Content</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">

                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title">
                                        </div>

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3" style="resize: none;"></textarea>
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

                                </div>
                                <!-- /.col-lg-12 (nested) -->

                            </div>
                            <!-- /.row (nested) -->

                            <button type="submit" class="btn btn-primary save_btn">Create Content</button>

                        </form>

                        </div>
                        <!-- /.panel-body -->

                    </div>
                    <!-- /.panel -->




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

                            ), array('id','cont_lang_id','cont_name','cont_author','cont_slug','cont_status','cont_type','cont_modified','cont_title','cont_content','cont_description','lang_id'
                            ), array("AND" => array("id" => $id, "lang_id" => $lang)) // Where
                            );


                    ?>
                    
                    <h1 class="page-header"><a href="index.php?p=content&s=show"><i class="fa fa-book fa-1x"></i></a> <?php echo $contents[0]['cont_title'];?></h1>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Multilanguage Content </b><br>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=updateContent">

                                        <div class="form-group">

                                            <label><i class="fa fa-language fa-2x"></i> Available Language </label>
                                            <?php foreach ($available_langs as $available_lang) { ?>

                                                    <code><?php echo $available_lang['lang_name'];?></code>&nbsp;

                                            <?php } ?>

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

                                        <?php } else { ;?>


                                        <div class="form-group">
                                            <label>Tilte</label>
                                            <input name="title" class="form-control" placeholder="Enter Content Title" value="<?php echo $contents[0]['cont_title'];?>">
                                        </div>
                                        <br />

                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3" style="resize: none;"><?php echo $contents[0]['cont_description'];?></textarea>
                                        </div>

                                        <div class="form-group">
                                                <label>Content</label>
                                                <div id="canvas">
                                                        <?php echo $contents[0]['cont_content'];?>
                                                </div>
                                        </div>



                                        <?php } ;?>



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

                                         <div class="col-lg-12">

                                                <textarea name="txt_content" id="say_some" style="display:none;">-</textarea>

                                                <input name="content_id" type="hidden" value="<?php echo $id;?>" />

                                                <button type="submit" class="btn btn-primary save_btn">Update Content</button>

                                                </form>
                                         </div>

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
                 <!-- Bite did hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeee -->
                                            <tr>
                                                <td><?php echo $data['lang_id'];?></td>
                                                <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_code" data-title="Edit below here" ><?php echo $data['lang_code'];?></a></td>
                                                <td><a href="#" class="name" data-type="text" data-pk="<?php echo $data['lang_id'];?>" data-url="query.php?a=editvaluelang&c=lang_name" data-title="Edit below here" ><?php echo $data['lang_name'];?></a></td>
                                                <td>
                                                    
                                                    <?php if($data['lang_id']){?>
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

<script>

    <?php if(!strcmp($_GET['s'], 'show') || !strcmp($_GET['s'], 'language')){?>
        //DataTable
        $('#dataTables-example').DataTable({
            responsive: true,
            "order": [[ 0, "desc" ]]
        });
    <?php }?>    
    
    $(document).ready(function() {

    $("#canvas").gridmanager({
        debug : 1
    });
    
    $("#input-700").fileinput({
        uploadUrl : "http://localhost/uploads/thumbnail/",
        maxFileCount : 1
    });

    });
    
    $(document).ready(function() {
        var gm = jQuery("#canvas").data('gridmanager');
        $(".save_btn").on("click", function(e) {
            gm.getContent();
    
        });
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
    
                console.log(cat_src);
    
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
    
    });

    
</script>

<script type="text/javascript" src="js/functions.js"></script>
<script src="components/Editablecss/js/bootstrap-editable.js"></script>
