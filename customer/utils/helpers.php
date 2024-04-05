<?php 

function reduce_fullname($fullName)
{
    $names = explode(" ",$fullName);
    if(count($names)>2){
        return $names[0]." ". ($names[count($names)-1]);
    }
}

?>