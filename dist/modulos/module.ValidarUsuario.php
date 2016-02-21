<?php
require_once("../clases/class.Session.php");
    $sesion = new sesion();
require_once ("../clases/class.Usuarios.php");
    $objUsuario = new Usuarios();
        $Usuario = $objUsuario->validar_usuario($_POST["user"],$_POST["pass"]);
    
if( isset($_POST["ingresar"]) )
{
    $usuario = $_POST["user"];
    $password = $_POST["pass"];
    
    if($Usuario)
    {           
        $sesion->set("usuario",$usuario);
        
        header("location: ../inicio.php");
    }
    else 
    {
        echo "Verifica tu nombre de usuario y contraseña";
    }
}



?>