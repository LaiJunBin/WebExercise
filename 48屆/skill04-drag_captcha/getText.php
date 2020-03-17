<?php
    
    
    
    $charSet = [];
    fillArray(48,57);
    fillArray(65,90);
    fillArray(97,122);

    function fillArray($min,$max){
        global $charSet;
        for($i = $min ; $i<=$max ; $i++){
            $charSet[count($charSet)] = chr($i);
        }
    }

    echo $charSet[mt_rand(0,count($charSet)-1)];
?>