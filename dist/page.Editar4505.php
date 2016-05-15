<?php
require_once ("clases/class.rped.php");
$objRPED = new rped();
$Registro = $objRPED->getUser($_GET["Ent"],$_GET["IdUser"],$_GET["Per"],$_GET["Año"]);

$FechaRegistro = $Registro[$i]['FechaRegistro'];

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

			<form action="">
				
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
					<label for="Sexo" class="col-lg-4 col-md-4 col-sm-4 col-xs-4">10. Sexo</label>
					<input type="text" name="Sexo" class="form-control col-lg-3 col-md-3 col-sm-3 col-xs-3" value="<?php echo $Registro[$i]['Sexo'];?>">
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
						<option value="1825-01-01" <?php if($FechaConsejeriaLactanciaInput=="1825-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($FechaConsejeriaLactanciaInput=="1830-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($FechaConsejeriaLactanciaInput=="1835-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
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
						<option value="1825-01-01" <?php if($ControlRecienNacidoInput=="1825-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ControlRecienNacidoInput=="1830-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ControlRecienNacidoInput=="1835-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
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
						<option value="1825-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1825-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1830-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($PlanificacionFamiliarPrimeraVezInput=="1835-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
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
						<option value="1825-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1825-01"){echo "selected";};?> >1825-01-01 - No se realiza por negación del usuario</option>
						<option value="1830-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1830-01"){echo "selected";};?> >1830-01-01 - No se realiza por tener datos de contacto del usuario no actualizados</option>
						<option value="1835-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1835-01"){echo "selected";};?> >1835-01-01 - No se realiza por otras razones</option>
						<option value="1845-01-01" <?php if($ControlPrenatalPrimeraVezInput=="1845-01-01"){echo "selected";};?> >1845-01-01 - No Aplica</option>
						<option value="<?php echo $ControlPrenatalPrimeraVezInput;?>" <?php if($ControlPrenatalPrimeraVezInput!="1800-01-01" || $ControlPrenatalPrimeraVezInput!="1845-01-01" || $ControlPrenatalPrimeraVezInput!="1805-01-01" || $ControlPrenatalPrimeraVezInput!="1810-01-01" || $ControlPrenatalPrimeraVezInput!="1825-01-01" || $ControlPrenatalPrimeraVezInput!="1830-01-01" || $ControlPrenatalPrimeraVezInput!="1835-01-01") echo "selected";?> ><?php echo $ControlPrenatalPrimeraVezInput;?></option>
					</select>
				</div>			
				
				<!-- 57. Control Prenatal -->

				<div class="form-group">
					<label class="col-lg-4 col-md-4 col-sm-4 col-xs-4" for="ControlPrenatal">57. Control Prenatal</label>
					<input type="text" name="ControlPrenatal" class="form-control col-lg-7 col-md-4 col-sm-4 col-xs-4" value="<?php echo $Registro["0"]["ControlPrenatal"]; ?>">
				</div>

			</form>

		</div>



	</div>


</div>