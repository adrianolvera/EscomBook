<?php 

class PDFController extends BaseController{

	public function index(){
		return View::make('reportes.reportes');
	}

	public function store(){
		return "algo";

	}

	public function show(){
		    $html = '<html><body>'
		     .'<p Prueba rapida pdf'
		     .'Aqui puede ir todo el html necesario.</p>'
		    .'</body></html>';
		    return PDF::load($html, 'A4', 'portrait')->show();
	}
}