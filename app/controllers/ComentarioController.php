<?php

class ComentarioController extends BaseController {

	public function crear()
	{
		$comentario = new Comentario;
		$comentario->idPost = Input::get('post');
		$comentario->mensaje = Input::get('commentbox');
		$comentario->idUsuario = Input::get('created_by');
		$pagina = Input::get('page');

		// si escogio una imagen
		if(Input::file('imageC')){
			$input = array('image' => Input::file('imageC'));
			$reglas  = array(
	            'image'   => 'image|mimes:jpeg,jpg,png|max:128'
	        );
	        $validator = Validator::make($input, $reglas);
	        if($validator->fails()){
				if (Auth::user()->tipo == '3'){
					return Redirect::back()->withErrors($validator); 
				}elseif (Auth::user()->tipo == '2'){
					return Redirect::back()->withErrors($validator);
				}else{
					return Redirect::back()->withErrors($validator);
				}
	    	}else{
	    		$image = Input::file('imageC');
	    		$comentario->tipo_comentario = '1';
				$comentario->rutaMultimedia = 'uploads/comments/'.$image->getClientOriginalName();
				//guardamos la imagen en public/uploads/comments con el nombre original de la imagen
				$destination_path = "uploads/comments";
				$destination_filename = $image->getClientOriginalName();
				$image->move($destination_path, $destination_filename);
	    	}
			
		}


		if (Auth::user()->tipo == '3'){
			$comentario->save();
			return Redirect::back();

		}elseif (Auth::user()->tipo == '2'){
			$comentario->save();
			return Redirect::back();

		}else{ // Administrador
			$comentario->save();
			return Redirect::back();
		}
	}

	public function borrar($id){
		$result = Comentario::find($id);
        $result->delete();
		if (Auth::user()->tipo == '3'){
			return Redirect::back(); // Regresa al Muro
		}elseif (Auth::user()->tipo == '2'){
			return Redirect::back(); // Regresa al Muro
		}else{
			return Redirect::back(); // '/wall' is the url to redirect
		}
	}
}
