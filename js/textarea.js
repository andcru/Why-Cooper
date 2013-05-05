$(document).ready(function() {
	loadMCE();
});

function loadMCE() {
	$('textarea:not(.plain)').tinymce({
		// Location of TinyMCE script
		script_url : '/js/tiny_mce/tiny_mce.js',
		inlinepopups_skin : 'ribbon_popup',
		force_br_newlines : true,
        force_p_newlines : false,

		// General options
		theme : "ribbon",
		plugins : "filein,autolink,lists,pagebreak,table,advhr,advimage,advlink,iespell,preview,contextmenu,paste,directionality,fullscreen,visualchars,nonbreaking,xhtmlxtras,tabfocus,advimagescale,loremipsum,image_tools,tableextras,style,table,inlinepopups,searchreplace,contextmenu,paste,wordcount,advlist,autosave",
		//plugins : 'filein,tabfocus,advimagescale,loremipsum,image_tools,embed,tableextras,style,table,inlinepopups,searchreplace,contextmenu,paste,wordcount,advlist,autosave',
		// Theme options
		
		// Example content CSS (should be your site CSS)
		content_css : "/css/main.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		external_media_list_url : "lists/media_list.js",
	}).css('width','700px').css('height','20em');
}

var iframe = document.getElementById('page-ifr');

// create a string to use as a new document object
var val = '<script src="//use.typekit.net/xcq2zay.js"></script>';
	val +='<script>try{Typekit.load();}catch(e){}</script>';

// get a handle on the <iframe>d document (in a cross-browser way)
var doc = iframe.contentWindow || iframe.contentDocument;
if (doc.document) { doc = doc.document;}

// open, write content to, and close the document
doc.open();
doc.write(val);
doc.close();