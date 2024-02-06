<?php
    $cookie_name="usuario";
    if(!isset($_COOKIE[$cookie_name])) {
        header("Location: pe_login.php");
        exit();
    } 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Location: pe_cesta.php");
    exit();
    }
    ?>
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
    
    <div>
        <h1>DENEGADO</h1>
        <p>Tu tarjeta no funciona o eres pobre!.</p>
    </div>
    <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="container">
            <input type="submit" value="Cesta" name="crear"> 
        </div>	
    </form>
    
</body>
</html>
