<?php
    require_once("../clases/class.Session.php");
    $sesion = new sesion();

    $IdUsuario = $sesion->get("idUsuario");
	$CodigoEntidad = $_POST['CodigoEntidad'];
	$CodigoMunicipio = $_POST['CodigoMunicipio'];
	$Periodo = $_POST['Periodo'];

	if (!$IdUsuario) {
		$sesion->termina_sesion();
	}

	function get_between($input, $start, $end) 
	{ 
	  $substr = substr($input, strlen($start)+strpos($input, $start), (strlen($input) - strpos($input, $end))*(-1)); 
	  return $substr; 
	}

    require_once ("../clases/class.Errores.php");
    $ObjErrores = new Errores();


	date_default_timezone_set('America/Bogota');

	// Definimos la Carpeta de Destino
	$carpetaDestino = "../Uploads/";

	// Si la Carpeta No Existe La Creamos
	if (!file_exists($carpetaDestino))
	{
		mkdir($carpetaDestino);
	}

	// Verificamos Que No Haya Errores
	if ($_FILES['upload']["error"] > 0)
	{
		// Si el Codigo del Error es 4 Significa
		// Error: 4 = UPLOAD_ERR_NO_FILE  = Valor: 4; No se subió ningún fichero.
		if ($_FILES['upload']['error'] == 4)
		{	
	    	header ("Location: ../inicio.php?menu=12&CodEPS=$CodigoEntidad&CodMun=$CodigoMunicipio&CodUs=$IdUsuario&Per=$Periodo&Estado=4");
	    	die();
		}

	}

	// Obtenemos el Tipo de Archivo Cargado

	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$fileContents = file_get_contents($_FILES['upload']['tmp_name']);
	$mimeType = $finfo->buffer($fileContents);

	// Si el Arcihvo Cargado es Diferente de text/plain o archivo de texto plano genera error y no continua con el codigo

	if ($mimeType != 'text/plain') 
	{
		header ("Location: ../inicio.php?menu=12&Estado=5");
    	die();
	}

	// Si El Archivo Existe Redirigir y Mostrar Error
	else if (file_exists($carpetaDestino . $_FILES['upload']['name']))
	{
    	header ("Location: ../inicio.php?menu=12&CodEPS=$CodigoEntidad&CodMun=$CodigoMunicipio&CodUs=$IdUsuario&Per=$Periodo&Estado=Warning");
    	die();
	}
	else 
	{

		// Movemos el Archivo Subido a la Carpeta Uploads del Servidor	
		move_uploaded_file($_FILES['upload']['tmp_name'],$carpetaDestino.$_FILES['upload']['name']);

		// Asignamos la ruta completa del archivo a una Variable
		$archivo = $carpetaDestino.$_FILES['upload']['name'];

		// Abrimos el Archivo Subido en Modo Lectura y lo Asignamos a una Variable
		$fp = fopen($archivo, "r");

		$now = new DateTime;
		$FechaRegistro = $now->format('Y-m-d H:i:s-U');		// Fecha Registro

		// Mientras no Sea el Final del Archivo
		while (!feof($fp))
		{
			$line = stream_get_line($fp, 1000000, "\n");
			$reg = explode("|", $line);

			// Si Hay Datos y Si es ECOOPSOS	
			if ($line && $CodigoEntidad == 'ESS091')
			{
				// Almacenamos en la variable $Cadena el texto de los Errores
				$Cadena = $reg[119];

				// Almacenamos el Número de Documento del Usuario
				$CodigoUsuario = $reg[4];

				// Almacenamos en la variable $AfiliadoNoExiste La Cadena que nos indica que el Afiliado no Existe
				$AfiliadoNoExiste = 'El afiliado no existe en la base de datos o sus datos no concuerdan con BDUA';
				// Almacenamos en la variable $AfiliadoValoresDiferentes La Cadena que indica que Los Valores Son Diferentes
				$AfiliadoValoresDiferentes = 'Afiliado con valores en Nombres y/o Apellidos y/o Fecha de nacimiento diferentes a BDUA';

				$pos = strpos($Cadena, $AfiliadoNoExiste);
				$posdos = strpos($Cadena, $AfiliadoValoresDiferentes);

				if ($pos !== false && $posdos !== false) {
					$Bandera = 1; // Si Bandera es 1 Se Encontraron Ambas Cadenas
				    //"Ambas cadenas Fueron Encontradas";

					// Afiliado con valores en Nombres y/o Apellidos y/o Fecha de nacimiento diferentes a BDUA

					$TipoError = 2;
					$MensajeError = substr($Cadena, 80,88);
					$Cadena = utf8_encode($Cadena);
					$Cadena = get_between($Cadena,'(',')');
					
					$ObjErrores->insertErrores(
					null
					,$CodigoUsuario
					,$CodigoEntidad
					,$TipoError
					,$Periodo
					,$CodigoMunicipio
					,$IdUsuario
					,$Cadena
					,$MensajeError
					);

				} else if ($pos !== false && $posdos === false) {
				    //"Se Econtró la Primera y La Segunda No";
					$Bandera = 2; // Si Bandera es 2 Se Encontro Una Cadena
					$TipoError = 1;
					$MensajeError = substr($Cadena, 1,80);

					if ($Bandera === 2 && $CodigoUsuario !='' && $CodigoEntidad !='') {

						$ObjErrores->insertErrores(
						null
						,$CodigoUsuario
						,$CodigoEntidad
						,$TipoError
						,$Periodo
						,$CodigoMunicipio
						,$IdUsuario
						,$Cadena
						,$MensajeError
						);
					}

				}

			// Si Hay Datos y Si es SAVIASALUD	
			} 
			else if ($line && $CodigoEntidad == 'EPSS40')
			{

				// Almacenamos el Dato Actual Que Contiene El Error
				
				if (array_key_exists(3, $reg)){
					$CadenaError = 	$reg[3];
				}


				if (array_key_exists(3, $reg)){
					$TextoError = 	$reg[2];
				}


				$CadenaError = mb_convert_encoding($CadenaError,"UTF-8","UCS-2");
				$TextoError = mb_convert_encoding($reg[2],"UTF-8","UCS-2")."<br>";

				// Cadena Buscada Para Numero de Documento
				$NumeroDoc = 'Numero Doc:';

				// Cadena Buscada Para Fecha de Nacimiento
				$DatoArchivo = 'Dato archivo';

				// Buscar Cadena de Numero de Documento
				$BuscarNumDoc = strpos($CadenaError, $NumeroDoc);

				// Buscar Cadena de Dato Archivo
				$BucarDatoArchivo = strpos($CadenaError, $DatoArchivo);


				if ($BuscarNumDoc !== false) // Si Es Verdadero Se Encontro la Cadena Numero Doc
				{

					$TipoError = 1;

					$CodigoUsuario = mb_substr($CadenaError, 12 ,mb_strlen($CadenaError),'UTF-8');

					$ObjErrores->insertErrores(
					null
					,$CodigoUsuario
					,$CodigoEntidad
					,$TipoError
					,$Periodo
					,$CodigoMunicipio
					,$IdUsuario
					,$CadenaError
					,$TextoError
					);

				}

			}
			
		}
		fclose($fp);
	}


// Codigo Para Vaciar la Carpeta Uploads
$carpetaDestino = "../Uploads/";
$handle = opendir($carpetaDestino); 

while ($file = readdir($handle))  
	{   
		if (is_file($carpetaDestino.$file)) 
			{ 
				unlink($carpetaDestino.$file); 
			}
	} 

header("Location: ../inicio.php?menu=12&CodEPS=$CodigoEntidad&CodMun=$CodigoMunicipio&CodUs=$IdUsuario&Per=$Periodo");

?>
