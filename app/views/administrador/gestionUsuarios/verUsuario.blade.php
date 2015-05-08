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
					else{

						// Tipo EGRESADO
						$resultados = DB::select('SELECT u.nombre,u.apPaterno,u.apMaterno,u.username,u.tipo,u.status,de.boleta,de.generacion, 
							                     tu.telefono, tu.extension, tt.descripcion from users u, datos_egresados de, telefono_usuario tu, tipo_telefono tt
                                                 where u.id = ? AND u.id = de.idUsuario AND u.id = tu.idUsuario AND tu.tipoTelefono = tt.id',array($idUsuario));

						if ($resultados != null) {
							# code...
						
								foreach ($resultados as $resultado)
									{
										$nombre = $resultado->nombre;	
										$apPaterno = $resultado->apPaterno;	
										$apMaterno = $resultado->apMaterno;							    		
									}

								$nombreCompleto = $nombre." ".$apPaterno." ".$apMaterno;
											
					?>

								<?php if ($idUsuario =! null) {?>
								<h3> Hola <?php echo $nombreSession; ?> los datos del Usuario son los siguientes:</h3>
								<?php } else { echo "<br>";}?>

								
								<input type="text" name="nombreCompleto" placeholder="Nombre" value="<?php echo $nombreCompleto;?>" readonly> <br><br>

					<?php }else { ?>

								<br> <h2>Usuario Inactivo, aun no actualiza sus datos completos.</h2><br><br>
						<?php } ?>

								<a class="btn" href="gestionUsuarios">Regresar</a><br>

				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

		
	</section>			

@stop