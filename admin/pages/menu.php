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

                                        <div class="col-lg-3">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input name="name" class="form-control" placeholder="Enter Content Name">
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
                                            $contents = $database->select("content", array('id','cont_name'));
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
                                        
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Url</label>
                                                <input id="url" name="url" class="form-control" placeholder="Enter Url">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6">
                                            <button id="create-item" class="btn btn-success"><i class="fa fa-leaf fa-1x"></i> Add Item</button>
                                        </div>
      
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
                                                <label>Menu</label>
                                                
                                                 <div class="cf nestable-lists">
                    
                                                    <!---- Create Zone -->           
                                                    <div class="dd" id="nestable">
                                                        <!-- <li class="dd-item" data-id="0"><div class="dd-handle">Create Zone</div></li> -->
                                                        <ol id="sora-menu" class="dd-list">
                                                            <?php
                                                                    $menu = $database->select("content_meta",'meta_value',array("meta_id"=>'1'));
                                                                    echo $menu[0];        
                                                            ?>
                                                        </ol>
                                                    </div>
                                                    
                                                    <!---- Delete Zone -->
                                                    <div class="dd" id="nestable-delete">
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="0">
                                                                <div class="dd-handle">Delete Zone</div>
                                                            </li>
                                                        </ol>
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                        </div> 
                                        
                                        <div class="col-lg-12"><div class="form-group"></div></div>
                                        <div class="col-lg-12"><div class="form-group"></div></div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>Result Data</label>
                                                <input name="menu-output" type="text" id="nestable-output"></input>
                                                <input name="menu-output-delete" type="text" id="nestable-delete-output"></input>
                                                <input name="menu-structure" type="hidden" id="menu-structure"></input>
                                                <br><br><button id="save-menu" class="btn btn-primary"><i class="fa fa-send fa-1x"></i>Save Menu</button>
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

<!-- Menu -->
<script src="components/menu-nestable/jquery.nestable.js"></script>

<script type="text/javascript">
    
    $(document).ready(function()
    {
        
        $("#item").chained("#type");
        var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        
        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1,
            maxDepth: 2
        })
        .on('change', updateOutput);
        
        $('#nestable').change(function(){
           $("#menu-structure").val("");
           $("#menu-structure").val($("#sora-menu").html()); 
        });
        
        // activate Nestable for list 2
        $('#nestable-delete').nestable({
            group: 1,
            maxDepth: 1
        })
        .on('change', updateOutput);
        
        $("#create-item").click(function(){
            
            //---------------------------------------  POST FORM -----------------------------------
            var formData = {
                'a'                 : 'addObject',
                'name'              : $('input[name=name]').val(),
                'url'               : $('input[name=url]').val(),
                'type'              : $('select[name=type]').val()
            };
             
            $.ajax({                                     
              url: 'query.php',                            
              data: formData,
              dataType: 'json',                                            
              success: function(data)          
              {
                var obj_id = data[0]['obj_id'];              //get id
                var obj_name = data[0]['obj_name'];          //get name
                
                $("#sora-menu").append(" <li class='dd-item' data-id='"+obj_id+"'><div class='dd-handle'>"+obj_name+"</div></li>");
                $("#nestable").trigger("change");
                $("#nestable-delete").trigger("change");
                $("#menu-structure").val("");
                $("#menu-structure").val($("#sora-menu").html());
              } 
            });

        });
        
        $("#save-menu").click(function(){
            
            //---------------------------------------  POST FORM -----------------------------------
            var formData = {
                'a'                 : 'saveMenu',
                'out'              : $('input[name=menu-output]').val(),
                'delete'               : $('input[name=menu-output-delete]').val(),
                'structure'              : $('input[name=menu-structure]').val()
            };
             
            $.ajax({                                     
              url: 'query.php',                            
              data: formData,
              dataType: 'json',                               
              success: function(data)          
              {
                  alert("Save Success");  
              } 
            });

        });        

        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        updateOutput($('#nestable-delete').data('output', $('#nestable-delete-output')));
        
        $('#type').change(function(){
            
            if($('#type').val() == "content")
                $('#url').val('index.php?p=content&id='+$('#item').val());
            else if($('#type').val() == "category")
                $('#url').val('index.php?p=category&id='+$('#item').val());
            else
                $('#url').val('');
            
        });
        $('#item').change(function(){
            
            if($('#type').val() == "content")
                $('#url').val('index.php?p=content&id='+$('#item').val());
            else if($('#type').val() == "category")
                $('#url').val('index.php?p=category&id='+$('#item').val());
            else
                $('#url').val('');
            
        });
        
        
    });
    
</script>