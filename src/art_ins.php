<?php
include "db.php";

class ant_in {
    public $mass;
    public $sign;
    public $q;
    
    public function helper($id , $xy){                              // Проверяет подходит ли нам файл, и в этом случае возвращает нам предполагаемый ход
        $past_step = read_val($w, $id - 1, 'xy');                           // считываем координаты первого хода

        if ($past_step == $xy) {                                            // Если координаты в файле и хода опонента совпадают
            $new_step = read_val($w, $id, 'xy');                          // Считываем координаты нашего хода
            return $new_step;                                               // Возвращаем их
        } else {                                                            // Если прошлый ход в файле не совпадает с ходом аппонента
            for ($i = 0; $i < count($this->mass); $i++) {                   // проходим по всем элементам массива
                if ($this->mass[$i] == $w) {                                // и удаляем тот у которого 
                    unset($this->mass[$i]);                                 // прошлый ход не совпадает с нашим
                    $this->mass = array_values($this->mass);                // Обновляем индексацию
                    $this->q--;                                             // Откатываем счётчик
                }
            }
        }
    }

    public function analizator($id, $xy)                             // Обработка данных в БД и вынесение вердикта какую службу вызывать
    {                                                                       // $xy - ход аппонента
        $this->q = 1;                                                       // Счётчик
        $bufer = null;
        foreach ($this->mass as $w) {
            $result = read($w , 0);                                         // Получаем результат просматриваемой игры

            if ($result != 0){                                              // Если кто то победил
                $new_xy = $this->helper($id , $xy);
                return $new_xy;
            } else {                                                        // Если это ничья
                $bufer = $this->helper($id, $xy);
            }

            if (($this->q + 1) == count($this->mass)) { return $bufer; }
        }
    }
                                                                                      
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
    public function main($pole, $xy)                                        // Управляющая ИИ конструкция
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