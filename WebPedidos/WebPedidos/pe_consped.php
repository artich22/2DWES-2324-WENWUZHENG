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

        nav button {
            margin-right: 10px;
            padding: 5px;
        }
        main {
            display: flex;
            height: 100vh;

        }

        .payment-box {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-content: center;
            align-items: center;
        }

        .payment-box input {
            width: 92%;
            padding: 10px;
            margin-bottom: 10px;
        }

        #buttonsearch {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<header>
    <h1>Consulta</h1>
    <nav>
        <button onclick="redirigir()">Inicio</button>
        <button onclick="cerrarSesion()">Cerrar Sesion</button>
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
            alert("Producto borrado del carrito");
        }
        function realizarCompra() {
            alert("Realizando compra...");
            window.location.href = 'compra.php';
        }
    </script>
</header>

<main>
    <div class="payment-box">
    <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="search">Busqueda:</label>
        <input type="text" id="search" name="search" placeholder="Customers Number">
        <input type="submit" name="buttonsearch" value="Buscar" id='buttonsearch'>
    </form>
    </div>
    <table>
        <thead>
            <tr>
                <th>Customer Number</th>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Order Line Number</th>
                <th>Product Name</th>
                <th>Quantity Ordered</th>
                <th>Price Each</th>
            </tr>
        </thead>
        <tbody>
            <?php
            function limpiar($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    
                    $customerNumber= limpiar($_POST['search']);
                try {
                    $conn =conexion();
                    $stmt = $conn->prepare("SELECT customerNumber, orderNumber, orderDate,status  FROM orders where customerNumber = :customerNumber");
                    $stmt->bindParam(':customerNumber', $customerNumber);
                    $stmt->execute();
                    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($resultado as $key) {
                        echo '<tr>';
                        echo '<td>'.$key['customerNumber'].'</td>';
                        echo '<td>'.$key['orderNumber'].'</td>';
                        echo '<td>'.$key['orderDate'].'</td>';
                        echo '<td>'.$key['status'].'</td>';
                        $stmt1 = $conn->prepare("SELECT orderLineNumber, productCode, quantityOrdered, priceEach  FROM orderdetails where orderNumber = :orderNumber order by orderLineNumber ASC");
                        $stmt1->bindParam(':orderNumber', $key['orderNumber']);
                        $stmt1->execute();
                        $consulta=$stmt1->fetchAll(PDO::FETCH_ASSOC);

                        if (count($consulta)>1) {
                            $contador=0;
                            foreach ($consulta as $prueba) {
                                if ($contador >=1) {
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                                    echo '<td></td>';
                                }
                                echo '<td>'.$prueba['orderLineNumber'].'</td>';
                                $stmt2 = $conn->prepare("SELECT  productName FROM products where productCode = :productCode");
                                $stmt2->bindParam(':productCode', $prueba['productCode']);
                                $stmt2->execute();
                                $otraconsulta=$stmt2->fetchAll(PDO::FETCH_ASSOC);
                                echo '<td>'.$otraconsulta[0]['productName'].'</td>';
                                echo '<td>'.$prueba['quantityOrdered'].'</td>';
                                echo '<td>'.$prueba['priceEach'].'</td>';
                                echo '</tr>';
                                $contador++;
                            }
                        }else{
                            echo '<td>'.$consulta[0]['orderLineNumber'].'</td>';
                            $stmt2 = $conn->prepare("SELECT  productName FROM products where productCode = :productCode");
                            $stmt2->bindParam(':productCode', $prueba['productCode']);
                            $stmt2->execute();
                            $otraconsulta=$stmt2->fetchAll(PDO::FETCH_ASSOC);
                            echo '<td>'.$otraconsulta[0]['productName'].'</td>';
                            echo '<td>'.$consulta[0]['quantityOrdered'].'</td>';
                            echo '<td>'.$consulta[0]['priceEach'].'</td>';
                        }
                        echo '</tr>';
                    }
                    
                }
                catch(PDOException $e) {
                    echo "Error nigga: " . $e->getMessage();
                }
                $conn = null;
            }
            ?>
        </tbody>
    </table>
</main>

</body>
</html>
