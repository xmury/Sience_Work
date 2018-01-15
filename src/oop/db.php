<?php
class data_base {
    /*
        Functions:
            write   ($tur [for analiz rezult] , $id [number step] , $xy [coordinates , $sign [char of player])
            read    ($id , $tur)
        
        КЗ , но кажись чтение палёное проверить надо
     */
    public $f_name;

    public function inialization()                         // Инициализация базы данных
    {
        $id = null;

        if (!file_exists('db/')) {                             // если директория не существует
            system('mkdir db');                                // создать её
        }

        if (file_exists('db/0.db')) {                          // получаем крайнего файла
            $fp = fopen('db/0.db', 'r+');                      // открыть файл
            $id = fgetc($fp);                                  // извлечь имя
            $n_id = $id + 1;                                   // генерируем новое имя 

            fclose($fp);                                       // закрываем файл
            $fp = fopen('db/0.db', 'w');                       // снова открыем, но теперь на запись
            $q = fwrite($fp, $n_id);                           // записываем новое имя в файл
        } else {                                           // Если файл не существует       
            $fp = fopen('db/0.db', 'w');                       // создать его
            fwrite($fp, 1);                                    // записать в него 1
        }
        fclose($fp);                                           // закрыть

        $f_name = "$id.db";                                    // формируем полное имя

        $ffp = fopen("db/$f_name", 'w');                       // создаём новый файл
        fclose($ffp);                                          // закрываем его

        return $f_name;                                        // возвращаем полное имя файла
    }

    public function write($tur, $id , $xy , $sign)     // Запись в БД 
    {
        $way = "db/$this->f_name";                             // путь до файла
        $fp = fopen($way, 'a');                                // открыть файл на дозапись с конца

        if ($tur == 3) {                                   // Если игра продолжается пишем ход
            $x = $xy[0]; $y = $xy[1];                          // расшифровываем координаты
            $wr = "$id $sign $x:$y\n";                         // создаём строку для записи
            fwrite($fp, $wr);                                  // записываем

        } else {                                           // Если игра завершена      
            fwrite($fp, $tur);                                 // фиксируем результат
        }
    }

    public function read($id , $tur)                   // Чтение из БД
    {                                                          // если tur = 0 --> Ищем строку; Если tur = 1 --> ищем результат игры
        $fp = fopen("db/$this->f_name", 'r');                  // открываем на чтение файл из БД 

        if ($tur == 0) {                                   // Если нам нужна строка с ходом
            $i = 1; $string = "";                              // счётчик и буфер
            
            while (!feof($fp)) {                               // пока не конец файла 
                $char = fgetc($fp);                            // извлекаем символ
                if ($char == "\n") { $i++; }                   // если конец строки увеличиваем счётчик
                if ($i == $id && $char != "\n") {              // если это не конец строки и номер строки совпадает с нужным нам   
                    $string .= $char;                          // записываем символ в буфер 
                }
            }

            if (!feof($fp) && $i != $id) {                     // если был указан плохой id                      
                fclose($fp); return null;                      // закрыаем файл и возвращаем null
            } else {                                           // иначе
                fclose($fp); return $string;                   // закроем файл и вернём строку
            }
        }

        if ($tur == 1) {                                   // Если нужен результат
            $string = "";                                      // буфер
            while (true) {                                     // пока всё норм             
                $char = fgetc($fp);                            // извлекаем символ

                if ($char == "\n") { $string = "";     }       // обнуляем буфер если конец строки
                if ($char != "\n") { $string .= $char; }       // если нет добавляем символ в буфер

                if (feof($fp)) {                               // если всё же конец строки 
                    fclose($fp);                               // закроем файл
                    return $string;                            // вернём строку
                } 

            }
        }
    }

}
?>