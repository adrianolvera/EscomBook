<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function()  // RAIZ
{
	if (Auth::check())
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
		
}
 return View::make('login.index'); 
});



Route::get('inicio', function()  // INICIO
{
 return View::make('login.index'); 
});





Route::post('verificarlogin','UserLogin@user'); //Login de Usuarios
Route::post('verificarPreRegistro','UserLogin@verificarpreregistro'); // Verificar Pre-Registro
Route::get('PreRegistro', function() // Despliega Vista Pre-Registro
{
	return View::make('login.preregistrado');
});

Route::post('GuardarPreRegistro','UserLogin@guardarpreregistro'); // Guardar Pre-Registro


Route::post('recuperar','UserLogin@verificarcorreo'); // Verificar Correo (Recuperacion Contraseña)
Route::get('recuperarContraseña', function() // Despliega Vista Recuperar
{
	return View::make('login.recuperar');
});


//////////// ADMINISTRADOR CRUD /////////////////////////

Route::get('editPost', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('editarPost', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));

Route::get('editPost2', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('editarPost2')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('editarPost2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.gestionContenido.editarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));

/////////////////////////


Route::get('eliminaPost', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('eliminarPost', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));


Route::get('eliminaPost2', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('eliminarPost2')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('eliminarPost2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.gestionContenido.eliminarPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));

///////////////////////VER POST///////////////////////////////////////////////////////////

Route::get('vePost', array('before' => 'auth', function() 
{

	
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('verPost', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));

////////////////////////

Route::get('vePost2', array('before' => 'auth', function() 
{

	
$valor= $_GET["id"];
$valor2= $_GET["id2"];

return Redirect::to('verPost2')->with(array('idUser'=> $valor,'idPost'=>$valor2));

}));



Route::get('verPost2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idPost');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
			else{
				return View::make('egresado.verPost')->with(array('idUser'=> $valor,'idPost'=>$valor2));
			}
}

}));

Route::post('GuardarEditarPost','AdministradorController@editarpost'); // Editar Post Administrador (Propios)
Route::post('GuardarEditarPost2','AdministradorController@editarpost2'); // Editar Post Administrador (Propios)


Route::post('EliminarPostAdministrador','AdministradorController@eliminarpost'); // Eliminar Post (Cualquiera)
Route::post('EliminarPostAdministrador2','AdministradorController@eliminarpost2'); // Eliminar Post (Cualquiera)




////////CRUD COMENTARIOS ADMINISTRADOR///////////

Route::get('veComentario', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));


Route::get('verComentario', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

Route::get('veComentario2', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('verComentario2')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));


Route::get('verComentario2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.gestionContenido.verComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

/////////////////////////

Route::get('editComentario', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));



Route::get('editarComentario', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

Route::get('editComentario2', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('editarComentario2')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));



Route::get('editarComentario2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.gestionContenido.editarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

/////////////////////////

Route::get('eliminaComentario', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));



Route::get('eliminarComentario', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

Route::get('eliminaComentario2', array('before' => 'auth', function() 
{
$valor= $_GET["id"];
$valor2= $_GET["id2"];
$valor3= $_GET["id3"];

return Redirect::to('eliminarComentario2')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));

}));



Route::get('eliminarComentario2', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');
	$valor2 = Session::get('idComentario');
	$valor3 = Session::get('idPOST');


	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionContenido.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionContenido.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
			else{
				return View::make('egresado.gestionContenido.eliminarComentario')->with(array('idUser'=> $valor,'idComentario'=>$valor2,'idPOST'=>$valor3));
			}
}

}));

/////////////////////////

Route::post('GuardarEditarComentario','AdministradorController@editarcomentario'); // Editar Comentario Administrador (Propios)
Route::post('GuardarEditarComentario2','AdministradorController@editarcomentario2'); // Editar Comentario Administrador (Propios)

Route::post('EliminarComentarioAdministrador','AdministradorController@eliminarcomentario'); // Eliminar PComentario (Cualquiera)
Route::post('EliminarComentarioAdministrador2','AdministradorController@eliminarcomentario2'); // Eliminar PComentario (Cualquiera)

// TERMINA GESTIÓN DE CONTENIDO ////////////////////////////////////////////////////


///////// GESTION DE USUARIOS //////////////////////////////////////////////////////

Route::get('cambiaUsuario', array('before' => 'auth', function() 
{
$valor= $_GET["id"];

return Redirect::to('cambiarUsuario')->with(array('idUsuario'=>$valor));

}));



Route::get('cambiarUsuario', array('before' => 'auth', function() 
{
	$valor = Session::get('idUsuario');

	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionUsuarios.cambiarUsuario')->with(array('idUsuario'=>$valor));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionUsuarios.cambiarUsuario')->with(array('idUsuario'=>$valor));
			}
			else{
				return View::make('egresado.gestionUsuarios.cambiarUsuario')->with(array('idUsuario'=>$valor));
			}
}

}));

///////////////////////VER USUARIO///////////////////////////////////////////////////////////

Route::get('veUsuario', array('before' => 'auth', function() 
{

	
$valor= $_GET["id"];

return Redirect::to('verUsuario')->with(array('idUser'=> $valor));

}));



Route::get('verUsuario', array('before' => 'auth', function() 
{
	$valor = Session::get('idUser');

	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
    			return View::make('administrador.gestionUsuarios.verUsuario')->with(array('idUser'=> $valor));
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.gestionUsuarios.verUsuario')->with(array('idUser'=> $valor));
			}
			else{
				return View::make('egresado.gestionUsuarios.verUsuario')->with(array('idUser'=> $valor));
			}
}

}));

////////////////////////


////////////////////////////////////////////////////////////////////////////////////////






Route::get('buscador', array('before' => 'auth', function()  // Tipo 1
{
	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1'){
				return View::make('administrador.buscador');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado.buscador');
			}
			else{
				return Redirect::to('egresado'); // Egresado No Busca
			}
}
}));

Route::post('buscarPost','PostController@buscarpost'); // Guardar Pre-Registro

Route::get('buscarPost', array('before' => 'auth', function()  // Tipo 1
{
	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1'){
				return View::make('administrador.busqueda');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado.busqueda');
			}
			else{
				return Redirect::to('egresado'); // Egresado No Busca
			}
}
}));



Route::get('logout',function() //Cerrar Sesión
{
	Auth::logout();
	return Redirect::to('/');
});


Route::get('administrador', array('before' => 'auth', function()  // Tipo 1
{
	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1'){
				return View::make('administrador.index');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado');
			}
			else{
				return Redirect::to('egresado');
			}// El usuario está autenticado
}
}));


Route::get('encargado', array('before' => 'auth', function() // Tipo 2
{
	if (Auth::check())
{
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
				return Redirect::to('administrador');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return View::make('encargado.index');
			}
			else{
				return Redirect::to('egresado');
			}// El usuario está autenticado
}

}));



Route::get('egresado', array('before' => 'auth', function() // Tipo 3
{
	if (Auth::check())
{
			if (Auth::user()->status != '1') {
				return Redirect::to('logout');
			}

    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
				return Redirect::to('administrador');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado');
			}
			else {
				return View::make('egresado.index');
			}

}

}));


Route::get('agregarUsuario', array('before' => 'auth', function() // Agregar Usuario Administrador
{
	if (Auth::check())
	{
		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
			return View::make('administrador.agregarUsuario');
		}
		elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
			return View::make('encargado.agregarUsuario');
		}
		else{
			return Redirect::to('egresado');
		}// El usuario está autenticado
	}

	}));

Route::post('agregarNuevoUsuario','UserController@agregarusuario'); // Agregar Usuario (Administrador)
Route::post('CambiarStatusUsuario','UserController@cambiarstatus'); // Cambiar Status Usuario


/* Rutas del muro: PostController  (QUE NO SIRVEN)*/
// Toño


Route::get('egresado.miMuro', array('before' => 'auth', 'uses' => 'PostController@myMuro')); // Armando

Route::get('encargado.muro', array('before' => 'auth', 'uses' => 'PostController@wall'));
Route::get('encargado.miMuro', array('before' => 'auth', 'uses' => 'PostController@myMuro'));


Route::get('administrador.muro', array('before' => 'auth', 'uses' => 'PostController@wall'));
Route::get('administrador.miMuro', array('before' => 'auth', 'uses' => 'PostController@myMuro'));


////////// GESTION DE POST /////////////////////

Route::get('gestionPosts', array('before' => 'auth', 'uses' => 'PostController@mostrarTodos'));
Route::get('gestionUsuarios', array('before' => 'auth', 'uses' => 'UserController@mostrarTodos'));


///////////////////////////////////////////////




/*POSTS*/
Route::post('muro', [
    'as' => 'crearP', 'uses' => 'PostController@store'
]);
/* COMENTARIOS */
Route::post('comentario', [
    'as' => 'crearC', 'uses' => 'ComentarioController@crear'
]);

Route::post('borrarC', [
    'as' => 'deleteC', 'uses' => 'ComentarioController@delete'
]);
/* Vista muro egresado */
Route::get('borrarComentario/{id}', [
    'as' => 'borrarComentario', 'uses' => 'ComentarioController@borrar'
]);



Route::resource('administrador/reportes', 'PDFController');

