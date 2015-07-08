$(document).ready(function() {

	$("#canvas").gridmanager({
		debug : 1
	});
	
	$("#input-700").fileinput({
		uploadUrl : "http://localhost/uploads/thumbnail/",
		maxFileCount : 1
	});

});

$(document).ready(function() {
	var gm = jQuery("#canvas").data('gridmanager');
	$(".save_btn").on("click", function(e) {
		gm.getContent();

	});
	//bite was here
	var cat_src = [];

	$.ajax({

		url : 'pages/query_category.php',
		dataType : 'json',

		success : function(data) {

			for ( i = 0; i < data.length; i++) {

				var cat_obj = {};
				cat_obj["value"] = data[i]['cat_id'];
				cat_obj["text"] = data[i]['cat_name'];

				cat_src.push(cat_obj);

			}

			console.log(cat_src);

		}
	});

	$(function() {
		$.fn.editable.defaults.mode = 'inline';

		$('.name').editable({});
		$('.status').editable({

			source : [{
				text : 'draft',
				value : 'draft'
			}, {
				value : 'future',
				text : 'future'
			}, {
				value : 'pending',
				text : 'pending'
			}, {
				value : 'private',
				text : 'private'
			}, {
				value : 'published',
				text : 'published'
			}, {
				value : 'trash',
				text : 'trash'
			}]

		});

		$('.category').editable({

			source : cat_src

		});

	});

});
