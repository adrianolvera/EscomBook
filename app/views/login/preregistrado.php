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
				<a href="logout">
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
		<center>


<?php

$curp = Session::get("curp");

if ($curp == null) {
	return Redirect::to('inicio');
}

	    $resultados = DB::select('SELECT * FROM users  WHERE username = ? ', array($curp));

		foreach ($resultados as $resultado)
		{
			$dato0 = $resultado->id;
    		$dato1 = $resultado->nombre;
    		$dato2 = $resultado->apPaterno;
    		$dato3 = $resultado->apMaterno;
    		$dato4 = $resultado->username;
    		$dato5 = $resultado->tipo;
    		$dato6 = $resultado->status;

		}

	    $datosegresados = DB::select('SELECT * FROM datos_egresados  WHERE idUsuario = ? ', array($dato0));

		foreach ($datosegresados  as $datosegresado)
		{
    		$egresado1 = $datosegresado->boleta;
    		$egresado2 = $datosegresado->generacion;

		}		

?>			
				
		 				 <?php if (Session::has('datos_correcto')) {?><br>
		 				<h4> <p style='color:#1DA643'>Datos Actualizados Correctamente. </p> </h4>
		 				 <?php }?>



				<img src="images/usuario_preregistro.png" border="0" usemap="#logoMap" id="logo" title="Datos Pre-Registrado"/>
				<br><br>
								<form class="form-horizontal" method="post" action="GuardarPreRegistro">
					 				 <?php if (Session::has('recuperar_datos')) {?>
					 				 <p></p>
					 				 <?php }else {?>
					 				 <h3> Bienvenido <?php echo $dato1; ?> por favor completa tus datos para continuar.</h3>
					 				 <?php } ?><br>
					 				<h4>
									<input type="hidden" name="id" placeholder="IdUsuario" value="<?php echo $dato0;?>" readonly>
					 			    Nombre(s):&nbsp;<input type="text" name="nombre" placeholder="Nombre" value="<?php echo $dato1;?>" pattern="[A-Za-z]{1}[A-Za-z\s]*$"; maxlength="50" required readonly><br><br>
					 				Apellido Paterno:&nbsp; <input type="text" name="apPaterno" placeholder="Apellido Paterno" value="<?php echo $dato2;?>" pattern="[A-Za-z]{1}[A-Za-z\s]*$"; maxlength="40" required readonly><br><br>
					 				Apellido Materno:&nbsp;<input type="text" name="apMaterno" placeholder="Apellido Materno" value="<?php echo $dato3;?>" pattern="[A-Za-z]{1}[A-Za-z\s]*$"; maxlength="40" required readonly><br><br>
									
									Correo:&nbsp;<input type="email" title="Ingresa tu E-mail" name="correo" placeholder="E-mail" size="50" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required><br><br><br>

									Telefono de Contacto:&nbsp;

									<select class="form-control" name="tipoTelefono" required>
								        <option value=1>Personal</option>
								        <option value=2>Trabajo</option>
								      </select>	<br><br>

									Numero: &nbsp;<input type="text" name="telefono" pattern="[0-9]*$"; maxlength="15" required>&nbsp;&nbsp;
									Extensión:&nbsp;<input type="text" name="extTelefono" pattern="[0-9]*$"; placeholder="Si no cuenta con extensión dejar en blanco">
									<br><br><br>

									
									CURP:&nbsp;<input type="text" name="username" placeholder="CURP" value="<?php echo $dato4;?>" readonly><br><br>

									Contraseña:&nbsp;<input type="password" title="Ingresa tu Contraseña" id="password" name="password" placeholder="Escriba una Contraseña" maxlength="50" required><br><br>
									Confirmar Contraseña:&nbsp;<input type="password" title="Confirma tu Contraseña"id="password2" name="password2" placeholder="Vuela a ingresar la Contraseña" maxlength="50" required><br><br>


									<input type="hidden" name="tipo" placeholder="tipo" value="<?php echo $dato5;?>" readonly>
									<input type="hidden" name="status" placeholder="status" value="<?php echo $dato6;?>" readonly>
					 				Boleta:&nbsp; <input type="text" name="boleta" placeholder="Boleta" value="<?php echo $egresado1;?>" pattern="[0-9]*$"; maxlength="10" required readonly><br><br>
					 				Generación:&nbsp;<input type="text" name="generacion" placeholder="Apellido Paterno" value="<?php echo $egresado2;?>"readonly><br><br>

					  			
					  				<br><br>

									<input id="boton" class="btn btn-primary btn-lg" type="submit" value="Enviar"> &nbsp;
									<a class="btn btn-primary btn-lg" href="logout">Cancelar</a>
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


<script type="text/javascript" /> <!--VALIDACION CONTRASEÑA-->
	$(function(){
		$('#password').keyup(function(){
			var _this = $('#password');
			var password = $('#password').val();
			_this.attr('style', 'background:white');
			if(password.charAt(0) == ' '){
				_this.attr('style', 'background:#FF4A4A');
				document.getElementById('boton').style.display='none';
			}
	
			if(_this.val() == ''){
				_this.attr('style', 'background:#FF4A4A');
			    document.getElementById('boton').style.display='none';
			}

		    if(password != password2 && password != ''){
			    document.getElementById('boton').style.display='none'; 
			}


		});
	
		$('#password2').keyup(function(){
			var password = $('#password').val();
			var password2 = $('#password2').val();
			var _this = $('#password2');
			_this.attr('style', 'background:white');

			if(password2.charAt(0) == ' '){
				_this.attr('style', 'background:#FF4A4A');
				document.getElementById('boton').style.display='none';
			}
	
			if(_this.val() == ''){
				_this.attr('style', 'background:#FF4A4A');
			    document.getElementById('boton').style.display='none';
			}			

			if(password != password2 && password2 != ''){
			    document.getElementById('boton').style.display='none'; 
				_this.attr('style', 'background:#FF4A4A');
			}
			else{
				_this.attr('style', 'background:#FF4A4A');
			    document.getElementById('boton').style.display='inline';
			    _this.attr('style', 'background:#2dcc70');
			}


		});		
	});
</script>				

</html>