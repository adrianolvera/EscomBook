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

	public function agregarusuario()  
	{
		$nombre= Input::get('nombre');
		$apPaterno= Input::get('apPaterno');
		$apMaterno= Input::get('apMaterno');

		$curp= Input::get('username');
		$pass = Input::get('password');		
		$tipo= Input::get('check');
		$status = Input::get('status');

		$boleta = Input::get('boleta');
		$generacion = Input::get('generacion');

		$correo = Input::get('correo');


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

		return Redirect::to('administrador')->with('agregarUsuario_Correcto',true);

	}	
	
}
?>