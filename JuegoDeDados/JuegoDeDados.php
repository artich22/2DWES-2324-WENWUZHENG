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

    include('JuegoDeDadosFunciones.php');
    $Nombres = Nombres();
    $Numeros=JugadoresYDadosTabla($Nombres);
    var_dump($Numeros);
    $Ndados= limpiar($_POST["numdados"]);
    mostrarDatos($Nombres,$Numeros,$Ndados);
    imprimirResultados($Nombres, $Numeros, $Ndados);
    $contadorGanadores = 0;
    $jugadoresDados = array();
    $resultado = array();
    $indicesMaximos = array();

    if ($numDados > 0 && $numDados < 10) {
        generarResultados($numDados, $jugadoresDados, $resultado);
        imprimirTabla($jugadores, $jugadoresDados, $numDados);
        imprimirResultados($jugadores, $resultado);
        determinarGanadores($jugadores, $resultado, $contadorGanadores);
        archivoTXT($jugadores, $jugadoresDados, $numDados, $resultado);


    }
} catch (Exception $e) {
    echo "Excepción: " . $e->getMessage();
}
$Numeros=JugadoresYDadosTabla($Nombres);
$Ndados= limpiar($_POST["numdados"]);
mostrarDatos($Nombres,$Numeros,$Ndados);
resultados($Nombres,$Numeros,$Ndados);
sacarArchivostxt($Nombres,$Numeros,$Ndados);
?>

</BODY>
</HTML>
