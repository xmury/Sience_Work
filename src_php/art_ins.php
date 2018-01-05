<?php
include "search.php";

function art_in($pole , $N, $sign){
    $box = search($pole , $N);
                                                                                echo gettype($box), PHP_EOL;
    if (gettype($box) == 'NULL'){               // В случайное место тыкнуть
        while (true){
            $x = random_int(0,2);
            $y = random_int(0, 2);
            
            if ($pole[$x][$y] == '-') {
                $pole[$x][$y] = $sign;
                return $pole;
            }
        }
    }
    
    if (gettype($box) == 'array') { 
        $pole[$box[0]][$box[1]] = $sign;
        return $pole;
    }  
}
?>