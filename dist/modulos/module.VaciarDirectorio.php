<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$path = "Val4505/dist/modulos/";
echo $root.$path;
echo "<br>";
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

header ("Location: ../inicio.php?menu=6");

?>