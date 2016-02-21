<?php
require_once ("../clases/class.Entidad.php");
    $objEntidad = new Entidad();
        $Entidad = $objEntidad->get_entidad_id($_POST["ent-cod"]);
    
if ($Entidad) {

    // Si la Entidad Existe Redirigir a page.Entidades.php
    header ("Location: ../inicio.php?menu=3&Estado=Warning");


} else {
    
    $grabar=$objEntidad->grabar_entidad();

    header ("Location: ../inicio.php?menu=3&Estado=Success"); 

}


?>