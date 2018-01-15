<?php
class pet{
    public      $name;      // Видна всем, изменение внутри и снаружи
    protected   $color;     // Видна внутри и у наследников
    private     $speed;     // Видна внутри


}

$dog = new pet;

$dog->name = "Vasya";

echo $dog->name;
?>