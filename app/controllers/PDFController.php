<?php  
class PDFController extends BaseController{

	public function index(){
		return View::make('reportes.reportes');
	}

	public function store(){
		return "algo";

	}

	public function show(){
		$data= Input::get('generacion');
		Session::put('prueba',$data);
	
/*	$consulta=DB::select('SELECT * FROM datos_egresados where generacion="21"');*/

/*	foreach ($consulta as $consul) {
			echo $consul->boleta." ".$consul->idUsuario;
		}*/
/*		@foreach ($consulta as $consul)  echo $consul->boleta." ".$consul->idUsuario @endforeach*/

		  /*  $html = '<html><head><meta charset="UTF-8"><link rel="stylesheet"  href="css/reportes.css"/>'
		    .'<link rel="stylesheet"  href="css/bootstrap.min.css"/></head><body>'
		    .'<div><h4>INSTITUTO POLITÉCNICO NACIONAL</h4></div>'
		    .'<div><h5>ESCUELA SUPERIOR DE COMPUTO</h5></div>'
            .'<p>Reporte correspondiente a: '
            .'</p>'
            .'<table class="table table-striped">'
            .'<tr>'
				.'<td>Nombre</td>'
				.'<td>Apellido Paterno</td>'
				.'<td>Apellido Materno</td>'
				.'<td>Primer periodo</td>'
				.'<td>Ultimo periodo</td>'
			.'</tr>'
			.@foreach ($consulta as $consul)
            .'<tr>'
                .'<td>'.{{ $consul->boleta }}.'</td>'
                .'<td> </td>'
            .'</tr>'
            .@endforeach
            .'</table>'
            .'<br><br>'
            .'<p>Validar.</p>'
            .'<p>Agregar imagenes a formato de reporte.</p>'
            .'<p>Preguntar que datos llevan las columnas del reporte.</p>'
            .'<p>Recordar que la consulta devuelve un arreglo de objetos.</p>'
            .'<p>Validar.</p>'
            .'</body></html>';*/
            
            $view=View::make('reportes.reporteGeneracion');
            $html=$view->render();
		    return PDF::load($html, 'A4', 'portrait')->show();
	}
}

?>
