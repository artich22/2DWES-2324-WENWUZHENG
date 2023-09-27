<HTML>
<HEAD><TITLE> EJ3 </TITLE></HEAD>
<BODY>
<table border="1" style="width:300px; border-collapse: collapse; text-align:center;">
<tr>
	<th></th>
	<th>Valor</th>
	<th>Suma</th>
</tr>
<?php

$array = array(0);


$c=0;

$par=0;
$impar=0;
$sum =0;

for($i=0; $i<=1000; $i++){

	if($i%2==0){
		$array[$c]=$i;

		$c++;
		
		
	}

	if($c==20){
	break;
	}
}

for ($i=0;$i<20;$i++){

	if($i%2==0){
	$par = $par + $array[$i];
	}else{
	$impar = $impar + $array[$i];
	}

}
$par=$par/10;
$impar=$impar/10;
		echo"<tr>";
		echo"<td>"."Media"."</td>";
		echo"<td>".$par."</td>";
		echo"<td>".$impar."</td>";
		echo"</tr>";
		echo "<br>";

?>
</table>
</BODY>