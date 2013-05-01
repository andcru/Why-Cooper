var options = {	
		itemSelector: '.student_project',
		animationEngine: 'best-available',
		animationOptions: {
	    	duration: 750,
	    	easing: 'linear',
	    	queue: false
		}};
$(document).ready(function() {

	$('#imgslider').anythingSlider({
	    theme               : "minimalist-round", // Theme name
	    buildArrows         : false,      // If true, builds the forwards and backwards buttons
	    buildStartStop      : false,      // If true, builds the start/stop button and adds slideshow functionality
	    hashTags            : false,      // Should links change the hashtag in the URL?
	    autoPlay            : true,     // If true, the slideshow will start running; replaces "startStopped" option
	    autoPlayLocked      : true,     // If true, user changing slides will not stop the slideshow
	    delay               : 4000,      // How long between slideshow transitions in AutoPlay mode (in milliseconds)
	    resumeDelay         : 4000,     // Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds).
	    animationTime       : 500,       // How long the slideshow transition takes (in milliseconds)
	    navigationFormatter : function(i,p){ return p.attr('data-title'); }
   	});

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