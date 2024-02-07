<?php

// Modelo contiene la lógica de la aplicación: clases y métodos que se comunican
// con la Base de Datos

function VERIFICATIONCLIENTE($usuario){
    global $conn;

            $stmt = $conn->prepare("SELECT CustomerNumber, ContactLastName FROM customers WHERE CustomerNumber = :CustomerNumber");
            $stmt->bindParam(':CustomerNumber', $usuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);


            

    }
function VERIFICATIONADMIN($usuario){
    global $conn;
    
                $stmt = $conn->prepare("SELECT employeeNumber, lastname FROM employees WHERE employeeNumber = :employeeNumber");
                $stmt->bindParam(':employeeNumber', $usuario);
                $stmt->execute();
    
                return $stmt->fetch(PDO::FETCH_ASSOC);

    
    
}
function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function error() {
    $usuario = '';
    $clave = '';

    echo "<script>alert('Usuario o contraseña incorrectos.');</script>";
}

?>