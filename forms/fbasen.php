<HTML>
<HEAD> <TITLE> Conversión</TITLE> </HEAD>
<BODY>
<h1>Conversión</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="op1">Numero</label>
        <input type="text" name="op1"><br><br><br>
        <label for="op2">Nueva base</label>
        <input type="text" name="op2">

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
$op2 = $_POST["op2"];

$partes= explode("/",$op1);

$conversion=base_convert($partes[0], $partes[1], $op2);



echo "Numero $partes[0]"." en base "."$partes[1]"." = "." $conversion "." en base "."$op2";

}
?>
</BODY>
</HTML>