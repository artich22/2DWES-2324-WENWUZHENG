<?php
$cookie_name="usuario";
if(!isset($_COOKIE[$cookie_name])) {
     header('LOCATION: logout.php');
} else {

}
session_start();
include 'funciones.php';
        function limpiar($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
            $check = limpiar($_POST['check']);
            $pattern = "/[A-Za-z]{2}[0-9]{5}/i";
            if (!preg_match($pattern, $check)) {
                echo'<script type="text/javascript">
                            alert("Ponga otra Check Number que no exista.");
                            window.location.href="pe_pago.php";
                            </script>';
                            exit();
            }
            if (!isset($_SESSION['precio'])) {
                echo'<script type="text/javascript">
                            alert("No hay nada que pagar.");
                            window.location.href="pe_pago.php";
                            </script>';
                            exit();
            }
            try {
                $conn =conexion();

                $stmt = $conn->prepare("SELECT checkNumber FROM payments ");
                $stmt->execute();
                $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultado as $id ) {
                    if($check==$id['checkNumber']){
                        echo'<script type="text/javascript">
                            alert("Ponga otra Check Number que no exista.");
                            window.location.href="pe_pago.php";
                            </script>';
                            exit();
                    };
                }

                $_SESSION['sesion']=$check;
                
                header('Location: pe_pasarela.php');
                
                
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $conn = null;
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

        .payment-box {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .payment-box input {
            width: 92%;
            padding: 10px;
            margin-bottom: 10px;
        }

        #pago {
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header>
    <h1>Cesta de Compras</h1>
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
    </script>
</header>

<main>
    <div class="payment-box">
        <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <label for="check">Check Number:</label>
            <input type="text" id="check" name="check" placeholder="Ej:AA99999">
            <?php
            
                if (isset($_SESSION['precio'])) {
                    echo '<strong>Precio total: </strong>'.$_SESSION['precio'].'$<br><br>';
                }else{
                    echo '<strong>Precio total: </strong>0$<br><br>';
                }
                
                    
            ?>
            <input type="submit" name="pago" value="Pagar" id='pago'>
        </form>
    </div>
    
</main>

</body>
</html>
