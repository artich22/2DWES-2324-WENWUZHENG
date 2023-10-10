<HTML>
<HEAD> <TITLE> Calculadora</TITLE> </HEAD>
<BODY>
    <h1>Calculadora</h1>
<?php
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
}
?>
</BODY>
</HTML>