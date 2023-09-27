<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario </TITLE></HEAD>
<BODY>
<?php
$n = "48";
$base="9";
$num = $n;
$numf=$n;
$count = 0;

$binario="";

do{
	if(bcdiv($n,$base,0)==$n/$base){
		$n=bcdiv($n,$base,0);
		$binario .= "0";
	}else{
		$num=($num=(bcdiv($n,$base,0))-$n/$base)*-$base;
		$n=bcdiv($n,$base,0);
		
		$binario .= "$num";
	}
}while($n!=0);

$binario=strrev("$binario");

echo "Numero "."$numf"." en binario = "."$binario".".";
?>
</BODY>