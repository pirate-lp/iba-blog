<?php

namespace LILPLP\IBAsBlog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;

use Carbon\Carbon;

use LILPLP\IBA\Http\Controllers\BookController;
use LILPLP\IBAsBlog\Post as Post;
use LILPLP\IBA\Name as Name;
use LILPLP\IBAsBlog\Keyword as Keyword;
use LILPLP\IBA\Bundle as Bundle;
use LILPLP\IBA\People as People;

class WeblogController extends BookController
{
    public $type = "post";
    public $class = Post::class;
    public $roles = ['mention'];
    public $bundleTypes = ['category', 'idea'];
    
    public function index()
    {
	    $posts = Post::get()->sortByDesc('timestamp.publish');
		
		if ( $people = request('mention') && !is_numeric(request('mention')) )
		{
			$detail = Name::where('identifier', $people)->first();
			if ($detail) {
 			$person = $detail->people;
			$id = $person->id;
		    $posts = Post::whereHas('roles', function( $query ) use ($id) {
				    $query->where([
		 			    ['role', 'mention'],
				    	['people_id', $id ] ]);
		    	})->get()->sortByDesc('timestamp.publish');
//  			return view('blog.people', compact('posts', 'person'));
			}
		}
		
		if ( $mention = request('mention') )
		{
// 			$detail = Name::where('identifier', $people)->first();
//  			$person = $detail->people;
// 			$id = $person->id;
			$person = People::find($mention);
		    $posts = Post::whereHas('roles', function( $query ) use ($mention) {
				    $query->where([
		 			    ['role', 'mention'],
				    	['people_id', $mention ] ]);
		    	})->get()->sortByDesc('timestamp.publish');
 			return view('iba-blog::weblog.people', compact('posts', 'person'));
		}
		
		
		if ( $tag = request('tag') )
		{
			$keyword = Keyword::where('word', $tag)->first();
			$posts = $keyword->posts()->get()->sortByDesc('timestamp.publish');
 			return view('iba-blog::weblog.keyword', compact('posts', 'keyword'));
		}
		    		
	    return view('iba-blog::weblog.index', compact('posts', 'title'));
    }
    
    public function show($post)
    {
	    $post = Post::find($post);
	    return view('iba-blog::weblog.post', compact('post'));
    }
    
    public function asset($post, $asset)
	{
		$uri = 'posts/' . $post . '/' . $asset;
		return response()->asset($asset, $uri);
	}
    
    public function category($slug)
    {
	    $posts = Post::whereHas('bundles', function($query) use ($slug) {
		    	$query = $query->whereHas('slug', function($query) use ($slug) {
			    	$query = $query->where('value', $slug);
		    	})->where('type', 'category');
	    	})->get()->sortByDesc('timestamp.publish');
	    
	    $category = $posts->first()->bundles()->first();
	    
	    return view('iba-blog::weblog.category', compact('posts','category'));
    }
}
