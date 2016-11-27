<div class="row-container">

	<div class="box box-middle">

		<div class="head-container">
			
			<div class="head-icon">
				<i class="fa fa fa-upload fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					<?php echo "DETALLE - ".$Ent[$i]["ENTIDAD_NAME"];?>
				</div>
				
				<div class="subtitle">
				<?php
				$PeriodoEntidad = $objEntidad->getPeriodoEntidad($_GET["CodEPS"],$sesion->get("idUsuario"),$_GET["CodMun"],$_GET["Per"]);
				?>
				</div>

			</div>

		</div>

		<div class="param-content">
			
			<div class="pnl-btn-cnt">
				<div class="btn-hed-cnt">
					<div class="btn-hed-ttl">
						<?php echo $Ent[$i]["ENTIDAD_NAME"];?>
						<span>
						<?php echo $PeriodoEntidad[0]["Periodo"]." ".$PeriodoEntidad[0]["Año"];?>
						</span>
					</div>
				</div>
				
				<div class="pnl-btn-fot">
				
					<div class="btn-fot-ctn">
						<div class="btn-lft-tlt">
							Registros
						</div>
						<div class="btn-lft-sub">
							<?php echo $PeriodoEntidad[0]["Registros"];?>
						</div>
					</div>
				
					<div class="pnl-btn-rgt">
						<a href="modulos/module.SeleccionValidador.php?CodEnt=<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>&CodMun=<?php echo $PeriodoEntidad[0]["CodigoMunicipio"];?>&FecIn=<?php echo $PeriodoEntidad[0]["FechaInicialReg"];?>&FecFn=<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>&IdUser=<?php echo $PeriodoEntidad[0]["IdUsuario"];?>" class="btn-min btn-min-green">
						<i class="fa fa-arrow-down" aria-hidden="true"></i>
						Descargar
						</a>
						<a href="modulos/module.EliminarPeriodo.php?IdUser=<?php echo $PeriodoEntidad[0]["IdUsuario"];?>&CodMun=<?php echo $PeriodoEntidad[0]["CodigoMunicipio"];?>&CodEnt=<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>&FecIn=<?php echo $PeriodoEntidad[0]["FechaInicialReg"];?>&FecFn=<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>" class="btn-min btn-min-red"><i class="fa fa-trash-o" aria-hidden="true"></i>
						Eliminar
						</a>
					</div>	
				
				</div>
				
			</div>

		</div>

		<div class="param-content">
				
			<form action="modulos/module.BuscarUsuario.php" method="POST">
				
				<div class="form-group">
					<label for="NumeroIdUsuario">Buscar Usuario</label>
					<input type="text" name="NumeroIdUsuario" class="form-control">
				</div>


				<input type="hidden" name="Entidad" value="<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>" class="form-control">

				<input type="hidden" name="Periodo" value="<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>" class="form-control">

				<input type="submit" value="Buscar" class="btn">

			</form>
		</div>

		<div class="param-content">
			<?php
			$Err = $objErrores->getErrorByEPS($PeriodoEntidad[0]["CodigoEntidad"], $PeriodoEntidad[0]["FechaFinalReg"], $PeriodoEntidad[0]["CodigoMunicipio"], $PeriodoEntidad[0]["IdUsuario"]);

			for ($i=0;$i<sizeof($Err);$i++)
			{
			?>	
			<div class="pnl-det-cnt">
				<div class="pnl-det-hed">
					<div class="pnl-det-ttl">
						Errores
						<span class="pnl-det-det">
						<?php echo $Err[$i]["Cantidad"];?> 
						</span>
					</div>
					<div class="pnl-det-sub">
						<span>Tipo Error:</span><?php echo $Err[$i]["MensajeError"];?>
					</div>
				</div>

				<div class="pnl-det-fot">
					<a href="modulos/module.ProcesarErrores.php?CodEPS=<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>&CodMun=<?php echo $PeriodoEntidad[0]["CodigoMunicipio"];?>&IdUser=<?php echo $PeriodoEntidad[0]["IdUsuario"];?>&Per=<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>&TipoError=<?php echo $Err[$i]["TipoError"];?>" class="btn-min btn-min-green">Procesar</a>
					<a href="modulos/module.EliminarErrores.php?CodEPS=<?php echo $PeriodoEntidad[0]["CodigoEntidad"];?>&CodMun=<?php echo $PeriodoEntidad[0]["CodigoMunicipio"];?>&IdUser=<?php echo $PeriodoEntidad[0]["IdUsuario"];?>&Per=<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>&TipoError=<?php echo $Err[$i]["TipoError"];?>" class="btn-min btn-min-red">Eliminar</a>
				</div>
			</div>
			<?php
			}	
			?>
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
				<input type="hidden" name="Periodo" value="<?php echo $PeriodoEntidad[0]["FechaFinalReg"];?>">

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

</div>