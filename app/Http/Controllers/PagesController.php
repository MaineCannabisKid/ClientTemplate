<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller {

	public function getIndex() {
		// Grab the Posts from the database
		$posts = Post::orderBy('created_at', 'desc')->take(5)->get();

		// Return the Pages.Welcome View
		return view('pages.welcome')->withPosts($posts);
	}

	public function getAbout() {
		return view('pages.about');
	}

	public function getContact() {
		return view('pages.contact');
	}

	public function postContact(Request $request) {
		
		// Validate request
		$this->validate($request, [
				'email' 	=> 'required|email',
				'subject' 	=> 'required|min:5|max:255',
				'message' 	=> 'min:50|required'
			]);

		// Pull data from request and put into data array variable
		$data = [
			'email' 	=> $request->email,
			'subject' 	=> $request->subject,
			'bodyMessage' 	=> $request->message
		];

		// Send Message
		Mail::send('emails.contact', $data, function($message) use ($data){
			$message->from($data['email']);
			$message->to('mainecannabiskid@gmail.com');
			$message->subject($data['subject']);
		});

		Session::flash('success', 'Email has been successfully');
		
		return redirect()->route('contact.index');

	}


}