/* http://blog.bassta.bg/2013/05/smooth-page-scrolling-with-tweenmax/ */

$(function(){
	
	var $window = $(".items-wrapper");		//Window object
	
	var scrollTime = 1.2;			//Scroll time
	var scrollDistance =320;		//Distance. Use smaller value for shorter scroll and greater value for longer scroll
		
	$window.on("mousewheel DOMMouseScroll", function(event){
		 $window.animate({ scrollLeft: finalScroll }, 320);
  
		event.preventDefault();	
										
		var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
		var scrollLeft = $window.scrollLeft();
		var finalScroll = scrollLeft - parseInt(delta*scrollDistance);
			
		TweenMax.to($window, scrollTime, {
			scrollTo : { x: finalScroll, autoKill:true },
				ease: Power1.easeOut,	//For more easing functions see http://api.greensock.com/js/com/greensock/easing/package-detail.html
				autoKill: true,
				overwrite: 5							
			});
		
	});
	
});