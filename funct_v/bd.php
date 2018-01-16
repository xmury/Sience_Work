<?php
function inialization(){
    $id = NULL;
    
    if( !file_exists('db/') ){ system('mkdir db'); }
    if (file_exists('db/0.db')){
        $fp = fopen('db/0.db', 'r+');            // открыть
        $id = fgetc($fp); $n_id = $id + 1;       // получить имя крайнего файла

        fclose($fp); $fp = fopen('db/0.db', 'w');
        $q  = fwrite($fp, $n_id);                // увеличить на единицу лежащее там число
    }
    else{
        $fp = fopen('db/0.db', 'w');             // создать файл из списка
        $id = 1;                                 // обозначить имя крайнего файла
        fwrite($fp, 1);                          // записать туда 1
    }
    fclose($fp);

    $f_name = "$id.db";
    
    $ffp = fopen("db/$f_name", 'w');
    fclose($ffp); 
   
    return $f_name;
}

function record($f_name, $tur, $id, $xy, $sign){
    $way = "db/$f_name";
    $fp = fopen($way, 'a');
    
    if ($tur == 3) {
        $x = $xy[0]; $y = $xy[1];
        $wr = "$id $sign $x:$y\n";  
        fwrite($fp, $wr);
    }
    else {
        fwrite($fp, $tur);
    }
}
?>