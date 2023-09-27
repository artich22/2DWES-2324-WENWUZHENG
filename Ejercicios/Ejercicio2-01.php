<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario </TITLE></HEAD>
<BODY>
<?php
$n = "127";
$num = $n;
$count = 0;

$binario="";

do{
	if(bcdiv($n,'2',0)==$n/2){
		$n=bcdiv($n,'2',0);
		echo "Truncar "."$n"; echo "<br>";
		$binario .= "0";
	}else{
		$n=bcdiv($n,'2',0);
		echo "Truncar "."$n"; echo "<br>";
		$binario .= "1";
	}
}while($n!=0);

$binario=strrev("$binario");

echo "Numero "."$num"." en binario = "."$binario".".";
?>
</BODY>