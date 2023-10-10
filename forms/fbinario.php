<HTML>
<HEAD> <TITLE> BINARIO</TITLE> </HEAD>
<BODY>
<h1>BINARIO</h1>
    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="op1">Numero decimal</label>
        <input type="text" name="op1"><br><br><br>

        <input type="submit" name="enviar" value="enviar">
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

$binario=decbin($op1);



echo "<label>Numero decimal  </label>";
echo "<input type='text' value='$op1' readonly><br>";
echo "<label>Numero binario  </label>";
echo "<input type='text' value='$binario' readonly><br>";
}
?>
</BODY>
</HTML>