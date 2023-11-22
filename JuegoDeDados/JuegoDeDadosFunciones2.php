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

    $juga1 = $_POST['jug1'];
    $juga2 = $_POST['jug2'];
    $juga3 = $_POST['jug3'];
    $juga4 = $_POST['jug4'];
    $jugadores = [$juga1, $juga2, $juga3, $juga4];
    $numDados = $_POST['numdados'];
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



?>




</BODY>
</HTML>
