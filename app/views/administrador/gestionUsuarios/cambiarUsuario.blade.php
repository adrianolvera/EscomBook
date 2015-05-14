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
			<header><h3>CAMBIAR STATUS USUARIO</h3></header>
				<div class="module_content"><center>
					<?php 

						$idSession = Auth::user()->id; // ID del usuario en Session;
						$nombreSession = Auth::user()->nombre; // ID del usuario en Session;
					    
					    $dato0 = $idUsuario;

					if ($idUsuario == null ) { 
					echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=gestionUsuarios'>"; 
					?><br><br><br><br><a class="btn" href="javascript:history.back(1)">Regresar</a><br><br><br><br> <?php
					}
					else{


						$resultados = DB::select('SELECT id,nombre,apPaterno,apMaterno,username,status from users where id = ?', array($idUsuario));

								foreach ($resultados as $resultado)
									{
										$user = $resultado->id;
							    		$nombre = $resultado->nombre;
							    		$ap1 = $resultado->apPaterno;
							    		$ap2 = $resultado->apMaterno;
							    		$curp = $resultado->username;
							    		$statusActual = $resultado->status;
									}

									$nombreCompleto = $nombre." ".$ap1." ".$ap2;											
					?>

								<form  method="post" action="CambiarStatusUsuario">
								<?php if ($idUsuario =! null) {?>
								<h3> Hola <?php echo $nombreSession; ?> los datos del usuario son los siguientes:</h3>
								<?php } else { echo "<br>";}?>

					 				<h4>
									<input type="hidden" name="id" placeholder="IdUsuario" value="<?php echo $user;?>" readonly><br>

									CURP:&nbsp;<input type="text"  name="username" placeholder="CURP" value="<?php echo $curp;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Nombre:&nbsp;<input type="text"  name="nombreCompleto" placeholder="Nombre Completo" value="<?php echo $nombreCompleto;?>" readonly><br><br>
					  			
									Status Actual:&nbsp; <b><?php if($statusActual == 0){ ?> <font color="red">Inactivo</font>
															<?php }elseif($statusActual == 1){ ?> <font color="#04B404">Activo</font>  
									                        <?php }else{?> <font color="#FE642E">Suspendida</font> 
									                        <?php }?> </b>
									<br><br><br>

									Cambiar Status a:&nbsp;

								      <select class="form-control" name="nuevoStatus" required>
								        <option value="3">Suspender</option>
								        <option value="1">Activo</option>							        								        
								      </select>	<br><br><br>					  				

									<input id="boton" class="btn" type="submit" value="Actualizar Status"> &nbsp;
									<a class="btn" href="javascript:history.back(1)">Cancelar</a><br><br><br><br>
								</form>	


				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

	</section>			

@stop