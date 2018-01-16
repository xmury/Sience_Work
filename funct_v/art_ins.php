<?php
include "m_l.php";

function safer($bufer, $mod)
{                                                               // $bufer - > значение $mass ;  
                                                                // $mod - > режим | r - чтение | w - запись
    $f_name = "mass.data";
    $fp = fopen($f_name, $mod);                                 // Читаем из файла

    if ($mod == 'r') {                                          // Если $mod = 'r'  
        $string = "";
        $mass = [];

        while (!feof($fp)) {                                    // Формируем массив
            $char .= fgetc($fp);
            
            if ($char == "\n") {
                $mass[] = $string;
                $string = "";
            }
        }
        return $mass;                                           // Возвращаем
    }

    if ($mod == 'w') {                                          // Если $mod = 'w'
        foreach ($bufer as $w) {
            $string = "$w\n";
            fwrite($fp, $string);                               // Сохраняем  значение $bufer построчно
        }

        fclose($fp);
    }
}

function analizator($id, $xy, $mass)
{                                                               // $xy - ход аппонента
    if(gettype($mass) != 'array') { return NULL; }

    $id = 1;
    $xy = "$xy[0]:$xy[1]";
    $bufer = null;
    foreach ($mass as $w) {
        $result = reader($w, 0, 1);
        if ($result == "1" || $result == "2") {
            $string = reader($w, $id - 1, 0);

            $past_step = "$string[4]:$string[6]";
            echo "$w Hello --> " . strlen($string);
            if ($past_step == $xy) {
                $string = reader($w, $id, 0);
                $new_step = [$string[4], $string[6]];
                return [$new_step, $mass];
            } else {
                for ($i = 0; $i < count($mass); $i++) {
                    if ($mass[$i] == $w) {
                        unset($mass[$i]);
                    }
                }
            }
        } else {
            if ($result == "0") {
                $string = reader($w, $id - 1, 0);

                $past_step = "$string[4]:$string[6]";
                if ($past_step == $xy) {
                    $string = reader($w, $id, 0);
                    $bufer = [$string[4], $string[6]];
                } else {
                    for ($i = 0; $i < count($mass); $i++) {
                        if ($mass[$i] == $w) {
                            unset($mass[$i]);
                            $mass = array_values($mass);
                            $i--;
                        }
                    }
                }
            } else {
                echo "res = $result\n";                             // Тест
            }
        }

        if (count($mass) == ($i + 1)) {
            return $bufer;
        }

        $i++;
    }
}

function rand_step($pole, $N)
{
    while (true) {
        $x = random_int(0, $N - 1);
        $y = random_int(0, $N - 1);

        $xy = [$x, $y];

        if ($pole[$x][$y] == '-') {
            return $xy;
        }
    }
}

function art_in($pole, $N, $xy, $id)
{
    if ($id < 3) {
        $mass = worker($id, $xy);                                   // Получить массив из базы данных
    } else {
        $mass = safer(0, 'r');                                      // Получить массив из буфера
    }

    if ($mass == NULL) { return rand_step($pole , $N); }
    else { $bufer = analizator($id, $xy, $mass); }                  // Вызвать анализатор}
    

    if ($bufer == null) {
        return rand_step($pole, $N);
    }                                                               // Если анализатор вернёт NULL, Запуск рандома
    else {
        safer($bufer[1], 'w');                                      // Иначе обновить значение $mass 
        return $bufer[0];                                           // и вернуть $xy
    }
}
?>