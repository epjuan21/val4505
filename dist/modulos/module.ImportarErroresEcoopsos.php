<?php
    require_once("../clases/class.Session.php");
    require_once ("../clases/class.rped.php");

    $sesion = new sesion();
    $objRPED = new rped();

    $IdUsuario = $sesion->get("idUsuario");
	$CodigoEntidad = $_POST['CodigoEntidad'];
	$CodigoMunicipio = $_POST['CodigoMunicipio'];
	$Periodo = $_POST['Periodo'];

	$RegistrosNumerados = $objRPED->gerRegNum($IdUsuario, $CodigoMunicipio, $CodigoEntidad, $Periodo);

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

		$i = 0;

		// Mientras no Sea el Final del Archivo
		
		if ($CodigoEntidad == 'ESS091' || $CodigoEntidad == 'EPSS40' || $CodigoEntidad == 'EPS040') {
			
			while (!feof($fp))
			{
				$line = stream_get_line($fp, 1000000, "\n");
				$reg = explode("|", $line);
	
				// ECOOPOSOS
	
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
	
					if ($pos !== false && $posdos !== false) 
					{
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
	
					} 
					else if ($pos !== false && $posdos === false) 
					{
						//"Se Econtró la Primera y La Segunda No";
						$Bandera = 2; // Si Bandera es 2 Se Encontro Una Cadena
						$TipoError = 1;
						$MensajeError = substr($Cadena, 1,80);
	
						if ($Bandera === 2 && $CodigoUsuario !='' && $CodigoEntidad !='') 
						{
	
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
				} 
	
				// SAVIASALUD SUBSIDIADIO
	
				// Si Hay Datos y Si es SAVIASALUD SUBSIDIADO
				else if ($line && $CodigoEntidad == 'EPSS40')
				{
					// Almacenamos el Dato Actual Que Contiene El Error
					
					if (array_key_exists(3, $reg)){
						$CadenaError = 	$reg[3];
					}
	
					if (array_key_exists(3, $reg)){
						$TextoError = 	$reg[2];
					}
	
					if (array_key_exists(0, $reg)){
						$CadenaLinea = 	$reg[0];
					}
	
					$CadenaError = mb_convert_encoding($CadenaError,"UTF-8","UCS-2");
					$TextoError = mb_convert_encoding($TextoError,"UTF-8","UCS-2");
					$CadenaLinea = mb_convert_encoding($CadenaLinea,"UTF-8","UCS-2");
	
					// Cadena Buscada Para Numero de Documento
					$NumeroDoc = 'Numero Doc:';
	
					// Cadena Buscada Para Fecha de Nacimiento
					$DatoArchivo = 'Dato archivo';
	
					// Buscar Cadena de Numero de Documento
					$BuscarNumDoc = strpos($CadenaError, $NumeroDoc);
	
					// Buscar Cadena de Dato Archivo que Indica Fecha de Nacimiento Errada
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
					else if ($BucarDatoArchivo !== false) // Si Es Verdadero Se Encontro la Cadena Dato Archivo
					{
						
						$TipoError = 3;
	
						//var_dump($CadenaError);
						// Obtenemos El Primer Caracter de la Cadena Error
						$var = substr($CadenaError, 14, 1);
						
						//var_dump($var);
	
						// Si el Primer Caracter es Numerico Se Asume que es Una Fecha
						if (is_numeric($var)){
	
							$CadenaFecha = substr($CadenaError, 44, 10);
	
							//var_dump($CadenaFecha);
							//var_dump($CadenaLinea);
	
							$Year = substr($CadenaFecha, 6, 4);
							$Month = substr($CadenaFecha, 3, 2);
							$Day = substr($CadenaFecha, 0, 2);
	
							$FechaNueva = $Year."-".$Month."-".$Day;
	
							for ($i=1;$i<=sizeof($RegistrosNumerados);$i++) 
							{
								if ($i == $CadenaLinea){
									// Obtenemos el Numero de Documento del Usuairo Segun La Linea en el Archivo de Errores
									$CodigoUsuario = $RegistrosNumerados[$i-1]["NumeroIdUsuario"];
	
									$ObjErrores->insertErrores(
									null
									,$CodigoUsuario
									,$CodigoEntidad
									,$TipoError
									,$Periodo
									,$CodigoMunicipio
									,$IdUsuario
									,$FechaNueva
									,$TextoError
									);
								}
							}
						}
					}
				}
	
				// SAVIASALUD CONTRIBUTIVO
	
				// Si Hay Datos y Si es SAVIASALUD CONTRIBUTIVO
				else if ($line && $CodigoEntidad == 'EPS040')
				{
					// Almacenamos el Dato Actual Que Contiene El Error
					
					if (array_key_exists(3, $reg)){
						$CadenaError = 	$reg[3];
					}
	
					if (array_key_exists(3, $reg)){
						$TextoError = 	$reg[2];
					}
	
					if (array_key_exists(0, $reg)){
						$CadenaLinea = 	$reg[0];
					}
	
					$CadenaError = mb_convert_encoding($CadenaError,"UTF-8","UCS-2");
					$TextoError = mb_convert_encoding($TextoError,"UTF-8","UCS-2");
					$CadenaLinea = mb_convert_encoding($CadenaLinea,"UTF-8","UCS-2");
	
					// Cadena Buscada Para Numero de Documento
					$NumeroDoc = 'Numero Doc:';
	
					// Buscar Cadena de Numero de Documento
					$BuscarNumDoc = strpos($CadenaError, $NumeroDoc);
	
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

		}

		while (!feof($fp)) {
			// MEDIMAS
			if ($CodigoEntidad == 'EPS044' || $CodigoEntidad == 'EPSS45') {
				
				// Obtenemos la Linea
				$line = stream_get_line($fp, 1000000, "\n");

				// Obtenemos cada registro, para MEDIMAS, estan separados por Espacios
				$reg = explode(" ", $line);

				// Buscamos las linea que coincidan con los siguientes textos
				
					// Consecutivo: 59. Información reportada a tener en cuenta: CC-21552577
					// Consecutivo: 5. Información reportada a tener en cuenta: CC-3379764 Fch Afiliación: 2017-08-01 - Fch Retiro: 2019-07-31
					// Consecutivo: 240. Información reportada a tener en cuenta: Documento: 1033648531 - Sexo reportado: F - Sexo EPS: M

				// Los errores anteriores seran tratado como Tipo de Error 1: Usuarios que seran borrados de la base de datos
				
				// Buscamos el String Consecutivo
				/*
				if (array_key_exists(2, $reg)){
					$Consecutivo = 	$reg[2];
				}
				*/
				// Buscamos el String Con el Posible Número de Documento
				
				if (array_key_exists(10, $reg)){
					$NumeroDocumento = 	$reg[10];
					
					if (preg_match('/^(CC|TI|RC)/', $NumeroDocumento)) {
						$NumeroDocumento = substr($NumeroDocumento,3,strlen($NumeroDocumento));

						if ($NumeroDocumento !== false) // Si Es Verdadero Se Encontró el Número de Documento a Eliminar
						{
		
							$TipoError = 1;
							$CadenaError = "El usuario no se encontró en las bases de datos de Medimás";
							$TextoError = "El usuario no se encontró en las bases de datos de Medimás";
		
							$CodigoUsuario = trim($NumeroDocumento);
		
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
				
				// Buscamos el String Nacimiento
				if (array_key_exists(14, $reg)){
					$FechaNacimiento = 	$reg[14];

					if ($FechaNacimiento == "Nacimiento" ) {
						
						$FechaNueva = $reg[21];
						$TipoError = 3;
						$CodigoUsuario = $reg[11];
						$TextoError = "La fecha de nacimiento no coincide para el usuario";
						
						$ObjErrores->insertErrores(
							null
							,$CodigoUsuario
							,$CodigoEntidad
							,$TipoError
							,$Periodo
							,$CodigoMunicipio
							,$IdUsuario
							,$FechaNueva
							,$TextoError
							);
					}
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
