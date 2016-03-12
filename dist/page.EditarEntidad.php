<div class="entidad-container">
	
	<div class="entidad-box">

		<div class="entidad-title">
			Entidades
		</div>


		<div class="entidad-content">

			<form action="modulos/module.ActualizarEntidad.php" class="form-entidad" method="POST">
				
				<input type="text" name="ent-cod" class="cod-ent-input" placeholder="Código" value="<?php echo $Ent[$i]["ENTIDAD_COD"];?>">

				<input type="text" name="ent-nombre" placeholder="Nombre Entidad" value="<?php echo $Ent[$i]["ENTIDAD_NAME"];?>">
	
				<input type="hidden" name="id-entidad" value="<?php echo $Ent[$i]["ENTIDAD_ID"];?>">

				<input type="submit" class="btn btn-primary btn-large ent-submit" name="grabar-entidad" value="Actualizar" />

			</form>


		</div>
		
	</div>


</div>