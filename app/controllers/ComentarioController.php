<?php

class ComentarioController extends BaseController {

	public function crear()
	{
		$post = new Post;
		$post->mensaje = Input::get('feedbox');
		$post->idUsuario = Auth::user()->id;
		// si escogio una fto
		if(Input::file('image')){
			$image = Input::file('image');
			$post->tipo_post = '1';
			$post->rutaMultimedia = 'uploads/muro/'.$image->getClientOriginalName();
			//guardamos la imagen en public/uploads/muro con el nombre original de la imagen
			$destination_path = "uploads/muro";
			$destination_filename = $image->getClientOriginalName();
			$image->move($destination_path, $destination_filename);
		}
		// $post->idUsuario = Input::get('created_by'); Era para buscar el user y actualizar la llave foranea
		if (Auth::user()->tipo == '3'){
			$post->permiso = '3';
			//Guardamos
			$post->save();
			return Redirect::to('administrador'); // Regresa al Muro
		}elseif (Auth::user()->tipo == '2'){
			$post->permiso = '2';
			$post->save();
			return Redirect::to('encargado.muro'); // Regresa al Muro
		}else{
			$post->permiso = '1';			
			$post->save();
			return Redirect::to('egresado'); // '/wall' is the url to redirect
		}
		
		// Y Devolvemos una redirección a la acción show para mostrar el usuario
		
	}

	
}
