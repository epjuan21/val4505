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
		?>
		<div class="param-content">
			
			<?php

				$CodUs = $sesion->get("idUsuario");
				$CodMun = $_GET["CodMun"];
				$CodEPS = $_GET["CodEPS"];

			for ($i=0;$i<sizeof($DetPer);$i++)
			{		
			$Per = $DetPer[$i]["FechaFinalReg"];
			?>

			<div class="wid2">
				
				<div class="wid2__box1">
					<i class="fa fa-calendar" aria-hidden="true"></i><?php echo $DetPer[$i]["Periodo"]." - ".$DetPer[$i]["Año"];?>
				</div>

				<div class="wid2__box2">
					<i class="fa fa-list" aria-hidden="true"></i><?php echo $DetPer[$i]["Registros"]. " Registros";?>
				</div>
				
				<div class="wid2__box3">
					<i class="fa fa-location-arrow" aria-hidden="true"></i><?php echo $DetPer[$i]["Municipio"];?>
				</div>

				<div class="wid2__icon">
					<a href="?menu=12&CodEPS=<?php echo $CodEPS?>&CodMun=<?php echo $CodMun;?>&CodUs=<?php echo $CodUs;?>&Per=<?php echo $Per;?>">
						<i class="fa fa-arrow-right fa-inverse" aria-hidden="true"></i>
					</a>
				</div>

			</div>
			<?php
			}
			?>

		</div>

	</div>

</div>