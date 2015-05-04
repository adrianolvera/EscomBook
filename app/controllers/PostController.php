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
        	return View::make('administrador', array('posts' => $posts, 'comments' => $comments));
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado/miMuro', array('posts' => $posts, 'comments' => $comments));
        else
        	return View::make('egresado/miMuro', array('posts' => $posts, 'comments' => $comments));
    }

	public function store()
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
	            'image'   => 'image|mimes:jpeg,jpg,png|max:128'
	        );
	        // Now pass the input and rules into the validator
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
				$image = Input::file('image');
				$post->tipo_post = '1';
				$post->rutaMultimedia = 'uploads/muro/'.$image->getClientOriginalName();
				//guardamos la imagen en public/uploads/muro con el nombre original de la imagen
				$destination_path = "uploads/muro";
				$destination_filename = $image->getClientOriginalName();
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
        if (Auth::user()->tipo == '1')
        	return View::make('administrador.gestionPosts'); // Regresa gestion posts
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado.gestionPosts'); // Regresa gestion posts
	}

	// Armando
	public function mostrarAdministradorTodos()
	{
		$publicaciones = DB::select('SELECT u.id,mensaje,u.nombre,u.apPaterno,p.updated_at from post p, users u where u.id = p.idUsuario ORDER BY updated_at desc');
        return View::make('administrador.index', array('posts' => $publicaciones)); // Regresa gestion posts
	}
}
