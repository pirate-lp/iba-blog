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



Route::prefix('/blog')->namespace('LILPLP\IBAsBlog\Http\Controllers')->group(function ()
{
	if ( !request()->wantsJson() )
	{
		Route::get('/categories/{slug}/', 'PostController@home');
		Route::get('/{post}/', 'PostController@home');
		Route::get('/', 'PostController@home');
	}
	else
	{
		
		
	    Route::get('/categories/{slug}', 'PostController@category');
		Route::get('/index/', 'PostController@index');
		Route::get('/{post}/', 'PostController@show')->name('post');
		Route::get('/', 'PostController@index');
		
		
		Route::get('/modules/tags/', 'PostController@tagsList');
/*
        Route::get('blog.sidebar-right', function($view) {
	        $view->with('mentions', \App\People::mentions());
        });
*/
        Route::get('/modules/categories/', 'PostController@categoriesList');
        
        
        Route::get('/modules/people/search/', '\LILPLP\IBA\Http\Controllers\PeopleController@find');
        
        Route::get('/{page}/', function($page) {
			$page = new LILPLP\IBA\Http\Controllers\LeafController('blog/' . $page);
			return $page->content();
		});
    }
	
// 	Route::get('/blog/feed/{type}', 'PostController@feed');
	Route::get('/blog/{year}/{season}/{slug}/', 'PostController@old');
	
	Route::get('/{post}/{asset}', 'PostController@asset');

});

Route::prefix('/weblog')->namespace('LILPLP\IBAsBlog\Http\Controllers')->middleware('web')->group(function () {
	
	Route::get('/introduction/', function() {
		$page = new LILPLP\IBA\Http\Controllers\PageController('blog/introduction/');
		return $page->content();
	});
	
	Route::get('/categories/{slug}', 'WeblogController@category');
	Route::get('/index/', 'WeblogController@index');
	Route::get('/{post}/', 'WeblogController@show')->name('post');
	Route::get('/', 'WeblogController@index');
	
	Route::get('/{post}/{asset}', 'WeblogController@asset');

	Route::get('/modules/people/search/', '\LILPLP\IBA\Http\Controllers\PeopleController@find');

});

Route::prefix('/api/iba/post')->namespace('LILPLP\IBAsBlog\Http\Controllers')->middleware(['api','auth:api'])->group(function () {
	Route::get('/', 'PostController@manage');
	Route::get('/create/', 'PostController@create');
	Route::post('/', 'PostController@store');
	Route::get('/{post}/edit', 'PostController@edit');
	Route::patch('/{post}/', 'PostController@update');
});

Route::prefix('/iba/analog')->namespace('LILPLP\IBAsBlog\Http\Controllers')->middleware(['web', 'auth'])->group( function() {
	Route::iba('post', 'PostController');
});