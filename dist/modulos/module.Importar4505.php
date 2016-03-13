<?php


	// Definimos la Carpeta de Destino
	$carpetaDestino = "../Uploads/";

	if ($_FILES['upload']["error"] > 0)
	{
		// Error: 4 = UPLOAD_ERR_NO_FILE  = Valor: 4; No se subió ningún fichero.	
		if ($_FILES['upload']['error'] == 4)
		{
	    	header ("Location: ../inicio.php?menu=6&Estado=4");
	    	die();
		}

	}
	else if (file_exists($carpetaDestino . $_FILES['upload']['name']))
	{
		// Si El Archivo Existe Redirigir y Mostrar Error
    	header ("Location: ../inicio.php?menu=6&Estado=Warning");
    	die();
	}
	else 
	{
	move_uploaded_file($_FILES['upload']['tmp_name'],$carpetaDestino.$_FILES['upload']['name']);


	header ("Location: ../inicio.php?menu=6&Estado=Success");
	}
	
	$archivo = $_FILES['upload']['name'];


?>