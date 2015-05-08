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

		<!-- ESTADISTICAS -->
		<?php $totalUsers = DB::table('users')->count(); // Saco El total de Usuarios
			  $activosUsers = DB::table('users')->where('status', '=', '1')->count(); // Activos
			  $totalPost = DB::table('post')->count(); // Saco El total de Post
			  $totalComentarios = DB::table('comentario')->count(); // Saco El total de Comentarios
		?>

		 <?php if (Session::has('editarPost_index')) {?>
			<h4 class="alert_success">Post Actualizado Correctamente!</h4>
		 <?php }?>	

		 <?php if (Session::has('eliminarPost_index')) {?>
			<h4 class="alert_success">Post Eliminado Correctamente!</h4>
		 <?php }?>	

		<?php if (Session::has('eliminarComentario_index')) {?>
			<h4 class="alert_success">Comentario Eliminado Correctamente!</h4>
		 <?php }?>	
		 		 		 					
		<article class="module width_full">
			<header><h3>Estadisticas</h3></header>
			<div class="module_content">
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Usuarios</p>
						
						<p class="overview_count">{{$totalUsers}}</p>
						<p class="overview_type">Pre-registrados</p>
						
						<p class="overview_count">{{$activosUsers}}</p>
						<p class="overview_type">Activos</p>						
					
					</div>
					<div class="overview_previous">
						<p class="overview_day">Contenido</p>

						<p class="overview_count">{{$totalPost}}</p>
						<p class="overview_type">Publicaciones</p>

						<p class="overview_count">{{$totalComentarios}}</p>
						<p class="overview_type">Comentarios</p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- ESTADISTICAS -->
		
		<article class="module width_3_quarter">
		<header><h3 class="tabs_involved">Ultimos 10 Posts Registrados</h3>
		<ul class="tabs">
   			<li><a href="#tab1">Posts</a></li>
		</ul>
		</header>

		<div class="tab_container">
			<div id="tab1" class="tab_content">
			<table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
   					 
    				<th>Contenido del Post</th>  
    				<th>Publicado por:</th> 
    				<th>Última fecha de actualización</th> 
    				<th>Acciones</th> 
				</tr> 
			</thead> 
			<tbody> 
				<?php  
				$posts = DB::select('SELECT u.id as idusuario,p.id,mensaje,u.nombre,u.apPaterno,p.updated_at from post p, users u where u.id = p.idUsuario ORDER BY updated_at desc');
				$contador = 1;
				?>
				@foreach($posts as $p) 
				<?php if ($contador > 10) {break;}else{$contador = $contador + 1;} ?>
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
    					<a href="vePost?id=<?php echo $p->idusuario?>&id2=<?php echo $p->id?>"><input type="image" src="images/icn_search.png" title="Ver"></a>
    					<a href="editPost?id=<?php echo $p->idusuario?>&id2=<?php echo $p->id?>"><input type="image" src="images/icn_edit.png" title="Editar"></a>
    					<a href="eliminaPost?id=<?php echo $p->idusuario?>&id2=<?php echo $p->id?>"><input type="image" src="images/icn_trash.png" title="Eliminar"></a>
    				</td> 
				</tr>
				@endforeach		
    	
			</tbody> 
			</table>
			</div><!-- end of #tab1 -->
			
		</div><!-- end of .tab_container -->
		</article><!-- end of content manager article -->	

		<div class="spacer"></div> 
		<article><br><br><article>

	</section>
@stop