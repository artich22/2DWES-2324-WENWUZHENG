<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        body {
            background-color: #f0f0f0;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 50px;
            margin: 0;
        }

        h1 {
            color: #333;
            font-size: 2em;
        }

        p {
            color: #666;
            font-size: 1.2em;
        }
    </style>
</head>
<body>
    <?php
    $cookie_name="usuario";
    if(!isset($_COOKIE[$cookie_name])) {
        header("Location: pe_login.php");
        exit();
    } 
    ?>
    <div>
        <h1>Bienvenido</h1>
        <p>Gracias por visitar nuestro sitio web. ¡Esperamos que disfrutes tu estancia!</p>
    </div>
    <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="container">
            <input type="submit" value="Cerrar Sesión" name="crear"> 
        </div>	
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    setcookie("usuario", "", time() - 3600, "/");
    header("Location: bienvenido.php");
    exit();
    }
    ?>
</body>
</html>
