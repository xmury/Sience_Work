<?php

function art_in($pole , $N, $sign){
    // В случайное место тыкнуть
    while (true){
        $x = random_int(0,2);
        $y = random_int(0, 2);
        
        if ($pole[$x][$y] == '-') {
            $pole[$x][$y] = $sign;
            return $pole;
        }
    }    
}
?>