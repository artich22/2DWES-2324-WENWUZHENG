<?php

session_start();

	// Se incluye la librería
	include 'apiRedsys.php';
	// Se crea Objeto
	$miObj = new RedsysAPI;

	// Valores de entrada que no hemos cmbiado para ningun ejemplo
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	$url="http://wenwu.atwebpages.com/WebPedidos/compra.php";
	$urlOKKO="http://wenwu.atwebpages.com/WebPedidos/pagoDenegado.php";
	$id=$_SESSION['sesion'];
	$amount=$_SESSION['precio']*100;	
	
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
	$miObj->setParameter("DS_MERCHANT_URLOK",$url);
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

	//Datos de configuración
	$version="HMAC_SHA256_V1";
	$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
	// Se generan los parámetros de la petición
	$request = "";
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($kc);

 
	echo "<form name='frm' action='https://sis-t.redsys.es:25443/sis/realizarPago' method='POST' target='_blank'>
		<input type='hidden' name='Ds_SignatureVersion' value='$version'/>
		<input type='hidden' name='Ds_MerchantParameters' value='$params'/>
		<input type='hidden' name='Ds_Signature' value='$signature'/>
		</form>
		<script language='JavaScript'>
		document.frm.submit();
		</script>"
?>
<html lang="es">
<head>
	<style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        #miDiv {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
			font-size: 24px;
        }
    </style>
</head>
<body>
<div id="miDiv">
    <p>Cargado pago...</p>
</div>
</body>
</html>
