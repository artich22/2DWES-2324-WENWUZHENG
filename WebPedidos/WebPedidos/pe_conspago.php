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
        .historico-total th {
            height: 25px;
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
            window.location.href = 'pe_inicio.php';
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
                <th colspan="2">Historial de pagos</th>
                </tr>
                <tr>
                <th>Fecha</th>
                <th>Pago</th>
            
            </tr>
        </thead>
        <tbody>
            
        
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                $fecha1=$_POST['fecha1'];
                $fecha2=$_POST['fecha2'];

                if ($fecha1!=''&&$fecha2!='') {
                
                try {
                    $conn =conexion();
                    $stmt = $conn->prepare("SELECT amount, paymentDate  FROM payments where paymentDate BETWEEN :fecha1 AND :fecha2 AND customerNumber =:customerNumber order by paymentDate ASC");
                    $stmt->bindParam(':fecha1', $fecha1);
                    $stmt->bindParam(':fecha2', $fecha2);
                    $stmt->bindParam(':customerNumber', $_COOKIE['usuario']);
                    $stmt->execute();
                    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

                    $guardar=array();
                    foreach ($resultado as $key) {
                        ?>
                        <tr>
                            <th><?=$key['paymentDate']?></th>
                            <th><?=$key['amount']?>€</th>
                        
                        </tr>
                        <?php
                    }
                    
                    
                    
                    
                }
                catch(PDOException $e) {
                    echo "Error nigga: " . $e->getMessage();
                }
                $conn = null;
            }else{
                try {
                    $conn =conexion();
                    $stmt = $conn->prepare("SELECT SUM(amount)  FROM payments where customerNumber =:customerNumber");
                    $stmt->bindParam(':customerNumber', $_COOKIE['usuario']);
                    $stmt->execute();
                    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);


                        ?>
                        <tr class="historico-total">
                            <th>Historico Total de Pagos</th>
                            <th><?=$resultado[0]['SUM(amount)']?>€</th>
                        
                        </tr>
                        <?php

                    
                    
                    
                    
                }
                catch(PDOException $e) {
                    echo "Error nigga: " . $e->getMessage();
                }
                $conn = null;
            }}
            ?>
        </tbody>
    </table>
</main>

</body>
</html>
