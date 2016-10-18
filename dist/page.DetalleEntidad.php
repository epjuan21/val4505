<?php
	$Entidad = $_GET["Ent"];
	$Periodo = $_GET["Period"];
	$Año = $_GET["Año"];
	$regByPeriod = $Objrped->getDetByPer($Entidad,$Periodo,$Año); 
?>
<div class="column-container">
	
	<div class="box box-big">
		
		<div class="param-title">
			Detalle Entidad
		</div>

		<div class="param-content">
			
			<div class="titleEntity">
				<?php echo $regByPeriod[$i]["Entidad"];?>
			</div>
	
			<div class="periodDetail">

				<div class="detail">
					<span>Periodo:</span> <?php echo $regByPeriod[$i]["Periodo"]. " - " .$regByPeriod[$i]["Año"];?>
				</div>

				<div class="detail">
					<span>Registros:</span> <?php echo $regByPeriod[$i]["Registros"];?>
				</div>
				
			</div>

			<div class="param-subtitle">
				Editar Registro
			</div>
		

			<form action="module.BuscarUsuario.php" method="POST" class="">

				<div class="form-group">

					<label for="NumeroIdUsuario">Número Identificación Usuario</label>
					
					<input type="text" name="NumeroIdUsuario" class="form-control">

					<input type="hidden" name="Entidad" value="<?php echo $regByPeriod[$i]["CodEnti"];?>">
					<input type="hidden" name="Año" value="<?php echo $regByPeriod[$i]["Año"];?>">
					<input type="hidden" name="Periodo" value="<?php echo $regByPeriod[$i]["CodPer"];?>">
					
					<input type="submit" value="Enviar" class="form-control btn btn-primary">

				</div>

			</form>

			<?php 
			if (isset($_GET["Estado"]) && $_GET["Estado"] == "Warning")
			{
			?>
			<div class="alert alert--dismissible alert--warning" role="alert">
				
				 <strong>Error!</strong> No se encontro el Usuario en la Base de Datos

			</div>
			<?php
			}
			?>

		</div>

	</div>

</div>

