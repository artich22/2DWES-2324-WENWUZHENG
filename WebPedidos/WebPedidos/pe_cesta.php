<?php
$cookie_name="usuario";
if(!isset($_COOKIE[$cookie_name])) {
     header('LOCATION: logout.php');
} else {

}
session_start();
if(isset($_SESSION['precio'])) {
    $_SESSION['precio'] = 0;
}
include 'funciones.php';
function limpiar($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['modificarCarrito'])) {
            $productosEnCarrito = array_keys($_SESSION['carrito']);
            for ($i = 0; $i < count($productosEnCarrito); $i++) {
                $id = $productosEnCarrito[$i];
                $nuevaCantidad = limpiar($_POST[$id]);
    
                if ($nuevaCantidad >= 0) {
                    $_SESSION['carrito'][$id] = $nuevaCantidad;
                } else {
                    echo "Error: La cantidad no puede ser negativa.";
                }
            }
            header('Location: pe_cesta.php');
        }
        if (isset($_POST['borrarCarrito'])) {
            session_unset();
            session_destroy();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta de Compras</title>
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
            justify-content: space-between;
            align-items: center;
        }

        .product img {
            max-width: 50px;
            max-height: 50px;
            margin-right: 10px;
        }

        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            margin-top: 20px;
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
        <h1>Cesta de Compras</h1>
    </a>
    <nav>
        <button onclick="redirigir()">Tienda</button>
        <button onclick="cerrarSesion()">Cerrar Sesion</button>
    </nav>
    <script>
            function redirigir() {
                window.location.href = 'pe_altaped.php';
            }
            function cerrarSesion() {
                alert("Sesión cerrada");
                window.location.href = 'logout.php';
            }
            function agregarAlCarrito() {
                alert("Producto borrado del carrito");

            }
            function modificarCarrito() {
                alert("Modificando...");
                window.location.href = 'pe_cesta.php';

            }
            function realizarCompra() {
                alert("Realizando compra...");
                window.location.href = 'pe_pago.php';

            }
        </script>
</header>

<main>
    <form name='borrarCarritoForm' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php

        try {
            $conn =conexion();
            $stmt = $conn->prepare("SELECT productCode, productName, buyPrice  FROM products");
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $preciototal=0;
            $contador=1;

        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                foreach($resultado as $prueba){
                    if ($prueba['productCode']==$id) {
                        $producto_nombre = $prueba['productName'];
                        $producto_precio = $prueba['buyPrice'];
                        $preciototal = $producto_precio * $cantidad;
                        if(isset($_SESSION['precio'])) {
                            $_SESSION['precio'] += $preciototal;
                        } else {
                            $_SESSION['precio'] = $preciototal;
                        }
        ?>
                <div class="product">
                    <div>
                        <h2><?php echo $producto_nombre; ?></h2>
                        <?php
                            $stmt2 = $conn->prepare("SELECT quantityInStock  FROM products where productCode=:productCode");
                            $stmt2 -> BindParam(':productCode',$prueba['productCode']);
                            $stmt2->execute();
                            $consulta=$stmt2->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <p>Cantidad: <?php echo '<input type="number" id="'.$id.'" name="'.$id.'" min="0" max="'.$consulta[0]['quantityInStock'].'" Value="'.$cantidad.'">'; ?> (Stock Disponible:<?php echo $consulta[0]['quantityInStock'];
                        if ($cantidad>$consulta[0]['quantityInStock']) {
                            echo '<strong>&nbsp;Mas cantidad que en stock</strong>';
                        }
                        ?>)</p>
                        <p>Precio unitario: $<?php echo number_format($producto_precio, 2); ?></p>
                    </div>
                </div>
                
        <?php
                }
            

            
        }}
        ?>
        
        <input type="submit" value="Modificar carrito" name="modificarCarrito">
        <input type="submit" value="Borrar carrito" name="borrarCarrito" onclick="agregarAlCarrito()">
</form>
        <br><br>
        <button onclick="realizarCompra()">Realizar compra</button>
        
    <?php
    
    
    }
    else {
    ?>
        <div class="empty-cart">
            La cesta está vacía.
        </div>
    <?php
    }}
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>

</main>

</body>
</html>
