<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
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
        // Grab all the Categories
        $categories = Category::all();

        // Grab all Tags
        $tags = Tag::all();

        // Show the Create Form to the User
        return  view('posts.create')
                    ->withCategories($categories)
                    ->withTags($tags);
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
            'title'         => 'required|max:255',
            'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'category_id'   => 'required|integer',
            'tags.*'        => 'integer',
            'body'          => 'required'
        ));

        // Grab a new instance of the Post Model
        $post = new Post;

        // Store Variables in Post Model
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        // Save the Object to the DB
        $post->save();

        // Sync Tags with Post
        $post->tags()->sync($request->tags, false);

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
        $categories = Category::all();

        $tags = Tag::all();

        // return view
        return  view('posts.edit')
                    ->withPost($post)
                    ->withCategories($categories)
                    ->withTags($tags);
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
                'title'         => 'required|max:255',
                'category_id'   => 'required|integer',
                'tags.*'        => 'integer',
                'body'          => 'required'
            ));
        } else {
            // Validate the data minus the slug because it didn't change
            $this->validate($request, array(
                'title'         => 'required|max:255',
                'slug'          => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                'category_id'   => 'required|integer',
                'tags.*'        => 'integer',
                'body'          => 'required'
            ));
        }


        // Set updates to the variables in the Post Object
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->category_id = $request->category_id;
        $post->body = $request->body;

        // Save the changes to the Database
        $post->save();

        // Sync and override the previous tags by not passing the 
        // second parameter, which by default is true.
        isset($request->tags) ? $post->tags()->sync($request->tags) : $post->tags()->sync([]);

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

        // Delete rows from post_tag pivot table
        $post->tags()->detach();

        // Delete the Item
        $post->delete();

        // Session Flash Message
        Session::flash('success', 'The post was successfully deleted.');

        // Redirect to the index
        return redirect()->route('posts.index');
    }
}
