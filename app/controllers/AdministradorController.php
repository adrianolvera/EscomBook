<?php

class AdministradorController extends BaseController{

	public function __construct()
	{
		$this->beforeFilter('auth'); //Bloqueo de Acceso
	}

	public function getIndex()
	{
		return View::make('administrador.index');
	}


	public function editarpost()  
	{
		$id = Input::get('idPublicacion');
		$mensaje = Input::get('mensaje');


			// Guardar en la BD los nuevos datos

			$post = Post::find( $id);
			$post -> mensaje = $mensaje;
			$post->save();	 // Actualizo Post


			return Redirect::to('administrador')->with('editarPost_index',true);

	}

		public function eliminarpost()  
	{
		$id = Input::get('idPublicacion');

			// Guardar en la BD los nuevos datos

			$post = Post::find( $id);
			$post->delete();	 // Actualizo Post


			return Redirect::to('administrador')->with('eliminarPost_index',true);

	}


	public function editarcomentario()  
	{
		$id = Input::get('idPublicacion');
		$mensaje = Input::get('mensaje');


			// Guardar en la BD los nuevos datos

			$Comentario = Comentario::find( $id);
			$Comentario -> mensaje = $mensaje;
			$Comentario->save();	 // Actualizo Post


			return Redirect::to('verPost')->with('editarComentario_index',true);

	}	

	public function eliminarcomentario()  
	{
		$id = Input::get('idPublicacion');

			// Guardar en la BD los nuevos datos

			$Comentario = Comentario::find( $id);
			$Comentario->delete();	 // Actualizo Comentario


			//return Redirect::to('verPost')->with('eliminarComentario_index',true);          ERROR No carga valores
			return Redirect::to('administrador')->with('eliminarComentario_index',true);

	}

}
?>