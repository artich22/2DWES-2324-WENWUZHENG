<?php
    $cookie_name="admin";
    if(!isset($_COOKIE[$cookie_name])) {
        header("Location: pe_login.php");
        exit();
    }
    include 'funciones.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
        setcookie("admin", "", time() - 3600, "/");
        echo '<script>window.location.href = "pe_login.php";</script>';
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
        <button onclick="location.href='pe_consped.php'">Consulta Pedidos</button>
        <button onclick="location.href='pe_consprodstock.php'">Consulta Stock</button>
        <button onclick="location.href='pe_constock.php'">Consulta Stock Categoria</button>
        <button onclick="location.href='pe_topprod.php'">Consulta Unidades Vendidas</button>
        <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="submit" value="Cerrar Sesión" name="crear"> 	
        </form>
        
    </main>

    <footer>
        <p>&copy; 2024 Tienda Online. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
