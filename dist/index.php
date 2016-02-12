<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/style.css">
        <title></title>
        <meta name="description" content="Validador Resolución 4505">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>

    <div class="login-container">

        <div class="form-container">
            
            <form name="frmLogin" action="modulos/module.ValidarUsuario.php" method="POST">

                <input type="text" name="user" class="login-input" placeholder="Usuario"/>
                <input type="password" name="pass" class="login-input" placeholder="Contraseña"/>
                <input type="submit" class="login-submit" name="ingresar" value="Ingresar" />

            </form>


        </div>        

    </div>


    </body>
</html>