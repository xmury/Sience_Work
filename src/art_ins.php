<?php
include "db.php";

class ant_in {
    public $mass;
    public $sign;
    public $q;
    
    public function helper($id , $xy){
        $past_step = read_val($w, $id - 1, 'xy');                      // считываем координаты первого хода

        if ($past_step == $xy) {                                    // Если координаты в файле и хода опонента совпадают
            $new_step = read_val($w, $id, 'xy');                  // Считываем координаты нашего хода
            return $new_step;                                       // Возвращаем их
        } else {                                                    // Если прошлый ход в файле не совпадает с ходом аппонента
            for ($i = 0; $i < count($this->mass); $i++) {           // проходим по всем элементам массива
                if ($this->mass[$i] == $w) {                        // и удаляем тот у которого 
                    unset($this->mass[$i]);                         // прошлый ход не совпадает с нашим
                    $this->mass = array_values($this->mass);
                    $this->q--;
                }
            }
        }
    }

    public function analizator($id, $xy)                         // Обработка данных в БД и вынесение вердикта какую службу вызывать
    {                                                                       // $xy - ход аппонента
        $q = 1;                                                             // Счётчик
        $bufer = null;                                                      // Буфер ....
        foreach ($this->mass as $w) {                                       // Просматриваем выборку
            $result = read($w , 0) ;                                      // Узнаём резльтат игры
                                                                            // Проверка соотношения первый походил == победил не требуется так как 
                                                                            // worker уже отобрал игры в которых была победа или ничья
            if ($result != 0) {                                             // Если это чья то победа  
                $past_step = read_val($w , $id-1, 'xy');                      // считываем координаты первого хода

                if ($past_step == $xy) {                                    // Если координаты в файле и хода опонента совпадают
                    $new_step = read_val($w , $id , 'xy');                  // Считываем координаты нашего хода
                    return $new_step;                                       // Возвращаем их
                } else {                                                    // Если прошлый ход в файле не совпадает с ходом аппонента
                    for ($i = 0; $i < count($this->mass); $i++) {           // проходим по всем элементам массива
                        if ($this->mass[$i] == $w) {                        // и удаляем тот у которого 
                            unset($this->mass[$i]);                         // прошлый ход не совпадает с нашим
                            $this->mass = array_values($this->mass);
                            $q--;
                        }
                    }
                }
            } else {                                        
                if ($result == "0") {                                       // Если результат игры - ничья
                    $past_step = read_val($w , $id-1 , 'xy');               // Считываем координаты прошлого хода
                    if ($past_step == $xy) {                                // Если полученые кооординты равны тем что у нас
                        $bufer = read_val($w, $id, 'xy');                   // и сохраняем текущий ход в буфер
                    } else {                                                // Иначе
                        for ($i = 0; $i < count($this->mass); $i++) {       // перебираем выборку
                            if ($this->mass[$i] == $w) {                    // находим наш элемент
                                unset($this->mass[$q]);                     // и удаляем его из выборки
                                $this->mass = array_values($this->mass);    // Проводим переиндексацию
                                $q--;
                            }
                        }
                    }
                } else {
                    echo "res = $result\n";                                 // Тест
                }   
            }   
            
            if (count($mass) == ($q + 1)) { return $bufer; }                // Если мы перед концом массива
            $q++;                                                           // А вариант с победой так и не найден возвращаем буфер
        }                                                                   // Если буфер так же не найден вернём null 
    }               

                                                                            // Передать значение поля нужно                 
    public function rand_step($pole , $N)                                   // Случайный выбор координат
    {                               
        while (true) {                                                      // пока не получим результат
            $x = random_int(0, $N - 1);                                     // генерируем x
            $y = random_int(0, $N - 1);                                     // генерируем у

            if ($pole[$x][$y] == '-') {                                     // если это поле пустое 
                return [$x, $y];                                            // возвращаем координаты нашего хода
            }
        }
    }

                                                                            // Та же самая проблема с полем
    public function main($pole, $N, $xy)                                    // Управляющая ИИ конструкция
    {
        if ($id < 3) {
            $this->mass = worker($id, $xy);                                 // Получить массив из базы данных
        }
    
        $bufer = $this->analizator($id , $xy);                              // Вызвать анализатор
    
        if ($bufer == null) {
            return $this->rand_step($pole, $N);
        }                                                                   // Если анализатор вернёт NULL, Запуск рандома
        else { 
            return $bufer;                                                  // и вернуть $xy
        }
    }
}
?>