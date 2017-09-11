<?php

namespace LILPLP\IBAsBlog\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Routing\Route;

// use App\Book\AbstractBook;

use Carbon\Carbon;

use LILPLP\IBA\Http\Controllers\BookController;
use LILPLP\IBAsBlog\Post as Post;
use LILPLP\IBA\Name as Name;
use LILPLP\IBAsBlog\Keyword as Keyword;
use LILPLP\IBA\Bundle as Bundle;

class PostController extends BookController
{
    public $type = "post";
    public $class = Post::class;
    public $roles = ['mention'];
    public $bundleTypes = ['category', 'idea'];
    
    public function home()
    {
	    return view('iba-blog::blog.base');
    }
    
    public function index(Request $request)
    {
	    $posts = Post::withAll()->get()->sortByDesc('timestamp.publish');

		if ( $people = request('people') )
		{
			$detail = Name::where('identifier', $people)->first();
 			$person = $detail->people;
			$id = $person->id;
		    $posts = Post::whereHas('roles', function( $query ) use ($id) {
				    $query->where([
		 			    ['role', 'mention'],
				    	['people_id', $id ] ]);
		    	})->get()->sortByDesc('timestamp.publish');
//  			return view('blog.people', compact('posts', 'person'));
		}
		
		
		if ( $tag = request('tag') )
		{
			$posts = Post::withAll()->whereHas('keywords', function($query) use ($tag) {
					$query->where('word', $tag);
				})->get()->sortByDesc('timestamp.publish');
		}
		    		
	    return response()->json($posts);
    }
    
    public function show($id)
    {
	    $all = array_merge(Post::$dimensions, Post::$groupings);
	    $return = Post::with($all)->find($id);
	    $return->content = $return->content();
// 	    return view('blog.post', compact('post'));
		return $return;
    }
    
    public function feed($type)
    {
	    $pages = Post::get()->sortByDesc('timestamp.publish')->take(35);
	    $view = 'backend.feed.' . $type . '.blog';
	    return response()
	    	->view($view, compact('pages'))
	    	->header('Content-Type', 'text/xml');
    }
    
    public function old($year, $season, $slug)
    {
	    $post = Post::whereHas('slug', function($query) use ($slug) {
	    	$query->where('value', $slug);
		    })->first();
	    return redirect()->action(
			    'PostController@show', ['id' => $post->id]
			);
    }
    
    public function asset($post, $asset)
	{	
		$uri = 'posts/' . $post . '/' . $asset;
		return response()->asset($asset, $uri);
	}
    
    public function category($slug)
    {
	    $posts = Post::withAll()->whereHas('bundles', function($query) use ($slug) {
		    	$query = $query->whereHas('slug', function($query) use ($slug) {
			    	$query = $query->where('value', $slug);
		    	})->where('type', 'category');
	    	})->get()->sortByDesc('timestamp.publish');
	    
// 	    $category = $posts->first()->bundles()->first();
	    
// 	    return view('blog.category', compact('posts','category'));
		return response()->json($posts);
    }
    
    public function store(Request $request)
    {
	    $request->validate([
	        'title' => 'required',
	        'slug' => 'required',
	        'content' => 'required',
	        'timestamp.publish' => 'required|date',
	        'timestamp.draft' => 'nullable|date',
	    ]);
	    
		$values = $request->only(['title', 'slug', 'thumbnail', 'keywords', 'bundles', 'timestamp', 'people', 'content']);
		
		$post = new Post;
		$post->save();
		
/*
		if($request->file('thumbnail')->isValid()) {
			$file = $request->file('thumbnail')->store();
			
			$fileUri = static::$storageName . '/' . $post->id . $request->file('thumbnail')->originalName . '.' . $request->file('thumbnail')->mimeType ;
			Storage::disk('ibook')->put($fileUri, $request->file('thumbnail') );
		}
*/
		
		$post->store($values);
		
		$post->save();
		
		return response()->backend($post);
    }
    
    public function update(Request $request, $post)
    {	
		$values = $request->only(['title', 'slug', 'subtitle', 'thumbnail', 'description', 'keywords', 'bundles', 'timestamp', 'people']);
		$post = Post::find($post);
		$post->revise($values);

		$post->save();
		
		return response()->backend($post);
    }
    
    public function categoriesList()
    {
	    $categories = Bundle::where('type', 'category')->get();
	    return response()->json($categories);
	}
	
	public function tagsList() {
		$tags = Keyword::
// 			whereHas()
		has('posts')->get()
 		    ->sortBy(function($item, $key) {
 		    	return count($item['keyword_id']);
 	    	});
		return response()->json($tags);
	}

}
