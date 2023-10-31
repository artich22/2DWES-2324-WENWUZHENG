<HTML>
<HEAD><TITLE> Practica5 </TITLE></HEAD>
<BODY>
<h1>Datos Alumnos</h1>
    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="Nombre">Nombre</label>
        <input type="text" name="Nombre"><br><br><br>
        <label for="Apellido1">Apellido1</label>
        <input type="text" name="Apellido1"><br><br><br>
        <label for="Apellido2">Apellido2</label>
        <input type="text" name="Apellido2"><br><br><br>
        <label for="Fechaf">Fecha de Nacimiento</label>
        <input type="date" name="Fechaf"><br><br><br>
        <label for="Localidad">Localidad</label>
        <input type="text" name="Localidad"><br><br><br>
        <br>
        <input type="submit" name="enviar" value="enviar">
        <input type="reset" name="borrar" value="borrar">
    </form>
<?php
$Linea = "";
$Nombre = "";
$Apellido1 = "";
$Apellido2 = "";
$Fechaf = "";
$Localidad = "";
function limpiar($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $Nombre = limpiar($_POST["Nombre"]);
    $Apellido1 = limpiar($_POST["Apellido1"]);
    $Apellido2 = limpiar($_POST["Apellido2"]);
    $Fechaf = limpiar($_POST["Fechaf"]);
    $Localidad = limpiar($_POST["Localidad"]);
}

$alumnos1 = fopen("alumnos1.txt","a+");

$Nombre = str_pad($Nombre,40," ",STR_PAD_RIGHT);
$Apellido1 = str_pad($Apellido1,41," ",STR_PAD_RIGHT);
$Apellido2 = str_pad($Apellido2,42," ",STR_PAD_RIGHT);
$Fechaf = str_pad($Fechaf,10," ",STR_PAD_RIGHT);
$Localidad = str_pad($Localidad,27," ",STR_PAD_RIGHT);
	
$Linea .= $Nombre;
$Linea .= $Apellido1;
$Linea .= $Apellido2;
$Linea .= $Fechaf;
$Linea .= $Localidad;
$Linea .= "\n";

fwrite($alumnos1,$Linea);
fclose($alumnos1);

?>
</BODY>