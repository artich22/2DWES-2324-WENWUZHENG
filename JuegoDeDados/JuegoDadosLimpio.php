<?php

include('JuegoDadosFuncionesRealElVerdaderoElQueFunciona.php');
$datos=jugadores();
$resultados=resultados($datos);
mostrarDatos($datos);
mostrarTexto($resultados);
sacarArchTXT($datos,$resultados);


?>