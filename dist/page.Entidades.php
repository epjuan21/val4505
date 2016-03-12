<div class="param-container">
	
	<div class="param-box">

		<div class="param-title">
			Entidades
		</div>


		<div class="param-content">

			<ul>
			<?php
			for ($i=0;$i<sizeof($list_enti);$i++)
			{
			?>
				<li>
					<div class="entidad-item"><?php echo $list_enti[$i]["ENTIDAD_NAME"];?></div>
					<div class="entidad-item-edit"><a href="?menu=4&CodEPS=<?php echo $list_enti[$i]["ENTIDAD_COD"];?>" title="Editar"><i class="fa fa-pencil-square-o fa-lg"></i></a></div>
					<div class="entidad-detalle"><?php echo $list_enti[$i]["ENTIDAD_COD"];?></div>
				</li>
			<?php
			}
			?>
			</ul>


		</div>
		
	</div>


	<div class="param-box">

		<div class="param-title">
			Agregar Entidades
		</div>


		<div class="param-content">
			
			<form action="modulos/module.AgregarEntidad.php" class="form" method="POST">
				
				<input type="text" name="ent-cod" placeholder="Código">

				<input type="text" name="ent-nombre" placeholder="Nombre Entidad">

				<input type="submit" class="btn btn-primary btn-large ent-submit" name="grabar-entidad" value="Agregar" />

			</form>

		<?php 
		if (isset($_GET["Estado"]) && $_GET["Estado"] == "Warning")
		{
		?>
		<div class="alert alert--dismissible alert--warning" role="alert">
			
			 <strong>Warning!</strong> La Entidad Ya Existe

		</div>
		<?php
		} else if (isset($_GET["Estado"]) && $_GET["Estado"] == "Success")
		{
		?>
		<div class="alert alert--dismissible alert--success" role="alert">
			
			<strong>Success!</strong> Entidad Agregadar con Éxito

		</div>
		<?php
		}
		?>


		</div>
		
	</div>

</div>