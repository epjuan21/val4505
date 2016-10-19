<?php
echo "prueba";
require_once("../clases/class.Session.php");
    $sesion = new sesion();
require_once ("../clases/class.Usuarios.php");
    $objUsuario = new Usuarios();
        $Usuario = $objUsuario->validar_usuario($_POST["user"],$_POST["pass"]);
        $UsuarioId =  $objUsuario->getUsuario($_POST["user"]);
        $UserId = $UsuarioId["0"]["USUARIO_ID"];
    
if( isset($_POST["ingresar"]) )
{
    $usuario = $_POST["user"];
    $password = $_POST["pass"];
    
    if($Usuario)
    {           
        $sesion->set("usuario",$usuario);
        $sesion->set("idUsuario",$UserId);
        
        header("location: ../inicio.php");
    }
    else 
    {
        header("location: ../index.php");
    }
}
?>