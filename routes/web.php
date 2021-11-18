<?php

$origin = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '*';
$origin = isset($_SERVER['HTTPS_ORIGIN']) ? $_SERVER['HTTPS_ORIGIN'] : '*';
header("Access-Control-Allow-Origin: *"); 
header('Access-Control-Allow-Origin: '.$origin);
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: https://campanas-servicio.cl/');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Body, Content-Type, X-Auth-Token , Authorization, Accept, Methods');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');

/*



|--------------------------------------------------------------------------



| Web Routes



|--------------------------------------------------------------------------



|



| This file is where you may define all of the routes that are handled



| by your application. Just tell Laravel the URIs it should respond



| to using a Closure or controller method. Build something great!



|



*/


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@admin');
Route::get('/audi', 'HomeController@audi');
Route::get('/seat', 'HomeController@seat');
Route::get('/skoda', 'HomeController@skoda');
Route::get('/volkswagen', 'HomeController@volkswagen_pkw');
Route::get('/volkswagen_lcv', 'HomeController@volkswagen_lcv');
Route::get('/volkswagen_tb', 'HomeController@volkswagen_tyb');
Route::get('/man', 'HomeController@man');
Route::get('/admin', 'HomeController@admin');


Route::group(['prefix' => 'admin'], function () {

	// Authentication Routes...
	$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
	$this->post('login', 'Auth\LoginController@login');
	$this->post('logout', 'Auth\LoginController@logout')->name('logout');
});

// Password Reset Routes...

$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
$this->post('password/reset', 'Auth\ResetPasswordController@reset');
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

	Route::get('vinsvokls/historial_busquedas', 'VinVolksController@historial_busquedas')->name('vinsvokls.historial_busquedas');
	Route::get('vinsman/historial_busquedas', 'VinManController@historial_busquedas')->name('vinsman.historial_busquedas');
	
	Route::resource('vins', 'VinController');
	Route::resource('vinsvokls', 'VinVolksController');
	Route::resource('vinsman', 'VinManController');

	Route::resource('users', 'UserController');
	Route::resource('usersman', 'UsermanController');
	Route::resource('userswolks', 'UserwolksController');

	Route::resource('detallecampanas', 'DetalleCampanaController');

	Route::get('vins/marca/{marca}', 'VinController@getVinPorMarca')->name('vins.marca');
	Route::get('panel/marca/{marca}', 'VinController@panelPorMarca')->name('panel.marca');
	Route::get('vines/upload', 'VinController@uploadVin')->name('vines.upload');

	Route::get('vines/listaVins', 'VinController@listaVins')->name('vines.listaVins');

	Route::get('vines/obtener-consultas-vins', 'VinController@getConsultas')->name('obtener-consultas-vins');

	//update de master camapanas
	Route::get('vines/upload/master', 'VinController@uploadMaster')->name('vines.upload.master');

	//activar vin
	Route::get('vins/{vin}/activar', 'VinController@activar')->name('vins.activar');
	Route::get('vinsvokls/{vin}/activar', 'VinVolksController@activar')->name('vinsvokls.activar');
	Route::get('vinsman/{vin}/activar', 'VinManController@activar')->name('vinsman.activar');

	//activar vin
	Route::get('vins/{vin}/desactivar', 'VinController@desactivar')->name('vins.desactivar');
	Route::get('vinsvokls/{vin}/desactivar', 'VinVolksController@desactivar')->name('vinsvokls.desactivar');
	Route::get('vinsman/{vin}/desactivar', 'VinManController@desactivar')->name('vinsman.desactivar');


	Route::get('vins/{codigo}/vistaDetalle', 'VinController@vistaDetalle')->name('vins.vistaDetalle');


	//logs
	Route::get('log', 'LogController@index')->name('log.index');

	//Tutorial
	Route::get('tutorial', 'VinController@tutorial')->name('vins.tutorial');
	//Tutorial
	Route::get('notificaciones/cambiar-estado', 'NotificacionController@cambiarEstado')->name('cambiar-estado');

	Route::resource('notificaciones', 'NotificacionController');
	
	Route::resource('logImportaciones', 'LogImportacionController');
	
	Route::resource('exportaciones', 'ExportacionController');
});

Route::get('vins/exportar', 'VinController@exportar')->name('vins.exportar');

Route::get('vins/importar', 'VinController@importar')->name('vins.importar');

//busqueda de vin

Route::post('/vins/search', 'VinController@search')->name('vins.search');

Route::get('/vins/search', 'VinController@search')->name('vins.search');

Route::post('/vinsvokls/search', 'VinVolksController@search')->name('vinsvokls.search');

Route::post('/vinsman/search', 'VinManController@search')->name('vinsman.search');


//subida de archivos excel

Route::post('vins/store/file', 'VinController@storeExcel')->name('vins.store.file');

//subida de archivos excel
Route::post('vins/store/master/file', 'VinController@storeExcelMaster')->name('vins.detalle.store.file');

//subida de archivos excel

Route::post('detallecampanas/exportar', 'DetalleCampanaController@exportarPorMarca')->name('detallecampana.exportar.marca');
Route::get('detallecampanas/obtener-campanas', 'DetalleCampanaController@obtenerCampanas')->name('detallecampana.obtenerCampanas');

Route::get('documento', function () {
	$pdf = PDF::loadView('documentos.apartamento');
    return $pdf->download('historicos.pdf');
});

Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('config:cache');
    echo 'cleared';
});
