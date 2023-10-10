<HTML>
<HEAD> <TITLE> Conversión</TITLE> </HEAD>
<BODY>
    <h1>Conversión</h1>
<?php
$op1 = $_POST["op1"];
$op2 = $_POST["op2"];

$partes= explode("/",$op1);

$conversion=base_convert($partes[0], $partes[1], $op2);



echo "Numero "."$partes[0]"." en base "."$partes[1]"." = "." $conversion "." en base "."$op2";


?>
</BODY>
</HTML>