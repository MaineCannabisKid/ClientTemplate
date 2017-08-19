<?php

namespace App\Http\Controllers;

use App\Post;

class PagesController extends Controller {

	

	public function getIndex() {
		// Grab the Posts from the database
		$posts = Post::orderBy('id', 'desc')->take(5)->get();

		// Return the Pages.Welcome View
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout() {
		return view('pages.about');
	}

	public function getContact() {
		return view('pages.contact');
	}


}