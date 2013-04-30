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
});
