<div class="row-container">

	<div class="param-box middle-box">

		<div class="ent-imp-head-content">
			
			<div class="ent-imp-icon">
				<i class="fa fa-list-alt fa-2x" aria-hidden="true"></i>
			</div>

			<div class="ent-imp-title-container">
				
				<div class="ent-imp-title">
					Entidades
				</div>
				<div class="ent-imp-subtitle">
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

				<?php $ListPerEnt = $Objrped->getListPeriodos($ListEnt[$i]["ENTIDAD_COD"]);?>
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
				<a href=""><i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i></a>
			</div>


		</div>
		
		<?php
		}
		?>

	</div>

	<!--
	<?php
	for ($i=0;$i<sizeof($ListEnt);$i++)
	{		
	?>

	<div class="container-ent-imp">
	

	<div class="ent-imp-title">
		<?php echo $ListEnt[$i]["ENTIDAD_NAME"];?>
	</div>



	<?php $ListPerEnt = $Objrped->getListPeriodos($ListEnt[$i]["ENTIDAD_COD"]);

	for ($j=0;$j<sizeof($ListPerEnt);$j++)
	{
	?>
	<div class="ent-imp-cont">
			<?php echo $ListPerEnt[$j]["Periodo"]." - ".$ListPerEnt[$j]["Año"]  ;?>
	</div>
	<?php
	}
	?>

	<div class="ent-imp-btn">
		<a href="" class="">Ver Detalle</a>
	</div>


	</div>

	<?php
	}
	?>

	-->
</div>
