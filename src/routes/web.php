<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use Request;



Route::namespace('LILPLP\IBAsBlog\Http\Controllers')->group(function () {
	Route::get('/blog/test/', 'PostController@index');
	
	if ( ! request()->ajax() ) {
			Route::get('/blog/categories/{slug}', 'PostController@home');
			Route::get('/blog/{post}', 'PostController@home');
			Route::get('/blog/', 'PostController@home');
	    } else {
		    
		    Route::get('/blog/introduction/', function(){
				$page = new LILPLP\IBA\Http\Controllers\PageController('blog/introduction/');
				return $page->content();
			});
			
		    Route::get('/blog/categories/{slug}', 'PostController@category');
		    Route::get('/blog/index/', 'PostController@index');
			Route::get('/blog/{post}/', 'PostController@show')->name('post');
			Route::get('/blog/', 'PostController@index');
			
			
			Route::get('/blog/modules/tags/', 'PostController@tagsList');
	/*
	        Route::get('blog.sidebar-right', function($view) {
		        $view->with('mentions', \App\People::mentions());
	        });
	*/
	        Route::get('/blog/modules/categories/', 'PostController@categoriesList');
	        
	        
	        
	    }
	
	Route::get('/blog/feed/{type}', 'PostController@feed');
	Route::get('/blog/{year}/{season}/{slug}/', 'PostController@old');
	
	Route::get('/blog/{post}/{asset}', 'PostController@asset');
});

	Route::namespace('LILPLP\IBAsBlog\Http\Controllers')->middleware('auth:api')->prefix('/api/backend/post')->group(function () {
		Route::put('/{post}/', 'PostController@update');
		Route::get('/{post}/edit', 'PostController@edit');
		Route::get('/create/', 'PostController@create');
		Route::post('/', 'PostController@store');
		Route::get('/', 'PostController@manage');
	});
