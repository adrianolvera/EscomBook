<?php  
class PDFController extends BaseController{

	public function index(){
		return View::make('reportes.reportes');
	}

	public function store(){
		$data= Input::get('generacion');
		Session::put('data',$data);

           
            $view=View::make('reportes.reporteGeneracion');
            $html=$view->render();
		    return PDF::load($html, 'A4', 'portrait')->show();
		 
	}

	public function show(){
		
	}
}

?>
