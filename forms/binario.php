<HTML>
<HEAD> <TITLE> BINARIO</TITLE> </HEAD>
<BODY>
    <h1>BINARIO</h1>
<?php
$op1 = $_POST["op1"];

$binario=decbin($op1);



echo "<label>Numero decimal  </label>";
echo "<input type='text' value='$op1' readonly><br>";
echo "<label>Numero binario  </label>";
echo "<input type='text' value='$binario' readonly><br>";

?>
</BODY>
</HTML>