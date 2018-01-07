<?php
function reader($f_name, $id, $tur){
    $fp = fopen($f_name, 'r');

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

$f_name = 'db/1.db';
$id = 5; 
$tur = 1;

$test = reader($f_name, $id, $tur);
if (gettype($test) != "NULL") { echo $test; }
else { echo "Error"; }
?>