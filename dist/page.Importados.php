<div class="row-container">

	<div class="box box-middle">

		<div class="head-container">
			
			<div class="head-icon">
				<i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
			</div>

			<div class="title-container">
				
				<div class="title">
					Entidades
				</div>
				<div class="subtitle">
					Listado Entidades Importadas
				</div>

			</div>

		</div>

		<?php
		for ($i=0;$i<sizeof($ListEnt);$i++)
		{		
		?>

		<div class="item-container">
		
			<div class="item-title-container">
				
				<div class="item-title">
					<?php echo $ListEnt[$i]["ENTIDAD_NAME"];?>
				</div>

				<?php $ListPerEnt = $ObjEntidades->getListPeriodos($ListEnt[$i]["ENTIDAD_COD"]);?>
				<div class="item-subtitle">
					<i class="fa fa-calendar-check-o fa-inverse" aria-hidden="true"></i>
					<?php
					for ($j=0;$j<sizeof($ListPerEnt);$j++)
					{
					?>
					<div class="item-periodo">
					<?php echo $ListPerEnt[$j]["Periodo"]." - ".$ListPerEnt[$j]["Año"];?>
					</div>
					<?php
					}
					?>
				</div>

			</div>

			<div class="item-link">
			<?php
			$CodEPS = $ListEnt[$i]['ENTIDAD_COD'];
			$CodMun = $ListEnt[$i]['CodigoMunicipio'];
			?>
				<a href="inicio.php?menu=11&CodEPS=<?php echo $CodEPS;?>&CodMun=<?php echo $CodMun;?>"><i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i></a>
			</div>


		</div>
		
		<?php
		}
		?>

	</div>

</div>