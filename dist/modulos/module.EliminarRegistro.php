<?php
require_once ("../clases/class.rped.php");
$objRPED = new rped();

$objRPED->deleteRegistro($_GET["ID"]);
header ("Location: ../inicio.php?menu=6")
?>