<HTML>
<HEAD> <TITLE> CAMBIO BASE</TITLE> </HEAD>
<BODY>
    <h1>CAMBIO BASE</h1>
<?php
$op1 = $_POST["op1"];

$binario=decbin($op1);
$octal=decoct($op1);
$hexadecimal=dechex($op1);

if($_POST["operacion"] === "Binario"){
    echo "<label>Numero decimal  </label>";
    echo "<input type='text' value='$op1' readonly><br>";
    echo "<label>Numero binario  </label>";
    echo "<input type='text' value='$binario' readonly><br>";
    
}
if($_POST["operacion"] === "Octal"){
    echo "<label>Numero decimal  </label>";
    echo "<input type='text' value='$op1' readonly><br>";
    echo "<label>Numero octal  </label>";
    echo "<input type='text' value='$octal' readonly><br>";
}
if($_POST["operacion"] === "Hexadecimal"){
    echo "<label>Numero decimal  </label>";
    echo "<input type='text' value='$op1' readonly><br>";
    echo "<label>Numero hexadecimal  </label>";
    echo "<input type='text' value='$hexadecimal' readonly><br>";
}
if($_POST["operacion"] === "Todos"){
    echo "<label>Numero decimal  </label>";
    echo "<input type='text' value='$op1' readonly><br>";
    echo "<label>Numero binario  </label>";
    echo "<input type='text' value='$binario' readonly><br>";

    echo "<label>Numero octal  </label>";
    echo "<input type='text' value='$octal' readonly><br>";

    echo "<label>Numero hexadecimal  </label>";
    echo "<input type='text' value='$hexadecimal' readonly><br>";
}
?>
</BODY>
</HTML>