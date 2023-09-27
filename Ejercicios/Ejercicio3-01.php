<HTML>
<HEAD><TITLE> EJ3 </TITLE></HEAD>
<BODY>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">
<tr>
	<th>Indice</th>
	<th>Valor</th>
	<th>Suma</th>
</tr>
<?php

$array = array(0);

$c=0;

$sum =0;

for($i=0; $i<=1000; $i++){

	if($i%2!=0){
		$array[$c]=$i;
		
		$sum = $sum +$i;
		echo"<tr>";
		echo"<td>".$c."</td>";
		echo"<td>".$i."</td>";
		echo"<td>".$sum."</td>";
		echo"</tr>";
		echo "<br>";
		$c++;
		
		
	}

	if($c==20){
	break;
	}
}


?>
</table>
</BODY>