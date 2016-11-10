<?php
error_reporting(E_ALL);
$root = $_SERVER['DOCUMENT_ROOT'];
if ($root == "C:/wamp/www/") 
{
	$path = "val4505/dist/modulos/";

} 
else if ($root == "C:/wamp64/www")
{
    $path = "/val4505/dist/modulos/";
}
else if ($root == "/var/www/html/val4505/dist")
{
	$path = "/modulos/";
}


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
?>