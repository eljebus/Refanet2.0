
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

Route::post('/Login', 'MainController@login');

Route::post('/LoginFb', 'MainController@loginFb');

Route::get('/getMarcks/{categoria}', 'MainController@setMarcks');

Route::get('/terminos', 'MainController@showTerms');

Route::post('/getPaySeller', 'MainController@getPay');



//Rutas para el comprador----------------------------------------------------------------

Route::group(['middleware' => 'auth'], function() {

	Route::get('/Comprador/deleteItem/{item}', 'BuyerController@deleteItem');

	Route::get('/Comprador', 'BuyerController@index');
	
	Route::get('/Comprador/Nueva', 'BuyerController@nuevaPublicacion');

	Route::get('/Comprador/Publicacion/{post}', 'BuyerController@post');

	Route::get('/Comprador/perfil', 'BuyerController@profile');


	Route::get('/Comprador/Compra/tarjeta', 'BuyerController@card');

	Route::get('/Comprador/Compra/directo', 'BuyerController@direct');


	Route::get('/Comprador/Compra/{post}', 'BuyerController@buy');

	Route::get('/Comprador/Compras', 'BuyerController@compras');

	Route::get('/Comprador/Compras/{post}', 'BuyerController@getCompra');


	Route::post('/Comprador/comentar', 'BuyerController@makeComment');

	Route::post('/Comprador/getProfile', 'BuyerController@getProfile');

	Route::post('/Comprador/saveProfile', 'BuyerController@saveProfile');

	Route::post('/Comprador/Save', 'BuyerController@registerDevice');

	Route::post('/Comprador/SaveEdit', 'BuyerController@editDevice');

	Route::post('Comprador/preguntar', 'BuyerController@saveQuestion');

	Route::post('/Comprador/finishBuy', 'BuyerController@finishBuy');

	Route::post('/Comprador/busqueda', 'BuyerController@search');


	Route::get('/Comprador/Soporte', 'BuyerController@listaSoporte');

	Route::get('/Comprador/Soporte/Nueva', 'BuyerController@soporte');

	Route::get('/Comprador/Pregunta/{ticket}', 'BuyerController@getTicket');

	Route::get('/Comprador/Exit', 'BuyerController@BuyerExit');

	Route::get('/Comprador/Editar/{publicacion}', 'BuyerController@Edit');

	Route::get('/Comprador/Finalizar/{offer}', 'BuyerController@finish');

	Route::get('/Comprador/Categoria/{categoria}', 'BuyerController@getCategory');



});



	
//Rutas del Vendedor --------------------------------------------------------------------------

Route::group(['middleware' => 'authSeller'], function() {

	Route::group(['middleware' => 'subsSeller'], function() {



		Route::get('/Vendedor', 'SellerController@index');

		Route::get('/Vendedor/Pieza/{pieza}', 'SellerController@showPart');

		Route::get('/Vendedor/Ofertas', 'SellerController@showOffers');

		Route::get('/Vendedor/Oferta/{oferta}', 'SellerController@post');

		Route::get('/Vendedor/EditarOferta/{ofer}', 'SellerController@editOffer');


		Route::get('/Vendedor/Aceptar/{oferta}', 'SellerController@acept');

		Route::get('/Vendedor/Ventas', 'SellerController@ventas');

		Route::get('/Vendedor/Soporte', 'SellerController@listaSoporte');

		Route::get('/Vendedor/Soporte/Nueva', 'SellerController@soporte');


		Route::get('/Vendedor/Finalizar/{offer}', 'SellerController@finish');

		Route::get('/Vendedor/Complete/{ofer}', 'SellerController@complete');

		Route::post('/Vendedor/Ofertar', 'SellerController@setOffer');

		Route::post('/Vendedor/ModifyOffer', 'SellerController@saveEditOffer');

		Route::post('/Vendedor/finishBuy', 'SellerController@finishBuy');

		Route::post('/Vendedor/preguntar', 'SellerController@saveQuestion');

		Route::post('/Vendedor/comentar','SellerController@makeComment');

		Route::post('/Vendedor/setConekta', 'SellerController@setConekta');

		Route::post('/Vendedor/busqueda', 'SellerController@search');

		Route::get('/Vendedor/Pregunta/{ticket}', 'SellerController@getTicket');

		Route::get('/Vendedor/Categoria/{categoria}', 'SellerController@getCategory');

		Route::get('/Vendedor/Sugerencias', 'SellerController@getSuggestions');


	});

	Route::get('/Vendedor/perfil', 'SellerController@profile');

	Route::get('/Vendedor/Metodo', 'SellerController@showPay');

	Route::post('/Vendedor/saveProfile', 'SellerController@saveProfile');

	Route::post('/Vendedor/savePay', 'SellerController@getPayContract');

	Route::post('/Vendedor/reportPay', 'SellerController@getPayContract');

});



	Route::get('/Vendedor/saveSeller','SellerController@saveSeller');

	Route::get('/Vendedor/getProfile/{perfil}','SellerController@getProfile');

	Route::post('/Vendedor/setPay','SellerController@getPayContract');


//Rutas Administrador-----------------------------------------------------------


	// Front --------------------------------------------------------------------

Route::group(['middleware' => 'authAdmin'], function() {


	Route::get('/Administrador', 'AdminController@index');

	Route::get('/Administrador/Marcas', 'AdminController@marcas');

	Route::get('/Administrador/Categorias', 'AdminController@categorias');

	Route::get('/Administrador/Soporte', 'AdminController@soporte');

	Route::get('/Administrador/Pregunta/{ticket}', 'AdminController@getTicket');

	Route::get('/Administrador/Perfil/{user}', 'AdminController@showProfile');

	Route::get('/Administrador/NuevaMarca', 'AdminController@newMark');

	Route::get('/Administrador/NuevaCategoria', 'AdminController@newCategory');

	Route::get('/Administrador/deleteUser/{user}', 'AdminController@deleteUser');

	Route::get('/Administrador/deleteCategory/{user}', 'AdminController@deleteCategory');

	Route::get('/Administrador/deleteMarck/{user}', 'AdminController@deleteMarck');

	Route::get('/Administrador/graficas', 'AdminController@getChart');

	Route::post('/Administrador/newC', 'AdminController@saveCategory');

	Route::post('/Administrador/newM', 'AdminController@saveMarck');

	Route::post('/Administrador/busqueda', 'AdminController@getSearch');

	Route::post('/Administrador/responder', 'AdminController@saveQuestion');

	Route::post('/Administrador/sugerencias', 'AdminController@saveSuggestions');




});


Route::get('/', 'MainController@showCategories');

Route::get('/{categoria}', 'MainController@show');



//Rutas de registro


Route::post('/Registro/Comprador/Detalles','MainController@registerUser');


Route::post('/Registro/Vendedor/Suscripciones','MainController@registerUser');

Route::post('/Registro/Vendedor/Subscriptions','MainController@registerSubscriptions');

Route::post('/Registro/Comprador/registerDevice','MainController@registerDevice');

Route::get('/Registro/Comprador/Finalizar','MainController@finishBuyer');

Route::get('/Registro/Comprador/Publicar','MainController@publicar');

Route::get('/Registro/Vendedor/Metodo','MainController@registerPay');

Route::get('/Registro/Vendedor/finalizar','MainController@finishSeller');

Route::get('/Registro/{user}/{etapa?}', 'MainController@register');



//Route::post('/Registro/{user}/{etapa?}', 'MainController@register');


