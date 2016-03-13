<div class="import-container">
	

	<div class="import-box">
		
		<div class="param-title">
			Importar Archivo 4505
		</div>

		<div class="param-content">
			
			<form action="modulos/module.Importar4505.php" method="POST" enctype="multipart/form-data" class="form">

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
				
				 <strong>Warning!</strong> Ningun Archivo Seleccionado

			</div>
			<?php
			}
			?>

		</div>

	</div>

</div>