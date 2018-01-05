<?php
include 'art_ins.php';
include 'fun_of_poligon.php';

function test($pole, $N)
{
    $i = 0;
    $y = 0;
    for ($x = 0; $x < $N; $x++) {
            
        $pole[$x][$y] = $i; $i++;
        printer($pole, $N, [1, 0], 0);            

        $y++;
    }
}
function poligon($N, $f){
    $pole = generator(3); // Создание поля
    $reviziya = NULL;

    $tik = 0;
    while ( $reviziya == NULL){
        $tik++;

        //echo PHP_EOL;
        $pole = art_in($pole, $N, 'X', $tik);
        //printer($pole, 3, [1,0], 0);
        $reviziya = revizor($pole, $N);
        if ($reviziya != NULL) { break; }

        //echo PHP_EOL;
        $pole = art_in($pole, $N, '0', $tik);
        //printer($pole, 3, [1, 0], 0);
        $reviziya = revizor($pole, $N);
    }

    printer($pole, 3, [1, 0], 0);
    switch ($reviziya) {
        case 10:
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

$N = 3;
$f = true;

poligon($N, $f)
?>