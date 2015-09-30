<!-- Page Content -->
<input type="hidden" name="user_id" value="<?php echo $details['id'];?>">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-dashboard fa-1x"></i> Menu</h1>
                
                    <?php
                            //Important Parameter

                            //$menu_id = $_GET['id'];      // Menu Id
                            
                            // Default Language Id
                            $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang')); // Get Defalut Language
                            if(!isset($_GET['lang'])) $lang = $default_lang[0];
                            else $lang = $_GET['lang'];
                            
                            // Find Menu Id by lang id 
                                                       
                            $menu_id_bylang = $database->select("menu","menu_id",array('lang_id'=>$lang));
                            
                            $menu_id = $menu_id_bylang[0];
                            
                            // 
                            
                            $lang_name = $database->select("language", "lang_name" , array("lang_id" => $lang));
                            $lang_name = $lang_name[0];
                            
                            // Language Select
                            $count = $database->count("language", "*");
                            $languages = $database->select("language", "*");
                            
                            // Check Did it have language in menu
                            $chk_lang = $database->count("menu", array("lang_id" => $lang));
                            
                            //All Available Language
                            $available_langs = $database->select("menu",array("[>]language" => array("lang_id" => "lang_id")),array("lang_name"));

                            
                            //var_dump($categorys);
                            
                    ?>                    
                     
                                      
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Add Menu</b>
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
                                    
                                    <form method="post" role="form" action="functions/update_menu.php" data-toggle="validator"> 

                                    <div class="form-group">

                                            <!-- Pull in Database from language list -->
                                            <label>Language</label>
                                            <select name="lang" class="form-control" onchange="location = 'index.php?p=menu&lang=' + this.options[this.selectedIndex].value";>

                                            <?php foreach ($languages as $data) {
                                                    if($data['lang_id'] == $lang) {?>

                                                        <option value="<?php echo $data['lang_id'];?>" selected><?php echo $data['lang_name'];?></option>

                                            <?php } else { ?>

                                                        <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>
                                                            
                                            <?php } } ?>

                                            </select>
                                    </div>
                                    
                                    <?php if($chk_lang == 0){ ?>
                                                        
                                            <button type="submit" class="btn btn-success" style="margin-bottom: 15px;">Create <b><?php echo $lang_name;?></b> Language Menu</button>                 
                                    
                                    <?php } else { ?>
                                        
                                    </form>
                                        
                                    <form data-toggle="validator" role="form" action="javascript: void(0)">
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" class="form-control" placeholder="Enter Content Name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="type" id="type">
                                                  <option value="link">Link</option>
                                                  <option value="content">Content</option>
                                                  <option value="category">Category</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <?php
                                            
                                            // Select Content
                                            $contents = $database->select("content", array('id','cont_name'),array('cont_type'=>'content' ,"ORDER" => "cont_name"));
                                            $categorys = $database->select("category", array('cat_id','cat_name') ,array("ORDER" => "cat_name"));
                                            
                                        ?>
                                        
                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Items</label>
                                                <select class="form-control" id="item" name="item">
                                                    <?php foreach ($contents as $content) { ?>
                                                        <option value="<?php echo $content['id'];?>" class="content"><?php echo $content['cont_name'];?></option>
                                                    <?php } ?>
                                                    
                                                    <?php foreach ($categorys as $category) { ?>
                                                        <option value="<?php echo $category['cat_id'];?>" class="category"><?php echo $category['cat_name'];?></option>
                                                    <?php } ?>
                                                    <option value="link" class="link">Please Enter Custom URLs</option>                                                  
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div id="div-url" class="col-lg-12">
                                            <div class="form-group">
                                                <label>Url</label>
                                                <input id="url" name="url" class="form-control" placeholder="Enter Url">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <button id="create-item" class="btn btn-success"><i class="fa fa-leaf fa-1x"></i> Add Item</button>
                                        </div>
                                        
                                    </form>
                                    <script>
                                            $(document).ready(function() {
                                                 $('button[id="create-item"]').attr('disabled','disabled');
                                                 $('input[name="name"]').keyup(function() {
                                                    if($(this).val() != '') {
                                                       $('button[id="create-item"]').removeAttr('disabled');
                                                    }
                                                    else{$('button[id="create-item"]').attr('disabled','disabled');}
                                                 });   
                                             });                                      
                                    </script>>      
                                    
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Create Menu</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <h3 style="margin-bottom: 20px;"><i class="fa fa-list-ul fa-1x"></i> Menu Structure</h3>
                                                <section id="demo">
                                                    <ol id="sora-menu" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded"> <?php $menu = $database->select("menu",'menu_structure', array("lang_id" => $lang)); echo $menu[0]; ?> </ol>
                                                </section><!-- END #demo -->
                                                
                                            </div>
                                        </div> 

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <p><em>Each Menu has maximum<code>" 2 Category Levels "</code>( Menu >> Category >> Sub-Category )</em></p>
                                                <input name="menu-structure" type="hidden" id="menu-structure"></input>
                                                <input type="hidden" name="lang_id" value="<?php echo $lang;?>">    <!-- Language ID -->
                                                <input type="hidden" name="menu_id" value="<?php echo $menu_id;?>"> <!-- Menu ID -->
                                                <br><br><button id="toArray" name="toArray" class="btn btn-primary"><i class="fa fa-send fa-1x"></i> Save Menu</button>
                                            </div>
                                        </div>
      
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                    
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

    //Chained Selection
    
    $(document).ready(function(){
        
        $("#item").chained("#type");
        
        $('#type').change(function(){
            
            if($('#type').val() == "content"){
                $('#div-url').hide();
                $('#url').val($('#item').val());
            }
            else if($('#type').val() == "category"){
                $('#div-url').hide();
                $('#url').val($('#item').val());
            }
            else{
                $('#div-url').show();
                $('#url').val('');
            }
            
        });
        $('#item').change(function(){
            
            if($('#type').val() == "content"){
                $('#div-url').hide();
                $('#url').val($('#item').val());
            }
            else if($('#type').val() == "category"){
                $('#div-url').hide();
                $('#url').val($('#item').val());
            }
            else{
                $('#div-url').show();
                $('#url').val('');
            }
            
        });
        
        $("#create-item").click(function(){
            
			$('#url').val($('#item').val());
            //---------------------------------------  POST FORM -----------------------------------
            var formData = {
                'a'                 : 'addObject',
                'name'              : $('input[name=name]').val(),
                'url'               : $('input[name=url]').val(),
                'type'              : $('select[name=type]').val()
            };
             
            $.ajax({
              type: "POST",                                     
              url:  'functions/update_menu.php',
              dataType: 'json',                             
              data: formData,
                                                          
              success: function(data)          
              {
                //alert(data);
                var obj_id = data[0]['obj_id'];              //get id
                var obj_name = data[0]['obj_name'];          //get name
                var obj_url = data[0]['obj_url'];            //get url
                var obj_type = data[0]['obj_type'];            //get type
                
                if(obj_type == "content"){
                    $("#sora-menu").append(" <li class='mjs-nestedSortable-leaf' id='menuItem_"+obj_id+"'>"+
                                         "<div class='menuDiv ui-sortable-handle'>"+
                                         "  <span title='Click to show/hide children' class='disclose ui-icon ui-icon-minusthick'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span title='Click to show/hide item editor' data-id='"+obj_id+"' class='expandEditor ui-icon ui-icon-triangle-1-n'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span>"+
                                         "      <span data-id='"+obj_id+"' class='itemTitle'>"+obj_name+"</span>"+
                                         "      <span title='Click to delete item.' data-id='"+obj_id+"' class='deleteMenu ui-icon ui-icon-closethick'>"+
                                         "          <span></span>"+
                                         "      </span>"+
                                         "  </span>"+
                                         "<div id='menuEdit"+obj_id+"' class='menuEdit'>"+
                                         "  <p>"+
                                                    "index.php?p=content&id="+obj_url+
                                         "  </p>"+
                                         "</div>"+
                                         "</div>"+
                                         "</li>");
                }
                else if(obj_type == "category"){
                    $("#sora-menu").append(" <li class='mjs-nestedSortable-leaf' id='menuItem_"+obj_id+"'>"+
                                         "<div class='menuDiv ui-sortable-handle'>"+
                                         "  <span title='Click to show/hide children' class='disclose ui-icon ui-icon-minusthick'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span title='Click to show/hide item editor' data-id='"+obj_id+"' class='expandEditor ui-icon ui-icon-triangle-1-n'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span>"+
                                         "      <span data-id='"+obj_id+"' class='itemTitle'>"+obj_name+"</span>"+
                                         "      <span title='Click to delete item.' data-id='"+obj_id+"' class='deleteMenu ui-icon ui-icon-closethick'>"+
                                         "          <span></span>"+
                                         "      </span>"+
                                         "  </span>"+
                                         "<div id='menuEdit"+obj_id+"' class='menuEdit'>"+
                                         "  <p>"+
                                                    "index.php?p=category&id="+ obj_url+
                                         "  </p>"+
                                         "</div>"+
                                         "</div>"+
                                         "</li>");    
                }else{
                    $("#sora-menu").append(" <li class='mjs-nestedSortable-leaf' id='menuItem_"+obj_id+"'>"+
                                         "<div class='menuDiv ui-sortable-handle'>"+
                                         "  <span title='Click to show/hide children' class='disclose ui-icon ui-icon-minusthick'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span title='Click to show/hide item editor' data-id='"+obj_id+"' class='expandEditor ui-icon ui-icon-triangle-1-n'>"+
                                         "      <span></span>"+
                                         "  </span>"+
                                         "  <span>"+
                                         "      <span data-id='"+obj_id+"' class='itemTitle'>"+obj_name+"</span>"+
                                         "      <span title='Click to delete item.' data-id='"+obj_id+"' class='deleteMenu ui-icon ui-icon-closethick'>"+
                                         "          <span></span>"+
                                         "      </span>"+
                                         "  </span>"+
                                         "<div id='menuEdit"+obj_id+"' class='menuEdit'>"+
                                         "  <p>"+
                                                    obj_url+
                                         "  </p>"+
                                         "</div>"+
                                         "</div>"+
                                         "</li>");    
                }
                          
                $("#menu-structure").val("");
                $("#menu-structure").val($("#sora-menu").html()); 
                $(".form-control[name=name]").val("");
                $(".form-control[name=url]").val("");
                
                toastr["success"]("Add Menu Item Success","Add Success");
                
                $('#toArray').trigger('click');
                
                $(document).trigger('readyAgain');
              } 
            });

           });
        
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
                maxLevels: 2,
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
                    'a'               : 'delMenu',
                    'obj_id'          : id
                };    
                $.ajax({
                     type: "POST",                                     
                     url: 'functions/update_menu.php',                            
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
               
               $("#menu-structure").val("");
               $("#menu-structure").val($("#sora-menu").html());
               
               //alert($("#sora-menu").html());
               
               var formData = {
                'a'                 : 'updateMenuStructure',
                'menu_id'           : $('input[name=menu_id]').val(),
                'structure'         : $('input[name=menu-structure]').val()
               };
                 
               $.ajax({
                 type: "POST",                                     
                 url: 'functions/update_menu.php',                            
                 data: formData,
                               
                 success: function(){toastr["success"]("Update Menu Structure Success","Update Success");} 
               });
               
               ////////////////////////////  
                
               arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});
               var jsonString = JSON.stringify(arraied);
               var menu_id = $('input[name=menu_id]').val();
               //alert(menu_id);
               //alert(jsonString);
               $.ajax({
                    type: "POST",
                    url: "functions/update_menu.php?menu_id="+menu_id,
                    data: {data : jsonString}, 
                    cache: false,
            
                    success: function(){
                        toastr["success"]("Save Menu Success","Save Success");
                    }
                });

            });
    });     
    
    //Menu II
  
    
</script>