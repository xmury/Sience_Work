<?php
function search($pole, $N){
    
    for ($x = 0; $x < $N; $x++){
        $null  = 0;
        $tire  = 0;
        $krest = 0;

        for ($y = 0; $y < $N; $y++){
            switch ($pole[x][y]){
                case '-':   $tire++ ; break;
                case '0':   $null++ ; break;
                case 'X':   $krest++; break;
            }   

            if ($tire == 2 || $null == 2 || $krest == 2){
                $y = 0; if ($pole[$x][$y] == '-'){ return 1, array($x,$y)}
                $y = 1; if ($pole[$x][$y] == '-'){ return 1, array($x,$y)}
                $y = 2; if ($pole[$x][$y] == '-'){ return 1, array($x,$y)}
            }
        }

    }

    

}


function art_in_1($pole){
    $sign = '0';



}

?>