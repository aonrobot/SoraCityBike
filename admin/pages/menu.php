<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-dashboard fa-1x"></i> Menu</h1>
                <?php
                
                // JSON TO ARRAY CODE 
                
                /*
                    $json = '[{"id":0},{"id":107,"children":[{"id":108},{"id":109},{"id":111}]},{"id":110},{"id":112}]';
                    echo "<pre>";
                    print_r(json_decode($json, true));
                    echo "</pre>";
                    echo "<pre>";
                    var_dump(json_decode($json, true));
                    echo "</pre>";
                    
                    $array = json_decode($json, true);
                    echo $array[1]['children'][0]['id'].'<br>';
                    
                    $objs = array();
                    
                    
                    for($i = 1 ; $i < count($array) ; $i++){
                        if($array[$i]['children'][0]['id'] == ''){
                            echo $i." not have children ".$array[$i]['id'].'<br>';
                            $obj = array("obj_id"=>$array[$i]['id'], "parent_id"=>"0", "menu_order"=>$i);
                            array_push($objs,$obj);
                        }else{
                            echo $i." have children ".$array[$i]['id'].'<br>';
                            $obj = array("obj_id"=>$array[$i]['id'], "parent_id"=>"0", "menu_order"=>$i);
                            array_push($objs,$obj);
                            for($j = 0 ; $j < count($array[$i]['children']) ; $j++){
                                $obj = array("obj_id"=>$array[$i]['children'][$j]['id'], "parent_id"=>$array[$i]['id'], "menu_order"=>$j+1);
                                array_push($objs,$obj);
                            }
                        }
                    }
                    
                    echo "<pre>";
                    print_r($objs);
                    echo "</pre>";
                    */
                ?> 
                    
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Add Menu</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
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
                                            $contents = $database->select("content", array('id','cont_name'),array('cont_type'=>'content'));
                                            $categorys = $database->select("category", array('cat_id','cat_name'));
                                            
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
                                                <h3 style="margin-bottom: 20px;"><i class="fa fa-list-ul fa-1x"></i> Menu Stucture</h3>
                                                <section id="demo">
                                                    <ol id="sora-menu" class="sortable ui-sortable mjs-nestedSortable-branch mjs-nestedSortable-expanded"> <?php $menu = $database->select("content_meta",'meta_value',array("meta_key" => 'menu')); echo $menu[0]; ?> </ol>
                                                </section><!-- END #demo -->
                                                
                                            </div>
                                        </div> 

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <p><em>This Menu has <code>max sub-menu</code> '2' Levels.</em></p>
                                                <input name="menu-structure" type="hidden" id="menu-structure"></input>
                                                <br><br><button id="toArray" name="toArray" class="btn btn-primary"><i class="fa fa-send fa-1x"></i> Save Menu</button>
                                            </div>
                                        </div>
      
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                
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
               //alert(jsonString);
               $.ajax({
                    type: "POST",
                    url: "functions/update_menu.php",
                    data: {data : jsonString}, 
                    cache: false,
            
                    success: function(){
                        toastr["success"]("Save Menu Success","Save Success");
                    }
                });

            });
            
        });         
    
</script>