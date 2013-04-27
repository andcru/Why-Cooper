$(document).ready(function() {
	$("#li_upload").click(showFileUpload);
	$("#li_select").click(showFileSelect);
	$("#li_video").click(showFileVideo);
	$('form#ul').ajaxForm(function(msg) {
		insertConfig(msg);
	});
});

var path;
var w;
var h;

function selectFile() {
	insertConfig($(this).attr('id'));
}

function insertConfig(inp) {
	showFileUpload();
	$("#uploadfile").hide();
	$("#fileinsert").show();
	path = inp.split(",");
	if(path.length > 0) {
		var file = path[0].split(".");
		var win = window.location.toString().split("/");
		var file = win[win.length-1];
		if(file == 'uploadimagex') 
			imgInsertConfig(inp);
		else 
			fileInsertConfig(inp);
	}
	else
		alert(inp);
}

function fileInsertConfig(inp) {
	var file = path[0].substr(path[0].indexOf("uploads/")+8);
	var split = file.split(".");
	var html = "<p>File Label: <input type='text' value='"+split[0]+"' id='name'></p>";
	if(split[1] == 'pdf') {
		html += "<p>Embed PDF? <input type='checkbox' id='pdf'></p>";
	}
	html += "<p><input type='button' value='Insert' id='insert'></p>";
	$("#fileinsert").html(html);
	$("#insert").click(function() {
		var title = $("#name").val();
		var src = path[0];
		if($("#pdf").attr('checked') == 'checked')
			var html = "<object data='/pages/"+src+"' type='application/pdf' width='100%' height='400px'>"; 
		else
			var html = "<a href='/pages/"+src+"'>"+title+"</a>";
		tinyMCE.activeEditor.selection.setContent(html);
		tinyMCEPopup.close();
	});
}

function imgInsertConfig(inp) {
	var width = 500; // in pixels
	path = inp.split(",");
	var file = path[0].split("uploads/");
	var split = file[1].split(".");
	var thumb = file[0]+"uploads/t/"+file[1];
	w = path[1];
	h = path[2];
	var scaleinit = Math.round(width/w*100);

	var html = "<table><tr><td><p>File Label: <input type='text' value='"+split[0]+"' id='name'></p>";
	html += "<p>Image Scale: <input style='width:35px' type='text' value='"+scaleinit+"' id='scale'>%</p>";
	html += "<p style='display:inline'>Image Size: (<div style='display:inline' id='imagesize'></div>) pixels</p>";
	html += "<p><input type='button' value='Insert' id='insert'></p><td>";
	html += "<td><img src='/users/"+thumb+"'></td></tr></table>";
	$("#fileinsert").html(html);
	w = Math.round(scaleinit*path[1]/100);
	h = Math.round(scaleinit*path[2]/100);
	$("#imagesize").html(w+" x "+h);

	$("#scale").keyup(function() {
		var scale = $(this).val();
		w = Math.round(scale*path[1]/100);
		h = Math.round(scale*path[2]/100);
		$("#imagesize").html(w+" x "+h);
	});
	$("#insert").click(function() {
		var title = $("#name").val();
		var src = path[0];
		var html = "<img title='"+title+"' src='/users/"+src+"' class='float_left' width='"+w+"' height='"+h+"'>";
		var ed = tinyMCEPopup.editor;  
		tinyMCE.activeEditor.selection.setContent(html);
		tinyMCEPopup.close();
	});

}

function videoInsertConfig() {
	var html = "<p>Video URL: <input type='text' id='name' style='width:400px'></p>";
	html += "<p><input type='button' value='Insert' id='insert'></p>";
	$("#fileinsert").html(html);
	$("#insert").click(function() {
		var title = $("#name").val();
		var vid = getURLParameter('v',title);
		if(vid=='null' && title.indexOf('youtu.be') > 0) {
			var slash = title.lastIndexOf('/');
			var vid = title.substring(slash+1);
		}
		if(vid=='null')
			alert('You must supply a valid YouTube URL.');
		else {
			var html = '<iframe width="425" height="240px" src="http://www.youtube.com/embed/'+vid+'" frameborder="0" allowfullscreen></iframe>';
			tinyMCE.activeEditor.selection.setContent(html);
			tinyMCEPopup.close();
		}
	});
}

function showFileVideo() {
	$("#selectfile").hide();
	$("#uploadfile").hide();
	$("#fileinsert").show();
	videoInsertConfig();
}

function showFileUpload() {
	$("#selectfile").hide();
	$("#fileinsert").hide();
	$("#uploadfile").show();
}

function showFileSelect() {
	$("#uploadfile").hide();
	$("#fileinsert").hide();
	$.ajax({
  		url: "/admin/uploadsx",
		}).done(function (data) {
			$("#selectfile").html(data);
			$("tr.imgselect").click(selectFile);
			$("#selectfile").show();
	});
}

function getURLParameter(name,title) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(title)||[,null])[1]
    );
}

function dump(arr,level) {
	var dumped_text = "";
	if(!level) level = 0;
	
	//The padding given at the beginning of the line.
	var level_padding = "";
	for(var j=0;j<level+1;j++) level_padding += "    ";
	
	if(typeof(arr) == 'object') { //Array/Hashes/Objects 
		for(var item in arr) {
			var value = arr[item];
			
			if(typeof(value) == 'object') { //If it is an array,
				dumped_text += level_padding + "'" + item + "' ...\n";
				dumped_text += dump(value,level+1);
			} else {
				dumped_text += level_padding + "'" + item + "' => \"" + value + "\"\n";
			}
		}
	} else { //Stings/Chars/Numbers etc.
		dumped_text = "===>"+arr+"<===("+typeof(arr)+")";
	}
	return dumped_text;
}