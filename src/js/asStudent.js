

$(document).ready(function(){
	$("#name").focus(function(){
		$("#forname").hide();
	})

	$("#name").blur(function(){
		var text=$("#name").val();
		if(text!="") $("#forname").hide();
		else  $("#forname").show();
	})

	$("#grade").change(function(){
		var text=$("#grade option:selected").text();
		if(text!="") 	$("#forgrade").hide();
		else $("#forgrade").show();
	})

	$("#class").change(function(){
		var text=$("#class option:selected").text();
		if(text!="") 	$("#forclass").hide();
		else $("#forclass").show();
	})
})