<?php
function revizor($pole, $N){
    // Ничья
    $tik = 0;
    for ($x = 0; $x < $N; $x++) {
        for ($y = 0; $y < $N; $y++) {
            if ($pole[$x][$y] != '-') {
                $tik++;
            }
        }
    }
    if ($tik == 0) {
        return 0;
    } 
    // Ничья

    else {
        // Победа линии
        for ($x = 0; $x < $N; $x++) {
            $null = 0;
            $krest = 0;

            for ($y = 0; $y < $N; $y++) {
                switch ($pole[$x][$y]) {
                    case 'X':
                        $krest++;
                        break;
                    case '0':
                        $null++;
                        break;
                }
            }

            if ($null == $N) {
                return 1;
            }
            if ($krest == $N) {
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
    }
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