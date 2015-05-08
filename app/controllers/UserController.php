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


		$resultados = DB::select('SELECT id FROM users WHERE username = ?', array($curp)); // Verificar si existe el CURP
		$resultados2 = DB::select('SELECT boleta FROM datos_egresados WHERE boleta = ?', array($boleta)); // Verificar si existe la boleta

		foreach ($resultados as $resultado) 
		{
    		$existeCURP = $resultado->id;
		}

		foreach ($resultados2 as $resultado) 
		{
    		$existeBoleta = $resultado->boleta;
		}

		if ($existeCURP == null && $existeBoleta == null ) {
					
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
	
}
