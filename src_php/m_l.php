<?php
function reader($f_name , $id , $tur){ // Если tur = 0 --> Ищем строку; Если tur = 1 --> ищем результат игры
    $fp = fopen("db/$f_name", 'r');

    if ($tur == 0) {                                                     // Если нам нужна строка с ходом
        $i = 1; $string = "";
        while (!feof($fp)){
            $char = fgetc($fp);
            if ($char == "\n"){ $i++;}
            if ($i == $id && $char != "\n") { $string .=  $char; }
        }
        
        if (!feof($fp) && $i != $id){
            fclose($fp); return NULL;
        }
        else {
            fclose($fp); return $string;
        }
    }

    if ($tur == 1) {
        $string = "";
        while(true){
            $char = fgetc($fp);
            
            if ($char == "\n") { $string = ""; }
            if ($char != "\n") { $string .= $char; }

            if (feof($fp)){ fclose($fp);  return $string; }
            else {  }

        } 
    }
}

function worker($id , $xy){ // id - > Какой сейчас ход || $xy - > Координаты первого хода (Обрабатывается если $id = 2)
    $directs = scandir("db/");
    unset($directs[0]); unset($directs[1]); unset($directs[2]);
    $mass = [];

    if ($id == 1){
        foreach ($directs as $w) {

        // Узнаём кто ходит первым
            $string = reader($w , 1 , 0);
            $player = $string[2];
        // Узнаём кто ходит первым
        // Узнаём результат игры
            $string = reader($w , 0 , 1);
            $result = $string[0];
        // Узнаём результат игры

        // Проверка результата
            if ($player == "X" && ( $result == "0" || $result == "2")) { $mass[] = $w; }
            if ($player == "0" && ( $result == "0" || $result == "1")) { $mass[] = $w; }
        // Проверка результата
        }    
    }

    else {
        
        foreach ($directs as $w) {
        // Проверим координаты первого хода
            $string = reader($w, 1, 0);
            $f_xy = "$string[4]:$string[6]";

            if ($f_xy != $xy) { continue; }
        // Проверим координаты первого хода

        // Узнаём кто походил вторым
            $string = reader($w, 2, 0);
            $player = $string[2]; 
        // Узнаём кто походил вторым

        // Узнаём результат игры
            $string = reader($w, 0, 1);
            $result = $string[0];
        // Узнаём результат игры

        // Проверка результата
            if ($player == "X" && ($result == 0 || $result == 2)) { $mass[] = $w; }
            if ($player == "0" && ($result == 0 || $result == 1)) { $mass[] = $w; }
        // Проверка результата

        }
    }

    // Пуст ли массив
        if (count($mass) == 0) { return NULL ; }
        else                   { return $mass; }
    // Пуст ли массив
}
?>