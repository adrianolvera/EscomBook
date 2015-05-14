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


		<?php if (Session::has('editarComentario_index')) {?>
			<h4 class="alert_success">Comentario Actualizado Correctamente!</h4>
		 <?php }?>		

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

					    if ($VerTipoUser == "1" ) {
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

											$curp = $resultado->username;
											$status = $resultado->status;

											$numeroTel = $resultado->telefono;
											$extTel = $resultado->extension;
											$tipoTelefono = $resultado->descripcion;

											$correoUser = $resultado->correo;
											$tipoCorreo = $resultado->dcorreo;

											
										}


									$nombreCompleto = $nombre." ".$apPaterno." ".$apMaterno;
									$tipoUser = "Administrador";
												
								?>

									<?php if ($idUsuario =! null) {?>
									<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
									<?php } else { echo "<br>";}?> <!-- Aqui van todos los datos -->

									Nombre: &nbsp;<input type="text" value="<?php echo $nombreCompleto;?>" readonly>&nbsp;&nbsp;&nbsp;
									CURP: &nbsp;<input type="text" value="<?php echo $curp;?>" readonly> <br><br>
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoUser;?>" readonly> &nbsp;&nbsp;&nbsp;
									Status: &nbsp;<input type="text" value="<?php if($status == 0){ ?>Inactivo
															<?php }elseif($status == 1){ ?>Activo
									                        <?php }else{?>Suspendida
									                        <?php }?>" readonly> <br><br>

									Teléfono: &nbsp;<input type="text" value="<?php echo $numeroTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Ext: &nbsp;<input type="text" value="<?php echo $extTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoTelefono;?>" readonly> <br><br>	

									Correo: &nbsp;<input type="text" value="<?php echo $correoUser;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoCorreo;?>" readonly> <br><br>																	                        
									

					 <?php }else { ?> <!-- Error Administrador -->

									<br> <h2>Error al mostrar datos, intenta de nuevo.</h2><br><br>
							<?php } 					    	
					    }

					    elseif ($VerTipoUser == "2") { // Tipo Encargado
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

											$curp = $resultado->username;
											$status = $resultado->status;

											$numeroTel = $resultado->telefono;
											$extTel = $resultado->extension;
											$tipoTelefono = $resultado->descripcion;

											$correoUser = $resultado->correo;
											$tipoCorreo = $resultado->dcorreo;


											
										}


									$nombreCompleto = $nombre." ".$apPaterno." ".$apMaterno;
									$tipoUser = "Encargado";
												
								?>

									<?php if ($idUsuario =! null) {?>
									<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
									<?php } else { echo "<br>";}?> <!-- Aqui van todos los datos -->

									Nombre: &nbsp;<input type="text" value="<?php echo $nombreCompleto;?>" readonly>&nbsp;&nbsp;&nbsp;
									CURP: &nbsp;<input type="text" value="<?php echo $curp;?>" readonly> <br><br>
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoUser;?>" readonly> &nbsp;&nbsp;&nbsp;
									Status: &nbsp;<input type="text" value="<?php if($status == 0){ ?>Inactivo
															<?php }elseif($status == 1){ ?>Activo
									                        <?php }else{?>Suspendida
									                        <?php }?>" readonly> <br><br>

									Teléfono: &nbsp;<input type="text" value="<?php echo $numeroTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Ext: &nbsp;<input type="text" value="<?php echo $extTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoTelefono;?>" readonly> <br><br>	

									Correo: &nbsp;<input type="text" value="<?php echo $correoUser;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoCorreo;?>" readonly> <br><br>	

					 <?php }else { ?> <!-- Error Encargado -->

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

									$nombreCompleto = $nombre." ".$apPaterno." ".$apMaterno;
									$tipoUser = "Egresado";
												
								?>

									<?php if ($idUsuario =! null) {?>
									<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
									<?php } else { echo "<br>";}?> <!-- Aqui van todos los datos -->

									Nombre: &nbsp;<input type="text" value="<?php echo $nombreCompleto;?>" readonly>&nbsp;&nbsp;&nbsp;
									CURP: &nbsp;<input type="text" value="<?php echo $curp;?>" readonly> <br><br>
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoUser;?>" readonly> &nbsp;&nbsp;&nbsp;
									Status: &nbsp;<input type="text" value="<?php if($status == 0){ ?>Inactivo
															<?php }elseif($status == 1){ ?>Activo
									                        <?php }else{?>Suspendida
									                        <?php }?>" readonly> <br><br>

									Boleta: &nbsp;<input type="text" value="<?php echo $boleta;?>" readonly>&nbsp;&nbsp;&nbsp;
									Generación: &nbsp;<input type="text" value="<?php echo $generacion;?>" readonly> <br><br>									                        

									Teléfono: &nbsp;<input type="text" value="<?php echo $numeroTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Ext: &nbsp;<input type="text" value="<?php echo $extTel;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoTelefono;?>" readonly> <br><br>	

									Correo: &nbsp;<input type="text" value="<?php echo $correoUser;?>" readonly>&nbsp;&nbsp;&nbsp;
									Tipo: &nbsp;<input type="text" value="<?php echo $tipoCorreo;?>" readonly> <br><br>	


					 <?php }else { ?> <!-- En caso de que este Inactivo el Egresado -->

									<br> <h2>El egresado se encuentra en modo Inactivo, aun no actualiza sus datos completos.</h2><br><br>
							<?php }} ?>

									<a class="btn" href="javascript:history.back(1)"">Regresar</a><br>

				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

		
	</section>			

@stop