<div class="row-container">

	<div class="box">

		<div class="param-title">
			Municipios
		</div>


		<div class="param-content">

			<ul>
			<?php
			for ($i=0;$i<sizeof($list_mun);$i++)
			{
			?>
				<li>
					<div class="entidad-item"><?php echo $list_mun[$i]["MUN_NAME"];?></div>
					<div class="entidad-item-edit"><a href="?menu=14&MunId=<?php echo $list_mun[$i]["MUN_ID"];?>" title="Editar"><i class="fa fa-pencil-square-o fa-lg"></i></a></div>
					<div class="entidad-detalle"><?php echo $list_mun[$i]["MUN_COD"];?></div>
				</li>
			<?php
			}
			?>
			</ul>

		</div>
		
	</div>

	<div class="box">

		<div class="param-title">
			Agregar Municipio
		</div>


		<div class="param-content">
			
			<form action="modulos/module.AgregarMunicipio.php" class="form" method="POST">
				
				<input type="text" name="mun-name" placeholder="Nombre Muncipio">

				<input type="text" name="mun-cod" placeholder="Código Municipio">

				<input type="text" name="mun-cod-hab" placeholder="Código Habilitación Entidad">

				<input type="text" name="mun-ent-nit" placeholder="NIT Entidad">
				
				<input type="submit" class="btn btn-primary btn-large mun-submit" name="grabar-municipio" value="Agregar" />

			</form>

		<?php 
		if (isset($_GET["Estado"]) && $_GET["Estado"] == "Warning")
		{
		?>
		<div class="alert alert--dismissible alert--warning" role="alert">
			
			 <strong>Warning!</strong> La Municipio Ya Existe

		</div>
		<?php
		} else if (isset($_GET["Estado"]) && $_GET["Estado"] == "Success")
		{
		?>
		<div class="alert alert--dismissible alert--success" role="alert">
			
			<strong>Success!</strong> Municipio Agregadar con Éxito

		</div>
		<?php
		}
		?>


		</div>
		
	</div>


</div>