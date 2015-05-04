<?php

class UserLogin extends BaseController {

	public function user()
	{
		//get POST data
		$userdata = array(
			'username' => Input::get('username'),
			'password' => Input::get('password'),
			 );

		if(Auth::attempt($userdata))
		{
			
			if(Auth::user()->tipo == '1' and Auth::user()->status == '1'){
				return Redirect::to('administrador');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado');
			}
			elseif (Auth::user()->tipo == '3' and Auth::user()->status == '1') {
				return Redirect::to('egresado');
			}

			if(Auth::user()->status == '0'){
				Auth::logout();
				return Redirect::to('/')->with('no_activo',true);
			}

		}
		else
		{
			return Redirect::to('/')->with('login_errors',true);
		}
	}




	public function verificarcorreo()
	{
		//POST data
		$correo = Input::get('correo');
		$curp = Input::get('username');
		$idusuario = 0;
		$nombreusuario = "Sin Nombre";

		$resultados = DB::select('SELECT u.id,u.nombre FROM users u,correo_usuario cu, tipo_correo tc WHERE u.username = ? AND cu.correo = ? AND u.id = cu.idusuario AND cu.tipocorreo = tc.id', array($curp,$correo));

		foreach ($resultados as $resultado)
		{
    		$idusuario = $resultado->id;
    		$nombreusuario = $resultado->nombre;
		}

		if ($idusuario != 0) {
			//echo "El id de Usuario es:",$idusuario;
			//echo "<br>";
			//echo "El Nombre es:",$nombreusuario;

	    	//GENERAR CONTRASEÑA ALEATORIA
	    	$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
			$numerodeletras=15; //numero de letras para generar el texto
			$cadena = ""; //variable para almacenar la cadena generada
			for($i=0;$i<$numerodeletras;$i++)
			{
			    $cadena .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres 
			entre el rango 0 a Numero de letras que tiene la cadena */
			}
			echo "<br>";

			echo "Nueva Contraseña:",$cadena;




			// Guardar en la BD la Nueva Contraseña

			$user = User::find( $idusuario);
			$user -> password = Hash::make($cadena);
			$user->save();	 // Guardo		


			// ENVIAR EL CORREO

			$para = 'pruebasescombook@hotmail.com'; // Probando el correo 
			$titulo = 'Solicitud de datos ESCOMBook';
			$header = 'From: ' . $correo; // De quien lo envia (Nosotros)
			$msjCorreo = "Buen día ".$nombreusuario."\n\n Tus datos de acesso son:\n\n* CURP: ".$curp."\n* Nueva Contraseña: ".$cadena. "\n* Correo Registrado: ".$correo ."\n\nIngrese a http://compartamoscine.esy.es/ para identificarse\n\n\nSaludos!";
			  
				if (mail($para, $titulo, $msjCorreo, $header)) {
					echo "<script language='javascript'>
					alert('Mensaje enviado, muchas gracias.');
					</script>";
				} 
				else {
					echo 'Falló el envio';
				}

		return Redirect::to('recuperarContraseña')->with('datos_correcto',true);
			// Terminamos de Enviar


		}
		else { // No coincide la información
			return Redirect::to('recuperarContraseña')->with('datos_errors',true);
		}

	}




	public function verificarpreregistro()  //El Valor de  CURP es -> username
	{
		
		$curp = Input::get('curp'); //Recupero lo que envia del Formulario
		$idusuario = 0;
		$nombreusuario = "Sin Nombre";
		$ValorCurp = "NULL";	

	    $resultados = DB::select('SELECT id,nombre,username,status,tipo FROM users  WHERE username = ? ', array($curp));

		foreach ($resultados as $resultado)
		{
    		$idusuario = $resultado->id;
    		$nombreusuario = $resultado->nombre;
    		$status = $resultado->status;
    		$tipo = $resultado->tipo;
		}

		if ($idusuario != 0) {

			if ($status == '1' || $tipo != 3) {
				return Redirect::to('/')->with('ya_actualizo',true);
			}
			else{
				return Redirect::to('PreRegistro')->with('curp', $curp);
			}
		}
		else{
			return Redirect::to('/')->with('preregistro_incorrecto',true);
		}				


	}


	public function guardarpreregistro()  
	{
		$idusuario = Input::get('id');
		$nombre = Input::get('nombre');
		$apPaterno = Input::get('apPaterno');
		$apMaterno = Input::get('apMaterno');
		$correo = Input::get('correo');
		$curp = Input::get('username');
		$password = Input::get('password');
		$tipo = Input::get('tipo');
		$status = Input::get('status');		

		$boleta = Input::get('boleta');
		$generacion = Input::get('generacion');	


			// Guardar en la BD los nuevos datos

			$user = User::find( $idusuario);
			$user -> nombre = $nombre;
			$user -> apPaterno = $apPaterno;
			$user -> apMaterno = $apMaterno;
			$user -> password = Hash::make($password);
		    $user -> status = "1";

			$user->save();	 // Guardo	Datos Usuario

        $resultados = DB::select('SELECT id FROM datos_egresados WHERE idUsuario = ?', array($idusuario));

		foreach ($resultados as $resultado)
		{
    		$idEgresado = $resultado->id;
		}					


			$egresado = DatosEgresado::find($idEgresado);
			$egresado -> boleta = $boleta;

			$egresado->save();	 // Guardo Boleta


			$mail = new Correo;
			$mail -> idUsuario = $idusuario;
			$mail -> correo = $correo;
		    $mail -> tipoCorreo = 1;  // Asigna por Default "Personal"

			$mail -> save(); // Guardo Correo


			// ENVIAR EL CORREO DE REGISTRO

			$para = 'pruebasescombook@hotmail.com'; // Probando el correo 
			$titulo = 'Registro en ESCOMBook';
			$header = 'From: ' . $correo; // De quien lo envia (Nosotros)
		    $msjCorreo = "Buen día ".$nombre."\n\n Tus datos de acesso a ESCOMBook son:\n\n* CURP: ".$curp."\n* Contraseña: ".$password ."\n* Correo Registrado: ".$correo ."\n\nIngrese a http://compartamoscine.esy.es/ para identificarse\n\n\nSaludos!";
			  
				if (mail($para, $titulo, $msjCorreo, $header)) {
					echo "<script language='javascript'>
					alert('Mensaje enviado, muchas gracias.');
					</script>";
				} 
				else {
					echo 'Falló el envio';
				}				

			return Redirect::to('/')->with('preregistro_correcto',true);

	}
}			