<HTML>
<HEAD><TITLE> EJ3 </TITLE></HEAD>
<BODY>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">
<tr>
	<th>Indice</th>
	<th>Binario</th>
	<th>Octal</th>
	<th>BinarioInverso</th>
</tr>
<?php

$modulos = array("Bases Datos”, “Entornos Desarrollo”, “Programación”);
$binario = array(0);
$binarioinv = array(0);
$octalarr = array(0);

for($i=0; $i<20; $i++){


		$binario[$i] = decbin($i);
		$octalarr[$i] = decoct($i);
		$binarioinv[$i] = strrev($binario[$i]);
		
		echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$binario[$i]."</td>";
		echo"<td>".$octalarr[$i]."</td>";
		echo"<td>".$binarioinv[$i]."</td>";
		echo"</tr>";
		echo "<br>";
		


}


?>
</table>
</BODY>