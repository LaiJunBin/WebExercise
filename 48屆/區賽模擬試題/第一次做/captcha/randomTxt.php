<?php

	$arr =Array();




	function getTxt($min,$max){
		global $arr;
		for($i=$min ; $i<=$max;$i++){
			array_push($arr,chr($i));	
		}

	}
	getTxt(48,57);
	getTxt(65,90);
	getTxt(97,122);
	
	echo $arr[mt_rand(0,count($arr)-1)];

?>