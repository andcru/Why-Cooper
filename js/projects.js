var options = {	
		itemSelector: '.student_project',
		animationEngine: 'best-available',
		animationOptions: {
	    	duration: 750,
	    	easing: 'linear',
	    	queue: false
		},
		filter: ".First"
	};
$(document).ready(function() {
	getProjects();
	$("#school_selects").on("click",".sel_school", function() {
		var buff = [];
		$('.sel_school:checked').each(function(){
			buff.push("."+$(this).val());
		})
		var filter = buff.length ? buff.join(', ') : ".nothing";
		$("#all_projects").isotope({ filter: filter });
		$(".readmore").hide();
	});
	$("#all_projects").on("click",".student_project", function(element) {
		window.open('http://'+window.location.host+'/project/'+$(this).attr('pid')+'/'+$(this).find('h4').text().split(' ').join('_'),'_blank');
	}).on("mouseenter",".student_project", function(){
		$(this).addClass('highlight-project');
	}).on("mouseleave",".student_project", function(){
		$(this).removeClass('highlight-project');
	});
	$(".readmore").on('click', function() {
		$(this).hide();
		$("#all_projects").isotope({ filter: ".student_project" });
	});
});

function getProjects() {
	$.getJSON('/data/projectsx', function(data) {
		var sch = {}, cnt = 0, text = "First", limit = 10;
		$.each(data, function() {
			text = (cnt++ < limit) ? text : "";
			if(typeof(this.mems) !== "undefined")
				if(this.mems.length ==1)
					this.student += "<br/>"+this.mems[0];
				else
					this.student += "<br/>and <span class='tooltip' title=\""+this.mems.join("&#013;")+"\">"+this.mems.length+" others</span>";
			sch[this.school[0].split(" ")[this.school[0].split(" ").length-1]] = ++sch[this.school[0].split(" ")[this.school[0].split(" ").length-1]] || 1;
			var newdiv = "<div pid='"+this.id+"' class='student_project box box-link "+this.school.join(" ")+" "+text+"'>";
			newdiv += "<div class='img-showcase-crop' style='background-image:url(\"http://whycooper.org/users/"+this.cuid+"/uploads/t/"+this.photo+"\");'></div>";
			newdiv += "<h4>"+this.title+"</h4></a>";
			newdiv += "<p>"+this.student+'</p>';
			$("#all_projects").append(newdiv+"</div>");
		});
		$.each(sch, function(k,v) {
			console.log($("label[for='"+$('.sel_school[value="'+k+'"]').attr('id')+"']").append("("+v+")"));
		});
		$("#all_projects").isotope(options);
	});
}

function openPic(test) {
	var url = $(test)[0].style.background.slice(4,-1);
	Messi.img(url);
}