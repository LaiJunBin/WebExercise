$(function(){
	document.title = $(".container>header").text();
	$("button,.fill").button();
	$("table").attr('align','center');
	$("input[type!=radio]").addClass('input');
	$(".btnset").buttonset();
});