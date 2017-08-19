<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Session;

class PostController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Create a Variable and store all the blog posts from the database
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        // Return a view and pass in the above variable
        return  view('posts.index')
                    ->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show the Create Form to the User
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required'
        ));

        // Grab a new instance of the Post Model
        $post = new Post;

        // Store Variables in Post Model
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        // Save the Object to the DB
        $post->save();

        // Flash Success Message to User
        Session::flash('success', 'The blog post was successfully saved!');

        // redirect to another page, and pass along the id parameter
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Grab the post by id
        $post = Post::find($id);
        // Return the Shows view
        return  view('posts.show')
                    ->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find the post in the database and save as variable
        $post = Post::find($id);

        // return view
        return  view('posts.edit')
                    ->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Grab the Post Information from the DB
        $post = Post::find($id);


        // Check to see if the Slug Has Changed
        if($request->input('slug') == $post->slug) {
            // Validate the data minus the slug because it didn't change
            $this->validate($request, array(
                'title' => 'required|max:255',
                'body' => 'required'
            ));
        } else {
            // Validate the data minus the slug because it didn't change
            $this->validate($request, array(
                'title' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'body' => 'required'
            ));
        }


        // Set updates to the variables in the Post Object
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;

        // Save the changes to the Database
        $post->save();

        // Set Flash Data with Success Message
        Session::flash('success', 'This post was successfully saved.');

        // Redirect with flash data to posts.show
        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the Post in the Database
        $post = Post::find($id);

        // Delete the Item
        $post->delete();

        // Session Flash Message
        Session::flash('success', 'The post was successfully deleted.');

        // Redirect to the index
        return redirect()->route('posts.index');
    }
}
