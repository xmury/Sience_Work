<?php
function poligon(){
    pole = array(array());
    for ($x = 0; $x < $N; $x++){
        for ($y = 0; $y < $N; $y++){
            $pole[$x][$y] = '-'; 
        }
    }

    for ($x = 0; $x < $N; $x++){
        for ($y = 0; $y < $N; $y++){
            echo $pole[$x][$y] , ' | '; 
        }
        echo '\n';
    }
}
?>