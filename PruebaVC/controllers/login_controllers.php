<?php
//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/login_model.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['USUARIO']) && isset($_POST['CLAVE'])) {
        
        $usuario = limpiar($_POST['USUARIO']);
        $clave = limpiar($_POST['CLAVE']);
        
        if ($usuario>1000) {
            $resultado=VERIFICATIONADMIN($usuario);
            if ($resultado['lastname']==$clave) {
                setcookie("admin", $usuario, time() + 3600,'/'); 
                header("Location: pe_consultas.php");
            } else {
                error();
            }
        }
        $resultado = VERIFICATIONCLIENTE($usuario);
        if ($resultado['ContactLastName']==$clave) {
            setcookie("usuario", $usuario, time() + 3600,'/'); 
            header("Location: pe_inicio.php");
        } else {
            error();
        }
    }
}

//Llamada a la vista -- Intermediario entre vista y modelo !!!
require_once("views/login_view.php");
?>