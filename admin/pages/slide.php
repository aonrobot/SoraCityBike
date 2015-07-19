<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="">
                    
                
                <?php if(strcmp($_GET['a'], 'edit')){?>
                <h1 class="page-header"><i class="fa fa-sliders fa-1x"></i> Slide</h1>                 
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Slide</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addSlide" data-toggle="validator">
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Slide Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Content Name" required="">
                                        </div>
                                        
                                        <div class="col-lg-2 form-group">
                                            <label>Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="content">Content Slide</option>
                                                <option value="category">Category Slide</option>
                                                <option value="video">Video Slide</option>
                                                <option value="home">Home Slide</option>  
                                            </select>
                                        </div>
                                        
                                        <?php $contents = $database->select("content", array('id','cont_name'),array('cont_type'=>'content')); ?>
                                        <div class="col-lg-2 form-group" id="div-content">
                                            <label>Content</label>
                                            <select class="form-control" name="cont_id">
                                                    <?php foreach ($contents as $content) { ?>
                                                        <option value="<?php echo $content['id'];?>"><?php echo $content['cont_name'];?></option>
                                                    <?php } ?>                                                 
                                            </select>
                                        </div>
                                        
                                        <?php $cats = $database->select("category", array('cat_id','cat_name')); ?>
                                        <div class="col-lg-2 form-group" id="div-category">
                                            <label>Category</label>
                                            <select class="form-control" name="cat_id">
                                                    <?php foreach ($cats as $cat) { ?>
                                                        <option value="<?php echo $cat['id'];?>"><?php echo $cat['cat_name'];?></option>
                                                    <?php } ?>                                                 
                                            </select>
                                        </div>

                                        <div class="col-lg-2">
                                            <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Create Slide</button>
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
                            <b>All Slide</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="show-slide">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slide Address</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("slide", array(

                                            "[>]content" => array("slide_id" => "slide_id"),
                                            
                                            "[>]category" => array("slide_id" => "slide_id"),

                                            ),

                                            array('slide.slide_id','cont_name','slide_name','slide_type','cat_name')

                                            );           
                                            foreach ($datas as $data) {
                                                $link_edit = "index.php?p=slide&a=edit&id=".$data['slide_id'];
                                    ?>       
                                    
                  <!-- bite fixx herreeeeeeeeeeeeeeeeeeeee --->                       
                                        <tr>
                                            <td><?php echo $data['slide_id'];?></td>
                                            <td><a class="slide_name" data-type="text" data-pk="<?php echo $data['slide_id'];?>" data-url="query.php?a=editvalueslide&c=slide_name" data-title="Edit below here" ><?php echo $data['slide_name'];?></a></td>
                                            
                                            <?php if(!strcmp($data['cont_name'], '')){?>
                                            <td><?php echo $data['cat_name'];?></td>
                                            <?php }else{?>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <?php }?>
                                            
                                            <td><?php echo $data['slide_type'];?></td>
                                            <td>
                                                <a href="<?php echo $link_edit;?>" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"> Edit</i></a>
                                                <a href="query.php?a=del&w=slide&i=<?php echo $data['slide_id'];?>" class="btn btn-danger" style="margin-right: 8px;"><i class="fa fa-recycle"> Delete</i></a>
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
                            
                            $slide_id = $_GET['id'];      // Slide Id
                            $slide_type = $database->select("slide",array("slide_type","slide_name"),array("slide_id" => $slide_id));  
                            
                            //Check This Slide Id has Content Data?
                            $chk_cont_meta = $database->count("content_meta", array("meta_key" => 'slide:'.$slide_id));
                            if($chk_cont_meta == 0) $database->delete("slide_data", array("slide_id" => $slide_id));                        
                                        
                    ?>
                    
                    <?php if(!strcmp($slide_type[0]['slide_type'], 'content') || !strcmp($slide_type[0]['slide_type'], 'category') || !strcmp($slide_type[0]['slide_type'], 'home')){?>
                        
                    <h1 class="page-header"><a href="index.php?p=slide"><i class="fa fa-sliders fa-1x"></i></a> <?php echo $slide_type[0]['slide_name'];?></h1>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Slide Info</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="post" role="form" action="query.php?a=updateSlide">
                                            
                                            <?php
                                                    // Check Where This Slide?
                                                    $where_is = $database->select("slide",'slide_type', array("slide_id" => $slide_id));
                                            ?>
                                            
                                            <div class="col-lg-4 form-group">
                                                <label>Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="content" <?php if(!strcmp($where_is[0],"content")) echo "selected";?> >Content Slide</option>
                                                    <option value="category" <?php if(!strcmp($where_is[0],"category")) echo "selected";?> >Category Slide</option>
                                                    <option value="video" <?php if(!strcmp($where_is[0],"video")) echo "selected";?>>Video Slide</option>
                                                    <option value="home" <?php if(!strcmp($where_is[0],"home")) echo "selected";?>>Home Slide</option>  
                                                </select>
                                            </div>

                                            <?php $contents = $database->select("content", array('id','cont_name'),array('cont_type'=>'content')); ?>
                                            <div class="col-lg-12 form-group" id="div-content">
                                                <label>Content</label>
                                                <select class="form-control" name="cont_id">
                                                        <?php foreach ($contents as $content) { ?>
                                                            <option value="<?php echo $content['id'];?>"><?php echo $content['cont_name'];?></option>
                                                        <?php } ?>                                                 
                                                </select>
                                            </div>
                                            
                                            <?php $cats = $database->select("category", array('cat_id','cat_name')); ?>
                                            <div class="col-lg-12 form-group" id="div-category">
                                                <label>Category</label>
                                                <select class="form-control" name="cat_id">
                                                        <?php foreach ($cats as $cat) { ?>
                                                            <option value="<?php echo $cat['cat_id'];?>"><?php echo $cat['cat_name'];?></option>
                                                        <?php } ?>                                                 
                                                </select>
                                            </div>

                                            <div class="col-lg-12">
                                                <input name="slide_id" type="hidden" value="<?php echo $slide_id;?>">
                                                <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Update Slide Info</button>
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
                                <b>Add Image</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                    
                                    <form data-toggle="validator" role="form" action="javascript: void(0)">    
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Image Name</label>
                                                <input name="img_name" class="form-control" placeholder="Enter Image Name">
                                            </div>
                                        </div>                                      
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Image URL</label><br>
                                                <img src="../sora_new_image.png" id="customRoxyImage" style="width:300px; height: 200px;">
                                                <input id="thumb" name="img_url" value="/sora_new_image.png" class="form-control" placeholder="Enter Image URL" style="margin-top: 13px;">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                
                                                <a class="modalButton btn btn-primary" data-toggle="modal" data-src="components/fileman_custom/index.html?integration=custom" data-height=450 data-width=100% data-target="#file_modal">Select Image From Server</a>
                                                
                                                <div class="modal fade" id="file_modal" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                         <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Select Image</h4>
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
                                            $('#thumb').change(function(){
                                                $(window.parent.document).find('#customRoxyImage').attr('src', $('#thumb').val());        
                                            });
                                                                                    
                                        </script>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Image Link (Where Do You Go, When Image Click)</label>
                                                <input name="img_link" class="form-control" placeholder="Enter Image Link">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Content <em>(Max <code>150 Character</code> And Max <code>3 Paragraphs</code>)</em></label>
                                                
                                                <textarea id="content" style="resize: none;" name="content" class="form-control" rows="3" placeholder="Enter Image Content"></textarea>
                                            </div>
                                            <script>
                                                
                                                CKEDITOR.replace( 'content', {
                                                                                                        
                                                    wordcount: {
                                                        showCharCount: true,
                                                        maxWordCount: 4000,
                                                        maxCharCount: 150,

                                                    },      
                                                                                                
                                                    toolbar: [
                                                      [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
                                                      { name: 'font', items: ['Font','FontSize'] },
                                                      '/',
                                                      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline','-','JustifyLeft','JustifyCenter','JustifyRight','-','NumberedList','BulletedList','-','Link','Unlink','-','Source' ] },
                                                      { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                                                      { name: 'tools', items: [ 'Maximize' ] }
                                                     ]
                                                     
                                                    }
                                                );
                                            </script>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Content Link (Where Do You Go, When Content Click)</label>
                                                <input name="content_link" class="form-control" placeholder="Enter Content Link">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <input name="slide_id" type="hidden" value="<?php echo $slide_id;?>" />
                                            <button id="create-img" class="btn btn-success"><i class="fa fa-leaf fa-1x"></i> Add Image</button>
                                        </div>
                                    
                                    </form>
                                   </div>
                                    <script>
                                            $(document).ready(function() {
                                                 $('button[id="create-img"]').attr('disabled','disabled');
                                                 $('input[name="img_name"]').keyup(function() {
                                                    if($(this).val() != '') {
                                                       $('button[id="create-img"]').removeAttr('disabled');
                                                    }
                                                    else{$('button[id="create-img"]').attr('disabled','disabled');}
                                                 });   
                                             });                                      
                                    </script>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Create Slide</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h3 style="margin-bottom: 20px;"><i class="fa fa-list-ul fa-1x"></i> Slide Stucture</h3>
                                                
                                                <section id="demo">
                                                    <ol id="sora-menu" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded"> <?php $menu = $database->select("content_meta",'meta_value',array("meta_key"=>'slide:'.$slide_id)); echo $menu[0]; ?> </ol>
                                                </section><!-- END #demo -->
                                                
                                            </div>
                                        </div> 

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <input name="img-structure" type="hidden" id="img-structure"></input>
                                                <br><br><button id="toArray" name="toArray" class="btn btn-primary"><i class="fa fa-send fa-1x"></i> Save Slide</button>
                                            </div>
                                        </div>
      
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
                    <?php }?>
                      
                    <?php if(!strcmp($slide_type[0]['slide_type'], 'video')){?>
                        
                    <h1 class="page-header"><a href="index.php?p=slide"><i class="fa fa-sliders fa-1x"></i></a> <?php echo $slide_type[0]['slide_name'];?></h1>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Slide Info</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="post" role="form" action="query.php?a=updateSlide">
                                            
                                            <div class="col-lg-4 form-group">
                                                <label>Type</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="content"   <?php if(!strcmp($slide_type[0]['slide_type'], "content"))echo "selected";?> >Content Slide</option>
                                                    <option value="category"  <?php if(!strcmp($slide_type[0]['slide_type'], "category"))echo "selected";?> >Category Slide</option>
                                                    <option value="video"     <?php if(!strcmp($slide_type[0]['slide_type'], "video"))echo "selected";?> >Video Slide</option>
                                                    <option value="home"      <?php if(!strcmp($slide_type[0]['slide_type'], "home"))echo "selected";?> >Home Slide</option>
                                                </select>
                                            </div>
                                            
                                            <?php $contents = $database->select("content", array('id','cont_name'),array('cont_type'=>'content')); ?>
                                            <div class="col-lg-12 form-group" id="div-content">
                                                <label>Content</label>
                                                <select class="form-control" name="cont_id">
                                                        <?php foreach ($contents as $content) { ?>
                                                            <option value="<?php echo $content['id'];?>"><?php echo $content['cont_name'];?></option>
                                                        <?php } ?>                                                 
                                                </select>
                                            </div>
                                            
                                            <?php $cats = $database->select("category", array('cat_id','cat_name')); ?>
                                            <div class="col-lg-12 form-group" id="div-category">
                                                <label>Category</label>
                                                <select class="form-control" name="cat_id">
                                                        <?php foreach ($cats as $cat) { ?>
                                                            <option value="<?php echo $cat['id'];?>"><?php echo $cat['cat_name'];?></option>
                                                        <?php } ?>                                                 
                                                </select>
                                            </div>
    
                                            <div class="col-lg-12">
                                                <input name="slide_id" type="hidden" value="<?php echo $slide_id;?>">
                                                <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Update Slide Info</button>
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
                                <b>Add Video</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                    
                                    <form data-toggle="validator" role="form" action="javascript: void(0)">      
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Video Name</label>
                                                <input name="img_name" class="form-control" placeholder="Enter Video Name">
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Video URL</label>
                                                <input name="img_url" class="form-control" placeholder="Enter Video URL">
                                            </div>
                                            <p><em>URL Must be this format(https://vimeo.com/[vidoe_id]) Example<code>https://vimeo.com/113560451</code></em></p>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <input name="slide_id" type="hidden" value="<?php echo $slide_id;?>" />
                                            <button id="create-video" class="btn btn-success"><i class="fa fa-leaf fa-1x"></i> Add Video</button>
                                        </div>
                                        
                                    </form>
                                    <script>
                                            $(document).ready(function() {
                                                 $('button[id="create-video"]').attr('disabled','disabled');
                                                 $('input[name="img_name"]').keyup(function() {
                                                    if($(this).val() != '') {
                                                       $('button[id="create-video"]').removeAttr('disabled');
                                                    }
                                                    else{$('button[id="create-video"]').attr('disabled','disabled');}
                                                 });   
                                             });                                      
                                    </script>
                                    
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Create Slide</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h3 style="margin-bottom: 20px;"><i class="fa fa-list-ul fa-1x"></i> Slide Stucture</h3>
                                                
                                                <section id="demo">
                                                    <ol id="sora-menu" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded"> <?php $menu = $database->select("content_meta",'meta_value',array("meta_key"=>'slide:'.$slide_id)); echo $menu[0]; ?> </ol>
                                                </section><!-- END #demo -->
                                                
                                            </div>
                                        </div> 

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <p><em>Note: This demo has the <code>maxLevels</code> option set to '4'.</em></p>
                                                <input name="img-structure" type="hidden" id="img-structure"></input>
                                                <br><br><button id="toArray" name="toArray" class="btn btn-primary"><i class="fa fa-send fa-1x"></i> Save Slide</button>
                                            </div>
                                        </div>
      
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
                    <?php }?>
                    
                <?php }?>
                 
                
                
            
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<!-- Modal Edit -->

<div class="modal fade" id="edit_name_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="edit_name_modal_label">Update Image</h4>
      </div>
      <div class="modal-body">
          
        <form data-toggle="validator" role="form" action="javascript: void(0)">
          
          <input name="slide_data_id" id="slide_data_id" type="hidden"/>
          <div class="form-group">
            <label>New Image Name</label>
            <input name="update_img_name" id="update_img_name" class="form-control" placeholder="Enter Image Name" value="">
          </div>
          
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="update-img-name" class="btn btn-success" type="button">Update Name</button>
      </div>
    </div>
  </div>
</div>

<!--    Edit Image  -->

<div class="modal fade" id="edit_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit_image_modal_label">Update Image</h4>
          </div>
          
          <div class="modal-body">
          <div class="container-fluid">
          <div class="row">
              
            <form data-toggle="validator" role="form" action="javascript: void(0)">
              
              <input name="slide_data_id_edit_image" id="slide_data_id_edit_image" type="hidden"/>
              
              <div class="col-lg-12">
                  <div class="form-group">
                      <label>Image URL</label><br>
                      <img src="../sora_new_image.png" id="update_thumb_image" style="width:300px; height: 200px;">
                      
                  </div>
              </div>
              
              <div class="col-lg-12">
                  <div class="form-group"> 
                      <a class="EditModalButton btn btn-primary" data-toggle="modal" data-src="components/fileman_custom_edit/index.html?integration=custom_edit" data-height=450 data-width=100% data-target="#edit_file_modal">Select Image From Server</a>
                  </div>                                
              </div>
              <div class="col-lg-12">
                  <div class="form-group"> 
                      <input id="update_img_url" name="update_img_url" value="/sora_new_image.png" class="form-control" placeholder="Enter Image URL" style="margin-top: 13px;">                               
                  </div>                                
              </div>              
              
              <div class="col-lg-12">
                  <div class="form-group">
                      <label>Image Link (Where Do You Go, When Image Click)</label>
                      <input id="update_img_link" name="update_img_link" class="form-control" placeholder="Enter Image Link" value="">
                  </div>
              </div>
              
            </form>
          
          </div>    <!-- Row -->
          </div>    <!-- container-fluid -->  
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="update-image" class="btn btn-success" type="button">Update Image</button>
          </div>
          
     </div>
  </div>
</div>


<!--    /Edit Image  -->


<!--    Edit Content  -->

<div class="modal fade" id="edit_content_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        
          <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="edit_content_modal_label">Update Content</h4>
          </div>
          
          <div class="modal-body">
          <div class="container-fluid">
          <div class="row">
              
            <form data-toggle="validator" role="form" action="javascript: void(0)">
              
              <input name="slide_data_id_edit_content" id="slide_data_id_edit_content" type="hidden"/>
              
              <div class="col-lg-12">
                <div class="form-group">
                    <label>Content <em>(Max <code>
                            150 Character</code> And Max <code>
                            3 Paragraphs</code>)</em></label>
                    <textarea id="update_content" style="resize: none;" name="update_content" class="form-control" rows="3" placeholder="Enter Image Content"></textarea>
            
                </div>
                <script>
                    CKEDITOR.replace('update_content', {
            
                        wordcount : {
                            showCharCount : true,
                            maxWordCount : 4000,
                            maxCharCount : 150,
            
                        },
            
                        toolbar : [['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'], {
                            name : 'font',
                            items : ['Font', 'FontSize']
                        }, '/', {
                            name : 'basicstyles',
                            items : ['Bold', 'Italic', 'Underline', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'Source']
                        }, {
                            name : 'colors',
                            items : ['TextColor', 'BGColor']
                        }, {
                            name : 'tools',
                            items : ['Maximize']
                        }]
            
                    });
                </script>
            </div>
            
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Content Link (Where Do You Go, When Content Click)</label>
                    <input id="update_content_link" name="update_content_link" class="form-control" placeholder="Enter Content Link">
                </div>
            </div>             
              
            </form>
          
          </div>    <!-- Row -->
          </div>    <!-- container-fluid -->  
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button id="update-content" class="btn btn-success" type="button">Update Content</button>
          </div>
          
     </div>
  </div>
</div>


<!--    /Edit Content  -->


<!-- Modal Select File -->

<div class="modal fade" id="edit_file_modal" tabindex="0" role="dialog"  aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Select Image</h4>
        </div>
        <div class="modal-body">
            <iframe frameborder="0"></iframe>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
              $('a.EditModalButton').on('click', function(e) {
                  var src = $(this).attr('data-src');
                  var height = $(this).attr('data-height') || 300;
                  var width = $(this).attr('data-width') || 400;
                                                    
                  $("#edit_file_modal iframe").attr({'src':src,'height': height,'width': width});
              });
              
              function closeCustomRoxyEdit(){
                $('#edit_file_modal').modal('hide');
              }
              $('#update_img_url').change(function(){
                $(window.parent.document).find('#update_thumb_image').attr('src', $('#update_img_url').val());        
              });
                                                                                        
</script>

<!-- /Modal Select File -->

<script>

    $('#edit_name_modal').on('show.bs.modal', function (event) {
        
      var button = $(event.relatedTarget);
      var recipient_id = button.data('whatever');

      var modal = $(this);
      modal.find('.modal-title').text('Edit Image Name');
      modal.find('.modal-body #slide_data_id').val(recipient_id);
      modal.find('.modal-body #update_img_name').val($("#img_name"+recipient_id).text()); 
      
    });
    
    $('#edit_image_modal').on('show.bs.modal', function (event) {
        
      var button = $(event.relatedTarget); 
      var recipient_id = button.data('whatever'); 
      
      var modal = $(this);
      modal.find('.modal-title').text('Edit Image url/link');
      modal.find('.modal-body #slide_data_id_edit_image').val(recipient_id);
      modal.find('.modal-body #update_img_url').attr('value', $("#img_href"+recipient_id).attr("href"));
      modal.find('.modal-body #update_thumb_image').attr('src', $("#img_href"+recipient_id).attr("href"));
      modal.find('.modal-body #update_img_link').val($("#img_link"+recipient_id).attr("href"));
      
    })
    
    $('#edit_content_modal').on('show.bs.modal', function (event) {
        
      var button = $(event.relatedTarget); 
      var recipient_id = button.data('whatever'); 
      
      var modal = $(this);
      modal.find('.modal-title').text('Edit Content');
      modal.find('.modal-body #slide_data_id_edit_content').val(recipient_id);
      
      var cont_html = $("#content"+recipient_id).html();
      
      CKEDITOR.instances['update_content'].setData(cont_html)
      
      modal.find('.modal-body #update_content_link').attr('value', $("#content_link"+recipient_id).attr("href"));
      
    })
    
</script>

<!-- /Modal Edit -->

<!-- Menu II -->
<script src="components/nestedSortable/jquery.mjs.nestedSortable.js"></script>

<script type="text/javascript">

    <?php if(strcmp($_GET['a'], 'edit')){?> 
        //DataTable
         $('#show-slide').DataTable({
             responsive: true,
             "order": [[ 0, "desc" ]]
         });
         $('#type').change(function(){
            
            if($('#type').val() == "content"){
                $('#div-content').show();
                $('#div-category').hide();
            }
            else if($('#type').val() == "category"){
                $('#div-category').show();
                $('#div-content').hide();
            }
            else if($('#type').val() == "video"){
                $('#div-content').hide();
                $('#div-category').hide();
            }
            else{
                $('#div-content').hide();
                $('#div-category').hide();
            }
            
       });
       
    <?php }?>
    
    <?php if(!strcmp($_GET['a'], 'edit')){?>  
        
     $('#type').change(function(){
            
            if($('#type').val() == "content"){
                $('#div-content').show();
                $('#div-category').hide();
            }
            else if($('#type').val() == "category"){
                $('#div-category').show();
                $('#div-content').hide();
            }
            else if($('#type').val() == "video"){
                $('#div-content').hide();
                $('#div-category').hide();
            }
            else{
                $('#div-content').hide();
                $('#div-category').hide();
            }
            
    });
    
    $(document).ready(function(){
        
         $("#update-img-name").click(function(){
            
            var slide_data_id = $('input[name=slide_data_id]').val()
            
            var formData = {
                'a'                     : 'updateImgName',
                'slide_data_id'              : slide_data_id,
                'update_img_name'              : $('input[name=update_img_name]').val(),
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_slide.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {               
                var new_img_name = data[0]['slide_data_name'];                          //get image name
                
                // Edit New Value
                
                $("#img_name"+slide_data_id).text(new_img_name);
                               
                // hide modal
                $('#edit_name_modal').modal('hide');                                 

                
                toastr["success"]("Update Image Name Success","Update Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

         });
         
         
         $("#update-image").click(function(){
            
            var slide_data_id = $('input[name=slide_data_id_edit_image]').val()
            
            var formData = {
                'a'                     : 'updateImage',
                'slide_data_id'              : slide_data_id,
                'update_img_url'              : $('input[name=update_img_url]').val(),
                'update_img_link'              : $('input[name=update_img_link]').val(),
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_slide.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {               
                var new_img_url = data[0]['slide_data_img_url'];                          //get image url
                var new_img_link = data[0]['slide_data_img_link'];                          //get image link
                
                // Edit New Value
                
                $("#img_href"+slide_data_id).attr("href", new_img_url);
                
                $("#img_url"+slide_data_id).css( "background-image", "url("+new_img_url+")" );
                
                $("#img_link"+slide_data_id).attr("href", new_img_link);
                $('#img_link'+slide_data_id).text(new_img_link);
                
                //
                
                $('#edit_image_modal').modal('hide');                                         // hide modal
                
                toastr["success"]("Update Image Success","Update Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

         });
         
         
         $("#update-content").click(function(){
            
            var slide_data_id = $('input[name=slide_data_id_edit_content]').val()
            var update_cont_value = CKEDITOR.instances['update_content'].getData();
            
            var formData = {
                'a'                             : 'updateContent',
                'slide_data_id'                 : slide_data_id,
                'update_content'                : update_cont_value,
                'update_content_link'           : $('input[name=update_content_link]').val(),
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_slide.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {               
                var new_content = data[0]['slide_data_content'];                          //get content url
                var new_content_link = data[0]['slide_data_content_link'];                //get content link
                
                // Edit New Value

                
                $("#content"+slide_data_id).html(new_content);
                
                $("#content_link"+slide_data_id).attr("href", new_content_link);
                $('#content_link'+slide_data_id).text(new_content_link);
                
                //
                
                $('#edit_content_modal').modal('hide');                                         // hide modal
                
                toastr["success"]("Update Content Success","Update Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

         });
             

         $("#create-img").click(function(){
            
            //---------------------------------------  POST FORM IMAGE-----------------------------------
            var cont_value = CKEDITOR.instances['content'].getData();
            var img_url = $('input[name=img_url]').val();
            img_url = escape(img_url);
            //cont_value = cont_value.replace(/<p>/g, '').replace(/<\/p>/g, '');
            
            var formData = {
                'a'                     : 'addImg',
                'slide_id'              : $('input[name=slide_id]').val(),
                'img_name'              : $('input[name=img_name]').val(),
                'img_url'               : img_url,
                'img_link'              : $('input[name=img_link]').val(),
                'content'               : cont_value,
                'content_link'          : $('input[name=content_link]').val()
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_slide.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {
                //alert(data);
                //--------------------------------------- RETURN IMAGE!!!! ------------------------------------
                
                var slide_data_id = data[0]['slide_data_id'];               //get slide_data_id
                var img_name = data[0]['slide_data_name'];                         //get image name
                var img_url = data[0]['slide_data_img_url'];                           //get image url
                var img_link = data[0]['slide_data_img_link'];                         //get image link
                var content = data[0]['slide_data_content'];                           //get content
                var content_link = data[0]['slide_data_content_link'];                 //get content_link

                /*  Have data-
                 *  
                 *  data-img_name
                 *  data-img_url
                 *  data-img_link
                 *  data-content_link      
                 * 
                */
               
                $("#sora-menu").append(
                                         
                                        "<li class='mjs-nestedSortable-leaf' id='menuItem_"+slide_data_id+"'>"+
                                        "<div class='menuDiv'>"+                                                         //Handle
                                        "<span title='Click to show/hide children' class='disclose ui-icon ui-icon-minusthick'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "<span title='Click to show/hide item editor' data-id='"+slide_data_id+"' class='expandEditor ui-icon ui-icon-triangle-1-n'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "<span>"+
                                        "<span data-id='"+slide_data_id+"' class='itemTitle' id='img_name"+slide_data_id+"'>"+img_name+" </span>"+
                                        " <button id='edit_name_btn' name='edit_name' class='btn btn-default btn-xs' data-toggle='modal' data-target='#edit_name_modal' data-whatever='"+slide_data_id+"'><i class='fa fa-pencil fa-fw'></i> Edit Name</button>"+     //Add Button
                                        "<span title='Click to delete item.' data-id='"+slide_data_id+"' class='deleteMenu ui-icon ui-icon-closethick'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "</span>"+
                                        "<div id='menuEdit"+slide_data_id+"' class='menuEdit'>"+                         //Handle
                                        "<div class='panel panel-primary'>"+
                                        "<div class='panel-heading'>"+
                                        "<button id='edit_image_btn' name='edit_image' class='btn btn-default btn-xs' data-toggle='modal' data-target='#edit_image_modal' data-whatever='"+slide_data_id+"' ><i class='fa fa-pencil fa-fw'></i> Edit Image</button>"+       //Add Button
                                        "</div>"+
                                        "<a href='"+img_url+"' target='_blank' id='img_href"+slide_data_id+"'><div id='img_url"+slide_data_id+"' style='background-image:url("+img_url+"); position:relative; width: 100%; height: 0; padding-bottom: 50%; background-repeat: no-repeat; background-position: center center; background-size: cover;'></div></a>"+
                                        "</div>"+
                                        "<div class='panel-footer'>"+
                                        
                                        "<div class='panel panel-red'>"+
                                        "<div class='panel-heading'>"+
                                        "Image Link"+
                                        "</div>"+
                                        "<div class='panel-body'>"+
                                        "<p><a href='"+img_link+"' target='_blank' id='img_link"+slide_data_id+"'>"+img_link+"</a></p>"+
                                        "</div>"+
                                        "</div>"+

                                        "<div class='panel panel-green'>"+
                                        "<div class='panel-heading'>"+
                                        "<button id='edit_content_btn' name='edit_content' class='btn btn-default btn-xs' data-toggle='modal' data-target='#edit_content_modal' data-whatever='"+slide_data_id+"'><i class='fa fa-pencil fa-fw'></i> Edit Content</button>"+       //Add Button
                                        "</div>"+
                                        "<div class='panel-body'>"+
                                        "<div id='content"+slide_data_id+"'>"+content+"</div><br>"+
                                        "<p><a href='"+content_link+"' target='_blank' id='content_link"+slide_data_id+"'>"+content_link+"</a></p>"+
                                        "</div>"+
                                        "</div>"+
                                        
                                        "</div></div></div></li> "
                                        
                                        );
                                         
                $("#img-structure").val("");
                $("#img-structure").val($("#sora-menu").html()); 
                
                $(".form-control[name=img_name]").val("");
                
                //$('#customRoxyImage').attr('src', '../sora_new_image.png');
                $(window.parent.document).find('#customRoxyImage').attr('src', "../sora_new_image.png");
                $(window.parent.document).find('#thumb').attr('value', "/sora_new_image.png");  
                //$('#thumb').val("/sora_new_image.png");             

                $(".form-control[name=img_link]").val("");
                CKEDITOR.instances.content.setData('');
                $(".form-control[name=content_link]").val("");
                
                toastr["success"]("Add Image Item Success","Add Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

           });
           
           $("#create-video").click(function(){
            
            //---------------------------------------  VDO -----------------------------------
            var formData = {
                'a'                     : 'addVideo',
                'slide_id'              : $('input[name=slide_id]').val(),
                'img_name'              : $('input[name=img_name]').val(),
                'img_url'               : $('input[name=img_url]').val(),

            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_slide.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {
                //alert(data);
                var slide_data_id = data[0]['slide_data_id'];               //get slide_data_id
                var img_name = data[0]['slide_data_name'];                         //get image name
                var img_url = data[0]['slide_data_img_url'];                           //get image url
                
                $("#sora-menu").append(
                                         
                                        "<li class='mjs-nestedSortable-leaf' id='menuItem_"+slide_data_id+"'>"+
                                        "<div class='menuDiv'>"+                                                         //Handle
                                        "<span title='Click to show/hide children' class='disclose ui-icon ui-icon-minusthick'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "<span title='Click to show/hide item editor' data-id='"+slide_data_id+"' class='expandEditor ui-icon ui-icon-triangle-1-n'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "<span>"+
                                        "<span data-id='"+slide_data_id+"' class='itemTitle'>"+img_name+"</span>"+
                                        "<span title='Click to delete item.' data-id='"+slide_data_id+"' class='deleteMenu ui-icon ui-icon-closethick'>"+
                                        "<span></span>"+
                                        "</span>"+
                                        "</span>"+
                                        "<div id='menuEdit"+slide_data_id+"' class='menuEdit'>"+                         //Handle
                                        "<div class='panel panel-primary'>"+
                                        "<div class='panel-heading'>"+
                                        "Video"+
                                        "</div>"+
                                        
                                        "<iframe src='"+img_url+"' width='400' height='300' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>"+
                                        
                                        "</div>"+
                                        
                                        "</div></div></li>"
                                        
                                        );
                                         
                $("#img-structure").val("");
                $("#img-structure").val($("#sora-menu").html()); 
                
                $(".form-control[name=img_name]").val("");
                $(".form-control[name=img_url]").val("");
                $(".form-control[name=img_link]").val("");
                $(".form-control[name=content]").val("");
                $(".form-control[name=content_link]").val("");
                
                toastr["success"]("Add Video Item Success","Add Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

           });        
        
    });     
    
    //Menu II
    
    $(document).on('ready readyAgain', function(){
            var ns = $('ol.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: 1,
                isTree: true,
                expandOnHover: 700,
                startCollapsed: false,
                change: function(){
                    console.log('Relocated item');
                }
            });
            
            $('.expandEditor').attr('title','Click to show/hide item editor');
            $('.disclose').attr('title','Click to show/hide children');
            $('.deleteMenu').attr('title', 'Click to delete item.');
        
            $('.disclose').on('click', function() {
                $(this).closest('li').toggleClass('mjs-nestedSortable-collapsed').toggleClass('mjs-nestedSortable-expanded');
                $(this).toggleClass('ui-icon-plusthick').toggleClass('ui-icon-minusthick');
            });
            
            $('.expandEditor, .itemTitle').click(function(){
                var id = $(this).attr('data-id');
                $('#menuEdit'+id).toggle();
                $(this).toggleClass('ui-icon-triangle-1-n').toggleClass('ui-icon-triangle-1-s');
            });
            
            $('.deleteMenu').click(function(){
                var id = $(this).attr('data-id');
                
                //Delete Ajax Query
                
                var formData = {
                    'a'                     : 'delImgData',
                    'slide_data_id'         : id
                };    
                $.ajax({
                     type: "POST",                                     
                     url: 'functions/update_slide.php',                            
                     data: formData,          
                     success: function(){toastr["success"]("Delete Item Success","Delete Success");} 
                });

                $('#menuItem_'+id).remove();
                
                $('#toArray').trigger('click');
            });
                
            $('#serialize').click(function(){
                serialized = $('ol.sortable').nestedSortable('serialize');
                $('#serializeOutput').text(serialized+'\n\n');
            })
    
            $('#toHierarchy').click(function(e){
                hiered = $('ol.sortable').nestedSortable('toHierarchy', {startDepthCount: 0});
                hiered = dump(hiered);
                (typeof($('#toHierarchyOutput')[0].textContent) != 'undefined') ?
                $('#toHierarchyOutput')[0].textContent = hiered : $('#toHierarchyOutput')[0].innerText = hiered;
            })
    
            $('#toArray').click(function(e){
               
               // Update Menu Structure 
               
               $("#img-structure").val("");
               $("#img-structure").val($("#sora-menu").html());
               
               //alert($("#sora-menu").html());
               
               var formData = {
                'a'                 : 'updateImageStructure',
                'slide_id'          : $('input[name=slide_id]').val(),
                'structure'         : $('input[name=img-structure]').val()
               };
                 
               $.ajax({
                 type: "POST",                                     
                 url: 'functions/update_slide.php',                            
                 data: formData,
                               
                 success: function(){toastr["success"]("Update Slide Structure Success","Update Success");} 
               });
               
               ////////////////////////////  
                
               arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
               var jsonString = JSON.stringify(arraied);
               //alert(jsonString);
               $.ajax({
                    type: "POST",
                    url: "functions/update_slide.php",
                    data: {data : jsonString}, 
                    cache: false,
            
                    success: function(){
                        toastr["success"]("Save Slide Success","Save Success");
                    }
                });

            });
            
        });
        
   <?php }?>
   
   
   $(document).ready(function(){
       
                
         if($('#type').val() == "content"){
             $('#div-content').show();
             $('#div-category').hide();
         }
         else if($('#type').val() == "category"){
             $('#div-category').show();
             $('#div-content').hide();
         }
         else if($('#type').val() == "video"){
             $('#div-content').hide();
             $('#div-category').hide();
         }
         else{
             $('#div-content').hide();
             $('#div-category').hide();
         }
         
   	     $(function() {
		 $.fn.editable.defaults.mode = 'inline';
		 
		 $('.slide_name').editable({});
		
		 $('.slidetype').editable({
		 	
		 	source: [ 
		 		{value: 'content', text: 'Content'},
		 		{value: 'category', text: 'Category'},
	            {value: 'video', text: 'Video'},
	            {value: 'home', text: 'Home'}
	            
	            
	        ]
		 	
		 	
			 });
    	});
			
			
	});
	
	

</script>


<script src="components/Editablecss/js/bootstrap-editable.js"></script>
