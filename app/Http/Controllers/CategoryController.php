<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoryController extends Controller
{

    public function __construct() {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Display a view of all of our categories
        // it will also have a form to create a new category
        
        $categories = Category::all();

        return view('categories.index')->withCategories($categories);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Save a new category then redirect to index
        $this->validate($request, [
                'name' => 'required|max:255'
            ]);

        $category = new Category;

        $category->name = $request->name;

        $category->save();

        Session::flash('success', 'New Category \'' . $category->name . '\' Has Been Created.');

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);

        return view('categories.show')
                    ->withCategory($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);

        return view('categories.edit')
                    ->withCategory($category);
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
        // Find the Category in the DB
        $category = Category::find($id);

        // Validate the Request
        $this->validate($request, [
               'name' => 'required|max:255'
            ]);

        // Assign Category to object instance
        $category->name = $request->name;

        // Save to DB
        $category->save();

        // Flash Session Message
        Session::flash('success', 'Updated the Category');

        // Redirect to Category Show
        return redirect()->route('categories.show', $category->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        Session::flash('success', 'Deleted the Category');

        return redirect()->route('categories.index');
    }
}
