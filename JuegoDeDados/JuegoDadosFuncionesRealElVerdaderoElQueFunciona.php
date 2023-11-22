<HTML>
<HEAD> <TITLE> Bingo</TITLE> </HEAD>
<BODY>
    
<?php
try {
    if ( empty($_POST['jug1']) || empty($_POST['jug2']) || empty($_POST['jug3']) || empty($_POST['jug4'])) {
        throw new Exception("Error: Deben participar siempre 4 jugadores.");
    }

    if (!isset($_POST['numdados']) || $_POST['numdados'] < 1 || $_POST['numdados'] > 10) {
        throw new Exception("Error: El número de dados debe estar entre 1 y 10.");
    }
    function limpiar($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    function generarNumero(){
        $numero=rand(1,6);
        return $numero;
    }
    function jugadores(){
        $prueba= limpiar($_POST['numdados']);
        for ($i=1; $i < 5; $i++) { 
            $nombrejugador= "jug".$i;
            $bro= limpiar($_POST["$nombrejugador"]);
            $datos[$bro]=array();
            for ($j=0; $j < $prueba; $j++) { 
                $numprub= generarNumero();
                array_push($datos[$bro], $numprub) ;
            }
        }
        return $datos;
    }

    function resultados($datos){
        $prueba= limpiar($_POST['numdados']);
        for ($i=1; $i < 5; $i++) { 
            $max=0;
            $xd= "jug".$i;
            $bro= limpiar($_POST["$xd"]);
            for ($j=0; $j < $prueba; $j++) { 
                $max+=$datos[$bro][$j];
            }
            if ($max/$datos[$bro][0]==$prueba) {
                $max=100;
            }
            $resultados[$bro]=$max; 
        }
        return $resultados;
    }
    function mostrarDatos($datos) {
        $prueba= limpiar($_POST['numdados']);
        echo "<table border='1' style='width:35%; text-align:center;margin: 0 auto;'>";
        foreach($datos as $dato=> $dado){
            echo "<tr>";
            echo "<td>$dato</td>";
            for ($j = 0; $j < $prueba; $j++) {
                $xd=$dado[$j].".png";
                echo "<td><img src='./images/$xd' style='width:50px';></td>";
            }
            echo "</tr>";
        }
    
        echo "</table>";
        
    }
    function mostrarTexto($resultados){
        $prueba= limpiar($_POST['numdados']);
        echo "<div style='width:35%; margin:0 auto;text-align:center;padding-top:30px;'>";

        foreach($resultados as $resultado=> $sumaDados){
            echo "<h2 style='margin: 0 auto;'>$resultado". " = ". $sumaDados . ".</h2><br>";
        }
        arsort($resultados);
        $max=0;
        $count=0;
        foreach($resultados as $resultado=> $sumaDados){
            $prueba=$sumaDados;
            if ($prueba>$max) {
                $count=0;
                $max=$prueba;
                $count++;
            }else if ($prueba==$max) {
                $count++;
            }
        }
        
        echo "<h2 style='margin: 0 auto;'>NUMERO GANADORES: ". $count . ".</h2><br>";
        echo "</div>";
    }
    function sacarArchTXT($datos,$resultados){
        $prueba= limpiar($_POST['numdados']);
        if (file_exists("resultados.txt")) {
            unlink("resultados.txt");
        }
        $archivo = fopen("resultados.txt","a+");

        

        arsort($resultados);

        foreach($resultados as $resultado => $sumaDados){
            $frase = "";
            foreach($datos as $dato=> $dado){
                if ($dato==$resultado) {
                    $frase= $dato."#";
                    $frase.=$sumaDados;
                    for ($i=0; $i < $prueba; $i++) { 
                        $frase.="#".$dado[$i];
                    }
                }
                
            }
            fwrite($archivo, $frase);
            fwrite($archivo, "\n");
        }

        fclose($archivo);
    }

    
    
} catch (Exception $e) {
    echo "Excepción: " . $e->getMessage();
}
?>

</BODY>
</HTML>
