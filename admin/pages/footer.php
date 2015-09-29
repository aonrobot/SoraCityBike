<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid" id="fakeLoader">
        <div class="row">
            <div class="col-lg-12">
                <!-- Start Content -->

                <?php if(strcmp($_GET['a'], 'edit')){?>

                    <h1 class="page-header"><i class="fa fa-dot-circle-o fa-1x"></i> Footer Management</h1>
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <b>Create New Footer</b>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form method="post" role="form" action="query.php?a=addFooter" data-toggle="validator">
                                            
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
                                                <label>Name</label>
                                                <input name="name" class="form-control" placeholder="Enter Footer Name" required>
                                            </div>
                                            
                                            <div class="col-lg-6 form-group">
                                                <label>Title</label>
                                                <input name="title" class="form-control" placeholder="Enter Title Name" required>
                                            </div>
                                                        
                                            <div class="col-lg-12 form-group">
                                                <label>Link</label>
                                                <input name="link" class="form-control" placeholder="Enter Link" required>
                                            </div>
                                                        
                                            <div class="col-lg-4 form-group">
                                                <label>Link Position</label>
                                                <select name="link_position" class="form-control">
                                                    <option value="left">Left</option>
                                                    <option value="center">Center</option>
                                                    <option value="right">Right</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-4 form-group">
                                                <label>Link Target</label>
                                                <select name="link_target" class="form-control">
                                                     <option value="_self">Same frame as it was clicked (Self)</option>
                                                     <option value="_blank">New window (Blank)</option>
                                                     <option value="_parent">Parent frameset (Parent)</option>
                                                     <option value="_top">Full body of the window (Top)</option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-lg-4 form-group">
                                                <label>Link Order</label>
                                                <input name="link_order" class="form-control" placeholder="Enter Link Order(Number)" required>
                                            </div>
    
                                            <div class="col-lg-2">
                                                <button style="margin-top: 20px;" type="submit" class="btn btn-primary save_btn">Create Footer</button>
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
                                <b>All Footer</b>
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                
                                <div class="dataTable_wrapper">
                                                                            
                                    <table class="table table-striped table-bordered table-hover" id="show-footer">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Link</th>
                                                <th>Target</th>
                                                <th>Position</th>
                                                <th>Order</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <!------------------------------ bite and aon was here ------------------------------------------------------------------->
                                        <tbody>
                                        <?php
                                                $datas = $database->select("footer", array("[<]footer_translation" => array("footer_id" => "footer_id"),) ,"*");
                                                
                                                $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang')); // Get Defalut Language
                                                
                                                foreach ($datas as $data) {
                                                    
                                                    if(!strcmp($default_lang[0], $data['lang_id'])){
                                                    $link_edit = "index.php?p=footer&a=edit&id=".$data['footer_id']."&lang=".$default_lang[0];
                                        ?>                                            
                                            <tr>
                                                <td><?php echo $data['footer_title'];?></td>
                                                <td><a href="#" class="footerlink" data-type="text" data-pk="<?php echo $data['footer_id'];?>" data-url="query.php?a=editvaluefooter&c=footer_link" data-title="Edit below here" > <?php echo $data['footer_link'];?></a></td>
                                                <td><a href="#" class="footertarget" data-type="select" data-pk="<?php echo $data['footer_id'];?>" data-url="query.php?a=editvaluefooter&c=footer_target" data-title="Edit below here"> <?php echo $data['footer_target'];?></a></td>
                                                <td><a href="#" class="footerposition" data-type="select" data-pk="<?php echo $data['footer_id'];?>" data-url="query.php?a=editvaluefooter&c=footer_position" data-title="Edit below here"> <?php echo $data['footer_position'];?></a></td>
                                                <td><a href="#" class="footerorder" data-type="text" data-pk="<?php echo $data['footer_id'];?>" data-url="query.php?a=editvaluefooter&c=footer_order" data-title="Edit below here"> <?php echo $data['footer_order'];?></a></td>
                                                <td>
                                                    <a href="<?php echo $link_edit;?>" class="btn btn-primary" style="margin-right: 8px;"><i class="fa fa-edit"></i></a>
                                                     <a href="query.php?a=del&w=footer&i=<?php echo $data['footer_id'];?>" class="btn btn-danger"> <i class="fa fa-recycle"></i></a>
                                                </td>
                                            </tr>
    
                                        </tbody>
                                        
                                                <?php continue;} }?>
                                        
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

                            $footer_id = $_GET['id'];      // Footer Id
                            
                            // Default Language Id
                            $default_lang = $database->select("site_meta",'meta_value',array('meta_key'=> 'site_default_lang')); // Get Defalut Language
                            if(!isset($_GET['lang'])) $lang = $default_lang[0];
                            else $lang = $_GET['lang']; 
                            
                            $lang_name = $database->select("language", "lang_name" , array("lang_id" => $lang));
                            $lang_name = $lang_name[0];
                            
                            // Language Select
                            $count = $database->count("language", "*");
                            $languages = $database->select("language", "*");
                            
                            // Check Did it have language in footer_translation
                            $chk_lang = $database->count("footer_translation", array(
                                "AND" => array("footer_id" => $footer_id, "lang_id" => $lang)
                            ));
                            
                            //All Available Language
                            $available_langs = $database->select("footer_translation",array("[>]language" => array("lang_id" => "lang_id")),array("lang_name"),array("footer_id" => $footer_id,));

                            //Category Select
                            $footers = $database->select("footer", array(

                            "[><]footer_translation" => array("footer_id" => "footer_id"),

                            ), "*", array("AND" => array("footer_translation.footer_id" => $footer_id, "lang_id" => $lang)) // Where
                            );
                            
                            //var_dump($categorys);
                            
                    ?>
                    <h1 class="page-header"><a href="index.php?p=footer"><i class="fa fa-cubes fa-1x"></i></a> <?php echo $footers[0]['footer_name'];?></h1>
                    
                    <form method="post" role="form" action="query.php?a=updateFooter" data-toggle="validator">
                        
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <b>Footer Info</b><br>
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
                                                <select name="lang" class="form-control" onchange="location = 'index.php?p=footer&a=edit&id=<?php echo $footer_id;?>&lang='+this.options[this.selectedIndex].value";>

                                                <?php foreach ($languages as $data) {
                                                        if($data['lang_id'] == $lang) {?>

                                                            <option value="<?php echo $data['lang_id'];?>" selected><?php echo $data['lang_name'];?></option>

                                                <?php } else { ?>

                                                            <option value="<?php echo $data['lang_id'];?>"><?php echo $data['lang_name'];?></option>
                                                            
                                                <?php } } ?>

                                                </select>
                                        </div>

                                        <?php if($chk_lang == 0){ ?>
                                                <input name="footer_id" type="hidden" value="<?php echo $footer_id;?>" />
                                                <button type="submit" class="btn btn-success" style="margin-bottom: 15px;">Create <b><?php echo $lang_name;?></b> Language Category Title</button>

                                        <?php } else { ?>


                                        <div class="form-group">
                                            <label>Title</label>
                                            <input name="title" class="form-control" placeholder="Footer Name" value="<?php echo $footers[0]['footer_title'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input name="name" class="form-control" placeholder="Footer Title" value="<?php echo $footers[0]['footer_name'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Link</label>
                                            <input name="link" class="form-control" placeholder="Footer Link" value="<?php echo $footers[0]['footer_link'];?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Link Position</label>
                                            <select name="link_position" class="form-control">
                                                <option value="left">Left</option>
                                                <option value="center">Center</option>
                                                <option value="right">Right</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Link Target</label>
                                            <select name="link_target" class="form-control">
                                                 <option value="_self">Same frame as it was clicked (Self)</option>
                                                 <option value="_blank">New window (Blank)</option>
                                                 <option value="_parent">Parent frameset (Parent)</option>
                                                 <option value="_top">Full body of the window (Top)</option>
                                           </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Link Order</label>
                                            <input name="link_order" class="form-control" placeholder="Footer Order" value="<?php echo $footers[0]['footer_order'];?>"/>
                                        </div>
                                        
                                        <br/>
                                       
                                       <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Update Footer</button>
                                       </div>
                                        
                                        <?php }?>
                                        
                                        
                                        

                                </div>
                                <!-- /.col-lg-12 (nested) -->

                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
                    <input name="footer_id" type="hidden" value="<?php echo $footer_id;?>" />
                    
                    
                    </form>

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
        $('#show-footer').DataTable({
            paging: false,
            responsive: true,
            "order": [[ 0, "desc" ]],
        });
    <?php }?>   


    $(function() {
            $.fn.editable.defaults.mode = 'inline';
    
            $('.name').editable({});

            $('.footerlink').editable({});
            $('.footertarget').editable({    
                source : [{
                    text : '_self',
                    value : '_self'
                }, {
                    value : '_parent',
                    text : '_parent'
                }, {
                    value : '_blank',
                    text : '_blank'
                }, {
                    value : '_top',
                    text : '_top'
                }]
    
            });
            $('.footerposition').editable({
    
                source : [{
                    text : 'left',
                    value : 'left'
                }, {
                    value : 'right',
                    text : 'right'
                }
                , {
                    value : 'center',
                    text : 'center'
                }]
    
            });
            $('.footerorder').editable({});
        });
            

</script>

<script src="components/Editablecss/js/bootstrap-editable.js"></script>
