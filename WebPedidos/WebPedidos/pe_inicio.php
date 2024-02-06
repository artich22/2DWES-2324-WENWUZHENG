<?php
    $cookie_name="usuario";
    if(!isset($_COOKIE[$cookie_name])) {
        header("Location: pe_login.php");
        exit();
    }
    include 'funciones.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        setcookie("usuario", "", time() - 3600, "/");
        header("Location: pe_login.php");
        exit();
        }
        ?>
    
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        main {
            text-align: center;
            padding: 20px;
        }

        button {
            font-size: 16px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <header>
        <h1>Bienvenido a la Tienda</h1>
    </header>

    <main>
        <button onclick="location.href='pe_altaped.php'">Hacer un Pedido</button>
        <button onclick="location.href='pe_cesta.php'">Ver Cesta</button>
        <button onclick="location.href='pe_conspago.php'">Ver Pagos</button>
        <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="submit" value="Cerrar Sesión" name="crear"> 	
        </form>
        

    <footer>
        <p>&copy; 2024 Tienda Online. Todos los derechos reservados.</p>
    </footer>
		</main>
</body>
</html>
