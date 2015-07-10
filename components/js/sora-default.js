function toggle_visibility(id) {

	var e = document.getElementById(id);
	if (e.style.display == 'block' || e.style.display=='') {
		e.style.display = 'none';
		e.style.height = '0px';
		document.getElementById('video_btn').src = "components/img/down-btn.png";
	}
	else {
	e.style.display = 'block';
	e.style.height = '403px';
	document.getElementById('video_btn').src = "components/img/up-btn.png";	
	 var swiper2 = new Swiper('.swiper2', {
  
        
        slidesPerView: 'auto',
        centeredSlides: false,
        spaceBetween: 0,
        grabCursor: false,

        nextButton: '.swiper-button-next2',
        prevButton: '.swiper-button-prev2'

    });

	
	
	
	}
}



function logo_mousein(id) {
	var e = document.getElementById(id);
	e.src = "components/img/icon/"+e.id+"-type1.png";
}
function logo_mouseout(id) {
	var e = document.getElementById(id);
	e.src = "components/img/icon/"+e.id+"-type2.png";
}
