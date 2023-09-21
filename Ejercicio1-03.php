<HTML>
<HEAD><TITLE> EJ3-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php
$ip = "192.168.16.100/21";

$partes = explode(".", $ip);

$mascara = explode("/", $partes[3]);

var_dump($partes);

var_dump($mascara);

$binred = $mascara[0];

echo "IP :" . rtrim($binred, "."); echo "<br/>"; echo "<br/>";

$mascara = $mascara[0];

$partesb = $partes;

$red = 0;

$count = 0;

$binario = "";

$ajuste = "";

$ajusteb = "";

$direcciones = "";

foreach ($partes as $parte) {
    $binario = str_pad(decbin((int) $parte), 8, "0", STR_PAD_LEFT);

    $ajuste .= "$binario" . ".";
}

$binario = "";
var_dump($partesb);

foreach ($partesb as $parteb) {
	if(is_numeric($parteb)){
    $binario = str_pad(decbin((int) $parteb), 8, "0", STR_PAD_LEFT);
    $ajusteb .= "$binario";
    }else{
	$binario = str_pad(decbin((int) $binred), 8, "0", STR_PAD_LEFT);
	$ajusteb .= "$binario";
	echo "IP :" . rtrim($binred, "."); echo "<br/>"; echo "<br/>";
    }
	
}

echo "IP :" . rtrim($ajusteb, "."); echo "<br/>"; echo "<br/>";

$direcciones = substr($ajusteb, 0, $mascara);

echo "direcciones :" . rtrim($direcciones, "."); echo "<br/>"; echo "<br/>";

$red = str_pad($direcciones, 32, "0", STR_PAD_RIGHT);

echo "red :" . rtrim($red, "."); echo "<br/>"; echo "<br/>";

$ajusteb = "";
$count = -32;
$direccionred = "";
$decimal = 0;
$rangoa="";
do {
    $count = $count + 8;
	echo "conteo :" . rtrim($count, "."); echo "<br/>"; echo "<br/>";
    if($ajusteb = substr($red, ($count - 8), $count)){
	$ajusteb = substr($red, ($count - 8), $count);
}else{
	echo "no"; echo "<br/>"; echo "<br/>";
}
	echo "red :" . rtrim($red, "."); echo "<br/>"; echo "<br/>";
	echo "ajusteb :" . rtrim($ajusteb, "."); echo "<br/>"; echo "<br/>";
    	$decimal = bindec($ajusteb);
    $direccionred .= "$decimal" . ".";
	if($count!=-8){
		$rangoa .= "$decimal" . ".";
 	}else{
		$decimal=$decimal+1;
   		$rangoa .= "$decimal" . ".";
	}
} while ($count != -0);



$broadcast = str_pad($direcciones, 32, "1", STR_PAD_RIGHT);


$ajustec = "";
$count = -32;
$direccionbroadcast = "";
$decimal = 0;
$rangob="";
do {
    $count = $count + 8; 	
    $ajustec = substr($broadcast, ($count - 8), $count);
    $decimal = bindec($ajustec);
    $direccionbroadcast .= "$decimal" . ".";
	if($count!=-8){
		$rangob .= "$decimal" . ".";
 	}else{
		$decimal=$decimal-1;
   		$rangob .= "$decimal" . ".";
	}
} while ($count != -0);


echo "IP :" . rtrim($ip, "."); echo "<br/>"; echo "<br/>";
echo "Mascara :" . $mascara; echo "<br/>"; echo "<br/>";
echo "Dirección Red :" . rtrim($direccionred, "."); echo "<br/>"; echo "<br/>";
echo "Dirección Broadcast :" . rtrim($direccionbroadcast, "."); echo "<br/>"; echo "<br/>";
echo "Rango :" . "$rangoa"." a "."$rangob"; echo "<br/>"; echo "<br/>";

?>
</BODY>
</HTML>
