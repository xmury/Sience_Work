<?php
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
    printer($pole, 3);
}

poligon();
?>