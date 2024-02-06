<?php
$cookie_name="usuario";
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
            width: 96.5%;
            
        }
        fieldset{
            height: 230px;
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
    <a href="pe_inicio.php" >
        <h1>Tienda online</h1>
    </a>
    <nav>
        <button onclick="redirigir()">Cesta</button>
        <button onclick="cerrarSesion()">Cerrar Sesión</button>
    </nav>
    <script>
        function redirigir() {
            window.location.href = 'pe_cesta.php';
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
            $stmt = $conn->prepare("SELECT productCode, productName, productDescription,quantityInStock  FROM products");
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<select name='codigo_prod' id='codigo_prod'>";
            foreach($resultado as $llave){
                $value=$llave['productCode'];
                $descripcion= $llave['productDescription'];
                $guardarnombre=$llave['productName'];
                if ($llave['quantityInStock']>0) {
                    echo '<option value ='.$value.'>'.$guardarnombre.'<br>';
                }
                        
                
                
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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['buscar'])) {
        $productcode=limpiar($_POST['codigo_prod']);


        try {
            $conn =conexion();
            $stmt = $conn->prepare("SELECT productCode, productName, productDescription, buyPrice,quantityInStock  FROM products where productCode = :productCode");
            $stmt->bindParam(':productCode', $productcode);
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo'<div class="product">';
            ?>
            
            <form name="cdpto" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" value="<?=$resultado[0]['productCode']?>" name="id">
            <?php
                echo'<fieldset class="container"><br>';
                    echo '<strong>Descripcion:</strong><br>';
                    echo'<p>'.$resultado[0]['productDescription'].'</p>';
                    echo'<strong>Cantidad:</strong><input type="number" name="cantidad" value="1" min="1" max="'.$resultado[0]['quantityInStock'].'" id="cantidad"><strong>Stock:</strong>'.$resultado[0]['quantityInStock'].'<br><br>';
                    echo'<strong>Precio:</strong>'.$resultado[0]['buyPrice'];
                    echo'<br><br><input type="submit" value="Agregar al carrito" name="agregar" onclick="agregarAlCarrito()">';
                echo'</fieldset>';
            echo'</form>';
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

<?php
function limpiar($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['agregar'])) {
        $id = limpiar($_POST['id']);
        $cantidad = limpiar($_POST['cantidad']);

        if(isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] += $cantidad;
        } else {
            $_SESSION['carrito'][$id] = $cantidad;
        }
    }
    
}
?>

</body>
</html>
