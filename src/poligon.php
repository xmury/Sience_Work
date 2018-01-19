<?php
include "art_ins.php";
include "db.php";

class poligon
{
    public $N = 3;
    public $pole;
    public $f_name;

    public function generator()                           // Генератор поля
    {
        $this->pole = array(array());
        for ($x = 0; $x < $this->N; $x++) {
            for ($y = 0; $y < $this->N; $y++) {
                $this->pole[$x][$y] = '-';
            }
        }
    }

    public function printer($clear, $time)               // Вывод поля
    {
        for ($x = 0; $x < $this->N; $x++) {
            for ($y = 0; $y < $this->N; $y++) {
                echo $this->pole[$x][$y], ' | ';
            }
            echo PHP_EOL;
        }
        time_nanosleep($time[0], $time[1]);

        if ($clear == 1) {
            system("clear");
        }
    }

    public function revizor()                           // Выявление окончания игры
    {
        // Победа линии
        for ($x = 0; $x < $this->N; $x++) {
            $null_v = 0; $krest_v = 0; $null_g = 0; $krest_g = 0;

            for ($y = 0; $y < $this->N; $y++) {
                switch ($this->pole[$x][$y]) {
                    case 'X':
                        $krest_g++;
                        break;
                    case '0':
                        $null_g++;
                        break;
                }
                switch ($this->pole[$y][$x]) {
                    case 'X':
                        $krest_v++;
                        break;
                    case '0':
                        $null_v++;
                        break;
                }
            }

            if ($null_v == $this->N || $null_g == $this->N) {
                return 1;
            }
            if ($krest_v == $this->N || $krest_g == $this->N) {
                return 2;
            }
        }
        // Победа линии

        // Диагонали

        // Диагональ `-.
        $y = 0;
        $krest = 0;
        $null = 0;
        for ($x = 0; $x < $this->N; $x++) {
            if ($this->pole[$x][$y] == '0') {
                $null++;
            }
            if ($this->pole[$x][$y] == 'X') {
                $krest++;
            }
            $y++;
        }
        // Диагональ `-.

        // Проверка
        if ($null == $this->N) {
            return 1;
        }
        if ($krest == $this->N) {
            return 2;
        }
        // Проверка

        // Диагональ .-`
        $y = 0;
        $krest = 0;
        $null = 0;
        for ($x = $this->N - 1; $y < $this->N; $x--) {
            if ($this->pole[$x][$y] == '0') {
                $null++;
            }
            if ($this->pole[$x][$y] == 'X') {
                $krest++;
            }
            $y++;
        }
        // Диагональ .-`

        // Проверка
        if ($null == $this->N) {
            return 1;
        }
        if ($krest == $this->N) {
            return 2;
        }
        // Проверка

        // Диагонали
        
        // Ничья
        $tik = 0;
        for ($x = 0; $x < $this->N; $x++) {
            for ($y = 0; $y < $this->N; $y++) {
                if ($this->pole[$x][$y] == '-') {
                    $tik++;
                }
            }
        }
        
        if ($tik == 0) {
            return 0;
        } 
        // Ничья
        
        return 3;
    }

    public function game()                              // Запуск игры
    {   
        // Инициализация
        $this->generator();                                 // Поле 
        $this->f_name = inialization();                     // БД

        $ai_1 = new art_in;                                 // ИИ 1
        $ai_1->sign = '0';

        $ai_2 = new art_in;                                 // ИИ 2
        $ai_2->sign = 'X';
        // Инициализация

        $id = 1; $xy = null; $game_mode = 3;
        while ($game_mode == 3) {
            //----------------------------------------------Ход ИИ 1
            $xy = $ai_1->main($this->pole , $xy, $id);      // Запрашиваем у ИИ координаты хода
            $this->pole[$xy[0]][$xy[1]] = $ai_1->sign;      // Записываем ход в поле
            $game_mode = $this->revizor();                  // Запускаем ревизора
            if ($game_mode == 0){                           // Если игра продолжается сохраняем в БД ход
                write($this->f_name, $game_mode, $id, $xy, $ai_1->sign); 
            } else {                                        // Если игра окончена сохраняем результат в БД
                write($this->f_name, $game_mode, $id, $xy, $ai_1->sign); 
            }
            $id++;                                          // Увеличиваем id хода
            //----------------------------------------------Ход ИИ 1
            if ($game_mode != 3) { break; }
            //----------------------------------------------Ход ИИ 2
            $xy = $ai_2->main($this->pole , $xy, $id);      // Запрашиваем у ИИ координаты хода
            $this->pole[$xy[0]][$xy[1]] = $ai_2->sign;      // Записываем ход в поле
            $game_mode = $this->revizor();                  // Запускаем ревизора
            if ($game_mode == 0){                           // Если игра продолжается сохраняем в БД ход
                write($this->f_name, $game_mode, $id, $xy, $ai_2->sign); 
            } else {                                        // Если игра окончена сохраняем результат в БД
                write($this->f_name, $game_mode, $id, $xy, $ai_2->sign); 
            }
            $id++;                                          // Увеличиваем id хода
            //----------------------------------------------Ход ИИ 2
        }

        if ($game_mode == 0) { echo "\nDraw!      \n"; }
        if ($game_mode == 1) { echo "\nAI_1 - WIN \n"; }
        if ($game_mode == 2) { echo "\nAI_2 - WIN \n"; }
        $this->printer(0,0);
    }
}
?>