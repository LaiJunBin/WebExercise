// JavaScript Document
$(function(){
	document.title = $(".container>header").text();
	$(".fill,button").button();
	$("input[type!=radio],textarea").addClass('input');
	$(".btnSet button").addClass('ui-controlgroup-item').removeClass('ui-widget');
});