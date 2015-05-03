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

/////////////////////////

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

Route::post('GuardarEditarPost','AdministradorController@editarpost'); // Editar Post Administrador (Propios)
Route::post('EliminarPostAdministrador','AdministradorController@eliminarpost'); // Eliminar Post (Cualquiera)

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

/////////////////////////

Route::post('GuardarEditarComentario','AdministradorController@editarcomentario'); // Editar Comentario Administrador (Propios)
Route::post('EliminarComentarioAdministrador','AdministradorController@eliminarcomentario'); // Eliminar PComentario (Cualquiera)

/////////////////////////////////////////////////////////



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
    		if(Auth::user()->tipo == '1' and Auth::user()->status == '1' ){
				return Redirect::to('administrador');
			}
			elseif (Auth::user()->tipo == '2' and Auth::user()->status == '1') {
				return Redirect::to('encargado');
			}
			else{
				return View::make('egresado.index');
			}// El usuario está autenticado
}

}));




Route::get('agregarUsuario', array('before' => 'auth', function() // Agregar Usuario Administrador
{
	return View::make('administrador.agregarUsuario');
}));


/* Rutas del muro: PostController */
// Toño
Route::get('egresado', 'PostController@wall');
Route::post('egresado', 'PostController@store');
//Nuevas Rutas
Route::get('egresado.muro', 'PostController@myMuro');
Route::get('encargado.muro', 'PostController@wall');
Route::get('encargado.miMuro', 'PostController@myMuro');
Route::get('administrador.muro', 'PostController@wall');
// Route::get('wall', 'PostController@wall');
// Route::post('wall', 'PostController@store');

Route::post('eliminar','PostController@delete'); //Eliminar
Route::post('actualizar','PostController@update'); //Actualizar

Route::get('gestionPosts', 'PostController@mostrarTodos');
Route::get('gestionPosts.show/{id}', 'PostController@show');
Route::get('gestionPosts.edit/{id}', 'PostController@edit');
Route::post('gestionPosts.edit/{id}', 'PostController@actualizar');
Route::get('gestionPosts.delete/{id}', 'PostController@erase');

Route::get('borrar/{id}', [
    'as' => 'borrar', 'uses' => 'PostController@erase'
]);

Route::post('egresado', [
    'as' => 'crear', 'uses' => 'ComentarioController@crear'
]);

/*Route::get('reportes', function()
{
    $html = '<html><head><meta charset="UTF-8"><link rel="stylesheet"  href="{{asset('css/bootstrap.min.css')}}"/></head><body>';
    $html.= '<p Prueba rapida pdf';
    $html.= 'Aqui puede ir todo el html necesario.</p>';
    $html.= '</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();
});*/

/*Route::get('administrador/reportes','PDFController@get_formulario');*/


Route::resource('administrador/reportes', 'PDFController');
