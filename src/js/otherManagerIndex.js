

$(document).ready(function(){
	$("#tip1").hide();
	$("#tip2").hide();
	$("#tip3").hide();
	$("#tip4").hide();
	$("#tip5").hide();

	$("#addactivity").mouseenter(function(){
		$("#tip1").show();
	})

	$("#addactivity").mouseleave(function(){
		$("#tip1").hide();
	})

	$("#deleteactivity").mouseenter(function(){
		$("#tip2").show();
	})

	$("#deleteactivity").mouseleave(function(){
		$("#tip2").hide();
	})

	$("#signintable").mouseenter(function(){
		$("#tip3").show();
	})

	$("#signintable").mouseleave(function(){
		$("#tip3").hide();
	})

	$("#asactivity").mouseenter(function(){
		$("#tip4").show();
	})

	$("#asactivity").mouseleave(function(){
		$("#tip4").hide();
	})

	$("#asstudent").mouseenter(function(){
		$("#tip5").show();
	})

	$("#asstudent").mouseleave(function(){
		$("#tip5").hide();
	})


})