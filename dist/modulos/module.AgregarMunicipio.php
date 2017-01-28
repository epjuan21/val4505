<?php
	require_once ("../clases/class.Municipio.php");
	    $objMunicipio = new Municipio();
	        $Municipio = $objMunicipio->getEntidadId($_POST["ent-cod"]);
	    
	if ($Municipio) {

	    // Si la Entidad Existe Redirigir a page.Entidades.php
	    header ("Location: ../inicio.php?menu=5&Estado=Warning");


	} else {
	    
	    $grabar=$objMunicipio->insertMunicipio();

	    header ("Location: ../inicio.php?menu=5&Estado=Success"); 

	}

?>