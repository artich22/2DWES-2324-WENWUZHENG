<HTML>
<HEAD><TITLE> Practica5 </TITLE></HEAD>
<BODY>
<table border="1" style="border-collapse: collapse; text-align:center;">
<tr>
	<th></th>
	<th>Nombre</th>
	<th>Apellido1</th>
    <th>Apellido2</th>
    <th>Fecha de Nacimiento</th>
    <th>Localidad</th>
</tr>
<?php
$z=file("alumnos1.txt");
foreach($z as $linea=>$texto) {
    echo"<tr>";
    $Nombre = trim(substr($texto,0,39));
    $Apellido1 = trim(substr($texto,40,41));
    $Apellido2 = trim(substr($texto,81,42));
    $Fecha = trim(substr($texto,123,10));
    $Localidad = trim(substr($texto,133,27));
    $ptsd=$linea+1;
    echo "<td> Alumno ".$ptsd."</td>";
    echo "<td>".$Nombre."</td>";
    echo "<td>".$Apellido1."</td>";
    echo "<td>".$Apellido2."</td>";
    echo "<td>".$Fecha."</td>";
    echo "<td>".$Localidad."</td>";
    echo"</tr>";
};

?>
</BODY>