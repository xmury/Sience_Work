<?php
include 'art_ins.php';
include 'fun_of_poligon.php';
include 'bd.php';

class poligon
{
    public $N = 3;
    public $pole;
    public $f_name;

    public $test = 1;

    public function init()
    {

    }

    public function generator()
    {
        $this->pole = array(array());
        for ($x = 0; $x < $this->N; $x++) {
            for ($y = 0; $y < $this->N; $y++) {
                $this->pole[$x][$y] = '-';
            }
        }

        if ($this->test) {
            echo "Generator test\n";
        }
    }

    public function printer($clear, $time)
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

    public function revizor()
    {
    // Победа линии
        for ($x = 0; $x < $this->N; $x++) {
            $null_v = 0;
            $krest_v = 0;
            $null_g = 0;
            $krest_g = 0;

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

    public function start()
    {
        $this->generator();
        $this->printer(0, 0);
    }
}

$arena = new poligon;
$arena->start();
?>