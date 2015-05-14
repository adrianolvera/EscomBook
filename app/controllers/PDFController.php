<?php  
class PDFController extends BaseController{

	public function index(){
		return View::make('reportes.reportes');
	}

	public function generarGeneracion(){
		$data= Input::get('generacion');
		Session::put('data',$data);

           
            $view=View::make('reportes.reporteGeneracion');
            $html=$view->render();
		    return PDF::load($html, 'A4', 'portrait')->show();
		 
	}

	public function generarAnioEgreso(){
		$data= Input::get('egreso');
		Session::put('data',$data);

           
            $view=View::make('reportes.reporteEgreso');
            $html=$view->render();
		    return PDF::load($html, 'A4', 'portrait')->show();
		 
	}

		public function generarLugarTrabajo(){
		$data= Input::get('generacion');
		Session::put('data',$data);

           
            $view=View::make('reportes.reporteTrabajo');
            $html=$view->render();
		    return PDF::load($html, 'A4', 'portrait')->show();
		 
	}

}

?>
