<?php

function asList(array $list, $limit=0, $maxlimit=5):void{
    if($limit>$maxlimit){
        return;
    }
    echo "<ul>";
    foreach($list as $key=>$field){
        if(is_array($field)){
            echo "<li><strong>{$key}</strong>";
            asList($field, $limit+1, $maxlimit);
            echo "</li>\n";
        }else{
            echo "<li><strong>{$key}</strong> <span>{$field}</span></li>\n";
        }
    }
    
    echo "</ul>";
}
