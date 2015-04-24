<?php if(Auth::check()) { ?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8"/>
	<title>Muro | ESCOMBook</title>
	<!-- CSS are placed here -->	
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="css/bootstrap.min.css">
    @yield('css')
	<script src="js/jquery-1.11.2.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
		<link rel="stylesheet" href="css/colorbox.css" />
		<script src="js/jquery.colorbox.js">
	</script>


</head>
<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="egresado">ESCOMBook</a></h1>
			<h2 class="section_title">MURO</h2>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>{{ Auth::user()->nombre}} {{ Auth::user()->apPaterno}} {{ Auth::user()->apMaterno}} &nbsp; (<a href="logout">Cerrar Sesión</a>)</p>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Busqueda Rapida" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>

		<h3>MENU</h3>
		<ul class="toggle">
			<li class=><a href="{{ URL::to('egresado.muro') }}">Mi Muro</a></li>
			<li class=><a href="#">Perfil</a></li>
			<li class=><a href="#">Encuestas</a></li>
		</ul>
		
		
		<footer>
			<hr/>
			<p><strong>Escuela Superior de Cómputo.</strong></p>
		<p style="text-align: justify;">Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito del Director General del Instituto.<br>
		® 2015</p> <br><br><br>

		</footer>
	</aside>

	@yield('content')
	<!-- Bootstrap JavaScript -->
	@yield('js')	
</body>

</html>

<?php } ?>