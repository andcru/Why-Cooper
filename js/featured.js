var options = {	
		itemSelector: '.featured',
		animationEngine: 'best-available',
		animationOptions: {
	    	duration: 750,
	    	easing: 'linear',
	    	queue: false
		}};
$(document).ready(function() {
	getFeatured();
	$("#type_selects").on("click","li", function() {
		var buff = [];
		$('.sel_type:checked').each(function(){
			buff.push("."+$(this).val());
		})
		var filter = buff.length ? buff.join(', ') : ".nothing";
		$("#all_featured").isotope({ filter: filter });
	});
});

function getFeatured() {
	$.getJSON('/data/featuredx', function(data) {
		console.log(data);
		$.each(data.news, function() {
			var url,col;
			if(typeof(this.link) !== "undefined") {
				url = makeURL(this.link);
				col = 'News';
			}
			else {
				url = 'https://jac.cooper.edu/advert/'+this.req_id;
				this.title += this.club;
				col = 'Events';
			}
			var newdiv = "<div pid='"+this.id+"' class='featured box box-thin "+ col + " " + this.featured +"'>";
			newdiv += "<h2>"+this.title+"</h2></a>";
			newdiv += "<p class='trunc feat-body'>"+this.preview+"</p>";
			newdiv += "<p class='feat-datelink'>"+this.pub_date+" | <a href=\"" + url + "\">More Info</a></p>";
			$("#all_featured").append(newdiv+"</div>");
			console.log(this);
		});
		$.each(data.alumni, function() {
			$("ul.alumni").append('<li><a class="alumniName" href="'+makeURL(this.link)+'">'+this.name+'</a> - <span> '+this.description+'</span></li>');
		});
		$(".trunc").dotdotdot();
		$("#all_featured").isotope(options);
	});
}

function makeURL(url) {
	var hl = url.substr(0,4) == 'http' ? url : 'http://'+url;
	return hl;
}