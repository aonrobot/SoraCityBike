function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block' || e.style.display=='') {
    	e.style.display = 'none';
    	
    }
    else e.style.display = 'block';
}

function logo_mousein(id) {
    var e = document.getElementById(id);
    e.src = "img/icon/"+e.id+"-type1.png";
}
function logo_mouseout(id) {
    var e = document.getElementById(id);
    e.src = "img/icon/"+e.id+"-type2.png";
}
