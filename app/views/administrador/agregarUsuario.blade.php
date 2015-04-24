@extends('plantilla.masterAdmin')

@section('content')
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Estadisticas</h3></header>
			<div class="module_content">
				<article class="stats_overview">
					<div class="overview_today">
						<p class="overview_day">Usuarios</p>
						
						<p class="overview_count">5,876</p>
						<p class="overview_type">Pre-registrados</p>
						
						<p class="overview_count">1,876</p>
						<p class="overview_type">Activos</p>						
					
					</div>
					<div class="overview_previous">
						<p class="overview_day">Contenido</p>

						<p class="overview_count">1,646</p>
						<p class="overview_type">Publicaciones</p>

						<p class="overview_count">2,054</p>
						<p class="overview_type">Comentarios</p>
					</div>
				</article>
				<div class="clear"></div>
			</div>
		</article><!-- end of stats article -->
		
		

@stop