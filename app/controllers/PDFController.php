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
		$consulta=DB::select('SELECT * FROM datos_egresados where generacion="$perro"');
		    $html = '<html><body>'
            .'<p>Has seleccionado la: '.$data.'</p>'
            .'</body></html>';
		    return PDF::load($html, 'A4', 'portrait')->show();
	}
}

