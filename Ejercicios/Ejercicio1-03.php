<HTML>
<HEAD><TITLE> EJ3-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php
$ip = "10.33.15.100/8";

$partes = explode(".", $ip);

$mascara = explode("/", $partes[3]);

$binred = $mascara[0];

$mascara = $mascara[1];

$red = 0;

$count = 0;

$binario = "";

$ajusteb = "";

$direcciones = "";

$binario = "";

$partes[3]=$binred;

foreach ($partes as $parte) {

    $binario = str_pad(decbin((int) $parte), 8, "0", STR_PAD_LEFT);
    $ajusteb .= "$binario";
	
}

$direcciones = substr($ajusteb, 0, $mascara);

$red = str_pad($direcciones, 32, "0", STR_PAD_RIGHT);

$trozoo[0]=bindec(substr($red,0,8));
$trozoo[1]=bindec(substr($red,8,8));
$trozoo[2]=bindec(substr($red,16,8));
$trozoo[3]=bindec(substr($red,24,8));

$ajusteb = "";
$count = 0;
$direccionred = " ";
$rangoa="";
do {
	$direccionred .= "$trozoo[$count]".".";
	
    	$count = $count + 1;

} while ($count != 4);
$count=0;

$trozoo[3]=$trozoo[3]+1;

foreach ($trozoo as $troz){
	
	$rangoa .= "$troz".".";
}

$trozoo[3]=$trozoo[3]-1;


$broadcast = str_pad($direcciones, 32, "1", STR_PAD_RIGHT);

$trozo[0]=bindec(substr($broadcast ,0,8));
$trozo[1]=bindec(substr($broadcast ,8,8));
$trozo[2]=bindec(substr($broadcast ,16,8));
$trozo[3]=bindec(substr($broadcast ,24,8));

$ajusteb = "";
$count = 0;
$direccionbroadcast = "";
$rangob="";
do {
	$direccionbroadcast .= "$trozo[$count]".".";
	
    	$count = $count + 1;

} while ($count != 4);
$count=0;

$trozo[3]=$trozo[3]-1;

foreach ($trozo as $troz){
	
	$rangob .= "$troz".".";
}

$trozo[3]=$trozo[3]+1;


echo "IP :" . rtrim($ip, "."); echo "<br/>"; echo "<br/>";
echo "Mascara :" . $mascara; echo "<br/>"; echo "<br/>";
echo "Dirección Red :" . rtrim($direccionred, "."); echo "<br/>"; echo "<br/>";
echo "Dirección Broadcast :" . rtrim($direccionbroadcast, "."); echo "<br/>"; echo "<br/>";
echo "Rango :" . "$rangoa"." a "."$rangob"; echo "<br/>"; echo "<br/>";

?>
</BODY>
</HTML>
