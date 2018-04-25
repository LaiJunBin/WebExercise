// JavaScript Document
$(function(){
	document.title = $(".container>header").text();
	$(".fill,button").button().removeClass('ui-widget');
	$("input[type!=radio],textarea").addClass('input');
	$(".btnSet button").addClass('ui-controlgroup-item');
});