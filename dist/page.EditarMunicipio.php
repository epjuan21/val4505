<div class="row-container">
	
	<div class="box">

		<div class="param-title">
			Municipio
		</div>

		<div class="param-content">

			<form action="modulos/module.ActualizarMunicipio.php" class="form" method="POST">

				<input type="text" name="CodigoMunicipio" placeholder="Código" value="<?php echo $Municipio[$i]["MUN_COD"];?>">

				<input type="text" name="NombreMunicipio" placeholder="Nombre Municipio" value="<?php echo $Municipio[$i]["MUN_NAME"];?>">

				<input type="text" name="CodigoHabilitacion" placeholder="Codigo Habilicación" value="<?php echo $Municipio[$i]["MUN_ENT_COD_HAB"];?>">

	
				<input type="hidden" name="IdMunicipio" value="<?php echo $Municipio[$i]["MUN_ID"];?>">

				<input type="submit" class="btn btn-primary btn-large ent-submit" name="grabar-entidad" value="Actualizar" />

			</form>

		</div>
		
	</div>

</div>