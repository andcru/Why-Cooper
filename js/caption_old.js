$(document).ready(function() {
	$(".normal").find('img').each(function() {
		$(this).load(function() {
			if(!$(this).parent().hasClass('imgdiv')) {
				var capt = $("<div>").attr('class','imgcapt').html($(this).attr('alt'));
				var imgdiv = $("<div>").attr('class','imgdiv '+$(this).attr('class')).attr('style',"width:"+$(this).width()+"px");
				$(this).attr('class','nopadding');
				$(this).clone().appendTo(imgdiv);
				if($(this).attr('alt'))
					$(imgdiv).append(capt);
				$(this).replaceWith(imgdiv);
			}
		});
	});
	$("input.prettybutton").click(function(event) {
		event.preventDefault();
		ifrc = $("iframe").contents();
		$(ifrc).find('div.imgdiv').each(function() {
			img = $(this).find("img");
			$(img).attr('class',$(this).attr("class").replace("imgdiv ",""));
			$(img).attr('alt',$(this).find("div.imgcapt").text());
			$(this).replaceWith(img);
		});
		$("iframe").contents().replaceWith(ifrc);
		$("form").submit();
	});
});
