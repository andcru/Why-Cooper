var options = {	
		itemSelector: '.experience',
		animationEngine: 'best-available',
		animationOptions: {
	    	duration: 750,
	    	easing: 'linear',
	    	queue: false
		}};
$(document).ready(function() {
	getFeatured();
});

function getFeatured() {
	$.getJSON('/data/experiencesx', function(data) {
		$.each(data, function() {
			var newdiv = "<div eid='"+this.id+"' class='experience box box-short'>";
			newdiv += "<p>\""+this.experience+"\"</p>";
			newdiv += "<div class='pull-right text-right'><h2>&#8212; "+this.student+"</h2>";
			newdiv += "<p class='hl-blue'>"+this.class+"</p></div>";
			$("#all_experiences").append(newdiv+"</div>");
		});
		$("#all_experiences").isotope(options);
	});
}
