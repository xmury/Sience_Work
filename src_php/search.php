<?php
function search_lines($pole, $N){
    for ($x = 0; $x < $N; $x++){
        $step_v = 0; $step_g = 0; $t_v = true; $t_g = true;
        
        for ($y = 0; $y < $N; $y++){
            if ($pole[$x][$y] == '-'){
                $step_g++;
                $t_g = [$x , $y];
            }

            if ($pole[$y][$x] == '-') {
                $step_v++;
                $t_v = [$x , $y];
            }
        }

        if ($step_v == 1) { return $t_v  ; }
        if ($step_g == 1) { return $t_g  ; }
    }
    
    return NULL;
}

function search_diagonals($pole, $N){
    // .-'
    for ($x = 2; $x >= 0; $x--){
        $step = 0; $t = true;
        
        for ($y = 0; $y < $N; $y++){
            if ($pole[$x][$y] == '-'){
                $step++; $t = [$x , $y];
            }
        }

        if ($step == 1) { return $t; }
    }
    // .-'

    // '-.
    for ($x = 0; $x < $N; $x++) {
        $step = 0; $t = true;
        
        for ($y = 0; $y < $N; $y++) {
            if ($pole[$x][$y] == '-') {
                $step++; $t = [$x, $y];
            }
        }

        if ($step == 1) { return $t; }
    }
    // '-.
}

function search($pole, $N)
{
    $box = search_lines($pole, $N);
    if (gettype($box) == 'NULL'){
        $box = search_diagonals($pole, $N);
        if (gettype($box) == 'NULL'){
            return NULL;
        }    
    }
    return $box;
}
?>