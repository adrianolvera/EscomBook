<?php

class UserController extends BaseController {
	public function mostrarTodos()
	{
		$users = User::orderBy('updated_at','desc')->paginate(10);

        if (Auth::user()->tipo == '1')
        	return View::make('administrador.gestionUsers', array('users' => $users)); // Regresa gestion users
        elseif(Auth::user()->tipo == '2')
        	return View::make('encargado.gestionUsers', array('users' => $users)); // Regresa gestion users
	}


	public function cambiarstatus()  
	{
		$id = Input::get('id');
		$nuevoStatus = Input::get('nuevoStatus');


			// Guardar en la BD los nuevos datos

			$User = User::find($id);
			$User -> status = $nuevoStatus;
			$User->save();	 // Actualizo Post

		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
			return Redirect::to('gestionUsuarios')->with('cambiarStatus_Correcto',true);
		}
		elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
			return Redirect::to('gestionUsuarios')->with('cambiarStatus_Correcto',true);
		}
		else{
			return Redirect::to('egresado'); //  Suspende su Cuenta
		}			

			

	}	

	public function agregarusuario()  
	{
		$nombre= Input::get('nombre');
		$apPaterno= Input::get('apPaterno');
		$apMaterno= Input::get('apMaterno');

		$curp= Input::get('username'); // CURP
		$pass = Input::get('password');		
		$tipo= Input::get('check');
		$status = Input::get('status');

		$boleta = Input::get('boleta');
		$generacion = Input::get('generacion');

		$correo = Input::get('correo');
		$existeCURP = null;
		$existeBoleta = null;
		$existeCorreo = null;

		$tipoTelefono = Input::get('tipoTelefono');
		$numero = Input::get('telefono');
		$extension = Input::get('extTelefono');		


		$resultados = DB::select('SELECT id FROM users WHERE username = ?', array($curp)); // Verificar si existe el CURP
		$resultados2 = DB::select('SELECT boleta FROM datos_egresados WHERE boleta = ?', array($boleta)); // Verificar si existe la boleta
		$resultados3 = DB::select('SELECT id,correo from correo_usuario where correo = ?', array($correo)); // Verificar si existe correo

		foreach ($resultados as $resultado) 
		{
    		$existeCURP = $resultado->id;
		}

		foreach ($resultados2 as $resultado) 
		{
    		$existeBoleta = $resultado->boleta;
		}

		foreach ($resultados3 as $resultado) 
		{
    		$existeCorreo = $resultado->correo;
		}		

		if ($existeCURP == null && $existeBoleta == null && $existeCorreo == null ) {
					
		// Guardar en la BD los datos

			$User = new User;
			$User -> nombre = $nombre;
			$User -> apPaterno = $apPaterno;
			$User -> apMaterno = $apMaterno;
			$User -> status = $status;
			$User -> username = $curp;
			$User -> password = Hash::make($pass);
			$User -> tipo = $tipo;
		    $User -> save();  // Guardamos Datos

		    $id = DB::table('users')->max('id');

		    if($boleta != 0000000000){ // En caso de que sea Tipo 3 "Egresado"
		    $Datos = new DatosEgresado();
		    $Datos -> idUsuario = $id;
		    $Datos -> boleta = $boleta;
		    $Datos -> generacion = $generacion;
		    $Datos -> save ();

			}

			//Guardo el Correo
			if($correo != "correo@correo.com"){
			$mail = new Correo;
			$mail -> idUsuario = $id;
			$mail -> correo = $correo;
		    $mail -> tipoCorreo = 1;  // Asigna por Default "Personal"

			$mail -> save(); // Guardo Correo

			$UserTel = new Telefono;
			$UserTel -> idUsuario = $id;
			$UserTel -> telefono = $numero;

			if ($extension != null) {
				$UserTel -> extension = $extension;
			}

			$UserTel -> tipoTelefono = $tipoTelefono;
			$UserTel -> save(); // Guardo los Datos


			// ENVIAR EL CORREO DE REGISTRO

			$para = 'pruebasescombook@hotmail.com'; // Probando el correo 
			$titulo = 'Registro en ESCOMBook';
			$header = 'From: ' . $correo; // De quien lo envia (Nosotros)
		    $msjCorreo = "Buen día ".$nombre."\n\n Tus datos de acesso a ESCOMBook son:\n\n* CURP: ".$curp."\n* Contraseña: ".$pass ."\n* Correo Registrado: ".$correo ."\n\nIngrese a http://compartamoscine.esy.es/ para identificarse\n\n\nSaludos!";
			  
				if (mail($para, $titulo, $msjCorreo, $header)) {
					echo "<script language='javascript'>
					alert('Mensaje enviado, muchas gracias.');
					</script>";
				} 
				else {
					echo 'Falló el envio';
				}

		    }

		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
			return Redirect::to('agregarUsuario')->with('agregarUsuario_Correcto',true);
		}
		elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
			return Redirect::to('agregarUsuario')->with('agregarUsuario_Correcto',true);
		}
		else{
			return Redirect::to('egresado'); // No puede Agregar a Otro Usuario
		}				    

	}
	else{

		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
			return Redirect::to('agregarUsuario')->with('agregarUsuario_Error',true);
		}
		elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
			return Redirect::to('agregarUsuario')->with('agregarUsuario_Error',true);
		}
		else{
			return Redirect::to('egresado'); // No puede Agregar a Otro Usuario
		}

	}
		

	}

	/*	TOÑO	*/
	public function perfil(){
    	$foto 	= DB::select('SELECT rutaMultimedia FROM users WHERE id = ?', array(Auth::user()->id));
        $tel    = Telefono::where('idUsuario', '=', Auth::user()->id)->get();
        $correo = Correo::where('idUsuario', '=', Auth::user()->id)->get();
        if(sizeof($tel) > 0 && sizeof($correo) > 0){
        	if (Auth::user()->tipo == '1')
	        	return View::make('administrador/perfil', array('tel' => $tel, 'correo' => $correo, 'foto' => $foto[0]->rutaMultimedia));
	        elseif(Auth::user()->tipo == '2')
	        	return View::make('encargado/perfil', array('tel' => $tel, 'correo' => $correo, 'foto' => $foto[0]->rutaMultimedia));
	        else
	        	return View::make('egresado/perfil', array('tel' => $tel, 'correo' => $correo, 'foto' => $foto[0]->rutaMultimedia));
        }else{
        	if (Auth::user()->tipo == '1')
	        	return View::make('administrador/perfil', array('foto' => $foto[0]->rutaMultimedia));
	        elseif(Auth::user()->tipo == '2')
	        	return View::make('encargado/perfil', array('foto' => $foto[0]->rutaMultimedia));
	        else
	        	return View::make('egresado/perfil', array('foto' => $foto[0]->rutaMultimedia));
        }
    }

    public function saveBasics(){
    	$all 	= "";
        //$input  = Input::except('_token');
        $x      = 0;
        $tel    = Telefono::where('idUsuario', '=', Auth::user()->id)->get();
        $user 	= User::find(Auth::user()->id);
        $correo = Correo::where('idUsuario', '=', Auth::user()->id)->get();
        if(sizeof($tel) > 0 && sizeof($correo) > 0){

        }else{
            $correo = new Correo;
            $tel    = new Telefono;
            $tel->idUsuario 	 = Auth::user()->id;
	        $correo->idUsuario   = Auth::user()->id;
        }
        if(Input::file('ProfilePhoto')){
	    	$input = array('ProfilePhoto' => Input::file('ProfilePhoto'));
			$reglas  = array(
	            'image'   => 'mimes:jpg,jpeg,png|max:2056'
	        );
	    	$validator = Validator::make($input, $reglas);
			if($validator->fails()){
				if (Auth::user()->tipo == '3'){
					return Redirect::back()->with('postImagen_Error', true);
				}elseif (Auth::user()->tipo == '2'){
					return Redirect::back()->with('postImagen_Error', true);
				}else{
					return Redirect::back()->with('postImagen_Error', true);
				}
	    	}else{
	    		$image = Input::file('ProfilePhoto');
				$extension = $image->getClientOriginalExtension(); //Saco la extension
		    	//GENERAR NOMBRE ALEATORIO
		    	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890_"; //posibles caracteres a usar
				$numerodeletras = 50; //numero de letras para generar el texto
				$cadena = ""; //variable para almacenar la cadena generada
				for($j = 0; $j < $numerodeletras; $j++)
				    $cadena .= substr($caracteres, rand(0, strlen($caracteres)), 1); /*Extraemos 1 caracter de los caracteres */
				
				$nuevonombre = $cadena.".".$extension;
				$user->rutaMultimedia = 'uploads/perfil/'.$nuevonombre;
				$destination_path = "uploads/perfil";
				$destination_filename = $nuevonombre;
				$image->move($destination_path, $destination_filename);
	    	}
        }else{	//No anexo imagen. Problema con las variables post?
        	$tam       = sizeof($tel);
        	$tamReal   = 0;
        	$input     = Input::get('tels');
        	for($j = 0; $j < 3; $j++){
        		if($input[$j] != '')
		        	$tamReal++;
		    }
		    if($tamReal < $tam){ //Elimino el segundo o tercer tel
		    	//Aun no defino esas opciones en la vista
		    }elseif($tamReal > $tam){ //Agrego mas de los qe tenia
		    	for($j = 0; $j < $tam; $j++){//Actualizo los que ya tenia
		    		$tel[$j]->telefono     = $input[$j];
		    		$tel[$j]->tipoTelefono = Input::get('radios'.$j);
		    		$tel[$j]->save();
		    		//$all = $all . $input[$j] . "<br>";
					//$all = $all . $tel[$j]->tipoTelefono . "<br>";
		    	}
		    	//Con este for crearia los que hacen falta
		    	for($j; $j < $tamReal; $j++){
		    		$tel    		   = new Telefono;
        			$tel->idUsuario    = Auth::user()->id;
        			$tel->telefono = $input[$j];
		    		$tel->tipoTelefono = Input::get('radios'.$j);
		    		$tel->save();
		    		//$all = $all . $input[$j] . "<br>";
					//$all = $all . $tel->tipoTelefono . "<br>";
		    	}
		    }else{//Caso en que solo edito sus telefonos
		    	for($j = 0; $j < $tam; $j++){//Actualizo los que ya tenia
		    		$tel[$j]->telefono     = $input[$j];
		    		$tel[$j]->tipoTelefono = Input::get('radios'.$j);
		    		$tel[$j]->save();
		   //  		$all = $all . $input[$j] . "<br>";
					// $all = $all . $tel[$j]->tipoTelefono . "<br>";
					
		    	}
		    }//FIN TELEFONOS
		    //EMPIEZAN LOS CORREOS :)
			$tam       = sizeof($correo);
        	$tamReal   = 0;
        	$input     = Input::get('mails');
        	for($j = 0; $j < 3; $j++){
        		if($input[$j] != '')
		        	$tamReal++;
		    }
		    if($tamReal < $tam){ //Elimino el segundo o tercer tel
		    	//Aun no defino esas opciones en la vista
		    }elseif($tamReal > $tam){ //Agrego mas de los qe tenia
		    	for($j = 0; $j < $tam; $j++){//Actualizo los que ya tenia
		    		$correo[$j]->correo       = $input[$j];
		    		$correo[$j]->tipoCorreo = Input::get('correos'.$j);
		    		$correo[$j]->save();
		    		//$all = $all . $input[$j] . "<br>";
					//$all = $all . $tel[$j]->tipoTelefono . "<br>";
		    	}
		    	//Con este for crearia los que hacen falta
		    	for($j; $j < $tamReal; $j++){
		    		$correo    		   = new Correo;
        			$correo->idUsuario    = Auth::user()->id;
        			$correo->correo = $input[$j];
		    		$correo->tipoCorreo = Input::get('correos'.$j);
		    		$correo->save();
		    		//$all = $all . $input[$j] . "<br>";
					//$all = $all . $tel->tipoTelefono . "<br>";
		    	}
		    }else{//Caso en que solo edito sus telefonos
		    	for($j = 0; $j < $tam; $j++){//Actualizo los que ya tenia
		    		$correo[$j]->correo     = $input[$j];
		    		$correo[$j]->tipoCorreo = Input::get('correos'.$j);
		   //  		$all = $all . $input[$j] . "<br>";
					// $all = $all . $tel[$j]->tipoTelefono . "<br>";
					$correo[$j]->save();
		    	}
		    }
	    }//Fin else no hay imagen
    	// if($x == 0)
    	// 	$tel->telefono 		= $i;
    	// elseif($x == 1)
    	// 	$tel->tipoTelefono  = $i;
    	// elseif($x == 3)
    	// 	$correo->correo 	= $i;
    	// elseif($x == 4)
    	// 	$correo->tipoCorreo = $i;
    	// $tel->save();
     //    $user->save();
     //    $correo->save();
    	return Redirect::back();
	    	//return $all;
    }
	    
	    

    public function work(){
        $tel = Telefono::where('idUsuario', '=', Auth::user()->id)->first();
        $correo = Correo::where('idUsuario', '=', Auth::user()->id)->first();
        if (Auth::user()->tipo == '1')
            return View::make('administrador/trabajo', array('tel' => $tel, 'correo' => $correo));
        elseif(Auth::user()->tipo == '2')
            return View::make('encargado/trabajo', array('tel' => $tel, 'correo' => $correo));
        else
            return View::make('egresado/trabajo', array('tel' => $tel, 'correo' => $correo));
    }

    public function saveWork(){
        $input  = Input::except('_token');
        $x      = 0;
        //return Redirect::back();
    }
}
