<HTML>
<HEAD> <TITLE> Bingo</TITLE> </HEAD>
<BODY>
    
<?php

function limpiar($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}

function Nombres(){
    $nombres = array();
    for ($i=0; $i < 4; $i++) { 
        $xdasd=$i+1;
        $xd= "jug".$xdasd;
        $nombres[$i]= limpiar($_POST["$xd"]);
    }

    return $nombres;
}

function JugadoresYDadosTabla($Nombres){
    $Ndados= limpiar($_POST["numdados"]);
    $numeros = array();
    for ($j=0; $j < count($Nombres); $j++) { 
        $xd=0;
            for ($i=0; $i < $Ndados; $i++) { 
                $numeros[$j][$i]=rand(1,6);
                $xd+=$numeros[$j][$i];
            }
            $prueba = $numeros[$j][0];
            if ($prueba==($xd/$Ndados)) {
                $xd=100;
            }
            $numeros[$j][$Ndados+1]=$xd;
    }
        
        
    return $numeros;
}
function mostrarDatos($Nombres,$Numeros,$Ndados) {
    echo "<table border='1' style='width:35%; text-align:center;margin: 0 auto;'>";

    for ($i = 0; $i < count($Nombres); $i++) {
        echo "<tr>";
        echo "<td>$Nombres[$i]</td>";
        for ($j = 0; $j < $Ndados; $j++) {
            $xd=$Numeros[$i][$j].".png";
            echo "<td><img src='./images/$xd' style='width:50px';></td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    
}

function resultados($Nombres,$Numeros,$Ndados){
    echo "<div style='width:35%; margin:0 auto;text-align:center;padding-top:30px;'>";
    $max=0;
    $gnom=array();
    $count=1;
    for ($i=0; $i < count($Nombres); $i++) { 
        $xd = 0;
        for ($j = 0; $j < $Ndados; $j++) {
            $xd+=$Numeros[$i][$j];
        }
        $prueba = $Numeros[$i][0];
        if ($prueba==($xd/$Ndados)) {
            $xd=100;
        }
        if ($xd>$max) {
            $max=$xd;
            reset($gnom);
            $gnom[0]=$Nombres[$i];
        }else if($xd==$max){
            $gnom[$count]=$Nombres[$i];
            $count++;
        }
        echo "<h2 style='margin: 0 auto;'>$Nombres[$i]". " = ". $xd . ".</h2><br>";
    
    }
    for ($i=0; $i < count($gnom); $i++) { 
        echo "<h2 style='margin: 0 auto;'>GANADOR: ". $gnom[$i] . ".</h2><br>";
    }
    
    echo "<h2 style='margin: 0 auto;'>NUMERO GANADORES: ". $count . ".</h2><br>";
    echo "</div>";
}

function sacarArchivostxt($Nombres,$Numeros,$Ndados){
    $exist = file_exists("resultados.txt");
    if ($exist)
    {
        $borrado = unlink("resultados.txt");
    }
    $resultados = fopen("resultados.txt","a+");
    $xd=array();
    $palabra = "contador".+1;
    for ($i=0; $i < count($Nombres); $i++) { 
        $xd[$i] = 0;
        for ($j = 0; $j < $Ndados; $j++) {
            $xd[$i]+=$Numeros[$i][$j];
        }
        $prueba = $Numeros[$i][0];
        if ($prueba==($xd[$i]/$Ndados)) {
            $xd[$i]=100;
        }
    }
    $max=0;
    $ordenar = array();
    for ($i=0; $i < count($Nombres); $i++) { 
        $ordenar[$i][0]=$xd[$i];
        $ordenar[$i][1]=$Nombres[$i];
    }
    var_dump($ordenar);
    
    uasort($ordenar, function($a, $b) {
        // Comparar por el valor de la primera columna
        if ($a[0] == $b[0]) {
            return 0;
        }
        return ($a[0] > $b[0]) ? -1 : 1;
    });
    var_dump($ordenar);
    $a=1;
    $b=0;
    for ($i = 0; $i < count($Nombres); $i++) { 
        echo $ordenar[$i];
        $nombreasdasdasd=$ordenar[$i];

        echo $ordenar[$i][1];
    }
    fclose($resultados);
}
function compararValoresDescendente($a, $b) {
    return $b - $a;
}


function imprimirResultados($jugadores, $resultado, $Ndados)
{
    $Ndados=$Ndados+1;
    for ($i = 0; $i < 4; $i++) {
        echo $jugadores[$i] . " : " . $resultado[$i][$Ndados] . "<br>";
    }
}




?>




</BODY>
</HTML>
