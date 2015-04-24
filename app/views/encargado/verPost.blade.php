@extends('plantilla.masterEncargado')

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

		<?php if (Session::has('eliminarComentario_index')) {?>
			<h4 class="alert_success">Comentario Eliminado Correctamente!</h4>
		 <?php }?>			 	

		<!-- INICIO DEL MAIN -->
		<article class="module width_full">
			<header><h3>DATOS DEL POST</h3></header>
				<div class="module_content"><center>
					<?php 

						$idSession = Auth::user()->id; // ID del usuario en Session;
						$nombreSession = Auth::user()->nombre; // ID del usuario en Session;
						$ValorPost = $idUser; // Para poder Regresar
					    
					    $dato0 = $idUser;
						$dato1 = $idPost;




						if ($dato0 == null  && $dato1 == null) {
							$dato0  = Session::get('idUsuarioSession');
							$dato1 = Session::get('idPostSession');
							$ValorPost = Session::get('idSession');

							$idPost = $dato1;
							$idUser = $dato0;
						}


					$dato2 = NULL; $dato3 = null; $dato4 = NULL; $dato5 = NULL; $dato6 = NULL;  $dato7 = NULL;  $dato8 = NULL;

					if ($dato0 == null && $dato1 == null ) { 
					$dato2 = NULL; $dato3 = $idUser; $dato4 = NULL; $dato5 = NULL; $dato6 = NULL;
					?><br><br><br><br><a class="btn" href="administrador">Regresar</a><br><br><br><br> <?php
					}
					else{


						$resultados = DB::select('SELECT u.id,p.mensaje,u.nombre,u.apPaterno,u.apMaterno,u.username,p.created_at,p.updated_at from post p, users u where u.id = p.idUsuario AND u.id = ? AND p.id = ?', array($idUser,$idPost));

								foreach ($resultados as $resultado)
									{
										$dato2 = $resultado->mensaje;
							    		$dato3 = $resultado->nombre;
							    		$dato4 = $resultado->apPaterno;
							    		$dato5 = $resultado->apMaterno;
							    		$dato6 = $resultado->username;
							    		$dato7 = $resultado->created_at;
							    		$dato8 = $resultado->updated_at;
							    		
									}
											
					?>


								<form  method="post">
								<?php if ($idUser =! null) {?>
								<h3> Hola <?php echo $nombreSession; ?> el post contiene lo siguiente:</h3>
								<?php } else { echo "<br>";}?>

					 				<h4>
									<input type="hidden" name="id" placeholder="IdUsuario" value="<?php echo $dato0;?>" readonly> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<input type="hidden" name="idPublicacion" placeholder="IdPublicacion" value="<?php echo $dato1;?>" readonly> <br>
					 			    Publicado por:&nbsp;<input type="text" name="nombre" placeholder="Publicado por" value="<?php echo $dato3 ." ".$dato4 ." ".$dato5;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

									CURP:&nbsp;<input type="text"  name="username" placeholder="CURP" value="<?php echo $dato6;?>" readonly><br><br>

									Creado:&nbsp;<input type="text"  name="creado" placeholder="Creado" value="<?php echo $dato7;?>" readonly>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									Actualizado:&nbsp;<input type="text"  name="actualizado" placeholder="Actualizado" value="<?php echo $dato8;?>" readonly><br><br>

						<fieldset>
							<label>Contenido del Post</label>
							<textarea rows="2" name="mensaje" required readonly><?php echo $dato2;?></textarea>
						</fieldset>
					  	<br>

					  	<fieldset>
								<label>Multimedia</label><br>
								<?php $post = Post::find($idPost);?>

							<?php if ($post->rutaMultimedia != null){ ?>

							<div class="module_content">

								<a class="group1" href="{{ $post->rutaMultimedia }}">
								    <img src="{{ $post->rutaMultimedia }}" height="15%" width="15%">
								</a>
							
							</div>							
								
							<?php } else{ ?>
								<h4 class="alert_warning">No contiene archivo Multimedia.</h4>
							<?php } ?>




						</fieldset>

						<br>

						<a class="btn" href="encargado">Regresar</a><br>
						</form>	


				<?php }?>			

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>

		<!-- SECCION COMENTARIOS -->
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">COMENTARIOS EN EL POST</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Comentarios</a></li>
		</ul>
		</header>

						<?php  
				$comentarios = DB::select('SELECT c.id,c.mensaje,c.idUsuario,c.idPost,c.updated_at,u.nombre,u.apPaterno FROM comentario c, users u where c.idPost = ? and u.id = c.idUsuario ORDER BY c.updated_at desc', array($idPost));
				if ($comentarios != null) {
				?>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					 
    				<th>Comentario</th>  
    				<th>Publicado por:</th> 
    				<th>Última fecha de actualización</th> 
    				<th>Acciones</th> 
				</tr> 
			</thead> 
			<tbody> 
				@foreach($comentarios as $p) 
				<tr> 
      				<td><?php 
      					if ( strlen($p->mensaje) > 45) 
      					{ 
      						echo substr($p->mensaje, 0, 45) ."&nbsp; [...]";  
      				    }
      				    else
      				    { 
      				    	echo substr($p->mensaje, 0, 45); 
      				    }
      				    ?>
      				</td> 

    				<td>{{ $p->nombre ." ". $p->apPaterno}}</td> 
    				<td><span class="label label-info"></span>{{ $p->updated_at }}</td> 
    				<td>
    					<a href="veComentario?id=<?php echo $p->idUsuario?>&id2=<?php echo $p->id?>&id3=<?php echo $ValorPost?>"><input type="image" src="images/icn_search.png" title="Ver"></a>
    					<a href="editComentario?id=<?php echo $p->idUsuario?>&id2=<?php echo $p->id?>&id3=<?php echo $ValorPost?>"><input type="image" src="images/icn_edit.png" title="Editar"></a>
    					<a href="eliminaComentario?id=<?php echo $p->idUsuario?>&id2=<?php echo $p->id?>&id3=<?php echo $ValorPost?>"><input type="image" src="images/icn_trash.png" title="Eliminar"></a>
    				</td> 
				</tr>
				@endforeach	    	
			</tbody> 
			</table>
			<?php } else{?>	
				<br><br><h4 class="alert_warning">No contiene comentarios.</h4>
				<br>
			<?php }?>	
			</div><!-- end of #tab1 -->
			
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->

		<div class="spacer"></div>	

	</section>			

@stop