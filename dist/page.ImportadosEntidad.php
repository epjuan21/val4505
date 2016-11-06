<div class="row-container">

	<div class="box box-middle">

		<div class="head-container">
			
			<div class="head-icon">
				<i class="fa fa fa-list fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					<?php echo $Ent[$i]["ENTIDAD_NAME"];?>
				</div>
				<div class="subtitle">
					Periodos Importados
				</div>

			</div>

		</div>

		<?php
		$DetPer = $objEntidad->getListPeriodosId($_GET["CodEPS"],$sesion->get("idUsuario"),$_GET["CodMun"]);
		for ($i=0;$i<sizeof($DetPer);$i++)
		{		
		?>

		<div class="item-container">
		
			<div class="item-title-container">
				
				<div class="item-title">
					<?php echo $DetPer[$i]["Periodo"]." - ".$DetPer[$i]["Año"];?>
				</div>
				
				<div class="item-subtitle">
					<i class="fa fa-chevron-right fa-inverse" aria-hidden="true"></i>
					<div class="item-periodo">
					<?php echo $DetPer[$i]["Registros"]. " Registros";?>
					</div>
				</div>

			</div>

			<div class="item-link">
				<a href="?menu=12&CodEPS=<?php echo $_GET["CodEPS"]?>&CodMun=<?php echo $_GET["CodMun"]?>"><i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i></a>
			</div>

		</div>
		
		<?php
		}
		?>

	</div>

</div>