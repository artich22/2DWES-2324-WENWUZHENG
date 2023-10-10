<HTML>
<HEAD> <TITLE> BINARIO</TITLE> </HEAD>
<BODY>
    <h1>BINARIO</h1>
<?php

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

?>
</BODY>
</HTML>