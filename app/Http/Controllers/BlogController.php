<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class BlogController extends Controller
{

	// Get the Index of Blog Posts
    public function getIndex() {
    	// Grab all of the posts from the DB
    	$posts = Post::paginate(10);

    	// Return the Index View
    	return view('blog.index')->withPosts($posts);
    }


    // Get Single Post
    public function getSingle($slug) {
    	// Grab the post via slug
    	$post = Post::where('slug', '=', $slug)->first();

    	// Return the Via Pass in Post Object
    	return view('blog.single')->withPost($post);
    }


    
}
