$(document).ready(function() {
	$("#team_members").on('click','.addrow', function() {
		var id = $("#team_members tr").length;
		$("#team_members").append("<tr><td><input type='hidden' id='cuid_"+id+"' name='cuid_"+id+"'></td><td><input type='text' id='member_"+id+"' class='query'></td><td><img src='/img/minus.png' class='delrow'></td>");
		loadStudPicker();
	}).on('click','.delrow', function() {
		$(this).parent().parent().remove();
	});
});