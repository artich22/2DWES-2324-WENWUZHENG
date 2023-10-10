<HTML>
<HEAD> <TITLE>DATOS ALUMNOS</TITLE> </HEAD>
<BODY>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">
    <h1>DATOS ALUMNOS</h1>
    <tr>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Email</th>
    <th>Sexo</th>
</tr>
<?php

$nombre = $_POST["nombre"];
$apellidos1 = $_POST["apellidos1"];
$apellidos2 = $_POST["apellidos2"];
$Mail = $_POST["Mail"];
$apellido=$apellidos1." ".$apellidos2;

        echo"<tr>";
        echo"<td>".$nombre."</td>";
        echo"<td>".$apellido."</td>";
        echo"<td>".$Mail."</td>";
        if($_POST["operacion"] === "Hombre"){
            echo "<td>H</td>";
        }
        if($_POST["operacion"] === "Mujer"){
            echo "<td>M</td>";
        }
        echo"</tr>";
        echo "<br>";

?>
</BODY>
</HTML>