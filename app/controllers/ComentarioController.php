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
	            'image'   => 'mimes:jpg,jpeg,png,bmp,gif|max:2056'
	        );
	        $validator = Validator::make($input, $reglas);
	        if($validator->fails()){
				if (Auth::user()->tipo == '3'){
					return Redirect::back()->with('comentarioImagen_Error',true);
				}elseif (Auth::user()->tipo == '2'){
					return Redirect::back()->with('comentarioImagen_Error',true);
				}else{
					return Redirect::back()->with('comentarioImagen_Error',true);
				}
	    	}else{
	    		$image = Input::file('imageC');
	    		$extension = $image->getClientOriginalExtension(); //Saco la EXTENSIÓN

	    		$comentario->tipo_comentario = '1';

	    		//GENERAR NOMBRE ALEATORIO
		    	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_"; //posibles caracteres a usar
				$numerodeletras=50; //numero de letras para generar el texto
				$cadena = ""; //variable para almacenar la cadena generada
				for($i=0;$i<$numerodeletras;$i++)
				{
				    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres */
				}

				$nuevonombre = $cadena.".".$extension;

				$comentario->rutaMultimedia = 'uploads/comments/'.$nuevonombre; // Guardando en el servidor


				//guardamos la imagen en public/uploads/comments con el nombre original de la imagen
				$destination_path = "uploads/comments";
				$destination_filename = $nuevonombre;
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
