<?php
	require_once("../clases/class.Session.php");
	
	$sesion = new sesion();
	$usuario = $sesion->get("usuario");	
	if( $usuario == false )
	{	
		header("Location: ../index.php");
	}
	else 
	{
		$usuario = $sesion->get("usuario");	
		$sesion->termina_sesion();	
		header("location: ../index.php");
	}
?>