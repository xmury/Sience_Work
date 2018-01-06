<?php
include 'art_ins.php';
include 'fun_of_poligon.php';
include 'bd.php';

function poligon($N)
{
    $pole   = generator(3); // Создание поля
    $f_name = inialization();
    
    $id = 0;
    while (true) {

        $sign = 'X'; $id++;
        $xy = art_in($pole, $N);
            $pole[$xy[ 'x' ]] [$xy[ 'y' ]] = $sign;    
        $reviziya = revizor($pole, $N);
                
        if ($reviziya != 3) { record($f_name, $reviziya, $id, $xy, $sign); break; }
        else {
            record($f_name, $reviziya, $id, $xy, $sign);
        }

        $sign = '0'; $id++;
        $xy = art_in($pole, $N);
            $pole[$xy[ 'x' ]] [$xy[ 'y' ]] = $sign;
        $reviziya = revizor($pole, $N);

        if ($reviziya != 3) { record($f_name, $reviziya, $id, $xy, $sign); break; }
        else {
            record($f_name, $reviziya, $id, $xy, $sign);
        }
    }

    printer($pole, $N, [0, 0], 0);
    switch ($reviziya) {
        case 10:
            echo "Draw", PHP_EOL;
            break;

        case 1:
            echo "AI first - win", PHP_EOL;
            break;
        case 2:
            echo "AI second - win", PHP_EOL;
            break;
    }
}
?>