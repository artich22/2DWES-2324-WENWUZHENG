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
    <strong>Fecha de inicio</strong>    
    <input type="date" name="fecha1">
    <br><br>
    <strong>Fecha Final</strong>    
    <input type="date" name="fecha2"><br>
    <br>

    <input type="submit" value="Buscar" name="buscar" id="buttonsearch">
    </form>
    </div>
    <table>
        <thead>
            <tr>
                <th colspan="2">Unidades vendidas entre estas fechas</th>
                </tr>
                <tr>
                <th>Nombre del Producto</th>
                <th>Cantidad</th>
            
            </tr>
        </thead>
        <tbody>
            
        
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $fecha1=$_POST['fecha1'];
                $fecha2=$_POST['fecha2'];
                if (!empty($fecha1)&&!empty($fecha2)) {
                
                try {
                    $conn =conexion();
                    $stmt = $conn->prepare("SELECT productCode, quantityOrdered from orderdetails where orderNumber IN
                                            (SELECT orderNumber  FROM orders where orderDate BETWEEN :fecha1 AND :fecha2)");
                    $stmt->bindParam(':fecha1', $fecha1);
                    $stmt->bindParam(':fecha2', $fecha2);
                    $stmt->execute();
                    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

                    $guardar=array();
                    
                    for ($i=0; $i < count($resultado); $i++) { 
                        if (!isset($guardar[$resultado[$i]['productCode']])) {
                            $guardar[$resultado[$i]['productCode']]=intval($resultado[$i]['quantityOrdered']);
                        }else{
                            $guardar[$resultado[$i]['productCode']]+=intval($resultado[$i]['quantityOrdered']);
                        }
                    }
                    foreach ($guardar as $key => $value) {
                        $stmt1 = $conn->prepare("SELECT productName from products where productCode= :productCode");
                        $stmt1->bindParam(':productCode', $key);
                        $stmt1->execute();
                        $nombre=$stmt1->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <tr>
                            <th><?=$nombre[0]['productName']?></th>
                            <th><?=$value?></th>
                        
                        </tr>
                        <?php
                    }
                    
                    
                    
                }
                catch(PDOException $e) {
                    echo "Error nigga: " . $e->getMessage();
                }
                $conn = null;
            }}else{
                
            }
            ?>
        </tbody>
    </table>
</main>

</body>
</html>
