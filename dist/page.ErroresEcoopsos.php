<div class="row-container">

	<div class="box box-middle">

		<div class="head-container">
			
			<div class="head-icon">
				<i class="fa fa fa-list fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					Errores - ECOOPSOS
				</div>
				
				<?php
				$DetPer = $ObjEntidades->getListPeriodosId($_GET["CodEPS"],$sesion->get("idUsuario"),$_GET["CodMun"]);
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
			
			<table class="table">
				<thead>
					<tr>
						<th>Id Usuario</th>
						<th>Error</th>
					</tr>
				</thead>
				<tbody>
					<?php
					for ($i=0;$i<sizeof($Errores);$i++)
					{
					?>
					<tr>
						<td><?php echo $Errores[$i]["NumeroIdUsuario"];?></td>
						<td>El afiliado no existe</td>
					</tr>
					<?php
					}
					?>	
				</tbody>


			</table>
			
		</div>
	
		<div class="item-container">
			<div class="form-group">
				<a href="modulos/module.ProcesarErroresEcoopsos.php?CodEPS=<?php echo $_GET['CodEPS'];?>&CodMun=<?php echo $_GET['CodMun'];?>" class="btn btn-alert btn-large">Procesar Errores</a>
			</div>	
		</div>


	</div>

</div>