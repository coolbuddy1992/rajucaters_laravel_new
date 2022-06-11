$(document).ready(function(){

var current_fs, next_fs, previous_fs; //fieldsets
var opacity;
var current = 1;
var steps = $("fieldset").length;

setProgressBar(current);

//$(".menu_stepform").eq($("fieldset").index(current_fs)).addClass("active");
$("#progressbar li").first().addClass("active");
$(".menu_stepform").first().addClass("active");


$(".next").click(function(){

	current_fs = $(this).parent();
	next_fs = $(this).parent().next();
	previous_fs = $(this).parent().prev();
	
	//Add Class Active
	$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
	$("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("finish");
	$("#progressbar li").eq($("fieldset").index(current_fs)).addClass("finish");
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
	
	$(".menu_stepform").eq($("fieldset").index(next_fs)).addClass("active");
	$(".menu_stepform").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the next fieldset
	next_fs.show();
	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			next_fs.css({'opacity': opacity});
		},
		duration: 500
	});
	
	setProgressBar(++current);
});

$(".previous").click(function(){

	current_fs = $(this).parent();
	previous_fs = $(this).parent().prev();

	$("#progressbar li").eq($("fieldset").index(previous_fs)).addClass("active");
	//Remove class active
	$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

	$(".menu_stepform").eq($("fieldset").index(previous_fs)).addClass("active");
	$(".menu_stepform").eq($("fieldset").index(current_fs)).removeClass("active");

	//show the previous fieldset
	previous_fs.show();

	//hide the current fieldset with style
	current_fs.animate({opacity: 0}, {
		step: function(now) {
			// for making fielset appear animation
			opacity = 1 - now;

			current_fs.css({
				'display': 'none',
				'position': 'relative'
			});
			previous_fs.css({'opacity': opacity});
		},
		duration: 500
	});
	setProgressBar(--current);
});

function setProgressBar(curStep){

	if ( curStep == 0 || curStep == 1) {
	 	$(".previous").addClass("hide");
	} else {
		$(".previous").removeClass("hide");
	}
	
	var percent = parseFloat(100 / steps) * curStep;

	percent = percent.toFixed();
	$(".progress-bar")
		.css("width",percent+"%")
	}

	$(".submit").click(function(){
		return false;
	})

});