<?php

function art_in($pole , $N){
    // В случайное место тыкнуть
    $back = $pole;

    while (true){
        $x = random_int(0 , 2);
        $y = random_int(0 , 2);
            
        $xy = ['x' => $x, 
               'y' => $y];        
        
        if ($pole[$x][$y] == '-') { return $xy; }
    }    
}
?>