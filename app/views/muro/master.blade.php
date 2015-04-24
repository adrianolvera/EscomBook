<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>ESCOMBook</title>

		<!-- Bootstrap CSS -->
		<!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
		{{ HTML::style('css/bootstrap.css') }}
        {{ HTML::style('css/bootstrap-theme.css') }}
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- jQuery -->
		<script src="js/jquery-1.11.2.js" type="text/javascript"></script>
		<!-- Custom CSS --> <!-- CSS Dinámicos -->
		@yield('css')
	</head>
	<body>
		<!-- Inicio del cuerpo -->
		<!-- Encabezado / Header -->
		<h2 class="text-center">Muro</h2>
		<br>
		<div class="row">
			<!-- Menú Izquierdo  -->
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				@yield('menuLeft')
			</div>
			<!-- Contenido central  -->
			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				@yield('contenido')
			</div>
		</div>

		<!-- Pie de Página / Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2015</p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </footer>

		
		<!-- Bootstrap JavaScript -->
		@yield('js')	
	</body>
</html>