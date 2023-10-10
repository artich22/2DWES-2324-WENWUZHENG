<HTML>
<HEAD> <TITLE>IP</TITLE> </HEAD>
<BODY>
<h1>IP</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="op1">IP en notación decimal</label>
        <input type="text" name="op1"><br><br><br>

        <input type="submit" name="enviar" value="Notacion binaria">
        <input type="reset" name="borrar" value="borrar">
    </form>
<?php
function prueba($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlsppecialchars($data);
    return $data;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
$op1 = $_POST["op1"];

$partes= explode(".",$op1);

$binario="";

$ajuste= "";

foreach ($partes as $parte){
	$binario = str_pad(decbin((int) $parte),8,"0",STR_PAD_LEFT);
	
	$ajuste .= "$binario".".";
}

$ajuste= rtrim($ajuste, ".");

echo "<label>Numero decimal  </label>";
echo "<input type='text' value='$op1' readonly><br>";
echo "<label>Numero binario  </label>";
echo "<input type='text' value='$ajuste' readonly><br>";
}
?>
</BODY>
</HTML>