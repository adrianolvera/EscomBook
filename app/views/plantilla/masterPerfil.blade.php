<?php if(Auth::check()) { ?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8"/>
	<title>Egresado| ESCOMBook</title>
	<!-- CSS are placed here -->
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    @yield('css')
	<script src="js/jquery-1.11.2.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

<script type="text/javascript"> //HORA 
function startTime(){
today=new Date();
h=today.getHours();
m=today.getMinutes();
s=today.getSeconds();
m=checkTime(m);
s=checkTime(s);
document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
t=setTimeout('startTime()',500);}
function checkTime(i)
{if (i<10) {i="0" + i;}return i;}
window.onload=function(){startTime();}
</script>

<script src="js/jquery.lightbox.js"></script>  <!-- MODAL IMAGENES -->
<link rel="stylesheet" type="text/css" href="css/modal/jquery.lightbox.css">
<script>
  // Initiate Lightbox
  $(function() {
    $('.gallery a').lightbox(); 
  });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="administrador">ESCOMBook</a></h1>
			<h2 class="section_title">Egresado</h2>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>{{ Auth::user()->nombre}} {{ Auth::user()->apPaterno}} {{ Auth::user()->apMaterno}} &nbsp; (<a href="logout">Cerrar Sesión</a>)</p>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3>Información</h3>
		<ul class="toggle">
			<li class="icn_profile"><a href="#">Información básica y de contacto</a></li>
			<li class="icn_categories"><a href="{{ URL::to('egresado.trabajo') }}">Trabajo</a></li>
			<li class="icn_security"><a href="{{ URL::to('egresado.privacidad') }}">Configuración Cuenta</a></li>
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