<?php
session_start();

include 'funciones.php'; 
        try {
            $conn =conexion();
            $conn->beginTransaction();
            $stmt = $conn->prepare("SELECT productCode, quantityInStock, productName  FROM products");
            $stmt->execute();
            $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
                $cuentapalabras=0;
                $cookie_name ="usuario";
                $customNumber = $_COOKIE[$cookie_name];

            $Productosfaltantes= '';
        if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $id => $cantidad) {
                foreach($resultado as $prueba){
                    if ($prueba['productCode']==$id) {
                    $validar=$prueba['quantityInStock']-$cantidad;
                    if ($validar<0) {
                        $Productosfaltantes.=$prueba['productName'].' ';
                            $cuentapalabras++;
                    }}
            

            
        }}}

        if ($cuentapalabras > 0) {
            echo '<script language="javascript">alert("No hay stock suficiente de ', implode(', ', $Productosfaltantes), '");</script>';
            header('Location: pe_cesta.php');
        }
    		$fecha = date("Y-m-d");
                
            $stmt3 = $conn->prepare("SELECT MAX(orderNumber) FROM orders");
            $stmt3->execute();
            $numeroorden = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                
                $numerito=$numeroorden[0]['MAX(orderNumber)']+1;
    
            $stmt = $conn->prepare("INSERT INTO orders (orderNumber, orderDate, requiredDate, status, customerNumber, comments) VALUES (:orderNumber, :orderDate, :requiredDate, :status, :customerNumber, :comments)");
            $stmt->bindParam(':orderNumber', $numerito);
            $stmt->bindParam(':orderDate', $fecha);
            $stmt->bindParam(':requiredDate', $fecha);
            $stmt->bindValue(':status', 'En proceso'); // Valor fijo 'En proceso'
            $stmt->bindParam(':customerNumber', $customNumber);
            $stmt->bindValue(':comments', 'No hay'); // Valor fijo 'No hay'
            $stmt->execute();

                
                
            $stmt = $conn->prepare("SELECT productCode, buyPrice FROM products");
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $contador = 1;

            if (isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])) {
                foreach ($_SESSION['carrito'] as $id => $cantidad) {
                    foreach ($resultado as $prueba) {
                        if ($prueba['productCode'] == $id) {
                            $producto_precio = $prueba['buyPrice'];
                            $producto_codigo = $prueba['productCode'];
                            $stmt = $conn->prepare("INSERT INTO orderdetails (orderNumber, productCode, quantityOrdered, priceEach, orderLineNumber) VALUES (:orderNumber, :productCode, :quantityOrdered, :priceEach, :orderLineNumber)");
                            $stmt->bindParam(':orderNumber', $numerito);
                            $stmt->bindParam(':productCode', $producto_codigo);
                            $stmt->bindParam(':quantityOrdered', $cantidad);
                            $stmt->bindParam(':priceEach', $producto_precio);
                            $stmt->bindParam(':orderLineNumber', $contador);
                            $stmt->execute();

                            // Actualizar quantityInStock en la tabla products
                            $stmt = $conn->prepare("UPDATE products SET quantityInStock = quantityInStock - :quantityOrdered WHERE productCode = :productCode");
                            $stmt->bindParam(':quantityOrdered', $cantidad);
                            $stmt->bindParam(':productCode', $producto_codigo);
                            $stmt->execute();

                            $contador++;
                        }
                    }
                }
    

                $stmt2 = $conn->prepare("INSERT INTO payments (customerNumber,checkNumber,paymentDate,amount) VALUES 
                (:customerNumber,:checkNumber,:paymentDate, :amount)");
                $stmt2->bindParam(':customerNumber', $customNumber);
                $stmt2->bindParam(':checkNumber', $_SESSION['sesion']);
                $stmt2->bindParam(':paymentDate', $fecha);
                $stmt2->bindParam(':amount', $_SESSION['precio']);
                $stmt2->execute();

        
    
    
        
            $conn->commit();
    }}
        catch(PDOException $e) {
            $conn->rollBack();
            echo "Error: " . $e->getMessage();
        }
        $conn = null;
		echo '<script>window.location.href = "factura.php";</script>';
?>
