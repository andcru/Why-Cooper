$(document).ready(function() {
	loadMCE();
});

function loadMCE() {
	$('textarea').tinymce({
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
		content_css : "/css/project.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		external_media_list_url : "lists/media_list.js",
	}).css('width','100%').css('height','20em');
}