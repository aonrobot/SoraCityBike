<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-sliders fa-1x"></i> Slide</h1>    
                
                <?php if(strcmp($_GET['a'], 'edit')){?>                 
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Create New Slide</b>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form method="post" role="form" action="query.php?a=addSlide">
                                        
                                        <div class="col-lg-4 form-group">
                                            <label>Slide Name</label>
                                            <input name="name" class="form-control" placeholder="Enter Content Name">
                                        </div>
                                        
                                        <div class="col-lg-2 form-group">
                                            <label>Type</label>
                                            <select name="type" id="type" class="form-control">
                                                <option value="content">Content Slide</option>
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
                                            <th>Name</th>
                                            <th>Content</th>
                                            <th>Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                            $datas = $database->select("slide", array(

                                            "[>]content" => array("slide_id" => "slide_id"),

                                            ),

                                            array('slide.slide_id','cont_name','slide_name','slide_type')

                                            );           
                                            foreach ($datas as $data) {
                                                $link_edit = "index.php?p=slide&a=edit&id=".$data['slide_id'];
                                    ?>            
                                        <tr>
                                            <td><a href="<?php echo $link_edit?>"><?php echo $data['slide_name'];?></a></td>
                                            <td><?php echo $data['cont_name'];?></td>
                                            <td><?php echo $data['slide_type'];?></td>
                                            <td>
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
                            $slide_type = $database->select("slide","slide_type",array("slide_id" => $slide_id));  
                            
                            //Check This Slide Id has Content Data?
                            $chk_cont_meta = $database->count("content_meta", array("meta_key" => 'slide:'.$slide_id));
                            if($chk_cont_meta == 0) $database->delete("slide_data", array("slide_id" => $slide_id));                          
                                        
                    ?>
                    
                    <?php if(!strcmp($slide_type[0], 'content') || !strcmp($slide_type[0], 'home')){?>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Add Image</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Image Name</label>
                                                <input name="img_name" class="form-control" placeholder="Enter Image Name">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Image URL</label>
                                                <input name="img_url" class="form-control" placeholder="Enter Image URL">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Image Link (Where Do You Go, When Image Click)</label>
                                                <input name="img_link" class="form-control" placeholder="Enter Image Link">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Content (Max 150 Character)</label>
                                                <textarea style="resize: none;" name="content" class="form-control" rows="3" placeholder="Enter Image Content"></textarea></textarea>
                                            </div>
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
                      
                    <?php if(!strcmp($slide_type[0], 'video')){?>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Add Video</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
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
                 
                 
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<!-- Menu II -->
<script src="components/nestedSortable/jquery.mjs.nestedSortable.js"></script>

<script type="text/javascript">

    <?php if(strcmp($_GET['a'], 'edit')){?> 
        //DataTable
         $('#show-slide').DataTable({
             responsive: true
         });
         $('#type').change(function(){
            
            if($('#type').val() == "content"){
                $('#div-content').show();
            }
            else if($('#type').val() == "video"){
                $('#div-content').hide();
            }
            else{
                $('#div-content').hide();
            }
            
        });
    <?php }?>
    
    <?php if(!strcmp($_GET['a'], 'edit')){?>  
    
    $(document).ready(function(){
        
         $("#create-img").click(function(){
            
            //---------------------------------------  POST FORM IMAGE-----------------------------------
            
            var formData = {
                'a'                     : 'addImg',
                'slide_id'              : $('input[name=slide_id]').val(),
                'img_name'              : $('input[name=img_name]').val(),
                'img_url'               : $('input[name=img_url]').val(),
                'img_link'              : $('input[name=img_link]').val(),
                'content'               : $('textarea[name=content]').val(),
                'content_link'          : $('input[name=content_link]').val()
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'pages/update_slide.php',
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
                                        "Image"+
                                        "</div>"+
                                        "<a href='"+img_link+"' target='_blank'><div style='background-image:url("+img_url+"); position:relative; width: 100%; height: 0; padding-bottom: 50%; background-repeat: no-repeat; background-position: center center; background-size: cover;'></div></a>"+
                                        "</div>"+
                                        "<div class='panel-footer'>"+
                                        
                                        "<div class='panel panel-red'>"+
                                        "<div class='panel-heading'>"+
                                        "Image Url"+
                                        "</div>"+
                                        "<div class='panel-body'>"+
                                        "<p><a href='"+img_url+"' target='_blank'>"+img_url+"</a></p>"+
                                        "</div>"+
                                        "</div>"+

                                        "<div class='panel panel-green'>"+
                                        "<div class='panel-heading'>"+
                                        "Content"+
                                        "</div>"+
                                        "<div class='panel-body'>"+
                                        "<p><a href='"+content_link+"' target='_blank'>"+content+"</a></p>"+
                                        "</div>"+
                                        "</div>"+
                                        
                                        "</div></div></div></li> "
                                        
                                        );
                                         
                $("#img-structure").val("");
                $("#img-structure").val($("#sora-menu").html()); 
                
                $(".form-control[name=img_name]").val("");
                $(".form-control[name=img_url]").val("");
                $(".form-control[name=img_link]").val("");
                $(".form-control[name=content]").val("");
                $(".form-control[name=content_link]").val("");
                
                $(document).trigger('readyAgain');
              } 
            });

           });
           
           $("#create-video").click(function(){
            
            //---------------------------------------  POST FORM -----------------------------------
            var formData = {
                'a'                     : 'addVideo',
                'slide_id'              : $('input[name=slide_id]').val(),
                'img_name'              : $('input[name=img_name]').val(),
                'img_url'               : $('input[name=img_url]').val(),

            };
             
            $.ajax({
              type: "POST",                                     
              url:  'pages/update_slide.php',
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
                     url: 'pages/update_slide.php',                            
                     data: formData,          
                     success: function(error){alert("Delete Success");} 
                });
                
                $('#menuItem_'+id).remove();
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
                 url: 'pages/update_slide.php',                            
                 data: formData,
                               
                 success: function(){} 
               });
               
               ////////////////////////////  
                
               arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
               var jsonString = JSON.stringify(arraied);
               //alert(jsonString);
               $.ajax({
                    type: "POST",
                    url: "pages/update_slide.php",
                    data: {data : jsonString}, 
                    cache: false,
            
                    success: function(){
                        alert("Success");
                    }
                });

            });
            
        });
        
   <?php }?>
    
</script>