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
					Periodos Importados
				</div>


			</div>

		</div>

		<div class="param-content">

			<table class="table">
				<thead>
					<tr>
						<th>Entidad</th>
						<th>Periodo</th>
						<th>Año</th>
						<th>Registros</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i=0;$i<sizeof($regEnt);$i++)
					{
					?>
					<tr>
						<td><?php echo $regEnt[$i]["Entidad"];?></td>
						<td><?php echo $regEnt[$i]["Periodo"];?></td>
						<td><?php echo $regEnt[$i]["Año"];?></td>
						<td><?php echo $regEnt[$i]["Registros"];?></td>
						<td>
							<a href="?menu=8&Ent=<?php echo $regEnt[$i]["CodigoEntidad"];?>&Año=<?php echo $regEnt[$i]["Año"];?>&Period=<?php echo $regEnt[$i]["CodPer"];?>"><i class="fa fa-pencil" aria-hidden="true"></i>
							</a>
						</td>
						<td>
							<a href="modulos/module.EliminarPeriodo.php?CodEnt=<?php echo $regEnt[$i]["CodigoEntidad"];?>&CodMun=<?php echo $regEnt[$i]["CodigoMunicipio"];?>&FecIn=<?php echo $regEnt[$i]["FechaInicialReg"];?>&FecFn=<?php echo $regEnt[$i]["FechaFinalReg"];?>&IdUser=<?php echo $regEnt[$i]["IdUsuario"];?>"><i class="fa fa-trash-o" aria-hidden="true"></i>
							</a>
						</td>
					</tr>
					<?php
					}
					?>			
				</tbody>
			</table>
			
		</div>

	</div>


</div>