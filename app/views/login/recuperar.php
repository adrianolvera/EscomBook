<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  <title>ESCOMBook</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Seguimiento de Egresados de la Escuela Superior de Cómputo.">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  
        <style>
            body {
                padding-top: 50px;
                padding-bottom: 20px;
            }
        </style>  
  
  
  <link rel="stylesheet" href="http://www.isc.escom.ipn.mx/css/bootstrap-responsive.min.css">
  <link rel="stylesheet" href="css/extras/font-awesome.min.css">  
  <link rel="stylesheet" href="css/style.css"> <!-- ESTILOS -->
  
  <link href="css/bootstrap-responsive.css" rel="stylesheet">
  <link href="css/bootstrap-modal.css" rel="stylesheet">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.js"></script>
  <script src="js/bootstrap-modalmanager.js"></script>
  <script src="js/bootstrap-modal.js"></script>
  
		<script type="text/javascript" src="js/alertas/lib/alertify.js"></script>
		<link rel="stylesheet" href="js/alertas/themes/alertify.core.css" />
		<link rel="stylesheet" href="js/alertas/themes/alertify.default.css" />  <!-- Alertas -->
	 	
</head>

<body>
      <div class="container">
        <section class="fondoBlanco">
        <div id="areaTrabajo">
            <div class="row-fluid logos">
              <div class="span6">
                <img src="images/logos/logoSEP.png" border="0" id="logo1">
              </div>
              <div class="span6" align="right">
                <a href="http://www.ipn.mx/" target="_blank">
                  <img src="images/logos/logoIPNGris.png" border="0">
                </a>
              </div>
            </div> <!-- Fin de logos -->
        </div>  <!-- Fin de areaTrabajo -->
       </section>

	</div>
	
<section class="gris">
	<div id="areaTrabajo">
    <div class="gris container">
      <!--<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
       	<span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>-->
    	<div class="nav-collapse pull-right in collapse" style="height: auto;">
        	<a href="http://www.ipn.mx/" class="ligasInst" target="_blank">Inicio IPN</a>&nbsp;<span class="blanco">|</span>
          <a href="http://www.ipn.mx/Paginas/Correo-Electronico.aspx" class="ligasInst" target="_blank" title="Correo Institucional">Correo Electrónico</a>&nbsp;<span class="blanco">|</span>
          <a href="http://www.ipn.mx/Paginas/Instalaciones.aspx" class="ligasInst" title="Instalaciones IPN" target="_blank">Instalaciones</a>&nbsp;<span class="blanco">|</span>
          <a href="http://www.ipn.mx/Paginas/Servicios-Medicos.aspx" class="ligasInst" title="Servicios Médicos" target="_blank">Servicios Médicos</a>&nbsp;<span class="blanco">|</span>
          <a href="http://www.ipn.mx/Paginas/Calendario-Escolar-IPN.aspx" class="ligasInst" title="Calendario" target="_blank">Calendario</a>&nbsp;<span class="blanco">|</span>
          <a href="http://www.ipn.mx/Paginas/Contacto.aspx" class="ligasInst" target="_blank">Contacto</a>&nbsp;
      </div><!--/.nav-collapse -->
 		</div><!-- Fin div container -->
 </div><!-- Fin areaTrabajo -->
</section><br>

	<section class="fondoBlanco">
		<div id="areaTrabajo">
				<div class="container">
				<a href="inicio">
				<img src="images/logos/logoEscom.png" border="0" usemap="#logoMap" id="logo" title="ESCOM - Escuela Superior de Cómputo"/>
				</a>
					<div class="texto-titulo">
					<titulo-inicio> Sistema de Seguimiento a Egresados (ESCOMBook). </titulo-inicio>
				    </div>
				</div>
		</div>
	</section>
	
	<!-- CENTRO -->

  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
		<h4><a href="inicio">Regresar</a></h4>
		<center>
				

		 				 <?php if (Session::has('datos_errors')) {?><br>
		 				<h4> <p style='color:#FB1D1D'>El CURP y/o Correo son incorrectos. </p> </h4>
		 				 <?php }?>

		 				 <?php if (Session::has('datos_correcto')) {?><br>
		 				<h4> <p style='color:#1DA643'>La Nueva Contraseña fue enviada a tu correo,favor de verificar. </p> </h4>
		 				 <?php }?>

				<img src="images/usuario_contrasena.png" border="0" usemap="#logoMap" id="logo" title="Recuperar Contraseña"/>
				<br><br>
								<form class="form-horizontal" method="post" action="recuperar">
					 				 <?php if (Session::has('recuperar_datos')) {?>
					 				 <p></p>
					 				 <?php }else {?>
					 				 <h3> Introduzca el CURP y Correo con el que estas registrado para continuar.</h3>
					 				 <?php } ?><br>
									<input type="text" title="Ingresa tu CURP" name="username" placeholder="CURP" size="50" 
									style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="18" 
									pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; required><br><br>
						  			<input type="email" title="Ingresa tu E-mail" name="correo" placeholder="E-mail" size="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required>
					  				<br><br><br>
										<input class="btn btn-primary btn-lg" type="submit" value="Enviar"> &nbsp;
										<input class="btn btn-primary btn-lg" type="reset" value="Borrar">
								</form>	
		</center>

				  
		</div><!-- /.span12 -->          
	</div><!-- /.row --> 
</div><!-- /.container -->

	
<!--Footer-->
  	<!--Footer-->
  <footer id="footer">
  <center>
    <div class="container">
		<div class="pull-right">	 
		<div class="fb-like" data-href="https://www.facebook.com/escom.iscipn.9" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>		 
		</div><br><br>

		<div class="pull-right">     
				 <p class="guinda center">Escuela Superior de Cómputo.</p>
				 <p class="center">Esta página es una obra intelectual protegida por la Ley Federal del Derecho de Autor, puede ser reproducida con fines no lucrativos, siempre y cuando no se mutile, se cite la fuente completa y su dirección electrónica; su uso para otros fines, requiere autorización previa y por escrito del Director General del Instituto.<br>
					® 2015
				</p> 
				
		</div>  		
         
        </div>
       
        <!--/Copyright-->
      </div>
    </div>
  </footer>
<!--/Footer-->  <!--/Footer-->

  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.3.1/js/bootstrap.min.js'></script>
  <script src="js/index.js"></script>

</body>

<script>
			function ok(){
				alertify.success("Correcto"); 
				return false;
			}
			function error(){
				alertify.error("Incorrecto"); 
				return false; 
			}
		</script>			

</html>