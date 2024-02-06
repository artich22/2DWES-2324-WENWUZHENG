<?php
include 'funciones.php';
$cookie_name="usuario";
if(!isset($_COOKIE[$cookie_name])) {
     header('LOCATION: logout.php');
}
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
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

        nav button {
            margin-right: 10px;
            padding: 5px;
        }
        main {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .white-box {
            width: 800px;
            height: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .white-box h2{
            text-align: center;
        }
        .product-input {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .product-input .uno {
            grid-column: span 2;
        }
        .product-input .uno p,.product-input .dos p
        ,.product-input .tres p
        {
            margin-left: 20px;
            text-align: left;
        }

        .product-input strong {
            display: block;
            margin-bottom: 5px;
        }

        .product-input p {
            text-align: center;
            margin: 0;
        }


        .invoice-header {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
            margin-left: 20px;
        }

        .invoice-header strong {
            display: block;
            margin-bottom: 5px;
        }
        .precio{
            text-align:right;
        }

    </style>
</head>
<body>
<header>
    <h1>Factura</h1>
    <nav>
        <button onclick="pagoTerminado()">Tienda</button>
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
        function pagoTerminado() {
            window.location.href = 'compracabada.php';
        }
    </script>
</header>

<main>
    <div class="white-box">
        <h2>Factura</h2>
        <?php
        try {
            $conn =conexion();
            
            $stmt = $conn->prepare("SELECT customerName, contactLastName, contactFirstName, phone, addrebLine1, city, postalCode, country  FROM customers where customerNumber = :customerNumber");
            $stmt -> bindParam(':customerNumber',$_COOKIE[$cookie_name]);
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="invoice-header">
                <div>
                    <strong>Nombre:</strong>
                    <p><?=$resultado[0]['customerName']?></p>
                </div>
            
                <div>
                    <strong>Dirección de Envío:</strong>
                    <p><?=$resultado[0]['addrebLine1']?></p>
                </div>
            
                <div>
                    <strong>Número de Teléfono:</strong>
                    <p><?=$resultado[0]['phone']?></p>
                </div>
            
                <div>
                    <strong>Ciudad:</strong>
                    <p><?=$resultado[0]['city']?></p>
                </div>
            
                <div>
                    <strong>Código Postal:</strong>
                    <p><?=$resultado[0]['postalCode']?></p>
                </div>
            
                <div>
                    <strong>País:</strong>
                    <p><?=$resultado[0]['country']?></p>
                </div>
            </div>
        


            <?php 
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>


        <h2> Productos </h2>
        <?php
        try {
            $conn =conexion();
            $stmt = $conn->prepare("SELECT productCode, productName, buyPrice  FROM products");
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $preciototal=0;
            $contador=1;
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                foreach($resultado as $prueba){
                    if ($id==$prueba['productCode']) {
                        $productnombre = $prueba['productName'];
                        $productPrecio = $prueba['buyPrice'];

                        ?>
                        <div class="product-input">
                    <div class="uno">
                            <strong>Nombre del Producto:</strong>
                            <p><?=$productnombre?></p>
                    </div>
                        <div class="dos">
                            <strong>Precio:</strong>
                            <p><?=$productPrecio?>€</p>
                    </div>
                    <div class="tres">
                            <strong>Cantidad:</strong>
                            <p><?=$cantidad?> uds.</p>
                    </div>
                        </div>

                    
                            

                        <?php
                        $preciototal += $productPrecio * $cantidad;
                    }
        }}}
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        ?>
        <p>------------------------------------------------------------------------------------------------------------------------------------------------------</p>

        <div class="precio">
            <strong> Precio Total:</strong>
            <p><?=$preciototal?>€</p>
        </div>
    </div>
</main>
<button onclick="pagoTerminado()">Salir</button>
</body>
</html>
