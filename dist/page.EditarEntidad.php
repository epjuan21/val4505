<div class="row-container">
	
	<div class="box">

		<div class="param-title">
			Entidades
		</div>


		<div class="param-content">

			<form action="modulos/module.ActualizarEntidad.php" class="form" method="POST">
				
				<input type="text" name="ent-cod" placeholder="Código" value="<?php echo $Ent[$i]["ENTIDAD_COD"];?>">

				<input type="text" name="ent-nombre" placeholder="Nombre Entidad" value="<?php echo $Ent[$i]["ENTIDAD_NAME"];?>">
	
				<input type="hidden" name="id-entidad" value="<?php echo $Ent[$i]["ENTIDAD_ID"];?>">

				<input type="submit" class="btn btn-primary btn-large ent-submit" name="grabar-entidad" value="Actualizar" />

			</form>


		</div>
		
	</div>


</div>