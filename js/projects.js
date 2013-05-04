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
		$("#all_projects").isotope({ filter: filter });
	});
	$("#all_projects").on("click",".student_project", function(element) {
		/*
		if($($(element)[0].target).hasClass('img-showcase-crop'))
			openPic($($(element)[0].target));
		else
		*/
		window.open('http://'+window.location.host+'/project/'+$(this).attr('pid'),'_blank');
	}).on("mouseenter",".student_project", function(){
		$(this).addClass('highlight-project');
	}).on("mouseleave",".student_project", function(){
		$(this).removeClass('highlight-project');
	});
});

function getProjects() {
	$.getJSON('/data/projectsx', function(data) {
		$.each(data, function() {
			if(typeof(this.mems) !== "undefined") {
				if(this.mems.length ==1)
					this.student += "<br/>"+this.mems[0];
				else
					this.student += "<br/>and <span class='tooltip' title=\""+this.mems.join("&#013;")+"\">"+this.mems.length+" others</span>";
			}
				console.log(this.mems);
			var newdiv = "<div pid='"+this.id+"' class='student_project box box-link "+this.school+"'>";
			newdiv += "<div class='img-showcase-crop' style='background-image:url(\"http://whycooper.org/users/"+this.cuid+"/uploads/t/"+this.photo+"\");'></div>";
			newdiv += "<h4>"+this.title+"</h4></a>";
			newdiv += "<p>"+this.student+'</p>';
			$("#all_projects").append(newdiv+"</div>");
		});
		$("#all_projects").isotope(options);
	});
}

function openPic(test) {
	var url = $(test)[0].style.background.slice(4,-1);
	Messi.img(url);
}