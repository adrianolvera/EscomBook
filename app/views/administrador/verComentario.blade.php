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
			<header><h3>COMENTARIO DEL POST</h3></header>
				<div class="module_content"><center>
					<?php 

						$idSession = Auth::user()->id; // ID del usuario en Session;
						$nombreSession = Auth::user()->nombre; // ID del usuario en Session;
					    $dato0 = $idUser;
						$dato1 = $idComentario;
						$envioidPOST = $idPOST;

					if ($idUser == null && $idComentario == null ) { 
					$dato2 = NULL; $dato3 = $idUser; $dato4 = NULL; $dato5 = NULL; $dato6 = NULL; $dato9=null;
					?><br><br><br><br><a class="btn" href="administrador">Regresar</a><br><br><br><br> <?php
					}
					else{


						$resultados = DB::select('SELECT u.id,c.mensaje,u.nombre,u.apPaterno,u.apMaterno,u.username,c.created_at,c.updated_at,c.idPost from comentario c, users u where u.id = c.idUsuario AND u.id = ? AND c.id = ?', array($idUser,$idComentario));

								foreach ($resultados as $resultado)
									{
										$dato2 = $resultado->mensaje;
							    		$dato3 = $resultado->nombre;
							    		$dato4 = $resultado->apPaterno;
							    		$dato5 = $resultado->apMaterno;
							    		$dato6 = $resultado->username;
							    		$dato7 = $resultado->created_at;
							    		$dato8 = $resultado->updated_at;
							    		$dato9 = $resultado->idPost;
							    		
									}
											
					?>


								<form  method="post">
								<?php if ($idUser =! null) {?>
								<h3> Hola <?php echo $nombreSession; ?> el comentario contiene lo siguiente:</h3>
								<?php } else { echo "<br>";}?>

					 				<h4>
									<input type="hidden" name="id" placeholder="IdUsuario" value="<?php echo $dato0;?>" readonly> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="hidden" name="idPublicacion" placeholder="IdPublicacion" value="<?php echo $dato1;?>" readonly> <br>
					 			    Publicado por:&nbsp;<input type="text" name="nombre" placeholder="Publicado por" value="<?php echo $dato3 ." ".$dato4 ." ".$dato5;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									CURP:&nbsp;<input type="text"  name="username" placeholder="CURP" value="<?php echo $dato6;?>" readonly><br><br>

									Creado:&nbsp;<input type="text"  name="creado" placeholder="Creado" value="<?php echo $dato7;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Actualizado:&nbsp;<input type="text"  name="actualizado" placeholder="Actualizado" value="<?php echo $dato8;?>" readonly><br><br>

						<fieldset>
							<label>Contenido en el Comentario</label>
							<textarea rows="4" name="mensaje" required readonly><?php echo $dato2;?></textarea>
						</fieldset>
					  	<br>

					  	<fieldset>
								<label>Multimedia</label><br>
								<?php $Comentario = Comentario::find($idComentario);?>

							<?php if ($Comentario->rutaMultimedia != null){ ?>

							<div class="module_content">

								<a class="group1" href="{{ $Comentario->rutaMultimedia }}">
								    <img src="{{ $Comentario->rutaMultimedia }}" height="20%" width="20%">
								</a>
							
							</div>							
								
							<?php } else{ ?>
								<h4 class="alert_warning">No contiene archivo Multimedia.</h4>
							<?php } ?>




						</fieldset>

						<br><br>

						<a class="btn" href="vePost?id=<?php echo $envioidPOST?>&id2=<?php echo $dato9?>">Regresar</a><br><br><br><br>
						</form>	


				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	
	</section>			

@stop