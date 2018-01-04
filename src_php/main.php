<?php
include 'art_ins.php';
function revizor($pole, $N){
    $tik = 0;
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            if ($pole[x][y] != '-'){ $tik++; }
        }
    }

    if ($tik == 0){ return 0; }
    
    else {
        for ($x = 0; $x < $N; $x++) {
            $null = 0; $krest = 0;
            
            for ($y = 0; $y < $N; $y++) {
                switch ($pole[x][y]) {
                    case 'X': $krest++ ; break;
                    case '0': $null++  ; break;
                }
            }

    if ($null == $N)  { return 1;}
    if ($krest == $N) { return 2;}    
        }
        for ($i = 0; $i < 2; $i++){
            $null = 0; $krest = 0;

            switch ($i) {   // Какую диагональ проверять?
                case 0: $y = 0; $x = 0; break;        
                case 1: $y = 0; $x = 2; break;
            }
            
            while (true) {
                switch ($pole[x][y]) {
                    case '-': $t = [x, y]; break;
                    case '0': $null++; break;
                    case 'X': $krest++; break;
                }

        if ($null == $N)  { return 1;}
        if ($krest == $N) { return 2;}

                switch ($i) {   // Какую диагональ проверять?
                    case 0:
                        $y++; $x++;
                        if ($x > 2) { break;}
                        break;

                    case 1:
                        $y++; $x--;
                        if ($x > 2) { break; }
                        break;
                }
            }
        }
    }
    return 0;
}

function printer($pole, $N){
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            echo $pole[$x][$y], ' | ';
        }
        echo PHP_EOL;
    }
}
function generator($N){
    $pole = array(array());
    for ($x = 0; $x < $N; $x++){
        for ($y = 0; $y < $N; $y++){
            $pole[$x][$y] = '-'; 
        }
    }

    return $pole;
}
function poligon(){
    $pole = generator(3);
    $N = 3;
    $q = 0;
    while($q < 1){
        time_nanosleep(1, 0);
        system('clear');
        printer($pole, 3);

        art_in_1($pole, $N);
        if (revizor($pole, $N) == 1) {
            echo "First AI winner!", PHP_EOL;
            break;
        }
        art_in_2($pole, $N);
        if (revizor($pole, $N) == 2) {
            echo "Second AI winner!", PHP_EOL;
            break;
        }
        $q++;
    }
}

poligon();
?>