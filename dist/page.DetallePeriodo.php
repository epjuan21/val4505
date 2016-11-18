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
				
				<div class="subtitle">
				<?php
				$PeriodoEntidad = $objEntidad->getPeriodoEntidad($_GET["CodEPS"],$sesion->get("idUsuario"),$_GET["CodMun"],$_GET["Per"]);

				echo $PeriodoEntidad[0]["Periodo"]." - ".$PeriodoEntidad[0]["Año"];

				?>
				</div>

			</div>

		</div>

		<div class="param-content row-container">
			
			<div class="panel-left">
				<div class="panel-head">
					<div class="panel-icon">
						<i class="fa fa-list fa-3x" aria-hidden="true"></i>
					</div>
					<div class="panel-body">
						<div class="panel-title">Registros</div>
						<div class="panel-subtitle"><?php echo $PeriodoEntidad[0]["Registros"];?></div>
					</div>
				</div>
				<div class="panel-footer">
					<a href="modulos/module.SeleccionValidador.php?CodEnt=<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>&CodMun=<?php echo $PeriodoEntidad[0]["CodigoMunicipio"];?>&FecIn=<?php echo $PeriodoEntidad[0]["FechaInicialReg"];?>&FecFn=<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>&IdUser=<?php echo $PeriodoEntidad[0]["IdUsuario"];?>">
						<span>Descargar</span>
						<span><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
					</a>
				</div>
			</div>
	
		</div>

		<div class="param-content">
				
				<form action="modulos/module.BuscarUsuario.php" method="POST" class="form-group">
					
					<label for="IdUsuario">Buscar Usuario</label>
					<input type="text" name="NumeroIdUsuario" class="form-control">

					<input type="hidden" name="Entidad" value="<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>" class="form-control">

					<input type="hidden" name="Periodo" value="<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>" class="form-control">

					<input type="submit" value="Buscar" class="btn">

				</form>
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
						echo $NumeroErrores = $objErrores->getNumErrorsByType(1);
						?>	
					</div>
					<a href="inicio.php?menu=13&CodEPS=<?php echo $_GET['CodEPS'];?>&CodMun=<?php echo $_GET['CodMun'];?>">El afiliado no existe en la base de datos o sus datos no concuerdan con BDUA</a>
				</div>
			</div>

		</div>

	</div>

</div>