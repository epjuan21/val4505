<div class="import-container">
	
	<div class="import-box">
		
		<div class="param-title">
			Importar Archivo 4505
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
	
				<input type="file" name="upload" id="upload" class="upload" ></input>
				
				<input type="submit" class="btn btn-primary btn-large" name="grabar-entidad" value="Subir" />

			</form>

			<?php
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
			?>

		</div>

	</div>

	<div class="import-box">
		
		<div class="param-title">
			Archivos en el Directorio
		</div>

		<div class="param-content">
			
			<?php
			$ruta = "./Uploads/";
			echo leer_archivos_y_directorios($ruta);

			?>

			<div class="separatorControl">			

				<a class="btn btn-alert btn-large" href="modulos/module.VaciarDirectorio.php">Vaciar Directorio</a>

			</div>

		</div>

	</div>

</div>