<?php

namespace LILPLP\IBAsBlog;

use LILPLP\IBA\Book;
use LILPLP\IBA\Bundle;
use LILPLP\IBA\Role;
use LILPLP\IBA\Keyword as Keyword;

class Post extends Book
{
    public static $dimensions = ['title', 'slug', 'thumbnail', 'timestamp'];
    public static $groupings = ['keywords', 'people', 'bundles'];
    public static $storageName = "posts";

    public function peoples($type)
    {
	    return $this->people()->where('role', $type);
    }
    
    public function roles()
    {
        return $this->morphMany(Role::class, 'peopleable');
    }
    

    public function categories()
    {
        return $this->belongsToMany(Bundle::class, 'bundleable');
    }

 
    public function bundleSingle($type)
    {
        return $this->bundles()->where('type', $type)->first();   
    }
    
/*
    public static function tags()
    {
	    dd(Keyword::all());
	    return Keyword::has('posts')->get()
 		    ->sortBy(function($item, $key) {
 		    	return count($tiem['keyword_id']);
 	    	});
    }
*/
}
