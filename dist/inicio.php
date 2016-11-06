<?php
    date_default_timezone_set('America/Bogota');
    
    require_once("modulos/module.LeerArchivos.php");
    require_once("modulos/module.ManejoFechas.php");

    require_once("clases/class.Session.php");
    require_once ("clases/class.rped.php");
    require_once ("clases/class.Menu.php");
    require_once ("clases/class.Entidad.php");
    require_once ("clases/class.Municipio.php");
    require_once ("clases/class.Errores.php");


    $objEntidad = new Entidad();

    $sesion = new sesion();
    $usuario = $sesion->get("usuario");

   
    $menu = new Menu();
    if (isset($_GET['menu'])){
        $id = $menu->getMenu($_GET['menu']);
    }

    $list_enti = $objEntidad->getEntidades();
    $ListEnt = $objEntidad->getListEnt($sesion->get("idUsuario"));

    if (isset($_GET['CodEPS'])){
        $Ent = $objEntidad->getEntidadId($_GET['CodEPS']);
    }

    
    $municipio = new Municipio();
    $list_mun = $municipio->getMunicipios();

    
    $Objrped = new rped();
    $regEnt = $Objrped->getRegByEnt();
    

    if( $usuario == false )
    {   
        $sesion->termina_sesion();  
        header("Location: ../index.php");
    }

?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <link rel="stylesheet" href="./css/style.css">
        <script src="https://code.jquery.com/jquery.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.css">
        <title>Val4505</title>
        <meta name="description" content="Validador Resolución4505">
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body class="flex-body">

	<header>

            <div class="logo"><a href="inicio.php">Val 4505</a></div>

            <nav role="navigation">
                <ul class="menu">
                    <li><a href="?menu=6">Importar</a></li>
                    <li><a href="modulos/module.Dump.php">Corregir</a></li>
                    <li><a href="?menu=7">Exportar</a></li>
                    <li><a href="?menu=2">Parametros</a></li>
                </ul>
        </nav>

        </header>

        <div class="container">

                <?php
                    if (!empty($_GET["menu"]))
                    {
                        for ($i=0;$i<sizeof($id);$i++)
                        {
                        include ($id["$i"]["MENU_HTML"].".php");
                        }
                    }
                    else
                    {
                        //include ("inicio.php");
                    }
                ?>                

        </div>

        <footer>

            <div class="footer-usuario">

                Usuario:  <?php echo $sesion->get("usuario");?> <button class="btn btn-default" ><a href="modulos/module.CerrarSesion.php"> Cerrar Sesion </a></button>

            </div>

            <div class="footer-derechos">
                
                Desarrollado y Diseñado por Juan Fernando Ramírez Vélez

            </div>

        </footer>
    
    <script src="js/bundle.js"></script>
    
    </body>
    
</html>
