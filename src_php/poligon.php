<?php
include 'art_ins.php';
include 'fun_of_poligon.php';
include 'bd.php';

function poligon($N)
{
    $pole   = generator(3); // Создание поля
    $f_name = inialization();
    
    $id = 0; $xy = NULL;
    while (true) {

        $sign = 'X'; $id++;                                                             // Ход "Х" увеличиваем на 1 номер хода
        $xy = art_in($pole, $N, $xy);                                                   // Получаем координаты 
            $pole[$xy[0]] [$xy[1]] = $sign;                                             // Записываем в выбранную ячейку наш знак
        $reviziya = revizor($pole, $N);                                                 // Проверяем поле
                
        if ($reviziya != 3) { record($f_name, $reviziya, $id, $xy, $sign); break; }     // Если ничего не произошло записывает ход в БД
        else { record($f_name, $reviziya, $id, $xy, $sign); }                           // Иначе записываем результат игры
        //-----------------------------------------------------------------------------------------------------------------------------
        $sign = '0'; $id++;                                                             // Ход "Y" увеличиваем на 1 номер хода
        $xy = art_in($pole, $N, $xy);                                                   // Получаем координаты 
            $pole[$xy[0]] [$xy[1]] = $sign;                                             // Записываем в выбранную ячейку наш знак
        $reviziya = revizor($pole, $N);                                                 // Проверяем поле

        if ($reviziya != 3) { record($f_name, $reviziya, $id, $xy, $sign); break; }     // Если ничего не произошло записывает ход в БД
        else { record($f_name, $reviziya, $id, $xy, $sign); }                           // Иначе записываем результат игры
    }

    printer($pole, $N, [0, 0], 0);                                                      // Выводим поле
    switch ($reviziya) {                                                                // Объявляем победителя
        case 0:                                                                         // Ничья
            echo "Draw", PHP_EOL;
            break;

        case 1:                                                                         // Победил "0"
            echo "AI first  [0] - win", PHP_EOL;
            break;
        case 2:                                                                         // Победил "Х"
            echo "AI second [X] - win", PHP_EOL;
            break;
    }
}
?>