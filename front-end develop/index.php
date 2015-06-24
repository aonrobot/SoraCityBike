<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sora City Bike</title>
    <!-- Swiper Slider css -->
    <link href="css/swiper.min.css" rel="stylesheet" >
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sora-default.css" rel="stylesheet">

    <!-- Fonts -->
    
    
    

    <style>

        .swiper-container {
            width: 100%;
            height: 40%;
            margin: none;
        }
        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            width:auto;
            height:100%;
            margin:none;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack:center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }
    </style>


</head>

<body>


    <div class="brand row">
        <div class="col-xs-4 brand-social ">
            <a href="https://www.facebook.com/"><img class="social_icon" onmouseover="logo_mousein('icon-fb')" onmouseout="logo_mouseout('icon-fb')" id="icon-fb" src="img/icon/icon-fb-type2.png"/></a>
            <a href="https://www.facebook.com/"><img class="social_icon" onmouseover="logo_mousein('icon-pt')" onmouseout="logo_mouseout('icon-pt')" id="icon-pt" src="img/icon/icon-pt-type2.png"/></a>
            <a href="https://www.facebook.com/"><img class="social_icon" onmouseover="logo_mousein('icon-tt')" onmouseout="logo_mouseout('icon-tt')" id="icon-tt" src="img/icon/icon-tt-type2.png"/></a>
            <a href="https://www.facebook.com/"><img class="social_icon" onmouseover="logo_mousein('icon-ig')" onmouseout="logo_mouseout('icon-ig')" id="icon-ig" src="img/icon/icon-ig-type2.png"/></a>
        </div>
        <div class="col-xs-4 brand-logo ">
            <img class="logo_img" src="img/LOGO-(with-cloud)2.png"/>
        </div>
        <div class="pero-font time-text col-xs-4 brand-time " align="center">
            <?php 
            echo date('D d M');
            ?>
        </div>


    </div>


    <!-- Navigation -->
    <nav class="bg-gray navbar navbar-default " role="navigation">
        <div class="bg-gray container top-menu ">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>

                </button>
                <a class="navbar-brand" href="index.html">Sora City Bike</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
                <ul class="nav navbar-nav">
                    <li id="menu_1">

                        <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            concept
                            <!--  <span class="red-text">+</span> -->
                        </div>
                       <!--  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">dude</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                            <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                        </ul> -->
                        
                    </li>
                    <li id="menu_2">
                       <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        bikes
                        <span><img class="dropdown-span" src="img/down-btn.png"/></span>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul>
                </li>
                <li id="menu_3">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        gears
                        <span><img class="dropdown-span" src="img/down-btn.png"/></span>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul>
                </li>
                <li id="menu_4">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        café
                        <span><img class="dropdown-span" src="img/down-btn.png"/></span>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul>
                </li>
                <li id="menu_5">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        gallery
                        <span><img class="dropdown-span" src="img/down-btn.png"/></span>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul>
                </li>
                <li id="menu_6">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        location
                        <!-- <span class="red-text">+</span> -->
                    </div>
                    <!-- <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul> -->
                </li>
                <li id="menu_7">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        partners
                        <span><img class="dropdown-span" src="img/down-btn.png"/></span>
                    </div>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul>
                </li>
                <li id="menu_8">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        projects
                        <!-- <span class="red-text">+</span> -->
                    </div>
                    <!-- <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul> -->
                </li>
                <li id="menu_9">
                    <div class="bg-gray pero-font btn btn-default " type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                        blog
                        <!-- <span class="red-text">+</span> -->
                    </div>
                    <!-- <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>

                    </ul> -->
                </li>
            </ul>
            
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>





<div class="swiper-container">

    <!-- Wrapper for slides -->
    <div class="swiper-wrapper">
        <div class="swiper-slide">
           <div class="slidein" > 
               <img src="img/slide-1.jpg" alt="" > 
               <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption</h1>	
                      <p style="margin-left:10px; color:white;"> Hello my name is pusit nice to meet you. This is first image.
                      </p>		
                  </span>
              </div> 

          </div>



          <div class="swiper-slide">
           <div class="slidein" > 
               <img src="img/slide-2.jpg" alt="" > 
               <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption1</h1>	
                      <p style="margin-left:10px; color:white;"> This is second image.
                      </p>		
                  </span>
              </div> 

          </div>
          <div class="swiper-slide">

           <div class="slidein" > 
               <img src="img/slide-3.jpg" alt="" > 
               <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption2</h1>	
                      <p style="margin-left:10px; color:white;"> This is third image.
                      </p>		
                  </span>
              </div> 

          </div>
          <div class="swiper-slide">
              <div class="slidein" > 
                 <img src="img/slide-1.jpg" alt="" > 
                 <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption3</h1>	
                      <p style="margin-left:10px; color:white;"> This is 4th image.
                      </p>		
                  </span>
              </div> 

          </div>
          <div class="swiper-slide">
              <div class="slidein" > 
                 <img src="img/slide-2.jpg" alt="" > 
                 <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption4</h1>	
                      <p style="margin-left:10px; color:white;"> This is 5th image.
                      </p>		
                  </span>
              </div> 

          </div>

          <div class="swiper-slide ">
             <div class="slidein" > 
                 <img src="img/slide-3.jpg" alt="" > 
                 <span class="caption simple-caption" >
                  <h3 style="margin-left:10px;">Simple Caption5</h1>	
                      <p style="margin-left:10px; color:white;"> This is 6th image.
                      </p>		
                  </span>
              </div> 
          </div>



      </div>

      <!--navigation buttons-->
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <!-- Add Scrollbar -->
      <div class="swiper-scrollbar"></div>


  </div>


  <div class="hidden-slider" align="center">

    <div class="hidden-content" id="hideMe" style="display:none;">I want to hide this by pressing the button above</div>

    <button class="bg-gray hidden-btn pero-font btn btn-default" onclick="toggle_visibility('hideMe')">more slide</button> 
    
</div>
<hr class="mid-line">


<div class="content row">
     <div class="container" align="center">
        <h4 class="pero-font large-font underline   ">stories</h4>


        <div class="row category pero-font">


            <div class="col-md-6 category-box">
                <img src="img/slide-3.jpg" class="index-img"/>
                <p class="pero-font text-header"> KINFOLK ISSUE SIXTEEN: THE ESSENTIALS ISSUE </p>
                <p class="pero-font text-content"> A look inside Kinfolk Issue Sixteen: The Essentials Issue, which will explore what we all consider the basic building blocks in life to be.
                    <a href="">READ MORE</a>
                </p>
            </div>

            <div class="col-md-6 category-box">
                <img src="img/slide-3.jpg" class="index-img">
                <p class="pero-font text-header"> KINFOLK ISSUE SIXTEEN: THE ESSENTIALS ISSUE </p>
                <p class="pero-font text-content"> A look inside Kinfolk Issue Sixteen: The Essentials Issue, which will explore what we all consider the basic building blocks in life to be.
                    <a href="">READ MORE</a>
                </p>       
            </div>
        </div>
        <div class="row category pero-font">
            <div class="col-md-6 category-box">
                <img src="img/slide-3.jpg" class="index-img">
                <p class="pero-font text-header"> KINFOLK ISSUE SIXTEEN: THE ESSENTIALS ISSUE </p>
                <p class="pero-font text-content"> A look inside Kinfolk Issue Sixteen: The Essentials Issue, which will explore what we all consider the basic building blocks in life to be.
                    <a href="">READ MORE</a>
                </p>        
            </div>

            <div class="col-md-6 category-box">
                <img src="img/slide-3.jpg" class="index-img">
                <p class="pero-font text-header"> KINFOLK ISSUE SIXTEEN: THE ESSENTIALS ISSUE </p>
                <p class="pero-font text-content"> A look inside Kinfolk Issue Sixteen: The Essentials Issue, which will explore what we all consider the basic building blocks in life to be.
                    <a href="">READ MORE</a>
                </p>        
            </div>
        </div>
    
</div>


</div>

<hr style="max-width: 70%;">


<!-- /.container -->

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right">
                <small>Copyright &copy; Your Website 2014</small>
            </div>
        </div>
    </div>
</footer>

<!-- jQuery -->
<script src="js/jquery.js"></script>
<script src="js/sora-default.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Script to Activate the Carousel -->
<script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
</script>
<!-- Swiper JS -->
<script src="js/swiper.min.js"></script>

<!-- Initialize Swiper -->
<script>
    var swiper = new Swiper('.swiper-container', {
        scrollbar: '.swiper-scrollbar',
        scrollbarHide: false,
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 0,
        grabCursor: false,

        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'

    });
</script>
</body>

</html>
