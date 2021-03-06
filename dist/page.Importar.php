<!-- Menú Importar -->

<div class="column-container">
	
	<div class="box box-middle">
		
		<div class="head-container">
			<div class="head-icon">
				<i class="fa fa fa-upload fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					Importar Archivo 4505
				</div>

				<div class="subtitle">
					
				</div>

			</div>

		</div>

		<div class="param-content">
			
			<form action="modulos/module.Importar4505.php" method="POST" enctype="multipart/form-data" class="form">
				
				<div class="control-group">
					<label class="labelMun" for="MunicipioReporte">Municipio</label>
					<select class="selectMun" name="MunicipioReporte" id="MunicipioReporte">
						<?php
						for ($i=0;$i<sizeof($list_mun);$i++)
						{	
						?>
						<option value="<?php echo $list_mun[$i]["MUN_ID"];?>"><?php echo $list_mun[$i]["MUN_NAME"];?></option>
						<?php
						}
						?>
					</select>	
				</div>
	
				
				<div class="file-upload">
					<div class="file-select">
				    	<div class="file-select-button" id="fileName">ARCHIVO</div>
				    	<div class="file-select-name" id="noFile">Ningún Archivo Seleccionado...</div> 
				    	<input type="file" name="upload" id="chooseFile">
					</div>
				</div>			

				
				<input type="submit" class="btn btn-primary btn-large" name="grabar-entidad" value="Subir" />

			</form>
			
			<?php
			// MENSAJE DE ERRORES
			if (isset($_GET["Estado"]) && $_GET["Estado"] == "Warning")
			{
			?>
			<div class="alert alert--dismissible alert--warning" role="alert">
				
				 <strong>Warning!</strong> El Archivo Ya Existe

			</div>
			<?php
			} else if (isset($_GET["Estado"]) && $_GET["Estado"] == "Success")
			{
			?>
			<div class="alert alert--dismissible alert--success" role="alert">
				
				<strong>Success!</strong> Archivo Subido con Éxito

			</div>
			<?php
			}
			else if (isset($_GET["Estado"]) && $_GET["Estado"] == "4")
			{
			?>	
			<div class="alert alert--dismissible alert--warning" role="alert">
				
				 <strong>Warning!</strong> Ningún Archivo Seleccionado

			</div>
			<?php
			}
			else if (isset($_GET["Estado"]) && $_GET["Estado"] == "5")
			{
			?>
			<div class="alert alert--dismissible alert--warning" role="alert">
				
				 <strong>Warning!</strong> Solo se permiten archivos de texto

			</div>
			<?php
			}
			?>

		</div>

	</div>

	<div class="box box-middle">
		
		<div class="head-container">
			<div class="head-icon">
				<i class="fa fa-table fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					Importados Recientemente
				</div>


			</div>

		</div>

		<div class="param-content">

			<?php
			for ($i=0;$i<sizeof($regEnt);$i++)
			{
			?>

			<div class="wid1">

				<div class="wid1__left">
					<i class="fa fa-database fa-2x" aria-hidden="true"></i>
				</div>

				<div class="wid1__right">
					
					<div class="wid1__cont">
							
							<div class="wid1__title">
								<a href="inicio.php?menu=11&CodEPS=<?php echo $regEnt[$i]['CodigoEntidad'];?>&CodMun=<?php echo $regEnt[$i]['CodigoMunicipio'];?>">
									<?php echo $regEnt[$i]["Entidad"];?>
								</a>
								
							</div>

							<div class="wid1__subtitle">
								<a href="?menu=12&CodEPS=<?php echo $regEnt[$i]['CodigoEntidad'];?>&CodMun=<?php echo $regEnt[$i]['CodigoMunicipio'];?>&CodUs=<?php echo $sesion->get('idUsuario');?>&Per=<?php echo $regEnt[$i]['FechaFinalReg'];?>">
									<?php echo $regEnt[$i]["Periodo"]." ".$regEnt[$i]["Año"]; ?>
								</a>
							</div>

					</div>

					<div class="wid1__detail"><?php echo $regEnt[$i]["Registros"];?></div>

				</div>
				
			</div>

			<?php
			}
			?>	

		</div>

	</div>


</div>