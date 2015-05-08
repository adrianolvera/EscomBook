<?php

class PostController extends BaseController {

	public function wall()
    {        
        $posts = Post::orderBy('updated_at','desc')->paginate(5);
        $comments[] = array();
        foreach ($posts as $post) {
            $date = $post->updated_at;    
            setlocale(LC_TIME, 'es_MX');
            $date = $date->formatlocalized('%A %d %B %Y');
            $aux = Comentario::where('idPost', '=', $post->id)->paginate(5);
            if ($aux->count() > 0)
            	array_push($comments, $aux);
        }

        if (Auth::user()->tipo == '1')
        	return View::make('administrador/muro', array('posts' => $posts, 'comments' => $comments));
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado/muro', array('posts' => $posts, 'comments' => $comments));
        else
        	return View::make('egresado/index', array('posts' => $posts, 'comments' => $comments));
    }

    public function myMuro()
    {
    	//$posts = DB::select('select * from post where idUsuario = ?', array(Auth::user()->id));
    	$posts = Post::orderBy('updated_at','desc')->where('idUsuario', '=', Auth::user()->id)->paginate(5);
    	$comments[] = array();

        foreach ($posts as $post) {
            $aux = Comentario::where('idPost', '=', $post->id)->paginate(5);
            if ($aux->count() > 0)
            	array_push($comments, $aux);
        }
        if (Auth::user()->tipo == '1')
        	return View::make('administrador/miMuro', array('posts' => $posts, 'comments' => $comments));
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado/miMuro', array('posts' => $posts, 'comments' => $comments));
        else
        	return View::make('egresado/miMuro', array('posts' => $posts, 'comments' => $comments));
    }

	public function store() // Guardar POST (Con Imagen o Sin Ella)
	{
		$post = new Post;
		$post->mensaje = Input::get('feedbox');
		$post->idUsuario = Auth::user()->id;
		// si escogio una fto
		if(Input::file('image')){
			// Build the input for our validation
	    	$input = array('image' => Input::file('image'));
	    	// Within the ruleset, make sure we let the validator know that this
	    	// file should be an image
			$reglas  = array(
	            'image'   => 'mimes:jpg,jpeg,png,bmp,gif|max:2056'
	        );
	        // Now pass the input and rules into the validator
	    	$validator = Validator::make($input, $reglas);
			if($validator->fails()){
				if (Auth::user()->tipo == '3'){
					return Redirect::back()->with('postImagen_Error',true);
				}elseif (Auth::user()->tipo == '2'){
					return Redirect::back()->with('postImagen_Error',true);
				}else{
					return Redirect::back()->with('postImagen_Error',true);
				}
	    	}else{
				$image = Input::file('image');
				$extension = $image->getClientOriginalExtension(); //Saco la EXTENSIÓN


				$post->tipo_post = '1'; // Con Imagen

		    	//GENERAR NOMBRE ALEATORIO
		    	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_"; //posibles caracteres a usar
				$numerodeletras=50; //numero de letras para generar el texto
				$cadena = ""; //variable para almacenar la cadena generada
				for($i=0;$i<$numerodeletras;$i++)
				{
				    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres */
				}

				$nuevonombre = $cadena.".".$extension;

				$post->rutaMultimedia = 'uploads/muro/'.$nuevonombre; // Guardando en el servidor

				//guardamos la imagen en public/uploads/muro con el nombre original de la imagen
				$destination_path = "uploads/muro";
				$destination_filename = $nuevonombre;
				$image->move($destination_path, $destination_filename);
			}
    	
		// Y Devolvemos una redirección a la acción show para mostrar el usuario
		}
		// $post->idUsuario = Input::get('created_by'); Era para buscar el user y actualizar la llave foranea
		if (Auth::user()->tipo == '3'){
			$post->permiso = '3';
			//Guardamos
			$post->save();
			return Redirect::back(); // Regresa al Muro
		}elseif (Auth::user()->tipo == '2'){
			$post->permiso = '2';
			$post->save();
			return Redirect::back(); // Regresa al Muro
		}else{
			$post->permiso = '1';			
			$post->save();
			return Redirect::back(); // '/wall' is the url to redirect
		}
	}

	public function show($id){
		return 'View for display only the selected post';
	}	

	public function edit($id){
		$post = Post::find($id);
		return View::make('muro.edit', array('post' => $post)); // Regresa gestion posts
	}

	public function update()
	{
		$id = Input::get('idpublicacion');
		$mensaje = Input::get('mensaje');

		$postdata = Post::find( $id );
        $postdata->mensaje = $mensaje;
        $postdata->save();

        if (Auth::user()->tipo == '1')
        	return Redirect::to('administrador.muro'); // Regresa al Muro
        elseif(Auth::user()->tipo == '2')
        	return Redirect::to('encargado.muro'); // Regresa al Muro
        else
        	return Redirect::to('egresado'); // Regresa al Muro
	}

	public function actualizar()
	{
		$id = Input::get('idPost');
		$mensaje = Input::get('feedbox');

		$postdata = Post::find($id);
        $postdata->mensaje = $mensaje;
        $postdata->save();

        return Redirect::to('gestionPosts'); // Regresa al Muro
	}

	//Función que utiliza el muro
	public function delete()
	{
		$id = Input::get('idpost');

		$postdata = Post::find($id);
        $postdata->delete();

        if (Auth::user()->tipo == '1')
        	return Redirect::back(); // Regresa al Muro
        elseif(Auth::user()->tipo == '2')
        	return Redirect::back(); // Regresa al Muro
        else
        	return Redirect::back(); // Regresa al Muro
	}

	//Función que utiliza el menú de admin
	public function erase($id)
	{
		$postdata = Post::find($id);
        $postdata->delete();
		return Redirect::to('gestionPosts');
	}

	public function mostrarTodos()
	{
		$posts = Post::orderBy('updated_at','desc')->paginate(10);

        if (Auth::user()->tipo == '1')
        	return View::make('administrador.gestionPosts', array('posts' => $posts)); // Regresa gestion posts
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado.gestionPosts', array('posts' => $posts)); // Regresa gestion posts
	}

	public function buscarpost()
	{
		$palabra = Input::get('palabraclave');
		$curp = Input::get('curp');
		$fecha = Input::get('fecha');


		if ($palabra != "VACIO") { // BUSCAR POR PALABRA CLAVE
			Session::put("BusquedaPorPalabra", $palabra);

			if (Auth::user()->tipo == '1')
	        	return View::make('administrador.busqueda'); // Va a mostrar Resultados
	        elseif(Auth::user()->tipo == '2')
	        	return View::make('encargado.busqueda'); // Va a mostrar Resultados
	        else
	        	return Redirect::to('egresado'); // Regresa al Muro        			
		}


		if ($curp != "GIRM910230HDFCRM00") { // BUSCAR POR PALABRA CURP
			Session::put("BusquedaPorCurp", $curp);

			if (Auth::user()->tipo == '1')
	        	return View::make('administrador.busqueda'); // Va a mostrar Resultados
	        elseif(Auth::user()->tipo == '2')
	        	return View::make('encargado.busqueda'); // Va a mostrar Resultados
	        else
	        	return Redirect::to('egresado'); // Regresa al Muro           			
		}



		if ($fecha != "2015-02-30") { // BUSCAR POR PALABRA FECHA
			Session::put("BusquedaPorFecha", $fecha);

			if (Auth::user()->tipo == '1')
	        	return View::make('administrador.busqueda'); // Va a mostrar Resultados
	        elseif(Auth::user()->tipo == '2')
	        	return View::make('encargado.busqueda'); // Va a mostrar Resultados
	        else
	        	return Redirect::to('egresado'); // Regresa al Muro            			
		}


		return Redirect::to('buscador'); // Regresa al Muro  					

        
	}	

}
