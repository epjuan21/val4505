<?php
require_once ("../clases/class.Entidad.php");
    $objEntidad = new Entidad();
        $objEntidad->updateEntidad();
    
	header ("Location: ../inicio.php?menu=3"); 


?>