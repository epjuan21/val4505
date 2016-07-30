<?php

$IdUsuario = $_GET["IdUser"];
$CodigoMunicipio = $_GET["CodMun"];
$CodigoEntidad = $_GET["CodEnt"];
$FechaInicialReg = $_GET["FecIn"];
$FechaFinalReg = $_GET["FecFn"];

switch ($CodigoEntidad) {

	case 'EPSS40':
		$module = "module.valSaviaSalud";
		break;

	case 'ESS091':
		$module = "module.valEcoopsos";
		break;

	case 'EPS037':
		$module = "module.valNuevaEPS";
		break;

	case 'EPS003':
		$module = "module.valCafesalud";
		break;

	case 'EPSM03':
		$module = "module.valCafesalud";
		break;

	case '05091':
		$module = "module.valVinculados";
		break;

}

header ("Location: ../modulos/".$module.".php?IdU=$IdUsuario&CodM=$CodigoMunicipio&CodE=$CodigoEntidad&FIn=$FechaInicialReg&FFn=$FechaFinalReg");

?>