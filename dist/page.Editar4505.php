<?php
require_once ("clases/class.rped.php");
$objRPED = new rped();
$Registro = $objRPED->getUser($_GET["Ent"],$_GET["IdUser"],$_GET["Per"],$_GET["Año"]);

$CodigoEntidad = $Registro[$i]['CodigoEntidad'];
$FechaRegistro = $Registro[$i]['FechaRegistro'];
$FechaInicialReg = $Registro[$i]['FechaInicialReg'];
$FechaFinalReg = $Registro[$i]['FechaFinalReg'];
$R_ID = $Registro[$i]['R_ID'];

?>
<div class="column-container">
	
	<div class="param-box big-box">
		
		<div class="param-title">
			Editar Registro 4505
		</div>

		<div class="param-content">
			
			<div class="param-subtitle">
				Detalle Registro
			</div>

			<div class="containerDetail">

				<div class="boxDetail">
				
					<div class="boxItem">
						<span>Fecha Importación:</span> <?php echo substr($FechaRegistro, 0, 19);?>
					</div>

					<div class="boxItem">
						<span>Usuario:</span> <?php echo $Registro[$i]['USUARIO_NAME'];?>
					</div>
				
					<div class="boxItem">
						<span>Municipio:</span> <?php echo $Registro[$i]['MUN_NAME'];?>
					</div>

				</div>
			
				<div class="boxDetail">
					<div class="boxItem">
						<span>Entidad:</span> <?php echo $Registro[$i]['ENTIDAD_NAME'];?>
					</div>
					
					<div class="boxItem">
						<span>Fecha Inicial Registro:</span> <?php echo $Registro[$i]['FechaInicialReg'];?>
					</div>
					<div class="boxItem">
						<span>Fecha Final Registro:</span> <?php echo $Registro[$i]['FechaFinalReg'];?>
					</div>

				</div>
				
			</div>

			<div class="param-subtitle">
				Formulario Actualización
			</div>

			<form action="modulos/module.Actualizar4505.php" method="POST">

				<!-- Entidad -->

				<div class="form-group form-group-alert">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CambiarCodigoEntidad">Cambiar Entidad:</label>
					<select name="CambiarCodigoEntidad" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">..Seleccione Entidad</option>
						<?php
						for ($j=0;$j<sizeof($list_enti);$j++)
						{
						?>
						<option value="<?php echo $list_enti[$j]["ENTIDAD_COD"];?>"><?php echo $list_enti[$j]["ENTIDAD_NAME"];?></option>
						<?php
						}
						?>
					</select>
				</div>

				<!-- Periodo Mes -->

				<div class="form-group form-group-alert">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CambioPeriodoMes">Cambiar Periodo - Mes:</label>
					<select name="CambioPeriodoMes" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">..Seleccione Mes</option>
						<option value="Enero">Enero</option>
						<option value="Febrero">Febrero</option>
						<option value="Marzo">Marzo</option>
						<option value="Abril">Abril</option>
						<option value="Mayo">Mayo</option>
						<option value="Junio">Junio</option>
						<option value="Julio">Julio</option>
						<option value="Agosto">Agosto</option>
						<option value="Septiembre">Septiembre</option>
						<option value="Octubre">Octubre</option>
						<option value="Noviembre">Noviembre</option>
						<option value="Diciembre">Diciembre</option>
					</select>
				</div>
				
				<!-- Periodo Año -->

				<div class="form-group form-group-alert">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CambioPeriodoAño">Cambiar Periodo - Año:</label>
					<select name="CambioPeriodoAño" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">..Seleccione Año</option>
						<option value="2011">2011</option>
						<option value="2012">2012</option>
						<option value="2013">2013</option>
						<option value="2014">2014</option>
						<option value="2015">2015</option>
						<option value="2016">2016</option>
						<option value="2017">2017</option>
						<option value="2018">2018</option>
						<option value="2019">2019</option>
						<option value="2020">2020</option>
						<option value="2021">2021</option>
						<option value="2022">2022</option>
					</select>
				</div>		

				<!-- 3. Tipo de identificación del usuario -->

				<div class="form-group">
					<label for="TipoIdUsuario" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">3. Tipo Id Usuario</label>
					<input type="text" name="TipoIdUsuario" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['TipoIdUsuario'];?>">
				</div>

				<!-- 4. Número de identificación del usuario -->

				<div class="form-group">
					<label for="NumeroIdUsuario" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">4. Número Id Usuario</label>
					<input type="text" name="NumeroIdUsuario" class="form-control col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['NumeroIdUsuario'];?>">
				</div>

				<!-- 5. Primer Apellido del Usuario -->

				<div class="form-group">
					<label for="Apellido1" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">5. Primer Apellido</label>
					<input type="text" name="Apellido1" class="form-control col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['Apellido1'];?>">
				</div>

				<!-- 6. Segundo Apellido del Usuario -->

				<div class="form-group">
					<label for="Apellido2" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">6. Segundo Apellido</label>
					<input type="text" name="Apellido2" class="form-control col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['Apellido2'];?>">
				</div>

				<!-- 7. Primer Nombre del Usuario -->

				<div class="form-group">
					<label for="Nombre1" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">7. Primer Nombre</label>
					<input type="text" name="Nombre1" class="form-control col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['Nombre1'];?>">
				</div>

				<!-- 8. Segundo Nombre del Usuario -->

				<div class="form-group">
					<label for="Nombre2" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">8. Segundo Nombre</label>
					<input type="text" name="Nombre2" class="form-control col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['Nombre2'];?>">
				</div>

				<!-- 9. Fecha de Nacimiento -->

				<div class="form-group">
					<label for="FechaNacimiento" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">9. Fecha Nacimiento</label>
					<input type="text" name="FechaNacimiento" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['FechaNacimiento'];?>">
					<span class="help-inline">Edad Años: <b><?php echo calcularEdad($Registro[$i]['FechaFinalReg'], $Registro[$i]['FechaNacimiento']);?></b> -  Edad Dias: <b><?php echo calcularEdadenDias($Registro[$i]['FechaNacimiento'], $Registro[$i]['FechaFinalReg']);?></b></span>
				</div>

				<!-- 10. Sexo -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Sexo">10. Sexo</label>
					<select name="Sexo" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Sexo</option>
						<option value="M" <?php if($Registro["0"]["Sexo"]=="M") echo "selected";?> >M</option>
						<option value="F" <?php if($Registro["0"]["Sexo"]=="F") echo "selected";?> >F</option>
					</select>
				</div>

				<!-- 11. Código pertenencia étnica -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="PertenenciaEtnica">11. Código Pertenencia Étnica</label>
					<select name="PertenenciaEtnica" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Código Pertenencia Étnica</option>
						<option value="1" <?php if($Registro["$i"]["PertenenciaEtnica"]=="1") echo "selected";?> >1 - Indígena</option>
						<option value="2" <?php if($Registro["$i"]["PertenenciaEtnica"]=="2") echo "selected";?> >2 - ROM (Gitano)</option>
						<option value="3" <?php if($Registro["$i"]["PertenenciaEtnica"]=="3") echo "selected";?> >3 - Raizal (Archipiélago de San Andrés y Providencia)</option>
						<option value="4" <?php if($Registro["$i"]["PertenenciaEtnica"]=="4") echo "selected";?> >4 - Palanquero de San Basilio</option>
						<option value="5" <?php if($Registro["$i"]["PertenenciaEtnica"]=="5") echo "selected";?> >5 - Negro(a), Mulato(a), Afrocolombiano(a) o Afrodescendiente</option>
						<option value="6" <?php if($Registro["$i"]["PertenenciaEtnica"]=="6") echo "selected";?> >6 - Ninguno de los Anteriores</option>
					</select>
				</div>

				<!-- 12. Código de ocupación -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoOcupacion">12. Código Ocupación</label>
					<select name="CodigoOcupacion" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Código Ocupación</option>
						<option value="6111" <?php if($Registro["$i"]["CodigoOcupacion"]=="6111") echo "selected";?> >Agricultores y trabajadores calificados de cultivos extensivos</option>
						<option value="9998" <?php if($Registro["$i"]["CodigoOcupacion"]=="9998") echo "selected";?> >No Aplica</option>
						<option value="9999" <?php if($Registro["$i"]["CodigoOcupacion"]=="9999") echo "selected";?> >Sin Dato</option>
					</select>
				</div>				

				<!-- 13. Código Nivel Educativo -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoNivelEducativo">13. Código Nivel Educativo</label>
					<select name="CodigoNivelEducativo" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Código Nivel Educativo</option>
						<option value="1" <?php if($Registro["0"]["CodigoNivelEducativo"]=="1") echo "selected";?> >1 - Preescolar</option>
						<option value="2" <?php if($Registro["0"]["CodigoNivelEducativo"]=="2") echo "selected";?> >2 - Básica Primaria</option>
						<option value="3" <?php if($Registro["0"]["CodigoNivelEducativo"]=="3") echo "selected";?> >3 - Básica Secundaria</option>
						<option value="4" <?php if($Registro["0"]["CodigoNivelEducativo"]=="4") echo "selected";?> >4 - Media Académica o Clásica</option>
						<option value="5" <?php if($Registro["0"]["CodigoNivelEducativo"]=="5") echo "selected";?> >5 - Media Técnica (Bachillerato Técnico)</option>
						<option value="6" <?php if($Registro["0"]["CodigoNivelEducativo"]=="6") echo "selected";?> >6 - Normalista</option>
						<option value="7" <?php if($Registro["0"]["CodigoNivelEducativo"]=="7") echo "selected";?> >7 - Técnica Profesional</option>
						<option value="8" <?php if($Registro["0"]["CodigoNivelEducativo"]=="8") echo "selected";?> >8 - Tecnológica</option>
						<option value="9" <?php if($Registro["0"]["CodigoNivelEducativo"]=="9") echo "selected";?> >9 - Profesional</option>
						<option value="10" <?php if($Registro["0"]["CodigoNivelEducativo"]=="10") echo "selected";?> >10 - Especialización</option>
						<option value="11" <?php if($Registro["0"]["CodigoNivelEducativo"]=="11") echo "selected";?> >11 - Maestría</option>
						<option value="12" <?php if($Registro["0"]["CodigoNivelEducativo"]=="12") echo "selected";?> >12 - Doctorado</option>
						<option value="13" <?php if($Registro["0"]["CodigoNivelEducativo"]=="13") echo "selected";?> >13 - Ninguno</option>
					</select>
				</div>	

				<!-- 14. Gestación -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Gestacion">14. Gestación</label>
					<select name="Gestacion" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Gestacion"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Gestacion"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["Gestacion"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["Gestacion"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 15. Sífilis Gestacional o Congénita -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SifilisGestacional">15. Sífilis Gestacional o Congénita</label>
					<select name="SifilisGestacional" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["SifilisGestacional"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["SifilisGestacional"]=="1") echo "selected";?> >1 - Si es mujer con sífilis gestacional</option>
						<option value="2" <?php if($Registro["0"]["SifilisGestacional"]=="2") echo "selected";?> >2 - Si es recién nacido con sífilis congénita</option>
						<option value="3" <?php if($Registro["0"]["SifilisGestacional"]=="3") echo "selected";?> >3 - No</option>
						<option value="21" <?php if($Registro["0"]["SifilisGestacional"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 16. Hipertensión Inducida por la Gestación -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="HipertensionInducidaGestacion">16. Hipertensión Inducida por la Gestación</label>
					<select name="HipertensionInducidaGestacion" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["HipertensionInducidaGestacion"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["HipertensionInducidaGestacion"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["HipertensionInducidaGestacion"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["HipertensionInducidaGestacion"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 17. Hipotiroidismo Congénito -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="HipotiroidismoCongenito">17. Hipotiroidismo Congénito</label>
					<select name="HipotiroidismoCongenito" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["HipotiroidismoCongenito"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["HipotiroidismoCongenito"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["HipotiroidismoCongenito"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["HipotiroidismoCongenito"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 18. Sintomático Respiratorio -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SintomaticoRespiratorio">18. Sintomático Respiratorio</label>
					<select name="SintomaticoRespiratorio" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["SintomaticoRespiratorio"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["SintomaticoRespiratorio"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["SintomaticoRespiratorio"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 19. Tuberculosis Multidrogoresistente -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Tuberculosis">19. Tuberculosis Multidrogoresistente</label>
					<select name="Tuberculosis" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Tuberculosis"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Tuberculosis"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["Tuberculosis"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["Tuberculosis"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 20. Lepra -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Lepra">20. Lepra</label>
					<select name="Lepra" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["Lepra"]=="1") echo "selected";?> >1 - Pausibacilar</option>
						<option value="2" <?php if($Registro["0"]["Lepra"]=="2") echo "selected";?> >2 - Multibacilar</option>
						<option value="3" <?php if($Registro["0"]["Lepra"]=="3") echo "selected";?> >3 - No</option>
						<option value="21" <?php if($Registro["0"]["Lepra"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 21. Obesidad o Desnutrición Proteico Calórica -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ObesidadDesnutricion">21. Obesidad o Desnutrición Proteico Calórica</label>
					<select name="ObesidadDesnutricion" class="form-control col-lg-5 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["ObesidadDesnutricion"]=="1") echo "selected";?> >1 - Si es Obesidad</option>
						<option value="2" <?php if($Registro["0"]["ObesidadDesnutricion"]=="2") echo "selected";?> >2 - Si es Desnutrición Proteico Calórica</option>
						<option value="3" <?php if($Registro["0"]["ObesidadDesnutricion"]=="3") echo "selected";?> >3 - No</option>
						<option value="21" <?php if($Registro["0"]["ObesidadDesnutricion"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 22. Víctima de Maltrato -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="VictimaMaltrato">22. Víctima de Maltrato</label>
					<select name="VictimaMaltrato" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["VictimaMaltrato"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["VictimaMaltrato"]=="1") echo "selected";?> >1 - Si es Mujer Víctima de Maltrato</option>
						<option value="2" <?php if($Registro["0"]["VictimaMaltrato"]=="2") echo "selected";?> >2 - Si es Menor Víctima de Maltrato</option>
						<option value="3" <?php if($Registro["0"]["VictimaMaltrato"]=="3") echo "selected";?> >3 - No</option>
						<option value="21" <?php if($Registro["0"]["VictimaMaltrato"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 23. Víctima de Violencia Sexual -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="VictimaViolenciaSexual">23. Víctima de Violencia Sexual</label>
					<select name="VictimaViolenciaSexual" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["VictimaViolenciaSexual"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["VictimaViolenciaSexual"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["VictimaViolenciaSexual"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 24. Infecciones de Trasmisión Sexual -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="InfeccionTrasmisionSexual">24. Infecciones de Trasmisión Sexual</label>
					<select name="InfeccionTrasmisionSexual" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["InfeccionTrasmisionSexual"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["InfeccionTrasmisionSexual"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["InfeccionTrasmisionSexual"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 25. Enfermedad Mental -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="EnfermedadMental">25. Enfermedad Mental</label>
					<select name="EnfermedadMental" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["EnfermedadMental"]=="1") echo "selected";?> >1 - Si el diagnóstico es ansiedad</option>
						<option value="2" <?php if($Registro["0"]["EnfermedadMental"]=="2") echo "selected";?> >2 - Si el diagnóstico es depresión</option>
						<option value="3" <?php if($Registro["0"]["EnfermedadMental"]=="3") echo "selected";?> >3 - Si el diagnóstico es esquizofrenia</option>
						<option value="4" <?php if($Registro["0"]["EnfermedadMental"]=="4") echo "selected";?> >4 - Si el diagnóstico es déficit de atención por hiperRegistroividad</option>
						<option value="5" <?php if($Registro["0"]["EnfermedadMental"]=="5") echo "selected";?> >5 - Si el diagnóstico es consumo de sustancias psicoRegistroivas</option>
						<option value="6" <?php if($Registro["0"]["EnfermedadMental"]=="6") echo "selected";?> >6 - Si el diagnóstico es trastorno del ánimo bipolar</option>
						<option value="7" <?php if($Registro["0"]["EnfermedadMental"]=="7") echo "selected";?> >7 - No</option>
						<option value="21" <?php if($Registro["0"]["EnfermedadMental"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 26. Cáncer de Cervix -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CancerCervix">26. Cáncer de Cervix</label>
					<select name="CancerCervix" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["CancerCervix"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["CancerCervix"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["CancerCervix"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["CancerCervix"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 27. Cáncer de Seno -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CancerSeno">27. Cáncer de Seno</label>
					<select name="CancerSeno" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["CancerSeno"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["CancerSeno"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["CancerSeno"]=="21") echo "selected";?> >3 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 28. Fluorosis Dental -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FluorosisDental">28. Fluorosis Dental</label>
					<select name="FluorosisDental" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($Registro["0"]["FluorosisDental"]=="1") echo "selected";?> >1 - Si</option>
						<option value="2" <?php if($Registro["0"]["FluorosisDental"]=="2") echo "selected";?> >2 - No</option>
						<option value="21" <?php if($Registro["0"]["FluorosisDental"]=="21") echo "selected";?> >21 - Riesgo No Evaluado</option>
					</select>
				</div>

				<!-- 29. Fecha del Peso -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaPeso">29. Fecha de Peso</label>
  					<input type="text" name="FechaPeso" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" data-date-format="yyyy-mm-dd" value="<?php echo $Registro["0"]["FechaPeso"]; ?>">
  					<span class="help-inline">Si no se toma registrar 1800-01-01</span>
				</div>

				<!-- 30. Peso en Kilogramos -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="PesoKilogramos">30. Peso en Kilogramos</label>
					<input type="text" name="PesoKilogramos" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["PesoKilogramos"]; ?>">
					<span class="help-inline">Si no se toma registrar 999</span>
				</div>

				<!-- 31. Fecha de la Talla -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTalla">31. Fecha de la Talla</label>
					<input type="text" name="FechaTalla" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" data-date-format="yyyy-mm-dd" value="<?php echo $Registro["0"]["FechaTalla"]; ?>">
					<span class="help-inline">Formato AAAA-MM-DD. Si no se toma registrar 1800-01-01</span>
				</div>

				<!-- 32. Talla en Centímetros -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TallaCentimetros">32. Talla en Centímetros</label>
					<input type="text" name="TallaCentimetros" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["TallaCentimetros"]; ?>">
					<span class="help-inline">Si no se toma registrar 999</span>
				</div>

				<!-- 33. Fecha Probable de Parto -->
				<?php $FechaProbableParto = $Registro["0"]["FechaProbableParto"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaProbableParto">33. Fecha Probable de Parto</label>
					<select name="FechaProbableParto" id="editable-select" class="form-control col-lg-5 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaProbableParto=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($FechaProbableParto=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaProbableParto;?>" <?php if($FechaProbableParto!="1800-01-01" || $FechaProbableParto!="1845-01-01") echo "selected";?> ><?php echo $FechaProbableParto;?></option>
					</select>
					<span class="help-inline">Formato AAAA-MM-DD</span>
				</div>

				<!-- 34. Edad Gestacional al Nacer -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="EdadGestacional">34. Edad Gestacional al Nacer</label>
					<input type="text" name="EdadGestacional" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["EdadGestacional"]; ?>">
				</div>

				<!-- 35. BCG -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="BCG">35. BCG</label>
					<select name="BCG" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["BCG"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["BCG"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="16" <?php if($Registro["0"]["BCG"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["BCG"]=="17") echo "selected";?> >17 - No se admninistra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["BCG"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["BCG"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["BCG"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["BCG"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 36. Hepatitis B Menores de 1 Año -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="HepatitisB">36. Hepatitis B Menores de 1 Año</label>
					<select name="HepatitisB" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["HepatitisB"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["HepatitisB"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="16" <?php if($Registro["0"]["HepatitisB"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["HepatitisB"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["HepatitisB"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["HepatitisB"]=="19") echo "selected";?> >18 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["HepatitisB"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["HepatitisB"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 37. Pentavalente -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Pentavalente">37. Pentavalente</label>
					<select name="Pentavalente" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Pentavalente"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Pentavalente"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["Pentavalente"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["Pentavalente"]=="3") echo "selected";?> >3 - Tres Dosis</option>
						<option value="16" <?php if($Registro["0"]["Pentavalente"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["Pentavalente"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["Pentavalente"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["Pentavalente"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["Pentavalente"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["Pentavalente"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 38. Polio -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Polio">38. Polio</label>
					<select name="Polio" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Polio"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Polio"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["Polio"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["Polio"]=="3") echo "selected";?> >3 - Tres Dosis</option>
						<option value="4" <?php if($Registro["0"]["Polio"]=="4") echo "selected";?> >4 - Cuatro Dosis</option>
						<option value="5" <?php if($Registro["0"]["Polio"]=="5") echo "selected";?> >5 - Cinco Dosis</option>
						<option value="16" <?php if($Registro["0"]["Polio"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["Polio"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["Polio"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["Polio"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["Polio"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["Polio"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 39. DPT Menores de 5 Años -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="DPT">39. DPT Menores de 5 Años</label>
					<select name="DPT" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["DPT"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="4" <?php if($Registro["0"]["DPT"]=="4") echo "selected";?> >4 - Cuatro Dosis</option>
						<option value="5" <?php if($Registro["0"]["DPT"]=="5") echo "selected";?> >5 - Cinco Dosis</option>
						<option value="16" <?php if($Registro["0"]["DPT"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["DPT"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["DPT"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["DPT"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["DPT"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["DPT"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 40. Rotavirus -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Rotavirus">40. Rotavirus</label>
					<select name="Rotavirus" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Rotavirus"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Rotavirus"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["Rotavirus"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="16" <?php if($Registro["0"]["Rotavirus"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["Rotavirus"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["Rotavirus"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["Rotavirus"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["Rotavirus"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["Rotavirus"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 41. Neumococo -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="Neumococo">41. Neumococo</label>
					<select name="Neumococo" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["Neumococo"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["Neumococo"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["Neumococo"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["Neumococo"]=="3") echo "selected";?> >3 - Tres Dosis</option>
						<option value="16" <?php if($Registro["0"]["Neumococo"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["Neumococo"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["Neumococo"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["Neumococo"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["Neumococo"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["Neumococo"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 42. Influenza Niños -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="InfluenzaN">42. Influenza Niños</label>
					<select name="InfluenzaN" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["InfluenzaN"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["InfluenzaN"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["InfluenzaN"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["InfluenzaN"]=="3") echo "selected";?> >3 - Tres Dosis Anual</option>
						<option value="16" <?php if($Registro["0"]["InfluenzaN"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["InfluenzaN"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["InfluenzaN"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["InfluenzaN"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["InfluenzaN"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["InfluenzaN"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 43. Fiebre Amarilla Niños de 1 Año -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FiebreAmarillaN1">43. Fiebre Amarilla Niños de 1 Año</label>
					<select name="FiebreAmarillaN1" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["FiebreAmarillaN1"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["FiebreAmarillaN1"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="16" <?php if($Registro["0"]["FiebreAmarillaN1"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["FiebreAmarillaN1"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["FiebreAmarillaN1"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["FiebreAmarillaN1"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["FiebreAmarillaN1"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["FiebreAmarillaN1"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 44. Hepatitis A -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="HepatitisA">44. Hepatitis A</label>
					<select name="HepatitisA" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["HepatitisA"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["HepatitisA"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="16" <?php if($Registro["0"]["HepatitisA"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["HepatitisA"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["HepatitisA"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["HepatitisA"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["HepatitisA"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["HepatitisA"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 45. Triple Viral Niños -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TripleViralN">45. Triple Viral Niños</label>
					<select name="TripleViralN" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["TripleViralN"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["TripleViralN"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["TripleViralN"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="16" <?php if($Registro["0"]["TripleViralN"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["TripleViralN"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["TripleViralN"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["TripleViralN"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["TripleViralN"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["TripleViralN"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 46. Virus del Papiloma Humano (VPH) -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="VPH">46. Virus del Papiloma Humano (VPH)</label>
					<select name="VPH" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["VPH"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["VPH"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["VPH"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["VPH"]=="3") echo "selected";?> >3 - Tres Dosis</option>
						<option value="16" <?php if($Registro["0"]["VPH"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["VPH"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["VPH"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["VPH"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["VPH"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["VPH"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 47. TD o TT Mujeres en Edad Fértil 15 a 49 Años -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TdTtMEF">47. TD o TT Mujeres en Edad Fértil 15 a 49 Años</label>
					<select name="TdTtMEF" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["TdTtMEF"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["TdTtMEF"]=="1") echo "selected";?> >1 - Una Dosis</option>
						<option value="2" <?php if($Registro["0"]["TdTtMEF"]=="2") echo "selected";?> >2 - Dos Dosis</option>
						<option value="3" <?php if($Registro["0"]["TdTtMEF"]=="3") echo "selected";?> >3 - Tres Dosis</option>
						<option value="4" <?php if($Registro["0"]["TdTtMEF"]=="4") echo "selected";?> >4 - Cuatro Dosis</option>
						<option value="5" <?php if($Registro["0"]["TdTtMEF"]=="5") echo "selected";?> >5 - Cinco Dosis</option>
						<option value="16" <?php if($Registro["0"]["TdTtMEF"]=="16") echo "selected";?> >16 - No se administra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["TdTtMEF"]=="17") echo "selected";?> >17 - No se administra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["TdTtMEF"]=="18") echo "selected";?> >18 - No se administra por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["TdTtMEF"]=="19") echo "selected";?> >19 - No se administra por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["TdTtMEF"]=="20") echo "selected";?> >20 - No se administra por otras razones</option>
						<option value="22" <?php if($Registro["0"]["TdTtMEF"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 48. Control de Placa Bacteriana -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ControlPlacaBacteriana">48. Control de Placa Bacteriana</label>
					<select name="ControlPlacaBacteriana" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="1") echo "selected";?> >1 - Si - Primera Vez en el Año</option>
						<option value="2" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="2") echo "selected";?> >2 - Si - Segunda Vez en el Año</option>
						<option value="16" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="16") echo "selected";?> >16 - No se realiza por una tradición</option>
						<option value="17" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="17") echo "selected";?> >17 - No se realiza por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="18") echo "selected";?> >18 - No se realiza por negación del usuario</option>
						<option value="19" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="19") echo "selected";?> >19 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="20" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="20") echo "selected";?> >20 - No se realiza por otras razones</option>
						<option value="22" <?php if($Registro["0"]["ControlPlacaBacteriana"]=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 49. Fecha Atención Parto o Cesárea -->
				<?php $FechaAtencionParto = $Registro["0"]["FechaAtencionParto"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaAtencionParto">49. Fecha Atención Parto o Cesárea</label>
					<select name="FechaAtencionParto" id="editable-select2" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaAtencionParto=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($FechaAtencionParto=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaAtencionParto;?>" <?php if($FechaAtencionParto!="1800-01-01" || $FechaAtencionParto!="1845-01-01") echo "selected";?> ><?php echo $FechaAtencionParto;?></option>
					</select>
					<span class="help-inline">Formato AAAA-MM-DD</span>
				</div>
				
				<!-- 50. Fecha Salida de la Atención del Parto o Cesárea -->
				<?php $FechaSalidaParto = $Registro["0"]["FechaSalidaParto"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaSalidaParto">50. Fecha Salida de la Atención del Parto o Cesárea</label>
					<select name="FechaSalidaParto" id="editable-select3" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaSalidaParto=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($FechaSalidaParto=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaSalidaParto;?>" <?php if($FechaSalidaParto!="1800-01-01" || $FechaSalidaParto!="1845-01-01") echo "selected";?> ><?php echo $FechaSalidaParto;?></option>
					</select>
					<span class="help-inline">Formato AAAA-MM-DD</span>
				</div>

				<!-- 51. Fecha Consejería en Lactancia Materna -->
				<?php $FechaConsejeriaLactanciaInput = $Registro["0"]["FechaConsejeriaLactanciaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaConsejeriaLactanciaInput">51. Fecha Consejería en Lactancia Materna</label>
					<select name="FechaConsejeriaLactanciaInput" id="editable-select4" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaConsejeriaLactanciaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaConsejeriaLactanciaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaConsejeriaLactanciaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="995" <?php if($FechaConsejeriaLactanciaInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaConsejeriaLactanciaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaConsejeriaLactanciaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaConsejeriaLactanciaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaConsejeriaLactanciaInput;?>" <?php if($FechaConsejeriaLactanciaInput!="1800-01-01" || $FechaConsejeriaLactanciaInput!="1845-01-01" || $FechaConsejeriaLactanciaInput!="1805-01-01" || $FechaConsejeriaLactanciaInput!="1810-01-01" || $FechaConsejeriaLactanciaInput!="1825-01-01" || $FechaConsejeriaLactanciaInput!="1830-01-01" || $FechaConsejeriaLactanciaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaConsejeriaLactanciaInput;?></option>
					</select>
				</div>

				<!-- 52. Control Recién Nacido -->
				<?php $ControlRecienNacidoInput = $Registro["0"]["ControlRecienNacidoInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ControlRecienNacidoInput">52. Control Recién Nacido</label>
					<select name="ControlRecienNacidoInput" id="editable-select5" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ControlRecienNacidoInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ControlRecienNacidoInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ControlRecienNacidoInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ControlRecienNacidoInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ControlRecienNacidoInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ControlRecienNacidoInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ControlRecienNacidoInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ControlRecienNacidoInput;?>" <?php if($ControlRecienNacidoInput!="1800-01-01" || $ControlRecienNacidoInput!="1845-01-01" || $ControlRecienNacidoInput!="1805-01-01" || $ControlRecienNacidoInput!="1810-01-01" || $ControlRecienNacidoInput!="1825-01-01" || $ControlRecienNacidoInput!="1830-01-01" || $ControlRecienNacidoInput!="1835-01-01") echo "selected";?> ><?php echo $ControlRecienNacidoInput;?></option>
					</select>
				</div>

				<!-- 53. Planificación Familiar Primera Vez -->
				<?php $PlanificacionFamiliarPrimeraVezInput = $Registro["0"]["PlanificacionFamiliarPrimeraVezInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="PlanificacionFamiliarPrimeraVezInput">53. Planificación Familiar Primera Vez</label>
					<select name="PlanificacionFamiliarPrimeraVezInput" id="editable-select6" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $PlanificacionFamiliarPrimeraVezInput;?>" <?php if($PlanificacionFamiliarPrimeraVezInput!="1800-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1845-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1805-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1810-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1825-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1830-01-01" || $PlanificacionFamiliarPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $PlanificacionFamiliarPrimeraVezInput;?></option>
					</select>
				</div>

				<!-- 54. Suministro de Método Anticonceptivo -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroMetodoAnticonceptivo">54. Suministro de Método Anticonceptivo</label>
					<select name="SuministroMetodoAnticonceptivo" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="1") echo "selected";?> >1 - Dispositivo Intrauterino</option>
						<option value="2" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="2") echo "selected";?> >2 - Dispositivo Intrauterino y Barrera</option>
						<option value="3" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="3") echo "selected";?> >3 - Implante Subdérmico</option>
						<option value="4" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="4") echo "selected";?> >4 - Implante Subdérmico y Barrera</option>
						<option value="5" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="5") echo "selected";?> >5 - Oral</option>
						<option value="6" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="6") echo "selected";?> >6 - Oral y Barrera</option>
						<option value="7" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="7") echo "selected";?> >7 - Inyectable Mensual</option>
						<option value="8" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="8") echo "selected";?> >8 - Inyectable Mensual y Barrera</option>
						<option value="9" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="9") echo "selected";?> >9 - Inyectable Trimestral</option>
						<option value="10" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="10") echo "selected";?> >10 - Inyectable Trimestral y Barrera</option>
						<option value="11" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="11") echo "selected";?> >11 - Emergencia</option>
						<option value="12" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="12") echo "selected";?> >12 - Emergencia y Barrera</option>
						<option value="13" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="13") echo "selected";?> >13 - Esterilización</option>
						<option value="14" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="14") echo "selected";?> >14 - Esterilización y Barrera</option>
						<option value="15" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="15") echo "selected";?> >15 - Barrera</option>
						<option value="16" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
						<option value="20" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
						<option value="21" <?php if($Registro["0"]["SuministroMetodoAnticonceptivo"]=="21") echo "selected";?> >21 - Registro No Evaluado</option>
					</select>
				</div>

				<!-- 55. Fecha Suministro de Método Anticonceptivo -->
				<?php $FechaSuministroMetodoAnticonceptivo = $Registro["0"]["FechaSuministroMetodoAnticonceptivo"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaSuministroMetodoAnticonceptivo">55. Fecha Suministro de Método Anticonceptivo</label>
					<select name="FechaSuministroMetodoAnticonceptivo" id="editable-select7" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaSuministroMetodoAnticonceptivo=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($FechaSuministroMetodoAnticonceptivo=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaSuministroMetodoAnticonceptivo;?>" <?php if($FechaSuministroMetodoAnticonceptivo!="1800-01-01" || $FechaSuministroMetodoAnticonceptivo!="1845-01-01") echo "selected";?> ><?php echo $FechaSuministroMetodoAnticonceptivo;?></option>
					</select>
				</div>

				<!-- 56. Control Prenatal de Primera Vez -->
				<?php $ControlPrenatalPrimeraVezInput = $Registro["0"]["ControlPrenatalPrimeraVezInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ControlPrenatalPrimeraVezInput">56. Control Prenatal de Primera Vez</label>
					<select name="ControlPrenatalPrimeraVezInput" id="editable-select8" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ControlPrenatalPrimeraVezInput;?>" <?php if($ControlPrenatalPrimeraVezInput!="1800-01-01" || $ControlPrenatalPrimeraVezInput!="1845-01-01" || $ControlPrenatalPrimeraVezInput!="1805-01-01" || $ControlPrenatalPrimeraVezInput!="1810-01-01" || $ControlPrenatalPrimeraVezInput!="1825-01-01" || $ControlPrenatalPrimeraVezInput!="1830-01-01" || $ControlPrenatalPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $ControlPrenatalPrimeraVezInput;?></option>
					</select>
				</div>			
				
				<!-- 57. Control Prenatal -->
				<?php $ControlPrenatal = $Registro["0"]["ControlPrenatal"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ControlPrenatal">57. Control Prenatal</label>
					<select name="ControlPrenatal" id="editable-select9" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="999" <?php if($ControlPrenatal=="999") {echo "selected";};?> >999 - No se tiene el dato</option>
						<option value="0" <?php if($ControlPrenatal=="0"){echo "selected";};?> >0 - No Aplica</option>
						<option value="<?php echo $ControlPrenatal;?>" <?php if($ControlPrenatal!="999" || $ControlPrenatal!="0") echo "selected";?> ><?php echo $ControlPrenatal;?></option>
					</select>
				</div>

				<!-- 58. Último Control Prenatal -->
				<?php $UltimoControlPrenatal = $Registro["0"]["UltimoControlPrenatal"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="UltimoControlPrenatal">58. Último Control Prenatal</label>
					<select name="UltimoControlPrenatal" id="editable-select10" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($UltimoControlPrenatal=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($UltimoControlPrenatal=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $UltimoControlPrenatal;?>" <?php if($UltimoControlPrenatal!="1800-01-01" || $UltimoControlPrenatal!="1845-01-01") echo "selected";?> ><?php echo $UltimoControlPrenatal;?></option>
					</select>
				</div>

				<!-- 59. Suministro de Ácido Fólico en el Último Control Prenatal -->
				<?php $SuministroAcidoFolico = $Registro["0"]["SuministroAcidoFolico"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroAcidoFolico">59. Suministro de Ácido Fólico en el Último Control Prenatal</label>
					<select name="SuministroAcidoFolico" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($SuministroAcidoFolico=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($SuministroAcidoFolico=="1") echo "selected";?> >1 - Si se suministra</option>
						<option value="16" <?php if($SuministroAcidoFolico=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
						<option value="17" <?php if($SuministroAcidoFolico=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($SuministroAcidoFolico=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
						<option value="20" <?php if($SuministroAcidoFolico=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
						<option value="21" <?php if($SuministroAcidoFolico=="21") echo "selected";?> >21 - Registro No Evaluado</option>
					</select>
				</div>

				<!-- 60. Suministro de Sulfato Ferroso en el Último Control Prenatal -->
				<?php $SuministroSulfatoFerroso = $Registro["0"]["SuministroSulfatoFerroso"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroSulfatoFerroso">60. Suministro de Sulfato Ferroso en el Último Control Prenatal</label>
					<select name="SuministroSulfatoFerroso" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="1") echo "selected";?> >1 - Si se suministra</option>
						<option value="16" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
						<option value="17" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
						<option value="20" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
						<option value="21" <?php if($Registro["0"]["SuministroSulfatoFerroso"]=="21") echo "selected";?> >21 - Registro No Evaluado</option>
					</select>
				</div>

			<!-- 61. Suministro de Carbonato de Calcio en el Último Control Prenatal -->
			<?php $SuministroCarbonatoCalcio = $Registro["0"]["SuministroCarbonatoCalcio"];?>

			<div class="form-group">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroCarbonatoCalcio">61. Suministro de Carbonato de Calcio en el Último Control Prenatal</label>
				<select name="SuministroCarbonatoCalcio" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
					<option value="">...Seleccione Una Opción</option>
					<option value="0" <?php if($SuministroCarbonatoCalcio=="0") echo "selected";?> >0 - No Aplica</option>
					<option value="1" <?php if($SuministroCarbonatoCalcio=="1") echo "selected";?> >1 - Si se suministra</option>
					<option value="16" <?php if($SuministroCarbonatoCalcio=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
					<option value="17" <?php if($SuministroCarbonatoCalcio=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
					<option value="18" <?php if($SuministroCarbonatoCalcio=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
					<option value="20" <?php if($SuministroCarbonatoCalcio=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
					<option value="21" <?php if($SuministroCarbonatoCalcio=="21") echo "selected";?> >21 - Registro No Evaluado</option>
				</select>
			</div>

			<!-- 62. Valoración de la Agudeza Visual -->
			<?php $ValoracionAgudezaVisualInput = $Registro["0"]["ValoracionAgudezaVisualInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ValoracionAgudezaVisualInput">62. Valoración de la Agudeza Visual</label>
					<select name="ValoracionAgudezaVisualInput" id="editable-select11" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ValoracionAgudezaVisualInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ValoracionAgudezaVisualInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ValoracionAgudezaVisualInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ValoracionAgudezaVisualInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ValoracionAgudezaVisualInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ValoracionAgudezaVisualInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ValoracionAgudezaVisualInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ValoracionAgudezaVisualInput;?>" <?php if($ValoracionAgudezaVisualInput!="1800-01-01" || $ValoracionAgudezaVisualInput!="1845-01-01" || $ValoracionAgudezaVisualInput!="1805-01-01" || $ValoracionAgudezaVisualInput!="1810-01-01" || $ValoracionAgudezaVisualInput!="1825-01-01" || $ValoracionAgudezaVisualInput!="1830-01-01" || $ValoracionAgudezaVisualInput!="1835-01-01") echo "selected";?> ><?php echo $ValoracionAgudezaVisualInput;?></option>
					</select>
				</div>				

				<!-- 63. Consulta por Oftalmología -->
				<?php $ConsultaOftalmologiaInput = $Registro["0"]["ConsultaOftalmologiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaOftalmologiaInput">63. Consulta por Oftalmología</label>
					<select name="ConsultaOftalmologiaInput" id="editable-select12" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaOftalmologiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaOftalmologiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaOftalmologiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaOftalmologiaInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaOftalmologiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaOftalmologiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaOftalmologiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaOftalmologiaInput;?>" <?php if($ConsultaOftalmologiaInput!="1800-01-01" || $ConsultaOftalmologiaInput!="1845-01-01" || $ConsultaOftalmologiaInput!="1805-01-01" || $ConsultaOftalmologiaInput!="1810-01-01" || $ConsultaOftalmologiaInput!="1825-01-01" || $ConsultaOftalmologiaInput!="1830-01-01" || $ConsultaOftalmologiaInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaOftalmologiaInput;?></option>
					</select>
				</div>	

				<!-- 64. Fecha Diagnóstico Desnutrición Proteico Calórica -->
				<?php $FechaDiagnosticoDesnutricion = $Registro["0"]["FechaDiagnosticoDesnutricion"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaDiagnosticoDesnutricion">64. Fecha Diagnóstico Desnutrición Proteico Calórica</label>
					<select name="FechaDiagnosticoDesnutricion" id="editable-select13" class="form-control col-lg-4 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaDiagnosticoDesnutricion=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1845-01-01" <?php if($FechaDiagnosticoDesnutricion=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaDiagnosticoDesnutricion;?>" <?php if($FechaDiagnosticoDesnutricion!="1800-01-01" || $FechaDiagnosticoDesnutricion!="1845-01-01") echo "selected";?> ><?php echo $FechaDiagnosticoDesnutricion;?></option>
					</select>
				</div>

				<!-- 65. Consulta Mujer o Menor Víctima del Maltrato -->
				<?php $ConsultaMujerMenorVictimaInput = $Registro["0"]["ConsultaMujerMenorVictimaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaMujerMenorVictimaInput">65. Consulta Mujer o Menor Víctima del Maltrato</label>
					<select name="ConsultaMujerMenorVictimaInput" id="editable-select14" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaMujerMenorVictimaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaMujerMenorVictimaInput;?>" <?php if($ConsultaMujerMenorVictimaInput!="1800-01-01" || $ConsultaMujerMenorVictimaInput!="1845-01-01" || $ConsultaMujerMenorVictimaInput!="1805-01-01" || $ConsultaMujerMenorVictimaInput!="1810-01-01" || $ConsultaMujerMenorVictimaInput!="1825-01-01" || $ConsultaMujerMenorVictimaInput!="1830-01-01" || $ConsultaMujerMenorVictimaInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaMujerMenorVictimaInput;?></option>
					</select>
				</div>	
				
				<!-- 66. Consulta Víctimas de Violencia Sexual -->
				<?php $ConsultaVictimaViolenciaSexualInput = $Registro["0"]["ConsultaVictimaViolenciaSexualInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaVictimaViolenciaSexualInput">66. Consulta Víctimas de Violencia Sexual</label>
					<select name="ConsultaVictimaViolenciaSexualInput" id="editable-select15" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaVictimaViolenciaSexualInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaVictimaViolenciaSexualInput;?>" <?php if($ConsultaVictimaViolenciaSexualInput!="1800-01-01" || $ConsultaVictimaViolenciaSexualInput!="1845-01-01" || $ConsultaVictimaViolenciaSexualInput!="1805-01-01" || $ConsultaVictimaViolenciaSexualInput!="1810-01-01" || $ConsultaVictimaViolenciaSexualInput!="1825-01-01" || $ConsultaVictimaViolenciaSexualInput!="1830-01-01" || $ConsultaVictimaViolenciaSexualInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaVictimaViolenciaSexualInput;?></option>
					</select>
				</div>					
	
				<!-- 67. Consulta Nutrición -->
				<?php $ConsultaNutricionInput = $Registro["0"]["ConsultaNutricionInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaNutricionInput">67. Consulta Nutrición</label>
					<select name="ConsultaNutricionInput" id="editable-select16" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaNutricionInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaNutricionInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaNutricionInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaNutricionInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaNutricionInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaNutricionInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaNutricionInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaNutricionInput;?>" <?php if($ConsultaNutricionInput!="1800-01-01" || $ConsultaNutricionInput!="1845-01-01" || $ConsultaNutricionInput!="1805-01-01" || $ConsultaNutricionInput!="1810-01-01" || $ConsultaNutricionInput!="1825-01-01" || $ConsultaNutricionInput!="1830-01-01" || $ConsultaNutricionInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaNutricionInput;?></option>
					</select>
				</div>	

				<!-- 68. Consulta de Psicología -->
				<?php $ConsultaPsicologiaInput = $Registro["0"]["ConsultaPsicologiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaPsicologiaInput">68. Consulta de Psicología</label>
					<select name="ConsultaPsicologiaInput" id="editable-select17" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaPsicologiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaPsicologiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaPsicologiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaPsicologiaInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaPsicologiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaPsicologiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaPsicologiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaPsicologiaInput;?>" <?php if($ConsultaPsicologiaInput!="1800-01-01" || $ConsultaPsicologiaInput!="1845-01-01" || $ConsultaPsicologiaInput!="1805-01-01" || $ConsultaPsicologiaInput!="1810-01-01" || $ConsultaPsicologiaInput!="1825-01-01" || $ConsultaPsicologiaInput!="1830-01-01" || $ConsultaPsicologiaInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaPsicologiaInput;?></option>
					</select>
				</div>	

				<!-- 69. Consulta de Crecimiento y Desarrollo Primera Vez -->
				<?php $ConsultaCyDPrimeraVezInput = $Registro["0"]["ConsultaCyDPrimeraVezInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaCyDPrimeraVezInput">69. Consulta de Crecimiento y Desarrollo Primera Vez</label>
					<select name="ConsultaCyDPrimeraVezInput" id="editable-select18" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1825-01-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaCyDPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaCyDPrimeraVezInput;?>" <?php if($ConsultaCyDPrimeraVezInput!="1800-01-01" || $ConsultaCyDPrimeraVezInput!="1845-01-01" || $ConsultaCyDPrimeraVezInput!="1805-01-01" || $ConsultaCyDPrimeraVezInput!="1810-01-01" || $ConsultaCyDPrimeraVezInput!="1825-01-01" || $ConsultaCyDPrimeraVezInput!="1830-01-01" || $ConsultaCyDPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaCyDPrimeraVezInput;?></option>
					</select>
				</div>	

				<!-- 70. Suministro de Sulfato Ferroso en la Última Consulta del Menor de 10 Años -->
				<?php $SuministroSulfatoFerrosoMenor = $Registro["0"]["SuministroSulfatoFerrosoMenor"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroSulfatoFerrosoMenor">70. Suministro de Sulfato Ferroso en la Última Consulta del Menor de 10 Años</label>
					<select name="SuministroSulfatoFerrosoMenor" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($SuministroSulfatoFerrosoMenor=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($SuministroSulfatoFerrosoMenor=="1") echo "selected";?> >1 - Si se suministra</option>
						<option value="16" <?php if($SuministroSulfatoFerrosoMenor=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
						<option value="17" <?php if($SuministroSulfatoFerrosoMenor=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($SuministroSulfatoFerrosoMenor=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
						<option value="20" <?php if($SuministroSulfatoFerrosoMenor=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
						<option value="21" <?php if($SuministroSulfatoFerrosoMenor=="21") echo "selected";?> >21 - Registro No Evaluado</option>
					</select>
				</div>
				
				<!-- 71. Suministro de Vitamina A en la Última Consulta del Menor de 10 Años -->
				<?php $SuministroVitaminaAMenor = $Registro["0"]["SuministroVitaminaAMenor"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="SuministroVitaminaAMenor">71. Suministro de Vitamina A en la Última Consulta del Menor de 10 Años</label>
					<select name="SuministroVitaminaAMenor" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($SuministroVitaminaAMenor=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($SuministroVitaminaAMenor=="1") echo "selected";?> >1 - Si se suministra</option>
						<option value="16" <?php if($SuministroVitaminaAMenor=="16") echo "selected";?> >16 - No se suministra por una tradición</option>
						<option value="17" <?php if($SuministroVitaminaAMenor=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($SuministroVitaminaAMenor=="18") echo "selected";?> >18 - No se suministra por negación de la usuaria</option>
						<option value="20" <?php if($SuministroVitaminaAMenor=="20") echo "selected";?> >20 - No se suministra por otras razones</option>
						<option value="21" <?php if($SuministroVitaminaAMenor=="21") echo "selected";?> >21 - Registro No Evaluado</option>
					</select>
				</div>

				<!-- 72. Consulta de Joven Primera Vez -->
				<?php $ConsultaJovenPrimeraVezInput = $Registro["0"]["ConsultaJovenPrimeraVezInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaJovenPrimeraVezInput">72. Consulta de Joven Primera Vez</label>
					<select name="ConsultaJovenPrimeraVezInput" id="editable-select19" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1825-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1830-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1835-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaJovenPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaJovenPrimeraVezInput;?>" <?php if($ConsultaJovenPrimeraVezInput!="1800-01-01" || $ConsultaJovenPrimeraVezInput!="1845-01-01" || $ConsultaJovenPrimeraVezInput!="1805-01-01" || $ConsultaJovenPrimeraVezInput!="1810-01-01" || $ConsultaJovenPrimeraVezInput!="1825-01-01" || $ConsultaJovenPrimeraVezInput!="1830-01-01" || $ConsultaJovenPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaJovenPrimeraVezInput;?></option>
					</select>
				</div>

				<!-- 73. Consulta de Adulto Primera Vez -->
				<?php $ConsultaAdultoPrimeraVezInput = $Registro["0"]["ConsultaAdultoPrimeraVezInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ConsultaAdultoPrimeraVezInput">73. Consulta de Adulto Primera Vez</label>
					<select name="ConsultaAdultoPrimeraVezInput" id="editable-select20" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ConsultaAdultoPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ConsultaAdultoPrimeraVezInput;?>" <?php if($ConsultaAdultoPrimeraVezInput!="1800-01-01" || $ConsultaAdultoPrimeraVezInput!="1845-01-01" || $ConsultaAdultoPrimeraVezInput!="1805-01-01" || $ConsultaAdultoPrimeraVezInput!="1810-01-01" || $ConsultaAdultoPrimeraVezInput!="1825-01-01" || $ConsultaAdultoPrimeraVezInput!="1830-01-01" || $ConsultaAdultoPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $ConsultaAdultoPrimeraVezInput;?></option>
					</select>
				</div>

				<!-- 74. Preservativos entregados a pacientes con ITS -->
				<?php $PreservativosITSInput = $Registro["0"]["PreservativosITSInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="PreservativosITSInput">74. Preservativos entregados a pacientes con ITS</label>
					<select name="PreservativosITSInput" id="editable-select21" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="999" <?php if($PreservativosITSInput=="999") {echo "selected";};?> >999 - No se tiene el dato</option>
						<option value="997" <?php if($PreservativosITSInput=="997"){echo "selected";};?> >997 - No se realiza por una tradición</option>
						<option value="996" <?php if($PreservativosITSInput=="996"){echo "selected";};?> >996 - No se realiza por una condición de salud</option>
						<option value="995" <?php if($PreservativosITSInput=="995"){echo "selected";};?> >995 - No se realiza por negación del usuario</option>
						<option value="994" <?php if($PreservativosITSInput=="994"){echo "selected";};?> >994 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="993" <?php if($PreservativosITSInput=="993"){echo "selected";};?> >993 - No se realiza por otras razones</option>
						<option value="0" <?php if($PreservativosITSInput=="0"){echo "selected";};?> >0 - No Aplica</option>
						<option value="<?php echo $PreservativosITSInput;?>" <?php if($PreservativosITSInput!="999" || $PreservativosITSInput!="0" || $PreservativosITSInput!="997" || $PreservativosITSInput!="996" || $PreservativosITSInput!="995" || $PreservativosITSInput!="994" || $PreservativosITSInput!="993") echo "selected";?> ><?php echo $PreservativosITSInput;?></option>
					</select>
				</div>

				<!-- 75. Asesoría Pre test Elisa para VIH -->
				<?php $AsesoriaPreElisaInput = $Registro["0"]["AsesoriaPreElisaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="AsesoriaPreElisaInput">75. Asesoría Pre test Elisa para VIH</label>
					<select name="AsesoriaPreElisaInput" id="editable-select22" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($AsesoriaPreElisaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($AsesoriaPreElisaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($AsesoriaPreElisaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($AsesoriaPreElisaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($AsesoriaPreElisaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($AsesoriaPreElisaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($AsesoriaPreElisaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $AsesoriaPreElisaInput;?>" <?php if($AsesoriaPreElisaInput!="1800-01-01" || $AsesoriaPreElisaInput!="1845-01-01" || $AsesoriaPreElisaInput!="1805-01-01" || $AsesoriaPreElisaInput!="1810-01-01" || $AsesoriaPreElisaInput!="1825-01-01" || $AsesoriaPreElisaInput!="1830-01-01" || $AsesoriaPreElisaInput!="1835-01-01") echo "selected";?> ><?php echo $AsesoriaPreElisaInput;?></option>
					</select>
				</div>

				<!-- 76. Asesoría Post test Elisa para VIH -->
				<?php $AsesoriaPostElisaInput = $Registro["0"]["AsesoriaPostElisaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="AsesoriaPostElisaInput">76. Asesoría Post test Elisa para VIH</label>
					<select name="AsesoriaPostElisaInput" id="editable-select23" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($AsesoriaPostElisaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($AsesoriaPostElisaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($AsesoriaPostElisaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($AsesoriaPostElisaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($AsesoriaPostElisaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($AsesoriaPostElisaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($AsesoriaPostElisaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $AsesoriaPostElisaInput;?>" <?php if($AsesoriaPostElisaInput!="1800-01-01" || $AsesoriaPostElisaInput!="1845-01-01" || $AsesoriaPostElisaInput!="1805-01-01" || $AsesoriaPostElisaInput!="1810-01-01" || $AsesoriaPostElisaInput!="1825-01-01" || $AsesoriaPostElisaInput!="1830-01-01" || $AsesoriaPostElisaInput!="1835-01-01") echo "selected";?> ><?php echo $AsesoriaPostElisaInput;?></option>
					</select>
				</div>

				<!-- 77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo -->
				<?php $PacienteEnfermedadMental = $Registro["0"]["PacienteEnfermedadMental"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="PacienteEnfermedadMental">77. Paciente con Diagnóstico de: Ansiedad, Depresión, Esquizofrenia, déficit de atención, consumo SPA y Bipolaridad recibió Atención en los últimos 6 meses por Equipo Interdisciplinario Completo</label>
					<select name="PacienteEnfermedadMental" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($PacienteEnfermedadMental=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($PacienteEnfermedadMental=="1") echo "selected";?> >1 - En Proceso de Atención</option>
						<option value="2" <?php if($PacienteEnfermedadMental=="2") echo "selected";?> >2 - Si recibió atención por equipo interdisciplinario completo</option>
						<option value="16" <?php if($PacienteEnfermedadMental=="16") echo "selected";?> >16 - No recibió atención por tener una tradición que se lo impide</option>
						<option value="17" <?php if($PacienteEnfermedadMental=="17") echo "selected";?> >17 - No se suministra por una condición de salud</option>
						<option value="18" <?php if($PacienteEnfermedadMental=="18") echo "selected";?> >18 - No se suministra por negación del usuario</option>
						<option value="19" <?php if($PacienteEnfermedadMental=="19") echo "selected";?> >19 - No recibió atención porque los datos de contacto del usuario no se encuentran actualizados </option>
						<option value="20" <?php if($PacienteEnfermedadMental=="20") echo "selected";?> >20 - No recibió atención por otras razones</option>
						<option value="22" <?php if($PacienteEnfermedadMental=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>
				
				<!-- 78. Fecha Antígeno de Superficie Hepatitis B en Gestantes -->
				<?php $FechaAntigenoHepatitisBGestantesInput = $Registro["0"]["FechaAntigenoHepatitisBGestantesInput"];?>
	
				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaAntigenoHepatitisBGestantesInput">78. Fecha Antígeno de Superficie Hepatitis B en Gestantes</label>
					<select name="FechaAntigenoHepatitisBGestantesInput" id="editable-select24" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaAntigenoHepatitisBGestantesInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaAntigenoHepatitisBGestantesInput;?>" <?php if($FechaAntigenoHepatitisBGestantesInput!="1800-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1845-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1805-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1810-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1825-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1830-01-01" || $FechaAntigenoHepatitisBGestantesInput!="1835-01-01") echo "selected";?> ><?php echo $FechaAntigenoHepatitisBGestantesInput;?></option>
					</select>
				</div>

				<!-- 79. Resultado Antígeno de Superficie Hepatitis B en Gestantes -->
				<?php $ResultadoAntigenoHepatitisBGestantes = $Registro["0"]["ResultadoAntigenoHepatitisBGestantes"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoAntigenoHepatitisBGestantes">79. Resultado Antígeno de Superficie Hepatitis B en Gestantes</label>
					<select name="ResultadoAntigenoHepatitisBGestantes" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($ResultadoAntigenoHepatitisBGestantes=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($ResultadoAntigenoHepatitisBGestantes=="1") echo "selected";?> >1 - Negativo</option>
						<option value="2" <?php if($ResultadoAntigenoHepatitisBGestantes=="2") echo "selected";?> >2 - Positivo</option>
						<option value="22" <?php if($ResultadoAntigenoHepatitisBGestantes=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 80. Fecha Serología para Sífilis -->
				<?php $FechaSerologiaSifilisInput = $Registro["0"]["FechaSerologiaSifilisInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaSerologiaSifilisInput">80. Fecha Serología para Sífilis</label>
					<select name="FechaSerologiaSifilisInput" id="editable-select24" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaSerologiaSifilisInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaSerologiaSifilisInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaSerologiaSifilisInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaSerologiaSifilisInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaSerologiaSifilisInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaSerologiaSifilisInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaSerologiaSifilisInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaSerologiaSifilisInput;?>" <?php if($FechaSerologiaSifilisInput!="1800-01-01" || $FechaSerologiaSifilisInput!="1845-01-01" || $FechaSerologiaSifilisInput!="1805-01-01" || $FechaSerologiaSifilisInput!="1810-01-01" || $FechaSerologiaSifilisInput!="1825-01-01" || $FechaSerologiaSifilisInput!="1830-01-01" || $FechaSerologiaSifilisInput!="1835-01-01") echo "selected";?> ><?php echo $FechaSerologiaSifilisInput;?></option>
					</select>
				</div>

				<!-- 81. Resultado Serología para Sífilis -->
				<?php $ResultadoSerologiaSifilis = $Registro["0"]["ResultadoSerologiaSifilis"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoSerologiaSifilis">81. Resultado Serología para Sífilis</label>
					<select name="ResultadoSerologiaSifilis" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($ResultadoSerologiaSifilis=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($ResultadoSerologiaSifilis=="1") echo "selected";?> >1 - No Reactiva</option>
						<option value="2" <?php if($ResultadoSerologiaSifilis=="2") echo "selected";?> >2 - Reactiva</option>
						<option value="22" <?php if($ResultadoSerologiaSifilis=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>
				
				<!-- 82. Fecha de Toma de Elisa para VIH -->
				<?php $FechaTomaElisaVIHInput = $Registro["0"]["FechaTomaElisaVIHInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaElisaVIHInput">82. Fecha de Toma de Elisa para VIH</label>
					<select name="FechaTomaElisaVIHInput" id="editable-select25" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaElisaVIHInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaElisaVIHInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaElisaVIHInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaElisaVIHInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaElisaVIHInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaElisaVIHInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaElisaVIHInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaElisaVIHInput;?>" <?php if($FechaTomaElisaVIHInput!="1800-01-01" || $FechaTomaElisaVIHInput!="1845-01-01" || $FechaTomaElisaVIHInput!="1805-01-01" || $FechaTomaElisaVIHInput!="1810-01-01" || $FechaTomaElisaVIHInput!="1825-01-01" || $FechaTomaElisaVIHInput!="1830-01-01" || $FechaTomaElisaVIHInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaElisaVIHInput;?></option>
					</select>
				</div>
				
				<!-- 83. Resultado Elisa para VIH -->
				<?php $ResultadoElisaVIH = $Registro["0"]["ResultadoElisaVIH"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoElisaVIH">83. Resultado Elisa para VIH</label>
					<select name="ResultadoElisaVIH" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($ResultadoElisaVIH=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($ResultadoElisaVIH=="1") echo "selected";?> >1 - Negativo</option>
						<option value="2" <?php if($ResultadoElisaVIH=="2") echo "selected";?> >2 - Positivo</option>
						<option value="22" <?php if($ResultadoElisaVIH=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 84. Fecha TSH Neonatal -->
				<?php $FechaTSHNeonatalInput = $Registro["0"]["FechaTSHNeonatalInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTSHNeonatalInput">84. Fecha TSH Neonatal</label>
					<select name="FechaTSHNeonatalInput" id="editable-select26" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTSHNeonatalInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTSHNeonatalInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTSHNeonatalInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTSHNeonatalInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTSHNeonatalInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTSHNeonatalInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTSHNeonatalInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTSHNeonatalInput;?>" <?php if($FechaTSHNeonatalInput!="1800-01-01" || $FechaTSHNeonatalInput!="1845-01-01" || $FechaTSHNeonatalInput!="1805-01-01" || $FechaTSHNeonatalInput!="1810-01-01" || $FechaTSHNeonatalInput!="1825-01-01" || $FechaTSHNeonatalInput!="1830-01-01" || $FechaTSHNeonatalInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTSHNeonatalInput;?></option>
					</select>
				</div>

				<!-- 85. Resultado TSH Neonatal -->
				<?php $ResultadoTSHNeonatal = $Registro["0"]["ResultadoTSHNeonatal"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoTSHNeonatal">85. Resultado TSH Neonatal</label>
					<select name="ResultadoTSHNeonatal" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($ResultadoTSHNeonatal=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($ResultadoTSHNeonatal=="1") echo "selected";?> >1 - Normal</option>
						<option value="2" <?php if($ResultadoTSHNeonatal=="2") echo "selected";?> >2 - Anormal</option>
						<option value="22" <?php if($ResultadoTSHNeonatal=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 86. Tamizaje Cáncer de Cuello Uterino -->
				<?php $TamizajeCancerCU = $Registro["0"]["TamizajeCancerCU"];?>

				<div class="form-group">
				<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TamizajeCancerCU">86. Tamizaje Cáncer de Cuello Uterino</label>
					<select name="TamizajeCancerCU" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($TamizajeCancerCU=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($TamizajeCancerCU=="1") echo "selected";?> >1 - Citología cervico uterina</option>
						<option value="2" <?php if($TamizajeCancerCU=="2") echo "selected";?> >2 - ADN - VPH</option>
						<option value="3" <?php if($TamizajeCancerCU=="3") echo "selected";?> >3 - Técnica de inspección visual</option>
						<option value="16" <?php if($TamizajeCancerCU=="16") echo "selected";?> >16 - No se realiza por una tradición</option>
						<option value="17" <?php if($TamizajeCancerCU=="17") echo "selected";?> >17 - No se realiza por una condición de salud</option>
						<option value="18" <?php if($TamizajeCancerCU=="18") echo "selected";?> >18 - No se realiza por negación de la usuaria</option>
						<option value="19" <?php if($TamizajeCancerCU=="19") echo "selected";?> >19 - No se realiza por tener datos de contacto de la usuaria no actualizados</option>
						<option value="20" <?php if($TamizajeCancerCU=="20") echo "selected";?> >20 - No se realiza por otras razones</option>
						<option value="22" <?php if($TamizajeCancerCU=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 87. Fecha Citología Cervico Uterina -->
				<?php $FechaCitologiaCUInput = $Registro["0"]["FechaCitologiaCUInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaCitologiaCUInput">87. Fecha Citología Cervico Uterina</label>
					<select name="FechaCitologiaCUInput" id="editable-select27" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaCitologiaCUInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaCitologiaCUInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaCitologiaCUInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaCitologiaCUInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaCitologiaCUInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaCitologiaCUInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaCitologiaCUInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaCitologiaCUInput;?>" <?php if($FechaCitologiaCUInput!="1800-01-01" || $FechaCitologiaCUInput!="1845-01-01" || $FechaCitologiaCUInput!="1805-01-01" || $FechaCitologiaCUInput!="1810-01-01" || $FechaCitologiaCUInput!="1825-01-01" || $FechaCitologiaCUInput!="1830-01-01" || $FechaCitologiaCUInput!="1835-01-01") echo "selected";?> ><?php echo $FechaCitologiaCUInput;?></option>
					</select>
				</div>
				
				<!-- 88. Citología Cervico Uterina Resultados según Bethesda -->
				<?php $CitologiaCUResultados = $Registro["0"]["CitologiaCUResultados"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CitologiaCUResultados">88. Citología Cervico Uterina Resultados según Bethesda</label>
					<select name="CitologiaCUResultados" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($CitologiaCUResultados=="1") echo "selected";?> >1 - ASC-US (células escamosas atípicas de significado indeterminado)</option>
						<option value="2" <?php if($CitologiaCUResultados=="2") echo "selected";?> >2 - ASC-H (células escamosas atípicas, de significado indeterminado sugestivo de LEI de alto grado)</option>
						<option value="3" <?php if($CitologiaCUResultados=="3") echo "selected";?> >3 - Lesión intraepitelial escamosa (LEI) de bajo grado- HPV (NIC I) (LEI BG)</option>
						<option value="4" <?php if($CitologiaCUResultados=="4") echo "selected";?> >4 - Lesión intraepitelial escamosa (LEI) de alto grado (NIC II-III CA INSITU) (LEI AG)</option>
						<option value="5" <?php if($CitologiaCUResultados=="5") echo "selected";?> >5 - Lesión intraepitelial escamosa de alto grado sospechosa de infiltración</option>
						<option value="6" <?php if($CitologiaCUResultados=="6") echo "selected";?> >6 - Carcinoma de células escamosas (escamocelular)</option>
						<option value="7" <?php if($CitologiaCUResultados=="7") echo "selected";?> >7 - Células endocervicales atípicas sin ningún otro significado</option>
						<option value="8" <?php if($CitologiaCUResultados=="8") echo "selected";?> >8 - Células endometriales atípicas sin ningún otro significado</option>
						<option value="9" <?php if($CitologiaCUResultados=="9") echo "selected";?> >9 - Células glandulares atípicas sin ningún otro significado</option>
						<option value="10" <?php if($CitologiaCUResultados=="10") echo "selected";?> >10 - Células endocervicales atípicas sospechosas de neoplasia</option>
						<option value="11" <?php if($CitologiaCUResultados=="11") echo "selected";?> >11 - Células endometriales atípicas sospechosas de neoplasia</option>
						<option value="12" <?php if($CitologiaCUResultados=="12") echo "selected";?> >12 - Células glandulares atípicas sospechosas de neoplasia</option>
						<option value="13" <?php if($CitologiaCUResultados=="13") echo "selected";?> >13 - Adenocarcinoma endocervical in situ</option>
						<option value="14" <?php if($CitologiaCUResultados=="14") echo "selected";?> >14 - Adenocarcinoma endocervical</option>
						<option value="15" <?php if($CitologiaCUResultados=="15") echo "selected";?> >15 - Adenocarcinoma endometrial</option>
						<option value="16" <?php if($CitologiaCUResultados=="16") echo "selected";?> >16 - Otras neoplasias</option>
						<option value="17" <?php if($CitologiaCUResultados=="17") echo "selected";?> >17 - Negativa para lesión intraepitelial o neoplasia</option>
						<option value="18" <?php if($CitologiaCUResultados=="18") echo "selected";?> >18 - Inadecuada para lectura</option>
						<option value="999" <?php if($CitologiaCUResultados=="999") echo "selected";?> >999 - Sin Dato</option>
						<option value="0" <?php if($CitologiaCUResultados=="0") echo "selected";?> >0 - No Aplica</option>
					</select>
				</div>

				<!-- 89. Calidad en la Muestra de Citología Cervicouterina -->
				<?php $CalidadMuestraCitologia = $Registro["0"]["CalidadMuestraCitologia"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CalidadMuestraCitologia">89. Calidad en la Muestra de Citología Cervicouterina</label>
					<select name="CalidadMuestraCitologia" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($CalidadMuestraCitologia=="1") echo "selected";?> >1 - Satisfactoria Zona de Transformación Presente</option>
						<option value="2" <?php if($CalidadMuestraCitologia=="2") echo "selected";?> >2 - Satisfactoria Zona de Transformación Ausente</option>
						<option value="3" <?php if($CalidadMuestraCitologia=="3") echo "selected";?> >3 - Insatisfactoria</option>
						<option value="4" <?php if($CalidadMuestraCitologia=="4") echo "selected";?> >4 - Rechazada</option>
						<option value="999" <?php if($CalidadMuestraCitologia=="999") echo "selected";?> >999 - Sin Dato</option>
						<option value="0" <?php if($CalidadMuestraCitologia=="0") echo "selected";?> >0 - No Aplica</option>
					</select>
				</div>

				<!-- 90. Código de Habilitación IPS donde se toma la Citología Cervicouterina -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoHabilitacionIPSTomaMuestra">90. Código de Habilitación IPS donde se toma la Citología Cervicouterina</label>
						<input type="text" name="CodigoHabilitacionIPSTomaMuestra" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["CodigoHabilitacionIPSTomaMuestra"]; ?>">
				</div>

				<!-- 91. Fecha Colposcopia -->
				<?php $FechaColposcopiaInput = $Registro["0"]["FechaColposcopiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaColposcopiaInput">91. Fecha Colposcopia</label>
					<select name="FechaColposcopiaInput" id="editable-select28" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaColposcopiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaColposcopiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaColposcopiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaColposcopiaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaColposcopiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaColposcopiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaColposcopiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaColposcopiaInput;?>" <?php if($FechaColposcopiaInput!="1800-01-01" || $FechaColposcopiaInput!="1845-01-01" || $FechaColposcopiaInput!="1805-01-01" || $FechaColposcopiaInput!="1810-01-01" || $FechaColposcopiaInput!="1825-01-01" || $FechaColposcopiaInput!="1830-01-01" || $FechaColposcopiaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaColposcopiaInput;?></option>
					</select>
				</div>

				<!-- 92. Código Habilitación IPS donde se toma la Colposcopia -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoHabilitacionTomaColposcopia">92. Código Habilitación IPS donde se toma la Colposcopia</label>
						<input type="text" name="CodigoHabilitacionTomaColposcopia" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["CodigoHabilitacionTomaColposcopia"]; ?>">
				</div>

				<!-- 93. Fecha Biopsia Cervical -->
				<?php $FechaBiopsiaCervicalInput = $Registro["0"]["FechaBiopsiaCervicalInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaBiopsiaCervicalInput">93. Fecha Biopsia Cervical</label>
					<select name="FechaBiopsiaCervicalInput" id="editable-select29" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaBiopsiaCervicalInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaBiopsiaCervicalInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaBiopsiaCervicalInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaBiopsiaCervicalInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaBiopsiaCervicalInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaBiopsiaCervicalInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaBiopsiaCervicalInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaBiopsiaCervicalInput;?>" <?php if($FechaBiopsiaCervicalInput!="1800-01-01" || $FechaBiopsiaCervicalInput!="1845-01-01" || $FechaBiopsiaCervicalInput!="1805-01-01" || $FechaBiopsiaCervicalInput!="1810-01-01" || $FechaBiopsiaCervicalInput!="1825-01-01" || $FechaBiopsiaCervicalInput!="1830-01-01" || $FechaBiopsiaCervicalInput!="1835-01-01") echo "selected";?> ><?php echo $FechaBiopsiaCervicalInput;?></option>
					</select>
				</div>

				<!-- 94. Resultado de Biopsia Cervical -->
				<?php $ResultadoBiopsiaCervical = $Registro["0"]["ResultadoBiopsiaCervical"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoBiopsiaCervical">94. Resultado de Biopsia Cervical</label>
					<select name="ResultadoBiopsiaCervical" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($ResultadoBiopsiaCervical=="1") echo "selected";?> >1 - Negativo para Neoplasia</option>
						<option value="2" <?php if($ResultadoBiopsiaCervical=="2") echo "selected";?> >2 - Infección por VPH</option>
						<option value="3" <?php if($ResultadoBiopsiaCervical=="3") echo "selected";?> >3 - NIC de Bajo Grado - NIC I</option>
						<option value="4" <?php if($ResultadoBiopsiaCervical=="4") echo "selected";?> >4 - NIC de Alto Grado - NIC II - NIC III</option>
						<option value="5" <?php if($ResultadoBiopsiaCervical=="5") echo "selected";?> >5 - Neoplasia Microinfiltrante: Escamocelular o Adenocarcinoma</option>
						<option value="6" <?php if($ResultadoBiopsiaCervical=="6") echo "selected";?> >6 - Neoplasia Infiltrante: Escamocelular o Adenocarcinoma</option>
						<option value="999" <?php if($ResultadoBiopsiaCervical=="999") echo "selected";?> >999 - Sin Dato</option>
						<option value="0" <?php if($ResultadoBiopsiaCervical=="0") echo "selected";?> >0 - No Aplica</option>
					</select>
				</div>	

				<!-- 95. Código Habilitación IPS donde se toma la Biopsia Cervical -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoHabilitacionTomaBiopsia">95. Código Habilitación IPS donde se toma la Biopsia Cervical</label>
					<input type="text" name="CodigoHabilitacionTomaBiopsia" class="form-control col-lg-3 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["CodigoHabilitacionTomaBiopsia"]; ?>">
				</div>

				<!-- 96. Fecha Mamografía -->
				<?php $FechaMamografiaInput = $Registro["0"]["FechaMamografiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaMamografiaInput">96. Fecha Mamografía</label>
					<select name="FechaMamografiaInput" id="editable-select30" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaMamografiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaMamografiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaMamografiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaMamografiaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaMamografiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaMamografiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaMamografiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaMamografiaInput;?>" <?php if($FechaMamografiaInput!="1800-01-01" || $FechaMamografiaInput!="1845-01-01" || $FechaMamografiaInput!="1805-01-01" || $FechaMamografiaInput!="1810-01-01" || $FechaMamografiaInput!="1825-01-01" || $FechaMamografiaInput!="1830-01-01" || $FechaMamografiaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaMamografiaInput;?></option>
					</select>
				</div>				

				<!-- 97. Resultado Mamografía -->
				<?php $ResultadoMamografia = $Registro["0"]["ResultadoMamografia"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoMamografia">97. Resultado Mamografía</label>
					<select name="ResultadoMamografia" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($ResultadoMamografia=="1") echo "selected";?> >1 - BIRADS 0: Necesidad de Nuevo Estudio Imagenológico o Mamograma previo para evaluación</option>
						<option value="2" <?php if($ResultadoMamografia=="2") echo "selected";?> >2 - BIRADS 1: Negativo</option>
						<option value="3" <?php if($ResultadoMamografia=="3") echo "selected";?> >3 - BIRADS 2: Hallazgos Benignos</option>
						<option value="4" <?php if($ResultadoMamografia=="4") echo "selected";?> >4 - BIRADS 3: Probablemente Benigno</option>
						<option value="5" <?php if($ResultadoMamografia=="5") echo "selected";?> >5 - BIRADS 4: Anormalidad Sospechosa</option>
						<option value="6" <?php if($ResultadoMamografia=="5") echo "selected";?> >6 - BIRADS 5: Altamente Sospechoso de Malignidad</option>
						<option value="7" <?php if($ResultadoMamografia=="6") echo "selected";?> >7 - BIRADS 6: Malignidad por Biopsia conocida</option>
						<option value="999" <?php if($ResultadoMamografia=="999") echo "selected";?> >999 - Sin Dato</option>
						<option value="0" <?php if($ResultadoMamografia=="0") echo "selected";?> >0 - No Aplica</option>
					</select>
				</div>	

				<!-- 98. Código Habilitación IPS donde se toma la Mamografía -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoHabilitacionTomaMamografia">98. Código Habilitación IPS donde se toma la Mamografía</label>
					<input type="text" name="CodigoHabilitacionTomaMamografia" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["CodigoHabilitacionTomaMamografia"]; ?>">
				</div>
				
				<!-- 99. Fecha Toma Biopsia Seno por BACAF -->
				<?php $FechaBiopsiaSenoInput = $Registro["0"]["FechaBiopsiaSenoInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaBiopsiaSenoInput">96. Fecha Mamografía</label>
					<select name="FechaBiopsiaSenoInput" id="editable-select31" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaBiopsiaSenoInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaBiopsiaSenoInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaBiopsiaSenoInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaBiopsiaSenoInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaBiopsiaSenoInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaBiopsiaSenoInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaBiopsiaSenoInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaBiopsiaSenoInput;?>" <?php if($FechaBiopsiaSenoInput!="1800-01-01" || $FechaBiopsiaSenoInput!="1845-01-01" || $FechaBiopsiaSenoInput!="1805-01-01" || $FechaBiopsiaSenoInput!="1810-01-01" || $FechaBiopsiaSenoInput!="1825-01-01" || $FechaBiopsiaSenoInput!="1830-01-01" || $FechaBiopsiaSenoInput!="1835-01-01") echo "selected";?> ><?php echo $FechaBiopsiaSenoInput;?></option>
					</select>
				</div>	

				<!-- 100. Fecha Resultado Biopsia Seno por BACAF -->
				<?php $FechaResultadoBiopsiaSeno = $Registro["0"]["FechaResultadoBiopsiaSeno"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaResultadoBiopsiaSeno">100. Fecha Resultado Biopsia Seno por BACAF</label>
					<select name="FechaResultadoBiopsiaSeno" id="editable-select32" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaResultadoBiopsiaSeno=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaResultadoBiopsiaSeno=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaResultadoBiopsiaSeno=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaResultadoBiopsiaSeno=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaResultadoBiopsiaSeno=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaResultadoBiopsiaSeno=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaResultadoBiopsiaSeno=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaResultadoBiopsiaSeno;?>" <?php if($FechaResultadoBiopsiaSeno!="1800-01-01" || $FechaResultadoBiopsiaSeno!="1845-01-01" || $FechaResultadoBiopsiaSeno!="1805-01-01" || $FechaResultadoBiopsiaSeno!="1810-01-01" || $FechaResultadoBiopsiaSeno!="1825-01-01" || $FechaResultadoBiopsiaSeno!="1830-01-01" || $FechaResultadoBiopsiaSeno!="1835-01-01") echo "selected";?> ><?php echo $FechaResultadoBiopsiaSeno;?></option>
					</select>
				</div>

				<!-- 101. Resultado Biopsia Seno por BACAF -->
				<?php $ResultadoBiopsiaSeno = $Registro["0"]["ResultadoBiopsiaSeno"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoBiopsiaSeno">101. Resultado Biopsia Seno por BACAF</label>
					<select name="ResultadoBiopsiaSeno" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($ResultadoBiopsiaSeno=="1") echo "selected";?> >1 - Benigna</option>
						<option value="2" <?php if($ResultadoBiopsiaSeno=="2") echo "selected";?> >2 - Atípica (Indeterminada)</option>
						<option value="3" <?php if($ResultadoBiopsiaSeno=="3") echo "selected";?> >3 - Malignidad Sospechosa/Probable</option>
						<option value="4" <?php if($ResultadoBiopsiaSeno=="4") echo "selected";?> >4 - Maligna</option>
						<option value="5" <?php if($ResultadoBiopsiaSeno=="5") echo "selected";?> >5 - No Satisfactoria</option>
						<option value="999" <?php if($ResultadoBiopsiaSeno=="999") echo "selected";?> >999 - Sin Dato</option>
						<option value="0" <?php if($ResultadoBiopsiaSeno=="0") echo "selected";?> >0 - No Aplica</option>
					</select>
				</div>

				<!-- 102. Código Habilitación IPS donde se toma la Biopsia de Seno por BACAF -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="CodigoHabilitacionBiopsiaSeno">102. Código Habilitación IPS donde se toma la Biopsia de Seno por BACAF</label>
					<input type="text" name="CodigoHabilitacionBiopsiaSeno" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["CodigoHabilitacionBiopsiaSeno"]; ?>">
				</div>

				<!-- 103. Fecha Toma de Hemoglobina -->
				<?php $FechaTomaHemoglobinaInput = $Registro["0"]["FechaTomaHemoglobinaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaHemoglobinaInput">103. Fecha Toma de Hemoglobina</label>
					<select name="FechaTomaHemoglobinaInput" id="editable-select33" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaHemoglobinaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaHemoglobinaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaHemoglobinaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaHemoglobinaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaHemoglobinaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaHemoglobinaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaHemoglobinaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaHemoglobinaInput;?>" <?php if($FechaTomaHemoglobinaInput!="1800-01-01" || $FechaTomaHemoglobinaInput!="1845-01-01" || $FechaTomaHemoglobinaInput!="1805-01-01" || $FechaTomaHemoglobinaInput!="1810-01-01" || $FechaTomaHemoglobinaInput!="1825-01-01" || $FechaTomaHemoglobinaInput!="1830-01-01" || $FechaTomaHemoglobinaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaHemoglobinaInput;?></option>
					</select>
				</div>

				<!-- 104. Resultado Hemoglobina -->
				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoHemoglobina">104. Resultado Hemoglobina Alteración del Joven</label>
					<input type="text" name="ResultadoHemoglobina" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["ResultadoHemoglobina"]; ?>">
				</div>

				<!-- 105. Fecha de la Toma de Glisemia Basal -->
				<?php $FechaTomaGlisemiaInput = $Registro["0"]["FechaTomaGlisemiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaGlisemiaInput">105. Fecha de la Toma de Glisemia Basal</label>
					<select name="FechaTomaGlisemiaInput" id="editable-select34" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaGlisemiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaGlisemiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaGlisemiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaGlisemiaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaGlisemiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaGlisemiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaGlisemiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaGlisemiaInput;?>" <?php if($FechaTomaGlisemiaInput!="1800-01-01" || $FechaTomaGlisemiaInput!="1845-01-01" || $FechaTomaGlisemiaInput!="1805-01-01" || $FechaTomaGlisemiaInput!="1810-01-01" || $FechaTomaGlisemiaInput!="1825-01-01" || $FechaTomaGlisemiaInput!="1830-01-01" || $FechaTomaGlisemiaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaGlisemiaInput;?></option>
					</select>
				</div>

				<!-- 106. Fecha Toma Creatinina -->
				<?php $FechaTomaCreatininaInput = $Registro["0"]["FechaTomaCreatininaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaCreatininaInput">106. Fecha Toma Creatinina</label>
					<select name="FechaTomaCreatininaInput" id="editable-select35" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaCreatininaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaCreatininaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaCreatininaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaCreatininaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaCreatininaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaCreatininaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaCreatininaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaCreatininaInput;?>" <?php if($FechaTomaCreatininaInput!="1800-01-01" || $FechaTomaCreatininaInput!="1845-01-01" || $FechaTomaCreatininaInput!="1805-01-01" || $FechaTomaCreatininaInput!="1810-01-01" || $FechaTomaCreatininaInput!="1825-01-01" || $FechaTomaCreatininaInput!="1830-01-01" || $FechaTomaCreatininaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaCreatininaInput;?></option>
					</select>
				</div>

				<!-- 107. Resultado Creatinina -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoCreatinina">107. Resultado Creatinina</label>
					<input type="text" name="ResultadoCreatinina" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["ResultadoCreatinina"]; ?>">
				</div>

				<!-- 108. Fecha Hemoglobina Glicosilada -->
				<?php $FechaHemoglobinaGlicosiladaInput = $Registro["0"]["FechaHemoglobinaGlicosiladaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaHemoglobinaGlicosiladaInput">108. Fecha Hemoglobina Glicosilada</label>
					<select name="FechaHemoglobinaGlicosiladaInput" id="editable-select36" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaHemoglobinaGlicosiladaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaHemoglobinaGlicosiladaInput;?>" <?php if($FechaHemoglobinaGlicosiladaInput!="1800-01-01" || $FechaHemoglobinaGlicosiladaInput!="1845-01-01" || $FechaHemoglobinaGlicosiladaInput!="1805-01-01" || $FechaHemoglobinaGlicosiladaInput!="1810-01-01" || $FechaHemoglobinaGlicosiladaInput!="1825-01-01" || $FechaHemoglobinaGlicosiladaInput!="1830-01-01" || $FechaHemoglobinaGlicosiladaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaHemoglobinaGlicosiladaInput;?></option>
					</select>
				</div>

				<!-- 109. Resultado Hemoglobina Glicosilada -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoHemoglobinaGlicosilada">109. Resultado Hemoglobina Glicosilada</label>
					<input type="text" name="ResultadoHemoglobinaGlicosilada" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["ResultadoHemoglobinaGlicosilada"]; ?>">
				</div>

				<!-- 110. Fecha Toma de Microalbuminuria -->
				<?php $FechaTomaMicroalbuminuriaInput = $Registro["0"]["FechaTomaMicroalbuminuriaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaMicroalbuminuriaInput">110. Fecha Toma de Microalbuminuria</label>
					<select name="FechaTomaMicroalbuminuriaInput" id="editable-select37" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaMicroalbuminuriaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaMicroalbuminuriaInput;?>" <?php if($FechaTomaMicroalbuminuriaInput!="1800-01-01" || $FechaTomaMicroalbuminuriaInput!="1845-01-01" || $FechaTomaMicroalbuminuriaInput!="1805-01-01" || $FechaTomaMicroalbuminuriaInput!="1810-01-01" || $FechaTomaMicroalbuminuriaInput!="1825-01-01" || $FechaTomaMicroalbuminuriaInput!="1830-01-01" || $FechaTomaMicroalbuminuriaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaMicroalbuminuriaInput;?></option>
					</select>
				</div>

				<!-- 111. Fecha Toma de HDL -->
				<?php $FechaTomaHDLInput = $Registro["0"]["FechaTomaHDLInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaHDLInput">111. Fecha Toma de HDL</label>
					<select name="FechaTomaHDLInput" id="editable-select38" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaHDLInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaHDLInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaHDLInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaHDLInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaHDLInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaHDLInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaHDLInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaHDLInput;?>" <?php if($FechaTomaHDLInput!="1800-01-01" || $FechaTomaHDLInput!="1845-01-01" || $FechaTomaHDLInput!="1805-01-01" || $FechaTomaHDLInput!="1810-01-01" || $FechaTomaHDLInput!="1825-01-01" || $FechaTomaHDLInput!="1830-01-01" || $FechaTomaHDLInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaHDLInput;?></option>
					</select>
				</div>

				<!-- 112. Fecha Toma de Baciloscopia de Diagnóstico -->
				<?php $FechaTomaBaciloscopiaInput = $Registro["0"]["FechaTomaBaciloscopiaInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTomaBaciloscopiaInput">112. Fecha Toma de Baciloscopia de Diagnóstico</label>
					<select name="FechaTomaBaciloscopiaInput" id="editable-select39" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTomaBaciloscopiaInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTomaBaciloscopiaInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTomaBaciloscopiaInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTomaBaciloscopiaInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTomaBaciloscopiaInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTomaBaciloscopiaInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTomaBaciloscopiaInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTomaBaciloscopiaInput;?>" <?php if($FechaTomaBaciloscopiaInput!="1800-01-01" || $FechaTomaBaciloscopiaInput!="1845-01-01" || $FechaTomaBaciloscopiaInput!="1805-01-01" || $FechaTomaBaciloscopiaInput!="1810-01-01" || $FechaTomaBaciloscopiaInput!="1825-01-01" || $FechaTomaBaciloscopiaInput!="1830-01-01" || $FechaTomaBaciloscopiaInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTomaBaciloscopiaInput;?></option>
					</select>
				</div>

				<!-- 113. Resultado de Baciloscopia de Diagnóstico -->
				<?php $ResultadoBaciloscopia = $Registro["0"]["ResultadoBaciloscopia"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ResultadoBaciloscopia">113. Resultado de Baciloscopia de Diagnóstico</label>
					<select name="ResultadoBaciloscopia" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1" <?php if($ResultadoBaciloscopia=="1") echo "selected";?> >1 - Negativa</option>
						<option value="2" <?php if($ResultadoBaciloscopia=="2") echo "selected";?> >2 - Positiva</option>
						<option value="3" <?php if($ResultadoBaciloscopia=="3") echo "selected";?> >3 - En Proceso</option>
						<option value="4" <?php if($ResultadoBaciloscopia=="4") echo "selected";?> >4 - No</option>
						<option value="22" <?php if($ResultadoBaciloscopia=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 114. Tratamiento para Hipotiroidismo Congénito -->
				<?php $TratamientoHipotiroidismoCongenito = $Registro["0"]["TratamientoHipotiroidismoCongenito"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TratamientoHipotiroidismoCongenito">114. Tratamiento para Hipotiroidismo Congénito</label>
					<select name="TratamientoHipotiroidismoCongenito" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($TratamientoHipotiroidismoCongenito=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($TratamientoHipotiroidismoCongenito=="1") echo "selected";?> >1 - Si recibe tratamiento pero aún no ha terminado</option>
						<option value="2" <?php if($TratamientoHipotiroidismoCongenito=="2") echo "selected";?> >2 - Si recibió tratamiento y ya lo terminó</option>
						<option value="16" <?php if($TratamientoHipotiroidismoCongenito=="16") echo "selected";?> >16 - No recibió tratamiento por tener una tradición que se lo impide</option>
						<option value="17" <?php if($TratamientoHipotiroidismoCongenito=="17") echo "selected";?> >17 - No recibió tratamiento por una condición de salud que se lo impide</option>
						<option value="18" <?php if($TratamientoHipotiroidismoCongenito=="18") echo "selected";?> >18 - No recibió tratamiento por negación del usuario</option>
						<option value="19" <?php if($TratamientoHipotiroidismoCongenito=="19") echo "selected";?> >19 - No recibió tratamiento por que los datos de contacto del usuario no se encuentran actualizados</option>
						<option value="20" <?php if($TratamientoHipotiroidismoCongenito=="20") echo "selected";?> >20 - No recibió tratamiento por otras razones</option>
						<option value="22" <?php if($TratamientoHipotiroidismoCongenito=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 115. Tratamiento para Sífilis Gestacional -->
				<?php $TratamientoSifilisGestacional = $Registro["0"]["TratamientoSifilisGestacional"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TratamientoSifilisGestacional">115. Tratamiento para Sífilis Gestacional</label>
					<select name="TratamientoSifilisGestacional" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($TratamientoSifilisGestacional=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($TratamientoSifilisGestacional=="1") echo "selected";?> >1 - Si recibe tratamiento pero aún no ha terminado</option>
						<option value="2" <?php if($TratamientoSifilisGestacional=="2") echo "selected";?> >2 - Si recibió tratamiento y ya lo terminó</option>
						<option value="16" <?php if($TratamientoSifilisGestacional=="16") echo "selected";?> >16 - No recibió tratamiento por tener una tradición que se lo impide</option>
						<option value="17" <?php if($TratamientoSifilisGestacional=="17") echo "selected";?> >17 - No recibió tratamiento por una condición de salud que se lo impide</option>
						<option value="18" <?php if($TratamientoSifilisGestacional=="18") echo "selected";?> >18 - No recibió tratamiento por negación del usuario</option>
						<option value="19" <?php if($TratamientoSifilisGestacional=="19") echo "selected";?> >19 - No recibió tratamiento por que los datos de contacto del usuario no se encuentran actualizados</option>
						<option value="20" <?php if($TratamientoSifilisGestacional=="20") echo "selected";?> >20 - No recibió tratamiento por otras razones</option>
						<option value="22" <?php if($TratamientoSifilisGestacional=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 116. Tratamiento para Sífilis Congénita -->
				<?php $TratamientoSifilisCongenita = $Registro["0"]["TratamientoSifilisCongenita"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TratamientoSifilisCongenita">116. Tratamiento para Sífilis Congénita</label>
					<select name="TratamientoSifilisCongenita" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($TratamientoSifilisCongenita=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($TratamientoSifilisCongenita=="1") echo "selected";?> >1 - Si recibe tratamiento pero aún no ha terminado</option>
						<option value="2" <?php if($TratamientoSifilisCongenita=="2") echo "selected";?> >2 - Si recibió tratamiento y ya lo terminó</option>
						<option value="16" <?php if($TratamientoSifilisCongenita=="16") echo "selected";?> >16 - No recibió tratamiento por tener una tradición que se lo impide</option>
						<option value="17" <?php if($TratamientoSifilisCongenita=="17") echo "selected";?> >17 - No recibió tratamiento por una condición de salud que se lo impide</option>
						<option value="18" <?php if($TratamientoSifilisCongenita=="18") echo "selected";?> >18 - No recibió tratamiento por negación del usuario</option>
						<option value="19" <?php if($TratamientoSifilisCongenita=="19") echo "selected";?> >19 - No recibió tratamiento por que los datos de contacto del usuario no se encuentran actualizados</option>
						<option value="20" <?php if($TratamientoSifilisCongenita=="20") echo "selected";?> >20 - No recibió tratamiento por otras razones</option>
						<option value="22" <?php if($TratamientoSifilisCongenita=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 117. Tratamiento para Lepra -->
				<?php $TratamientoLepra = $Registro["0"]["TratamientoLepra"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="TratamientoLepra">117. Tratamiento para Lepra</label>
					<select name="TratamientoLepra" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="0" <?php if($TratamientoLepra=="0") echo "selected";?> >0 - No Aplica</option>
						<option value="1" <?php if($TratamientoLepra=="1") echo "selected";?> >1 - Si recibe tratamiento pero aún no ha terminado</option>
						<option value="2" <?php if($TratamientoLepra=="2") echo "selected";?> >2 - Si recibió tratamiento y ya lo terminó</option>
						<option value="16" <?php if($TratamientoLepra=="16") echo "selected";?> >16 - No recibió tratamiento por tener una tradición que se lo impide</option>
						<option value="17" <?php if($TratamientoLepra=="17") echo "selected";?> >17 - No recibió tratamiento por una condición de salud que se lo impide</option>
						<option value="18" <?php if($TratamientoLepra=="18") echo "selected";?> >18 - No recibió tratamiento por negación del usuario</option>
						<option value="19" <?php if($TratamientoLepra=="19") echo "selected";?> >19 - No recibió tratamiento por que los datos de contacto del usuario no se encuentran actualizados</option>
						<option value="20" <?php if($TratamientoLepra=="20") echo "selected";?> >20 - No recibió tratamiento por otras razones</option>
						<option value="22" <?php if($TratamientoLepra=="22") echo "selected";?> >22 - Sin Dato</option>
					</select>
				</div>

				<!-- 118. Fecha de Terminación Tratamiento para Leishmaniasis -->
				<?php $FechaTerLeishmaniasisInput = $Registro["0"]["FechaTerLeishmaniasisInput"];?>

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="FechaTerLeishmaniasisInput">118. Fecha de Terminación Tratamiento para Leishmaniasis</label>
					<select name="FechaTerLeishmaniasisInput" id="editable-select40" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4">
						<option value="">...Seleccione Una Opción</option>
						<option value="1800-01-01" <?php if($FechaTerLeishmaniasisInput=="1800-01-01") {echo "selected";};?> >1800-01-01 - No se tiene el dato</option>
						<option value="1805-01-01" <?php if($FechaTerLeishmaniasisInput=="1805-01-01"){echo "selected";};?> >1805-01-01 - No se realiza por una tradición</option>
						<option value="1810-01-01" <?php if($FechaTerLeishmaniasisInput=="1810-01-01"){echo "selected";};?> >1810-01-01 - No se realiza por una condición de salud</option>
						<option value="1825-01-01" <?php if($FechaTerLeishmaniasisInput=="1825-01-02"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaTerLeishmaniasisInput=="1830-01-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaTerLeishmaniasisInput=="1835-01-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($FechaTerLeishmaniasisInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $FechaTerLeishmaniasisInput;?>" <?php if($FechaTerLeishmaniasisInput!="1800-01-01" || $FechaTerLeishmaniasisInput!="1845-01-01" || $FechaTerLeishmaniasisInput!="1805-01-01" || $FechaTerLeishmaniasisInput!="1810-01-01" || $FechaTerLeishmaniasisInput!="1825-01-01" || $FechaTerLeishmaniasisInput!="1830-01-01" || $FechaTerLeishmaniasisInput!="1835-01-01") echo "selected";?> ><?php echo $FechaTerLeishmaniasisInput;?></option>
					</select>
				</div>

				<input type="hidden" name="R_ID" value="<?php echo $R_ID;?>">
				<input type="hidden" name="CodigoEntidad" value="<?php echo $CodigoEntidad;?>">
				<input type="hidden" name="FechaInicialReg" value="<?php echo $FechaInicialReg;?>">
				<input type="hidden" name="FechaFinalReg" value="<?php echo $FechaFinalReg;?>">

				<div class="form-group">
					<input class="btn btn-alert btn-large" type="submit" value="Actualizar">
				</div>

			</form>

		</div>



	</div>


</div>