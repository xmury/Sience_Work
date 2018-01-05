<?php
include 'art_ins.php';
include 'fun_of_poligon.php';

function poligon($N, $f){
    $pole = generator(3); // Создание поля
    $reviziya = NULL;

    $tik = 0;
    while ( $reviziya == NULL){
        $tik++;

        echo PHP_EOL;
        $pole = art_in($pole, $N, 'X', $tik);
        printer($pole, 3, [1,0], 0);
        $reviziya = revizor($pole, $N);

        echo PHP_EOL;
        $pole = art_in($pole, $N, '0', $tik);
        printer($pole, 3, [1, 0], 0);
        $reviziya = revizor($pole, $N);
    }

    switch ($reviziya) {
        case 0:
            echo "Draw" , PHP_EOL;
            break;
        
        case 1:
            echo "AI first - win" , PHP_EOL;
            break;
        case 2:
            echo "AI second - win", PHP_EOL;
            break;
    }
}

poligon(3, true);
?>