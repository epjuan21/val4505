<?php
    require_once("clases/class.Session.php");
    $sesion = new sesion();
    $usuario = $sesion->get("usuario");
?>
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
    <body class="flex-body">

        <header>

            <div class="logo">Val 4505</div>

            <nav>
                <ul class="menu">
                    <li><a href="">Importar</a></li>
                    <li><a href="">Corregir</a></li>
                    <li><a href="">Exportar</a></li>
                    <li><a href="">Parametros</a></li>
                </ul>
        </nav>


        </header>

        <div class="container">


            <div class="main">

                <div class="opcion">
                    Opcion 1
                </div>


                <div class="opcion">
                    Opcion 1
                </div>

                <div class="opcion">
                    Opcion 1
                </div>

            </div>

        </div>



        <footer>

            <div class="footer-usuario">

                Usuario:  <?php echo $sesion->get("usuario"); ?> <button class="btn btn-default" ><a href="modulos/module.CerrarSesion.php"> Cerrar Sesion </a></button>

            </div>

            <div class="footer-derechos">
                
                Desarrollado y Diseñado por Juan Fernando Ramírez Vélez

            </div>


        </footer>

    </body>
</html>
