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
			<header><h3>EDITAR POST</h3></header>
				<div class="module_content"><center>
					<?php 

						$idSession = Auth::user()->id; // ID del usuario en Session;
					    $dato0 = $idUser;
						$dato1 = $idPost;

					if ($idUser == null && $idPost == null ) { 
					echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=administrador'>"; 
					?><br><br><br><br><a class="btn" href="administrador">Regresar</a><br><br><br><br> <?php
					}
					else{

						if ($idSession == $dato0) {

						$resultados = DB::select('SELECT u.id,p.mensaje,u.nombre,u.apPaterno,u.apMaterno,u.username from post p, users u where u.id = p.idUsuario AND u.id = ? AND p.id = ?', array($idUser,$idPost));

								foreach ($resultados as $resultado)
									{
										$dato2 = $resultado->mensaje;
							    		$dato3 = $resultado->nombre;
							    		$dato4 = $resultado->apPaterno;
							    		$dato5 = $resultado->apMaterno;
							    		$dato6 = $resultado->username;
							    		
									}
											
					?>


								<form  method="post" action="GuardarEditarPost">
								<?php if ($idUser =! null) {?>
								<h3> Hola <?php echo $dato3; ?> por favor edita en la parte inferior tu post.</h3>
								<?php } else { echo "<br>";}?>

					 				<h4>
									<input type="hidden" name="id" placeholder="IdUsuario" value="<?php echo $dato0;?>" readonly> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="hidden" name="idPublicacion" placeholder="IdPublicacion" value="<?php echo $dato1;?>" readonly> <br>
					 			    Publicado por:&nbsp;<input type="text" name="nombre" placeholder="Publicado por" value="<?php echo $dato3 ." ".$dato4 ." ".$dato5;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									CURP:&nbsp;<input type="text"  name="username" placeholder="CURP" value="<?php echo $dato6;?>" readonly><br><br>

						<fieldset>
							<label>Contenido del Post</label>
							<textarea rows="4" name="mensaje" required ><?php echo $dato2;?></textarea>
						</fieldset>
					  			
					  				<br><br>

									<input id="boton" class="btn" type="submit" value="Actualizar Post"> &nbsp;
									<a class="btn" href="administrador">Cancelar</a><br><br><br><br>
								</form>	

						<?php } else { ?> <br><br><h2>No puedes editar este Post</h2><br><br><a class="btn" href="administrador">Regresar</a><br><br><br><br> <?php }?>		

				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

	</section>			

@stop