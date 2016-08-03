<div class="column-container">
	
	<div class="param-box middle-box">
		
		<div class="param-title">Exportar</div>

		<div class="param-content">
			
			<ul class="list-export">
				<?php
				for ($i=0;$i<sizeof($regEnt);$i++)
				{
				?>			
				<li class="list-item">
					<div class="list-content"><?php echo $regEnt[$i]["Entidad"]; echo " "; echo $regEnt[$i]["Periodo"]; echo " "; echo $regEnt[$i]["Año"];?></div>
					<div class="export-boton"><a href="modulos/module.SeleccionValidador.php?CodEnt=<?php echo $regEnt[$i]["CodigoEntidad"];?>&CodMun=<?php echo $regEnt[$i]["CodigoMunicipio"];?>&FecIn=<?php echo $regEnt[$i]["FechaInicialReg"];?>&FecFn=<?php echo $regEnt[$i]["FechaFinalReg"];?>&IdUser=<?php echo $regEnt[$i]["IdUsuario"];?>" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i> Exportar</a></div>
				</li>
				<?php
				}
				?>
			</ul>

		</div>


	</div>


</div>