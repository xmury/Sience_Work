<?php
function search($pole, $N){
    
    for ($x = 0; $x < $N; $x++){
        
        $null  = 0; $krest = 0;
        for ($y = 0; $y < $N; $y++){
            switch ($pole[x][y]){
                case '-':   $t = [x,y] ; break;
                case '0':   $null++ ; break;
                case 'X':   $krest++; break;
            }   

            if ($null == 2 || $krest == 2){
                return $t;
            }
        }

    }

    for ($i = 0; $i < 2; $i++){
        $null = 0; $krest = 0;

        switch ($i) {   // Какую диагональ проверять?
            case 0:
                $y = 0; $x = 0;
                break;        
            case 1:
                $y = 0; $x = 2;
                break;
        }

        $q = true;
        while ($q){
            switch ($pole[x][y]){
                case '-':   $t = [x,y]; break;
                case '0':   $null++ ; break;
                case 'X':   $krest++; break;
            }

            if ($null == 2 || $krest == 2) {
                return $t;
            }

            switch ($i) {   // Какую диагональ проверять?
                case 0:
                    $y++; $x++; 
                    if ($x > 2) { break; }
                    break;
                
                case 1:
                    $y++; $x--; 
                    if ($x > 2) { break; }
                    break;
            }
        }
    }
    return NULL;
}


function art_in_1($pole){
    $sign = '0';

    $box = search();
    if (gettype($value) == 'NULL'){
        while (true){
            $x = random_int(0,2);
            $y = random_int(0, 2);

            if (pole[x][y] == '-'){
                $pole[x][y] = $sign; break;
            }
        }
    }
    else{
        $pole[$box[0]][$box[1]] = $sign;
    }

}

function art_in_2($pole)
{
    $sign = 'X';

    $box = search();
    if (gettype($value) == 'NULL') {
        while (true) {
            $x = random_int(0, 2);
            $y = random_int(0, 2);

            if (pole[x][y] == '-') {
                $pole[x][y] = $sign;
                break;
            }
        }
    } else {
        $pole[$box[0]][$box[1]] = $sign;
    }

}
?>