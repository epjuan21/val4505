<div class="row-container">

	<?php
	for ($i=0;$i<sizeof($ListEnt);$i++)
	{		
	?>

	<div class="container-ent-imp">
	

	<div class="ent-imp-title">
		<?php echo $ListEnt[$i]["ENTIDAD_NAME"];?>
	</div>

	<div class="ent-imp-btn">
		<a href="" class="">VER DETALLE</a>
	</div>


	</div>

	<?php
	}
	?>



</div>
