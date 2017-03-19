<?php
require_once ("../clases/class.Municipio.php");
    $objMunicipio = new Municipio();
        $objMunicipio->updateMunicipio();
    
	header ("Location: ../inicio.php?menu=5"); 


?>