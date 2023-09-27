<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip = "192.18.16.204";

$partes= explode(".",$ip);

$binario="";

$ajuste= "";

foreach ($partes as $parte){
	$binario = str_pad(decbin((int) $parte),8,"0",STR_PAD_LEFT);
	
	$ajuste .= "$binario".".";
}


echo "LA IP ES :".$ajuste;

?>
</BODY>