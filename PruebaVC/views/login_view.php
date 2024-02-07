<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botón Acceder</title>
    <style>
        .container {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 350px;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        fieldset {
            border: none;
        }
        fieldset > input{
            
            float: right;

        }
        input {
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form name='cdpto' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return validarFormulario()">
        <div class="container">
            <fieldset>
                Alta Clientes<br><br>
                <B>Usuario: </B><input type='text' name='USUARIO' value='' id= "usuario"size=25><br><br> 
                <B>Clave: </B><input type='password' name='CLAVE' id="clave"value='' size=25><br><br>
            </fieldset> 
            <input type="submit" value="Login" name="crear" > 
        </div>	
    </form>



    <script>
        function validarFormulario() {
            var usuario = document.getElementById('usuario').value;
            var clave = document.getElementById('clave').value;

            if (usuario === '' || clave === '') {
                alert('Por favor, complete todos los campos.');
                return false;
            }

            return true;
        }
    </script>
</body>
</html>