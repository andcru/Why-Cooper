$(document).ready(function() {
	getHeadings();
	$("#editpage").submit(function (){
		if(!$("#heading").select2("val")) {
			alert('You must select a parent for this page.');
			return false;
		}
		if(!$("#title").val()) {
			alert('You must enter a page title.');
			return false;
		}
	});
	$("a.button.delete").click(function(event) {
		event.preventDefault();
		var conf = confirm('Are you sure you want to delete this page?');
		if(conf == true) {
			window.location.href = $(this).attr('href');
		}
	});
	$(".ord").click(function() {
		alert($(this).attr('id'));
	});
	
});

function getHeadings() {
	if($("#heading").length != 0) {
		$.getJSON("/admin/headingx",function(data){
			var selectthis = 0;
			$("#heading").append("<option></option>")
			$.each(data, function(){
				if(this.sel){
					if(this.parent)
						selectthis = "p"+this.id;
					else
						selectthis = this.id;
				}
				if(!this.parent){
					$("#heading").append($("<option />").val(this.id).text(this.name));
				}
				else{
					$("#heading").append($("<option />").val("p"+this.id).text(this.name).addClass("select2-option-subpage"));

				}
			});
			if(selectthis) 
				$("#heading").select2("val",selectthis);
			else 
				$("#heading").select2("val","")
		});
	}
}

function getSubHeadings() {
	var par = $("#heading").val();
	$("#parent").find('option').remove();
	if(par>0) {
		$.getJSON("/admin/headingx", {s: par}, function(data){
			console.log(data);
			$.each(data, function(){
				if(this.sel == 1)
					$("#parent").append($("<option />").val(this.id).text(this.name).attr('selected','selected'));
				else
					$("#parent").append($("<option />").val(this.id).text(this.name));
			});
			if(data.length>1) {
				$("#dparent").show();
			}
			else {
				$("#dparent").hide();
			}
		});
	}
	else {
		$("#parent").find('option').remove();
		$("#dparent").hide();
	}
}