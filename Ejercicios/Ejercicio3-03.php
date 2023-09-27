<HTML>
<HEAD><TITLE> EJ3 </TITLE></HEAD>
<BODY>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">
<tr>
	<th>Indice</th>
	<th>Binario</th>
	<th>Octal</th>
</tr>
<?php

$array = array(0);
$binario = array(0);
$octalarr = array(0);

for($i=0; $i<20; $i++){


		$binario[$i] = decbin($i);
		$octalarr[$i] = decoct($i);

		
		echo"<tr>";
		echo"<td>".$i."</td>";
		echo"<td>".$binario[$i]."</td>";
		echo"<td>".$octalarr[$i]."</td>";
		echo"</tr>";
		echo "<br>";
		


}


?>
</table>
</BODY>