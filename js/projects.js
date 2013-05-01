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
	$("#all_projects").on("click",".student_project", function() {
		window.location = '/project/'+$(this).attr('pid');
	});
});

function getProjects() {
	$.getJSON('/data/projectsx', function(data) {
		$.each(data, function() {
			var newdiv = "<div pid='"+this.id+"' class='student_project "+this.school+"'>";
			newdiv += "<div class='img-showcase-crop' style='background-image:url(\"http://whycooper.org/users/"+this.cuid+"/uploads/t/"+this.photo+"\");'></div>";
			newdiv += "<h4>"+this.title+"</h4></a>";
			newdiv += "<p>by "+this.student+"</p>";
			$("#all_projects").append(newdiv+"</div>");
			console.log(this);
		});
		$("#all_projects").isotope(options);
	});
}