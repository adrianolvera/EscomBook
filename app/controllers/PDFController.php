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
		$consulta=DB::select('SELECT * FROM datos_egresados where generacion=:id',['id'=>$data]);
		    $html = '<html><head><meta charset="UTF-8"><link rel="stylesheet"  href="css/reportes.css"/>
		    .<link rel="stylesheet"  href="css/bootstrap.min.css"/></head><body>'
		    .'<div><h4>INSTITUTO POLITÉCNICO NACIONAL</h4></div>'
		    .'<div><h5>ESCUELA SUPERIOR DE COMPUTO</h5></div>'
            .'<p>Has seleccionado la: '.       
            '<tr>
                <td></td>
                <td> </td>
            </tr>'.
            '</p>'
            .'<br><br>'
            .'<p>Validar.</p>'
            .'<p>Agregar imagenes a formato de reporte.</p>'
            .'<p>Preguntar que datos llevan las columnas del reporte.</p>'
            .'<p>Recordar que la consulta devuelve un arreglo de objetos.</p>'
            .'<p>Validar.</p>'
            .'</body></html>';
		    return PDF::load($html, 'A4', 'portrait')->show();
	}
}

