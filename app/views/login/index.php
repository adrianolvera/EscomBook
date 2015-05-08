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
				<img src="images/logos/logoEscom.png" border="0" usemap="#logoMap" id="logo" title="ESCOM - Escuela Superior de Cómputo">
					<div class="texto-titulo">
					<titulo-inicio> Sistema de Seguimiento a Egresados (ESCOMBook). </titulo-inicio>
				    </div>
				</div>
		</div>
	</section>

	
	<!-- BOTONES CENTRALES --><br>
	<center><button data-toggle="modal" type="button" class="btn btn-primary btn-lg" href="#login" data-target="#login">Iniciar Sesión</button>
	</center>
	<!-- FIN BOTONES CENTRALES-->	


<!-- LOGIN -->

					     <center>
		 				 <?php if (Session::has('login_errors')) {?><br><br>
		 				<h4> <p style='color:#FB1D1D'>El CURP y/o Contraseña son incorrectos. </p> </h4>
		 				 <?php }?>

		 				 <?php if (Session::has('suspendido')) {?><br><br>
		 				<h4> <p style='color:#FB1D1D'>Actualmente tu cuenta esta suspendida,comunicate con el:<br><br> Lic. José Francisco Serrano García
						<br>Horario: 9:00 a 15:00 hrs. y 18:00 a 21:00 hrs.
						<br>Contacto: Tel. 57296000 Ext. 52056 / ext_ae_escom@ipn.mx. </p> </h4>
		 				 <?php }?>		 				 

		 				 <?php if (Session::has('no_activo')) {?><br><br>
		 				<h4> <p style='color:#FB1D1D'>Actualmente tu cuenta esta inactiva,comunicate con el:<br><br> Lic. José Francisco Serrano García
						<br>Horario: 9:00 a 15:00 hrs. y 18:00 a 21:00 hrs.
						<br>Contacto: Tel. 57296000 Ext. 52056 / ext_ae_escom@ipn.mx. </p> </h4>
		 				 <?php }?>

		 				 <?php if (Session::has('preregistro_incorrecto')) {?><br><br>
		 				<h4> <p style='color:#FB1D1D'>No estas Pre-Registrado en ESCOMBook,comunicate con el:<br><br> Lic. José Francisco Serrano García
						<br>Horario: 9:00 a 15:00 hrs. y 18:00 a 21:00 hrs.
						<br>Contacto: Tel. 57296000 Ext. 52056 / ext_ae_escom@ipn.mx.
						<br><br>Para verificar tu situación. </p> </h4>
		 				 <?php }?>	


		 				 <?php if (Session::has('preregistro_correcto')) {?><br><br>
		 				<h4> <p style='color:##1DA643'>Tus Datos Fueron actualizados Correctamente,ingresa con tu CURP y Contraseña que definiste anteriormente. </p> </h4>
		 				 <?php }?>				 				 	

		 				 <?php if (Session::has('ya_actualizo')) {?><br><br>
		 				<h4> <p style='color:#FB1D1D'>Ya actualizaste tus datos, ingresa con tu CURP y Contraseña que definiste anteriormente. </p> </h4>
		 				 <?php }?>			 				  				 

		 				</center>		 				


				<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="modalLogin" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
								<center><h4>LOGIN DE USUARIO</h4></center>
							</div>
							  	<div class="modal-body">
									<form class="form-horizontal" method="post" action="verificarlogin"><center
						 				 <?php if (Session::has('login_errors')) {?>
						 				 <p></p>
						 				 <?php }else {?>
						 				<h4> <p> Introduzca CURP y Contraseña para continuar. </p></h4><br>
						 				 <?php } ?>

						 				 <div class="control-group">
											<label class="control-label" for="inputEmail">CURP:</label>
											<div class="controls">
							  					<input type="text" title="Ingresa tu CURP" name="username" placeholder="CURP" size="30"  style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
							  					pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; maxlength="18" required>
							  				</div>
						  				</div>

						  				<div class="control-group">
											<label class="control-label" for="inputPassword">Contraseña:</label>
											<div class="controls">
							  					<input type="password" title="Ingresa tu contraseña" name="password" placeholder="Password" size="30"  required>
											</div>
						  				</div><br>
						  				
										<p>¿No recuerdas tu contraseña? <a href="recuperarContraseña">Da clic aquí</a></p>
										 <div class="modal-footer">
											<input type="submit" value="Enviar"> 
											<input type="reset">
										 </div>
									</form>		
									
			  					</div>
						</div>
					</div>
				</div>
<!-- FIN LOGIN -->	


	
	<!-- INICIO CARRUSEL -->

  <div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">

				   <div class="carousel slide" id="myCarousel">
					<div class="carousel-inner">

						<div class="item active">

							<div class="bannerImage">
								<a href="#"><img src="images/carrusel-1.png" alt=""></a>
							</div>
						</div><!-- /Slide1 --> 

						<div class="item">
							<div class="bannerImage">
								<a href="#"><img src="images/carrusel-2.png" alt=""></a>
							</div>                                              
						</div><!-- /Slide2 -->             

						<div class="item">
							<div class="bannerImage">
								<a href="#"><img src="images/carrusel-3.png" alt=""></a>
							</div>                                                 
						</div><!-- /Slide2 -->                      

					</div>

					<div class="control-box">                            
						<a data-slide="prev" href="#myCarousel" class="carousel-control left">‹</a>
						<a data-slide="next" href="#myCarousel" class="carousel-control right">›</a>
					</div><!-- /.control-box -->   

				</div><!-- /#myCarousel -->

		</div><!-- /.span12 -->          
	</div><!-- /.row --> 
</div><!-- /.container -->

		<article> <center>
		<h4 id="h4">Si es la primera vez que entras a la aplicación, Verifica si estás pre-registrado &nbsp;
			<button data-toggle="modal" type="button" class="btn btn-primary btn-lg" href="#revisar" data-target="#revisar">Verificar</button>
				<div class="modal fade" id="revisar" tabindex="-1" role="dialog" aria-labelledby="modalRevisar" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
								<h4>Verificar Pre-Registro</h4>
							</div>
							  	<div class="modal-body">
									<form class="form-horizontal" method="post" action="verificarPreRegistro">
					 				 <div class="control-group">
										<label class="control-label" for="input">CURP</label>
										<div class="controls">
						  				<input type="text" name="curp" title="Ingresa tu CURP" placeholder="CURP" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="18" 
						  				pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; required>
						  				</div>
					  				</div>
									 <div class="modal-footer">
										<input type="submit" value="Enviar"> 
										<input type="reset"></form>		
									 </div>
			  					</div>
						</div>
					</div>
				</div>
		</h4>	
	</article> </center>


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