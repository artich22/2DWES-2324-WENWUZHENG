<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip = "192.18.16.204";


$ip = "192.168.18.204";
$octetos = explode(".", $ip);//dividir
$binario = sprintf("%b.",$octetos);
$ipBinaria = sprintf("%08b%08b%08b%08b", $octetos[0], $octetos[1], $octetos[2], $octetos[3]);
echo "IP $ip en binario es: $ipBinaria";

?>
</BODY>