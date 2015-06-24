/*
 * Portfolio.js v1.0
 * jQuery Plugin for Portfolio Gallery
 * http://portfoliojs.com
 *
 * Copyright (c) 2012 Abhinay Omkar (http://abhiomkar.in) @abhiomkar
 * Licensed under the MIT License:
 *   http://www.opensource.org/licenses/mit-license.php
 *
 * Dependencies
 *  - jQuery: http://jquery.com
 *  - jQuery easing: http://gsgd.co.uk/sandbox/jquery/easing
 *  - jQuery touch swipe: http://labs.skinkers.com/touchSwipe
 *  - jQuery imagesLoaded: http://desandro.github.com/imagesloaded
 *  - jQuery scrollTo: http://flesler.blogspot.in/2007/10/jqueryscrollto.html
 *  - JS Spin: http://fgnass.github.com/spin.js

 * */

;(function($) {

    $.fn.portfolio = function(settings) {
        
    // default values 
    var defaults = {
        autoplay: false,
        firstLoadCount:30,
        enableKeyboardNavigation:false,
        loop: false,
        easingMethod: 'easeOutQuint',
        height: '400px',
        width: '100%',
        lightbox: false,
        showArrows: true,
        logger: true
    };

    // overriding default values
    $.extend(this, defaults, settings);

    // Local variables
    var portfolio = this, gallery = this,
    currentViewingImage,
    totalLoaded = 0,
    offset_left = 6,
    imageLoadedCalled = false;

    // portfolio public methods
    $.extend(this, {
        version: "0.1v",
        inthis: function() {

            portfolio.scrollToOptions={axis: 'x', easing: portfolio.easingMethod, offset: 0,margin:true}

            // Responsive for Mobile
            if ($(window).width() <= 700) {
                // if mobile, reduce the gallery height to fit on screen
                // 200px fixed height is good enough?
                
                // override gallery height
                portfolio.height = '200px';
            }

            // CSS Base
            $(this).css({
                width: portfolio.width,
                'max-height': portfolio.height,
                'overflow-x': 'scroll',
                'overflow-y': 'hidden',
                'white-space': 'nowrap',

				
				
				
				
				
				
            });

            $(this).find('img').css({
                display: 'inline-block',
                'max-width': 'none',
                height: portfolio.height,
                width: 'auto',
				margin:0
            });
			   
			  


            $(this).find("img").css('display', 'none');
		
            // end

            // set all images element attribute loaded to false and hide, bcoz the
            // game is not yet started :)
            $(this).find("img").attr('loaded', 'false');
            // end

            // mark first & last images
            $(this).find("img").first().attr('first', 'true').css({'margin-left': '0px'});
            $(this).find("img").last().attr('last', 'true').css({'margin-right': '0px'});
            // end
	
			

            // spinner
            // show spinner while the images are being loaded...
          

            // load first 4 images
            portfolio.loadNextImages(portfolio.firstLoadCount);
            
            // First Image
            $(this).find("img").first().addClass('active');

          

            // Show Arrows
            if (portfolio.showArrows) {
                portfolio.navigation.show();
            }

       
            // Events

          

          

            // Gallery Scroll
            $(this).scroll(function() {
                    if ($(gallery).find('img').last().attr('loaded') === 'true') {
                        $('.gallery-blank-space').css({left: $(gallery).find('img').last().data('offset-left') + $(gallery).find('img')
						.last().width() + 'px'});
                    }

                    // if (gallery[0].offsetWidth + gallery.scrollLeft() >= gallery[0].scrollWidth) // scroll end condition
                    
                    // scroll amount is greater than 60%
                    if ((gallery[0].offsetWidth + gallery.scrollLeft())*100 / gallery[0].scrollWidth > 60) {

                        if (totalLoaded < $(gallery).find('img').length) {
                            console_.log('scroll(): loading some more images');
                            portfolio.loadNextImages(30);
                            // $(gallery).find('img[loaded=true]').last().addClass('ctive');

                        }
                    }
            });

            // Window Resize
            $(window).resize(function() {
                if ($(window).width() <= 700 && $(gallery).find('img').first().height()!==200) {
                    $(gallery).css({height: '200px'});
                    $(gallery).find('img').css({height: '200px'});
                    $(gallery).find('.gallery-arrow-left, .gallery-arrow-right').css({height: '200px'});
                }
                else if ($(window).width() > 700 && $(gallery).find('img').first().height()===200) {
                    $(gallery).css({height: portfolio.height});
                    $(gallery).find('img').css({height: portfolio.height});
                    $(gallery).find('.gallery-arrow-left, .gallery-arrow-right').css({height: portfolio.height});
                }
            });

        }, // init

        next: function() {

            var cur_img = $(gallery).find('img.active'),
                next_img = $(gallery).find('img.active').next();

            if($(cur_img).attr('last') === 'true') {

                // if on last image and if loop is on 
                if(portfolio.loop) {
                    // go to first image 
                    console_.log('last', 'loop: on');

                    $(gallery).scrollTo(0, 500, portfolio.scrollToOptions);

                    $(gallery).find('img').removeClass('active').first().addClass('active');
					
                    
                }
                else {
                    console_.log('last', 'loop: off');
                }
            }

            // if next image is already loaded
            else if ($(next_img).attr('loaded') === 'true') {
                // go to next image
                $(gallery).scrollTo(next_img, 600, portfolio.scrollToOptions);

                $(gallery).find('img').removeClass('active');
                $(next_img).addClass('active');


            }
            // if next image is not yet loaded
            else if ($(next_img).attr('loaded') === 'false') {
                // show the spinner and prepare to load next images
                console_.log('next images are being loaded...');
            }

            /*
            if (gallery.offsetWidth + gallery.scrollLeft >= gallery.scrollWidth) {
                console_.log('scrollEnd');
                var spinner_target = $(currentViewingImage).after('<span class="spinner-container"></span>');
                $(gallery).scrollTo($(currentViewingImage).data("offset-left") + 100, 500, {axis: 'x'});
                portfolio.spinner(spinner_target);
            }
            */
            console_.log('next: current viewing image', $(gallery).find('img.active'));
        },

        prev: function() {
            var cur_img = $(gallery).find('img.active'),
                prev_img = $(gallery).find('img.active').prev();

            if($(cur_img).attr('first') === 'true') {
                // If on first Image stay there, do not scroll
            }
            else if (prev_img){
                // go to prev image
                $(gallery).scrollTo(prev_img, 500, portfolio.scrollToOptions);

                $(gallery).find('img').removeClass('active');
                $(prev_img).addClass('active');

                if (portfolio.lightbox) {
                    $(gallery).find('img').not('.active').animate({opacity: '0.2'});
                    $(gallery).find('img.active').animate({opacity: '1'});
                }
            }

            console_.log('prev: current viewing image', $(gallery).find('img.active'));
        },

        slideTo: function(img) {

            $(gallery).scrollTo(img, 500, portfolio.scrollToOptions);

            $(gallery).find('img').removeClass('active');
            $(img).addClass('active');

            if (portfolio.lightbox) {
                $(gallery).find('img').not('.active').animate({opacity: '0.4'});
                $(gallery).find('img.active').animate({opacity: '1'});
            }

        },

        spinner: {
            remove: function() {
                $(gallery).find('.spinner-container').remove();
            },

            show: function(width) {
                // Spinner
                portfolio.spinner.remove();

                var lastImg = $(gallery).find('img[loaded=true]').last();
                $(gallery).append('<span class="spinner-container"></span>');
                $(gallery).find('.spinner-container').css({
                    display: 'inline-block',
                    height: portfolio.height,
                    width: width,
                    'vertical-align': 'top',
	
                });

            }
        },

        loadNextImages: function(count) {
                // console_.log('loading...', totalLoaded, count, $(gallery).find(".photo img").slice(totalLoaded, totalLoaded + count));

            if (!imageLoadedCalled) {
                var nextImages;
                
                // load first few pictures - gallery init
                nextImages = $(gallery).find("img[loaded=false]").slice(0, count);
                $(nextImages).each(function(index) {
                    // current img element
                    var cur_img = this;

                    cur_img.src = $(cur_img).data('src');
                    $(cur_img).attr('loaded', 'loading');
                }); // each()

                // .imagesLoaded callback on images having src attribute but not loaded yet
                // on otherwords, filter only loading images
                $(nextImages).imagesLoaded(function($img_loaded){

                    console_.log('images loaded:');
                    console_.log($img_loaded);
                    $img_loaded.each(function(index) {
                        var img = this;			
						
                        // Inorder to fadeIn effect to work, make the new
                        // img element invisible by 'display: none'
                        $(img).css({display: 'none'});
						
					 	$(img).attr("onclick","showImage(id);");
								
						
						////////////////////////////////////
						
						
						
                        portfolio.spinner.remove();
                        $(img).fadeIn('slow');

                        img_width = $(img).width();

                        totalLoaded += 1;

                        $(img).data('width', img_width);
                        $(img).attr('loaded', 'true');

                    }); // each()

                    portfolio.spinner.show('100px');
                    imageLoadedCalled = false;

                    // loaded all images
                    if (totalLoaded === $(gallery).find('img').length) {
                        portfolio.spinner.remove();
                    }
                    else if (gallery[0].offsetWidth === gallery[0].scrollWidth) {
                        // if the first loaded images doesn't fill the
                        // offsetWidth of gallery then load some more images
                        portfolio.loadNextImages(6);
                    }

                }); // imagesLoaded()

                imageLoadedCalled = true;
            } // if(!imageLoadedCalled)

        }, // loadNextImages
        navigation: {
            show: function() {
                if (portfolio.navigation.created) {
                    // arrows already exists, do not create again
                    $('.gallery-arrow-left, .gallery-arrow-right').show();
                    $('.gallery-arrow-left, .gallery-arrow-right').delay(6000).fadeOut();
                }
                else {
                    // create arrows
                    $(gallery).before('<span class="gallery-arrow-left"></span>').after('<span class="gallery-arrow-right"></span>');
                    $(gallery).prev('.gallery-arrow-left').css({
                        position: 'absolute',
                        left: '8px',
                        height: portfolio.height,
                        width: '50px',
                        'z-index': '9999',
                        // inline image for arrow-left
                        background: "url(img/but_left.png) center left no-repeat",
                        'background-position': '8px',
                        opacity: '0.5',
						cursor:'pointer'
                    });
                    $(gallery).next('.gallery-arrow-right').css({
                        position: 'absolute',
                        right: '8px',
                        top: $(gallery).position().top,
                        height: portfolio.height,
                        width: '50px',
                        'z-index': '9999',
                        // inline image for arrow-right
                        background: "url(img/but_right.png) center left no-repeat",
                        'background-position': '8px',
                        opacity: '0.5',
						cursor:'pointer'
                    });

                    $(gallery).prev('.gallery-arrow-left').click(function(e) {
                        portfolio.prev();
						alert(portfolio());
                    });

                    $(gallery).next('.gallery-arrow-right').click(function(e) {
                        portfolio.next();
                    });

                    $('.gallery-arrow-left, .gallery-arrow-right').hover(function(){
                        // Mouse In
                        $(this).css({ 'opacity': '1' });
                    }, 
                    function() {
                        // Mouse Out
                        $(this).css({ 'opacity': '0.5' });
                    }); // hover()

                    $(gallery).mousemove(function(){
                        portfolio.navigation.show();
                    });

                    $('.gallery-arrow-left, .gallery-arrow-right').delay(6000).fadeOut();
                    portfolio.navigation.created = true;

                } // if.. else..
            }, // show() 

            hide: function() {
                $('.gallery-arrow-left, .gallery-arrow-right').fadeOut();
            }, // hide()
            created: false
        } // navigation
    }); // extend()

  

    // logger
    var console_ = {
        log: function() {
            if (this.active) {
                // var l = [];
                for (var i=0, len=arguments.length; i < len; i++) {
                    // l.push(arguments[i]);
                    console.log(arguments[i]);
                }
                // console.log(l.join(' '));
            }
        },
        active: portfolio.logger
    } // console_

    return this;
} // $.fn.portfolio

// TODO
// handle keyboard shortcuts in a smart way when multiple galleries are used

})(jQuery);
