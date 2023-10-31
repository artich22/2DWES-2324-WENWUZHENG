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
$z=file("alumnos2.txt");
foreach($z as $linea=>$texto) {
    echo"<tr>";
    $datos = explode("##", $texto);
    $ptsd=$linea+1;
    echo "<td> Alumno ".$ptsd."</td>";
    foreach($datos as $dato){
        echo "<td>".$dato."</td>";
    }
    echo"</tr>";
};

?>
</BODY>