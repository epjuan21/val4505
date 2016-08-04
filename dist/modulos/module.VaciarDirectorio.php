<?php
error_reporting(E_ALL ^ E_WARNING );
$root = $_SERVER['DOCUMENT_ROOT'];
$path = "val4505/dist/modulos/";
$dir = opendir($root.$path);

$finfo = new finfo(FILEINFO_MIME_TYPE);

while ($file = readdir($dir)) {
    if ($file == '.' || $file == '..') {
        continue;

    }
    $fileContents = file_get_contents($root.$path.$file);
    $mimeType = $finfo->buffer($fileContents);
    if (is_file($root.$path.$file) && $mimeType == 'text/plain') 
	{ 
		unlink($root.$path.$file); 
	}
}
closedir($dir);

//header ("Location: ../inicio.php?menu=6");

?>