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

</script>

		</h4>		

		<!-- INICIO DEL MAIN -->
		<article class="module width_full">
			<header><h3>BUSQUEDA DE POST</h3></header>
				<div class="module_content"><center>

					<?php $nombreSession = Auth::user()->nombre; // ID del usuario en Session;
					?>


								<form  name ="form1" method="post" action="buscarPost">
								<?php if ($idUser =! null) {?>
								<h3> Hola <?php echo $nombreSession; ?> selecciona:</h3>
								<?php } else { echo "<br>";}?>

					 				<b>Buscar POSTS por:</b><br><br>
					 				 Palabras Clave:&nbsp;<input type="radio" name="check"  id="check1" value=1 onchange="javascript:showContent()"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 CURP:&nbsp;<input type="radio" name="check"  id="check2" value=2 onchange="javascript:showContent()"/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									 Fecha:&nbsp; <input type="radio" name="check"  id="check3" value=3 onchange="javascript:showContent()" /><br><br><br>

								<div id="content" style="display: none;"> <!-- Palabra Clave -->
					 				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 				<input type="text" id="palabraclave" name="palabraclave" placeholder="Palabra clave dentro del POST" maxlength="50" required> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					 				<br><br>
					 			</div>
								

								<div id="content2" style="display: none;"> <!-- CURP -->

									CURP:&nbsp;<input type="text" title="CURP" name="curp" id="curp" placeholder="CURP" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" 
							  					pattern="[A-Z]{1}[AEIOU]{1}[A-Z]{2}[0-9]{6}[HM]{1}[A-Z]{5}[A-Z0-9]{2}$"; maxlength="18" required> <br><br>			 			
								</div>

								<div id="content3" style="display: none;"> <!-- FECHA -->

									FECHA:&nbsp;<input type="text" id="fecha" title="Fecha" name="fecha" placeholder="Año-Mes-Día (Ejemplo: 2015-02-30)" maxlength="10"
												pattern="[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$" required><br><br>								   			 								 			
								</div>														



						<br>
						<input id="boton" class="btn" type="submit" value="Buscar"> &nbsp;
						<a class="btn" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Regresar</a><br>
						</form>		

				</div>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>	


<script type="text/javascript">
    function showContent() {
        element = document.getElementById("content");  // Palabra Clave
        element2 = document.getElementById("content2");
        element3 = document.getElementById("content3");
        check3 = document.getElementById("check3");
        check2 = document.getElementById("check2");
        check1 = document.getElementById("check1"); // Palabra Clave


        if (check1.checked){ // Selecciono PALABRA CLAVE
        	element.style.display='inline';
        	element2.style.display='none';
        	element3.style.display='none';
        	document.getElementById('palabraclave').value="";
            document.getElementById('curp').value='GIRM910230HDFCRM00';
            document.getElementById('fecha').value="2015-02-30";

        }


        if (check2.checked){ // Selecciono CURP
        	element.style.display='none';
        	element2.style.display='inline';
        	element3.style.display='none';
        	document.getElementById('palabraclave').value="VACIO";
            document.getElementById('curp').value='';
            document.getElementById('fecha').value="2015-02-30";


        }

        
        if (check3.checked) { // Seleccione FECHA
            element.style.display='none';
            element2.style.display='none';
            element3.style.display='inline';
        	document.getElementById('palabraclave').value="VACIO";
            document.getElementById('curp').value='GIRM910230HDFCRM00';
            document.getElementById('fecha').value="";


        }
        

    }
</script>	

@stop