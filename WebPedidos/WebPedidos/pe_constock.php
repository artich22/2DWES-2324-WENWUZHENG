<?php
$cookie_name="admin";
if(!isset($_COOKIE[$cookie_name])) {
     header('LOCATION: logout.php');
} else {

}
session_start();
include 'funciones.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav select {
            margin-right: 10px;
            padding: 5px;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .product img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 10px;
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
        .container{
            width: 660%;
            
        }
        fieldset{
            height: 100px;
        }
        #cantidad{
            width: 50px;
        }
        main select {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        main {
            text-align: center;
        }
        a {
            text-decoration: none; 
            color: white;
        }
    </style>
</head>
<body>
    
<header>
    <a href="pe_consultas.php" >
        <h1>Tienda online</h1>
    </a>
    <nav>
        <button onclick="redirigir()">Inicio</button>
        <button onclick="cerrarSesion()">Cerrar Sesión</button>
    </nav>
    <script>
        function redirigir() {
            window.location.href = 'pe_consultas.php';
        }
        function cerrarSesion() {
            alert("Sesión cerrada");
            window.location.href = 'logout.php';
        }

        function agregarAlCarrito() {
            alert("Producto agregado al carrito");

        }
    </script>
</header>

<main>
<form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
        /*SELECTs - mysql PDO*/


        try {
            $conn =conexion();
            $stmt = $conn->prepare("SELECT DISTINCT productLine FROM products");
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<select name='codigo_prod' id='codigo_prod'>";
            foreach($resultado as $llave){
                $value=$llave['productLine'];
                $guardarnombre=$llave['productLine'];
                    echo '<option value ='.$value.'>'.$guardarnombre.'<br>';
                        
                
                
            }

            echo "</select><br><br>";
            
        }
        catch(PDOException $e) {
            echo "Error nigga: " . $e->getMessage();
        }
        $conn = null;

    ?>

    <input type="submit" value="Buscar" name="buscar">  
    </form>
    <?php
    function limpiar($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['buscar'])) {
        $productcode=limpiar($_POST['codigo_prod']);
                var_dump($productcode);


        try {
            $conn =conexion();
            $stmt = $conn->prepare("SELECT SUM(quantityInStock)  FROM products where productLine = :productLine");
            $stmt->bindParam(':productLine', $productcode);
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo'<div class="product">';
            ?>
            
            <?php
                echo'<fieldset class="container"><br>';
                    echo'<strong>Stock:</strong>'.$resultado[0]['SUM(quantityInStock)'].'<br><br>';
                echo'</fieldset>';
            echo'</div>';
            
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
    }
    }
    ?>  

</main>

<footer>
    &copy; 2024 Tienda Online
</footer>


</body>
</html>
