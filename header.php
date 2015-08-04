<?php 

session_start();

include 'counter.php';

$lang=$database->select("language",'*');
$site=$database->select("site_meta",'*',["meta_key[=]" => 'site_path']);
$site_path=$site[0]['meta_value'];

$lang_def=$database->select("site_meta",'*',["meta_key[=]" => 'site_default_lang']);
$default_lang=$lang_def[0]['meta_value'];


if(!isset($_SESSION['lang_session']))
	$_SESSION['lang_session'] = $default_lang;
?>


<?php 
    
    if(isset($_GET['id']))
        $content_db = $database->select("content",['cont_thumbnail'],["id[=]"  => $_GET['id']]);

?>

<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href=<?php echo '"'.$site_path.'/components/img/favicon2.png"'?>>
	<link rel="icon" href=<?php echo '"'.$site_path.'/components/img/favicon2.png"'?>>

	<title>
		<?php

		if(empty($_GET['id'])){
			echo 'sora city';

		}
		else{

			$title = $database->select("content_translation","*",["AND"=>["lang_id[=]"=>$_SESSION['lang_session'],"cont_id[=]"=>$_GET['id']]]);

			echo $title[0]["cont_title"].' | Sora City Bike';
		}
		?>
	</title>
	
	<?php if(isset($_GET['id'])){ ?>
	<meta property="og:image" content="<?php echo 'https://www.soracity.bike'.$content_db[0]["cont_thumbnail"];?>"/>
	<?php };?>
	
	<!-- RRSSB Social Share CSS -->
    <link rel="stylesheet" href="<?php echo $site_path;?>/components/css/rrssb.css" />
    
	<link href=<?php echo '"'.$site_path.'/'.'components/css/bootstrap.css'.'"'; ?> rel="stylesheet">
	<link href=<?php echo '"'.$site_path.'/'.'components/css/sora-default.css'.'"'; ?> rel="stylesheet">
	<link href=<?php echo '"'.$site_path.'/'.'components/css/leo.css'.'"'; ?> rel="stylesheet">
	<link href=<?php echo '"'.$site_path.'/'.'components/css/cobox.css'.'"'; ?> rel="stylesheet">
	<script src=<?php echo '"'.$site_path.'/'.'components/js/jquery.js'.'"'; ?>></script>

</head>


<body> 




	<!-- ////////////////////////////////////    THIS  IS TOP MENU       ///////////////////////////////////////////////////// -->
	<div class="row row_navbar">
		<div class="col-xs-4 brand-time " align="center">
			<?php 

			echo '<span class=" pero-font uppercase time_text"><b>'.date('D j M').'</b></span>';



			?>
		</div>
		<div class="col-xs-4 col-xs-offset-4 brand-social" align="center" style="left:-6%;">
			<a href="https://www.facebook.com/soracity" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-fb')" 
				onmouseout="logo_mouseout('icon-fb')" id="icon-fb" src=<?php echo '"'.$site_path.'/components/img/icon/icon-fb-type2.png"/'?>></a>

				<a href="https://instagram.com/soracity/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ig')" 
					onmouseout="logo_mouseout('icon-ig')" id="icon-ig" src=<?php echo '"'.$site_path.'/components/img/icon/icon-ig-type2.png"/'?>></a>

					<a href="https://www.pinterest.com/soracity/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-pt')" 
						onmouseout="logo_mouseout('icon-pt')" id="icon-pt" src=<?php echo '"'.$site_path.'/components/img/icon/icon-pt-type2.png"/'?>></a>

						<a href="https://www.vimeo.com/soracity/" target="_blank"><img class="social_icon" onmouseover="logo_mousein('icon-ve')" 
							onmouseout="logo_mouseout('icon-ve')" id="icon-ve" src=<?php echo '"'.$site_path.'/components/img/icon/icon-ve-type2.png"/'?>></a>
							<br class="br-header">
							<?php

							foreach ($lang as $a) {?>

							<a href=""><button class="lang_btn time_text bg-gray pero-font btn btn-default lowercase" id="lang_btn" onclick=<?php echo '"a('."'".$a['lang_id']."'".');"'; ?>     ><?php echo $a['lang_code']; ?></button></a>

							<?php
						}    
						?>
						<script type="text/javascript">
							function a(e){

								$.ajax({
									type: 'POST',
									url: <?php echo '"'.$site_path.'/change_lang.php"'?>,
									data: {
										lang: e
									}
								}).done(function() {

								});

							}
						</script>
					</div>
				</div>

				<div class="brand row">


					<div class="col-xs-4 col-xs-offset-4 brand-logo ">
						<a href=<?php echo '"'.$site_path.'/index.php"'; ?>><img class="logo_img" src=<?php echo '"'.$site_path.'/components/img/LOGO-(with-cloud)2.png"/'?>></a>
					</div>


				</div>
				<hr class="top_line">

				<nav class="bg-gray navbar navbar-default " role="navigation" id="stickyheader">
					<div class="bg-gray container top-menu ">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header" align="center">

							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>

							</button>
							<a class="pero-font navbar-brand" href=<?php echo '"'.$site_path.'/index.php"'; ?>><img class="logo_img" src=<?php echo '"'.$site_path.'/components/img/LOGO-(with-cloud)2.png"/'?>></a>
						</div>

						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" align="center">

							<ul class="nav navbar-nav">

								<?php 
								$top_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[=]" => 0]);
								$sub_menu=$database->select("menu", ["[>]object" => ["obj_id" => "obj_id"]],"*",["parent_id[>]" => 0]);
								?>





								<?php

								foreach ($top_menu as $menu ) { 

									echo '<li id="menu_'.$menu['menu_id'].'">';
									if ($menu['obj_type'] == 'content') {

										$datas_con = $database->select("content",["id","cont_slug","cont_name"],["id[=]"  => $menu['obj_url']]);
										$link = "'".$site_path."/content/".$menu['obj_url']."/".$datas_con[0]["cont_slug"]."'";

									}
									elseif ($menu['obj_type'] == 'link') {

										$link ="'".$menu['obj_url']."'";  

									} 
									else {
										$datas_cat = $database->select("category",["cat_id","cat_slug"],["cat_id[=]"  => $menu['obj_url']]);
										$link = "'".$site_path."/category/".$menu['obj_url']."/".$datas_cat[0]["cat_slug"]."'";
									}    
									echo '<div class="dropdown-toggle bg-gray pero-bold-font btn btn-default " type="button" id="dropdownMenu1" 
									data-hover="dropdown" data-delay="100" data-toggle="dropdown" onclick="window.location.href='.$link.'">';?>
									<?php echo $menu['obj_name']; ?>



									<?php 
									$check=0;
									foreach ($sub_menu as $a ){
										if ($menu['obj_id']==$a['parent_id']) {
											$check=$check+1;
											if ($check==1) {
												echo '<span><img class="dropdown-span" src="'.$site_path.'/components/img/down-btn.png"/></span>'; 
											}}}
											?>


										</div>


										<?php 
										$check=0;
										foreach ($sub_menu as $a ){
											if ($menu['obj_id']==$a['parent_id']) {
												$check=$check+1;
												if ($check==1) { {

													?>
													<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
														<?php

														foreach ($sub_menu as $a ) {
															$sub=$a['parent_id'];
															$top=$menu['obj_id'];
															if ($sub==$top) {
																if ($a['obj_type']=='content')
																{ 
																	$datas = $database->select("content",["id","cont_slug","cont_name"],["id[=]"  => $menu['obj_url']]);

																	echo '<li role="presentation"><a role="menuitem" class="dropdownmenu" tabindex="-1" href="'.$site_path.'/'.$a['obj_type'].'/'.$a['obj_url'].'/'.$datas[0]["cont_slug"].'">'.$a['obj_name'].'</a></li>' ;
																}
																elseif ($a['obj_type']=='category') { 
																	$datas = $database->select("category",["cat_id","cat_slug"],["cat_id[=]"  => $menu['obj_url']]);

																	echo '<li role="presentation"><a role="menuitem" class="dropdownmenu" tabindex="-1" href="'.$site_path.'/'.$a['obj_type'].'/'.$a['obj_url'].'/'.$datas[0]["cat_slug"].'">'.$a['obj_name'].'</a></li>' ;
																}

															}
														}

														?>







													</ul>
													<?php }}}} ?>
												</li>
												<?php } ?>



											</ul>

										</div>
										<!-- /.navbar-collapse -->
									</div>
									<!-- /.container -->
								</nav>

								<div id="stickyalias"></div>
								
								<nav class="navbar navbar-default navbar-fixed-bottom">
									
										<div class="pero-font col-xs-3 footer-bar" align="left" style="padding-left:3.7%;">
											<h5>©soracity 2015</h5>
										</div>
										<div class="pero-font col-xs-6" align="center">
										<?php 
											$footer_link=$database->select("content", ["[>]content_meta" => ["id" => "cont_id"]],["cont_name","meta_key","meta_value"],["AND"=>["cont_type[=]"=>'footer',"meta_key[=]"=>'footer.link']]);
											//$footer_link_target=$database->select("content", ["[>]content_meta" => ["id" => "cont_id"]],["cont_name","meta_key","meta_value"],["AND"=>["cont_type[=]"=>'footer',"meta_key[=]"=>'footer.link_target']]);
											foreach ($footer_link as $key ) {
												echo '<a href="'.$key['meta_value'].'" class="footer-link pero-font "><span class="footer-text">'.$key['cont_name'].'</span></a>';
											
										 } ?>
										</div> 
										<div class="pero-font col-xs-3 footer-bar" align="right" style="padding-right:3.7%;">
											<h5>issue 1</h5>
										</div>
									
								</nav>

								<script>

									$(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('#stickyheader').offset().top;
        $(window).scroll(function(){
        	if( $(window).scrollTop() > stickyHeaderTop ) {
        		$('#stickyheader').css({position: 'fixed',width:'100%', top: '0px'});

        		$('#stickyalias').css('display', 'block');
        	} else {
        		$('#stickyheader').css({position: 'relative', top: '0px'});
        		$('#stickyalias').css('display', 'none');
        	}
        });
    });

								</script>
      <!-- ////////////////////////////////////    THIS  IS END OF TOPMENU       ///////////////////////////////////////////////////// -->