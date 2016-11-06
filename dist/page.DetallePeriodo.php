<div class="row-container">

	<div class="box box-middle">

		<div class="head-container">
			
			<div class="head-icon">
				<i class="fa fa fa-upload fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					<?php echo "Importar Archivo de Errores - ".$Ent[$i]["ENTIDAD_NAME"];?>
				</div>
				
				<?php
				$DetPer = $objEntidad->getListPeriodosId($_GET["CodEPS"],$sesion->get("idUsuario"),$_GET["CodMun"]);
				for ($i=0;$i<sizeof($DetPer);$i++)
				{		
				?>

				<div class="subtitle">
					<?php echo $DetPer[$i]["Periodo"]." ".$DetPer[$i]["Año"]." - ";?>
					<?php echo $DetPer[$i]["Registros"]. " Registros";?>
				</div>

				<?php
				}
				?>

			</div>

		</div>

		<div class="item-container-column">
			
			<form action="modulos/module.ImportarErroresEcoopsos.php" method="POST" enctype="multipart/form-data" class="form">
							
				<div class="file-upload">
					<div class="file-select">
				    	<div class="file-select-button" id="fileName">ARCHIVO</div>
				    	<div class="file-select-name" id="noFile">Ningún Archivo Seleccionado...</div> 
				    	<input type="file" name="upload" id="chooseFile">
					</div>
				</div>			
				
				<input type="hidden" name="CodigoEntidad" value="<?php echo $_GET['CodEPS'];?>">
				<input type="hidden" name="CodigoMunicipio" value="<?php echo $_GET['CodMun'];?>">

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
	
		<div class="item-container">
			<div class="item-title-container">
				<div class="item-title">
					Errores
				</div>
				<div class="item-subtitle">
					<div class="item-periodo">
						<?php 
						echo $NumeroErrores = $ObjErrores->getNumErrorsByType(1);
						?>	
					</div>
					<a href="inicio.php?menu=13&CodEPS=<?php echo $_GET['CodEPS'];?>&CodMun=<?php echo $_GET['CodMun'];?>">El afiliado no existe en la base de datos o sus datos no concuerdan con BDUA</a>
				</div>
			</div>


		</div>


	</div>

</div>