<?php
function conexion(){
    $servername = "fdb1034.awardspace.net";
    $username = "4429561_pedidos";
    $password = "Pedidos1234";
    $dbname = "4429561_pedidos";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

?>