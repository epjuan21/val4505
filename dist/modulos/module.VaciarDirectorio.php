<?php
$ruta = "../Uploads/";
$handle = opendir($ruta); 

while ($file = readdir($handle))  
	{   
		if (is_file($ruta.$file)) 
			{ 
				unlink($ruta.$file); 
			}
	} 


header ("Location: ../inicio.php?menu=6");

?>