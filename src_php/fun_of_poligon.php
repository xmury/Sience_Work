<?php
function revizor($pole, $N){
    // Победа линии
    for ($x = 0; $x < $N; $x++) {
        $null_v = 0;    $krest_v = 0;
        $null_g = 0;    $krest_g = 0;

        for ($y = 0; $y < $N; $y++) {
            switch ($pole[$x][$y]) {
                case 'X': $krest_g++;   break;
                case '0': $null_g++;    break;
            }
            switch ($pole[$y][$x]) {
                case 'X': $krest_v++;   break;
                case '0': $null_v++;    break;
            }
        }

        if ($null_v  == $N || $null_g == $N) {
            echo "line = ", $null_v, " | ", $null_v, PHP_EOL;
            return 1;
        }
        if ($krest_v == $N || $krest_g == $N) {
            echo "line = ", $krest_v , " | " , $krest_v , PHP_EOL;
            return 2;
        }
    }
    // Победа линии

    // Диагонали

    // Диагональ `-.
        $y = 0; $krest = 0; $null = 0;
        for ($x = 0; $x < $N; $x++) {
            if ($pole[$x][$y] == '0')   { $null++  ; }
            if ($pole[$x][$y] == 'X')   { $krest++ ; }
            $y++;
        }
    // Диагональ `-.

    // Проверка
        if ($null == $N) {
            return 1;
        }
        if ($krest == $N) {
            return 2;
        }
    // Проверка

    // Диагональ .-`
        $y = 0; $krest = 0; $null = 0;
        for ($x = $N-1; $y < $N; $x--) {
            if ($pole[$x][$y] == '0')   { $null++  ; }
            if ($pole[$x][$y] == 'X')   { $krest++ ; }
            $y++;
        }
    // Диагональ .-`

    // Проверка
        if ($null == $N) {
            return 1;
        }
        if ($krest == $N) {
            return 2;
        }
    // Проверка

    // Диагонали
    
    // Ничья
    $tik = 0;
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            if ($pole[$x][$y] == '-') {
                $tik++;
            }
        }
    }
    if ($tik == 0) {
        return 10;
    } 
    // Ничья

    return NULL;
}

function printer($pole, $N, $time, $clear){
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            echo $pole[$x][$y], ' | ';
        }
        echo PHP_EOL;
    }

    time_nanosleep($time[0] , $time[1]);

    if ($clear == 1) { system("clear"); }
}

function generator($N){
    $pole = array(array());
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            $pole[$x][$y] = '-';
        }
    }

    return $pole;
}
?>