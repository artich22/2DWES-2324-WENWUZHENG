<HTML>
<HEAD> <TITLE> Calculadora</TITLE> </HEAD>
<BODY>
    <h1>Calculadora</h1>
    <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <label for="op1">Operando1</label>
        <input type="text" name="op1"><br><br><br>
        <label for="op2">Operando2</label>
        <input type="text" name="op2">
        <br><br><br><br>
        <p>Selecciona operacion:</p>
        <label for="Suma">Suma</label>
        <input type="radio" name="operacion" value="Suma"><br>
        <label for="Resta">Resta</label>
        <input type="radio" name="operacion" value="Resta"><br>
        <label for="Producto">Producto</label>
        <input type="radio" name="operacion" value="Producto"><br>
        <label for="division">Division</label>
        <input type="radio" name="operacion" value="Division"><br>
        <br>
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
if($_POST["operacion"] === "Suma"){
echo "El resultado de la suma de : " . $op1 . " y " . $op2 . " es: " . ($op1 + $op2);
}
if($_POST["operacion"] === "Resta"){
    echo "El resultado de la resta de : " . $op1 . " y " . $op2 . " es: " . ($op1 - $op2);
}
if($_POST["operacion"] === "Producto"){
    echo "El resultado del producto de : " . $op1 . " y " . $op2 . " es: " . ($op1 * $op2);
}
if($_POST["operacion"] === "Division"){
    echo "El resultado de la division de : " . $op1 . " y " . $op2 . " es: " . ($op1 / $op2);
}}
?>
</BODY>
</HTML>