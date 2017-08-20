<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Session;

class TagController extends Controller
{

	public function __construct() {
		// Make sure admin is logged in
		$this->middleware('auth:admin');
	}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Grab all the tags from the DB
        $tags = Tag::all();

        // Return the view with resources
        return view('tags.index')->withTags($tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate Request
        $this->validate($request, [
        		'name' => 'required|max:255|unique:tags'
        	]);

        // Generate new instance of tag
        $tag = new Tag;

        // Store variables in tag model
        $tag->name = $request->name;

        // Save into database
        $tag->save();

        // Flash Session
        Session::flash('success', 'New tag \'' . $tag->name . '\' was created');

        // Return to index
        return redirect()->route('tags.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);

        return view('tags.show')
                    ->withTag($tag);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('tags.edit')
                    ->withTag($tag);
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
        $tag = Tag::find($id);

        $this->validate($request, [
            'name' => 'required|max:255'
            ]);

        $tag->name = $request->name;

        $tag->save();

        Session::flash('success', 'The ' . $tag->name . ' has been updated.');

        return redirect()->route('tags.show', $tag->id);
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
        $tag = Tag::find($id);

        // Delete rows from tag_tag pivot table
        $tag->posts()->detach();

        // Delete the Item
        $tag->delete();

        // Session Flash Message
        Session::flash('success', 'The tag was successfully deleted.');

        // Redirect to the index
        return redirect()->route('tags.index');

    }
}
