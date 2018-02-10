<?php

namespace LILPLP\IBAsBlog;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\View as View;
// use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Support\Facades\Response as Response;

use GuzzleHttp;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Response;

use LILPLP\IBAsBlog\Keyword;
use LILPLP\IBA\Bundle;

class IBAsBlogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    $this->publishes([
        	__DIR__.'/config/iba-blog.php' => config_path('iba-blog.php'),
		]);
		
        //
//         $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
		// require __DIR__.'/routes/routes.php';
        $this->loadViewsFrom(__DIR__.'/resources/views', 'iba-blog');
        
        $this->publishes([
        	__DIR__.'/public' => public_path('lil-plp/iba-blog'),
			], 'public');
		
		$this->loadMigrationsFrom(__DIR__.'/database/migrations');
		
		
		View::composer('iba-blog::modules.tags', function($view) {
	        $view->with('keywords', Keyword::has('posts')->get()->sortBy(function($item, $key) {
 		    	return count($item['keyword_id']);
 	    		})
 	    	);
        });
        View::composer('iba-blog::weblog.base', function($view)	{
	        $view->with('categories', Bundle::where('type', 'category')->get());
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
