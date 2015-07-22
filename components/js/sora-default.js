function toggle_visibility(id) {

	var e = document.getElementById(id);
	if (e.style.display == 'block' || e.style.display=='') {
		e.style.display = 'none';
		e.style.height = '0px';
		document.getElementById('video_btn').src = "/components/img/down-btn.png";
	}
	else {
	e.style.display = 'block';
	e.style.height = '403px';
	document.getElementById('video_btn').src = "/components/img/up-btn.png";	
	 
	}
}



