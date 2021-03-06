var options = {	
		itemSelector: '.student_project',
		animationEngine: 'best-available',
		animationOptions: {
	    	duration: 750,
	    	easing: 'linear',
	    	queue: false
		}};
$(document).ready(function() {
	getProjects();
	$("#school_selects").on("click",".sel_school", function() {
		var buff = [];
		$('.sel_school:checked').each(function(){
			buff.push("."+$(this).val());
		})
		var filter = buff.length ? buff.join(', ') : ".nothing";
		console.log(buff);
		$("#all_projects").isotope({ filter: filter });
	});
});

function getProjects() {
	$.getJSON('/data/showcasex', function(data) {
		$.each(data, function() {
			var newdiv = "<div class='student_project "+this.school+"'><h4>"+this.title+"</h4></div>";
			$("#all_projects").append(newdiv);
		});
		$("#all_projects").isotope(options);
	});
}