@extends('plantilla.masterAdmin')

@section('content')
	<section id="main" class="column">
		
		<h4 class="alert_info">¡Bienvenido! 

<script>
var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
var f=new Date();
document.write(diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
</script>

<div id="reloj"></div>

		</h4>		


		<!-- INICIO DEL MAIN -->
		<article class="module width_full">
			<header><h3>DATOS DEL USUARIO</h3></header>
				<div class="module_content"><center>
					<?php 

						$idSession = Auth::user()->id; // ID del usuario en Session;
						$nombreSession = Auth::user()->nombre; // ID del usuario en Session;
						$ValorPost = $idUser; // Para poder Regresar
					    
					    $idUsuario = $idUser;

					if ($idUsuario == null) {
						echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=gestionUsuarios'>";  
						?><br><br><br><br><a class="btn" href="javascript:history.back(1)">Regresar</a><br><br><br><br> <?php
					}
					else{ // sI TENGO ID

						// Determinar Que tipo de Usuario Llega
						$resultadosTipo = DB::select('SELECT tipo from users where id= ?',array($idUsuario));	
								foreach ($resultadosTipo as $resultado)
									{
										$VerTipoUser = $resultado->tipo;							    		
									}	



					    if ($VerTipoUser == "1" || $VerTipoUser == "2" ) {
							$resultadosAdministrador = DB::select('SELECT u.id,u.nombre,u.apPaterno,u.apMaterno,u.username,u.tipo,u.status, 
																   tu.telefono, tu.extension, tt.descripcion, cu.correo , tc.descripcion as dcorreo
																   from users u, telefono_usuario tu, tipo_telefono tt, correo_usuario cu, tipo_correo tc
																   where u.id= ? AND u.id = tu.idUsuario AND tu.tipoTelefono = tt.id
																   AND u.id = cu.idUsuario AND cu.tipoCorreo = tc.id;',array($idUsuario));

							if ($resultadosAdministrador != null) { // ES TIPO EGRESADO y NO ES NULL
									foreach ($resultadosAdministrador as $resultado)
										{
											$nombre = $resultado->nombre;	
											$apPaterno = $resultado->apPaterno;	
											$apMaterno = $resultado->apMaterno;

											$tipoUser = $resultado->tipo;

											$curp = $resultado->username;
											$status = $resultado->status;

											$numeroTel = $resultado->telefono;
											$extTel = $resultado->extension;
											$tipoTelefono = $resultado->descripcion;

											$correoUser = $resultado->correo;
											$tipoCorreo = $resultado->dcorreo;

											
										}

									
												
								?>

									<?php if ($idUsuario =! null) { ?>
									<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
									<?php } else { echo "<br>";}?> <!-- Aqui van todos los datos -->

									<form  name ="form1" method="post" action="123">
					 			    Nombre(s):&nbsp;<input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="50" required>&nbsp;&nbsp;&nbsp;
					 				<input type="text" name="apPaterno" placeholder="Apellido Paterno" value="<?php echo $apPaterno;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="40" required>&nbsp;&nbsp;&nbsp;
					 				<input type="text" name="apMaterno" placeholder="Apellido Materno" value="<?php echo $apMaterno;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="40" required><br><br>									


									CURP: &nbsp;<input type="text" title="Ingresa el CURP" name="username" placeholder="CURP" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
							  					pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; value="<?php echo $curp;?>" maxlength="18" required>&nbsp;&nbsp;&nbsp;
									
					 				<br><br><b>Tipo</b><br><br>
					 				 Administrador:&nbsp;<input type="radio" name="check" id="check1" value="3" onchange="javascript:showContent()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 Encargado:&nbsp;<input type="radio" name="check" id="check2" value="3" onchange="javascript:showContent()" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 Egresado:&nbsp; <input type="radio" name="check" id="check3" value="3" onchange="javascript:showContent()"/><br><br><br>


								<div id="content" style="display: none;">
					 				Boleta:&nbsp; <input type="text" id="boleta" name="boleta" placeholder="Boleta" pattern="[0-9]{10}" maxlength="10" required> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 				
					 				Generación:&nbsp;

								      <select class="form-control" id="generacion" name="generacion" required>
								        <option value="Generación 1">Generación 1 </option>
								        <option value="Generación 2">Generación 2 </option>
								        <option value="Generación 3">Generación 3 </option>
								        <option value="Generación 4">Generación 4 </option>								        
								        <option value="Generación 5">Generación 5 </option>
								        <option value="Generación 6">Generación 6 </option>	
								        <option value="Generación 7">Generación 7 </option>
								        <option value="Generación 8">Generación 8 </option>
								        <option value="Generación 9">Generación 9 </option>
								        <option value="Generación 10">Generación 10 </option>								        
								        <option value="Generación 11">Generación 11 </option>
								        <option value="Generación 12">Generación 12 </option>									        							        
								        <option value="Generación 13">Generación 13 </option>
								        <option value="Generación 14">Generación 14 </option>
								        <option value="Generación 15">Generación 15 </option>
								        <option value="Generación 16">Generación 16 </option>								        
								        <option value="Generación 17">Generación 17 </option>
								        <option value="Generación 18">Generación 18 </option>	
								        <option value="Generación 19">Generación 19 </option>								        								        
								      </select>	<br><br>			 				
								</div>								      


									Teléfono: <input type="text" id="telefono" value="<?php echo $numeroTel;?>" name="telefono" pattern="[0-9]*$"; placeholder="Ejemplo: 57789645 o 5538959678" maxlength="15" required>&nbsp;&nbsp;
									Ext:&nbsp;<input type="text" value="<?php echo $extTel;?>" name="extTelefono" placeholder="(Opcional)">
									
									<br><br>Correo: &nbsp;<input type="email" value="<?php echo $correoUser;?>"><br><br><br>

									<input id="boton" class="btn" type="submit" value="Actualizar"> &nbsp;
									<a class="btn" href="javascript:history.back(1)">Regresar</a><br>
								</form>
									

					 <?php } else { ?> <!-- Error Administrador -->

									<br> <h2>Error al mostrar datos, intenta de nuevo.</h2><br><br>
							<?php } 					    	
					    }			



					    else{ // Tipo EGRESADO
							$resultadosEgresado = DB::select('SELECT u.id,u.nombre,u.apPaterno,u.apMaterno,u.username,u.tipo,u.status,de.boleta,de.generacion, 
												tu.telefono, tu.extension, tt.descripcion, cu.correo , tc.descripcion as dcorreo
												from users u, datos_egresados de, telefono_usuario tu, tipo_telefono tt, correo_usuario cu, tipo_correo tc
												where u.id= ? AND u.id = de.idUsuario AND u.id = tu.idUsuario AND tu.tipoTelefono = tt.id
												AND u.id = cu.idUsuario AND cu.tipoCorreo = tc.id;',array($idUsuario));

							if ($resultadosEgresado != null) { // ES TIPO EGRESADO y NO ES NULL
									foreach ($resultadosEgresado as $resultado)
										{
											$nombre = $resultado->nombre;	
											$apPaterno = $resultado->apPaterno;	
											$apMaterno = $resultado->apMaterno;

											$curp = $resultado->username;
											$status = $resultado->status;

											$boleta = $resultado->boleta;
											$generacion = $resultado->generacion;											

											$numeroTel = $resultado->telefono;
											$extTel = $resultado->extension;
											$tipoTelefono = $resultado->descripcion;

											$correoUser = $resultado->correo;
											$tipoCorreo = $resultado->dcorreo;
										}

									$tipoUser = "Egresado";
												
								?>

									<?php if ($idUsuario =! null) {?>
									<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
									<?php } else { echo "<br>";}?> <!-- Aqui van todos los datos -->

									<form  name ="form1" method="post" action="456">
					 			    Nombre(s):&nbsp;<input type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombre;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="50" required>&nbsp;&nbsp;&nbsp;
					 				<input type="text" name="apPaterno" placeholder="Apellido Paterno" value="<?php echo $apPaterno;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="40" required>&nbsp;&nbsp;&nbsp;
					 				<input type="text" name="apMaterno" placeholder="Apellido Materno" value="<?php echo $apMaterno;?>"  pattern="[A-Za-z]{1}[A-Za-z-éíó\s]*$"; maxlength="40" required><br><br>									

CURP: &nbsp;<input type="text" title="Ingresa el CURP" name="username" placeholder="CURP" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
							  					pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; value="<?php echo $curp;?>" maxlength="18" required>&nbsp;&nbsp;&nbsp;
									
					 				<br><br><b>Tipo</b><br><br>
					 				 Administrador:&nbsp;<input type="radio" name="check" id="check1" value="3" onchange="javascript:showContent()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 Encargado:&nbsp;<input type="radio" name="check" id="check2" value="3" onchange="javascript:showContent()" /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 Egresado:&nbsp; <input type="radio" name="check" id="check3" value="3" onchange="javascript:showContent()"/><br><br><br>

									<input type="hidden" id="boleta2" name="boleta2"  value="<?php echo $boleta;?>"  >
									<input type="hidden" id="generacion2" name="generacion2"  value="<?php echo $generacion;?>"  >

								<div id="content" style="display: none;">
					 				Boleta:&nbsp; <input type="text" id="boleta" name="boleta" placeholder="Boleta" pattern="[0-9]{10}" maxlength="10" required> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 				
					 				Generación:&nbsp;

								      <select class="form-control" id="generacion" name="generacion" required>
								        <option value="Generación 1">Generación 1 </option>
								        <option value="Generación 2">Generación 2 </option>
								        <option value="Generación 3">Generación 3 </option>
								        <option value="Generación 4">Generación 4 </option>								        
								        <option value="Generación 5">Generación 5 </option>
								        <option value="Generación 6">Generación 6 </option>	
								        <option value="Generación 7">Generación 7 </option>
								        <option value="Generación 8">Generación 8 </option>
								        <option value="Generación 9">Generación 9 </option>
								        <option value="Generación 10">Generación 10 </option>								        
								        <option value="Generación 11">Generación 11 </option>
								        <option value="Generación 12">Generación 12 </option>									        							        
								        <option value="Generación 13">Generación 13 </option>
								        <option value="Generación 14">Generación 14 </option>
								        <option value="Generación 15">Generación 15 </option>
								        <option value="Generación 16">Generación 16 </option>								        
								        <option value="Generación 17">Generación 17 </option>
								        <option value="Generación 18">Generación 18 </option>	
								        <option value="Generación 19">Generación 19 </option>								        								        
								      </select>	<br><br>			 				
								</div>	


									Teléfono: <input type="text" id="telefono" value="<?php echo $numeroTel;?>" name="telefono" pattern="[0-9]*$"; placeholder="Ejemplo: 57789645 o 5538959678" maxlength="15" required>&nbsp;&nbsp;
									Ext:&nbsp;<input type="text" value="<?php echo $extTel;?>" name="extTelefono" placeholder="(Opcional)">




									
									<br><br>Correo: &nbsp;<input type="email" value="<?php echo $correoUser;?>">&nbsp;&nbsp;&nbsp;&nbsp;
									<br><br>

									<input id="boton" class="btn" type="submit" value="Actualizar"> &nbsp;
									<a class="btn" href="javascript:history.back(1)">Regresar</a><br>
								</form>
									
					 <?php }else { ?> <!-- En caso de que este Inactivo el Egresado -->

									<br> <h2>El egresado se encuentra en modo Inactivo, aun no actualiza sus datos completos.</h2><br><br>
									<a class="btn" href="javascript:history.back(1)">Regresar</a><br>
							<?php }} ?>

									

				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

		
	</section>	


<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");
        check3 = document.getElementById("check3");
        check2 = document.getElementById("check2");
        check1 = document.getElementById("check1");

        
        if (check3.checked) { // EGRESADO
            element.style.display='inline';
            document.getElementById('boleta').value='';
            document.getElementById('generacion').value='';

    		var x = document.getElementById("boleta");               //Obtengo los valores de Boleta de la BD
    		var y = document.getElementById("boleta2").value;
    		x.value = y;

    		var xx = document.getElementById("generacion");         //Obtengo los valores de Generacion de la BD
    		var yy = document.getElementById("generacion2").value;
    		xx.value = yy;    		

        }
        
        if (check2.checked || check1.checked){ // Administrador o Egresado
        	element.style.display='none';
        	document.getElementById('boleta').value="0000000000";
        	document.getElementById('generacion').value='Generación 1';
        }

    }
</script>	


@stop