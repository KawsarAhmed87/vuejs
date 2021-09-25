<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $categories = Category::with('Posts')->get();
        // return $categories;
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ], 200);

    }
    public function activeCategoriesList()
    {
        // $categories = Category::with('Posts')->get();
        // return $categories;
        $categories = Category::where('status', 1)->get();
        return response()->json([
            'categories' => $categories,
        ], 200);

    }


    public function activeTopCategoriesList(){
        $categories = Category::where('status', 1)->get();
        return response()->json([
            'categories' => $categories,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'status' => 'required',

        ]);

        Category::create([
            'name' => $request->name,
            'slug' => slugify($request->name), //app/helpers/functions.php->slugify()
            'status' => $request->status,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $category = Category::where('slug', $slug)->first();

        return response()->json(['category' => $category], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $this->validate($request, [
            'name' => 'required|min:5|max:100',
            'status' => 'required',

        ]);

        $category = Category::where('slug', $slug)->first();

        $category->name = $request->name;
        $category->slug = slugify($request->name);
        $category->status = $request->status;

        $category->save();
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
    }

    public function bulkDelete(Request $request)
    {
        foreach ($request->dataSelect as $data) {
            $category = Category::find($data);
            $category->delete();
        }
    }

    public function changeBulkStatus(Request $request)
    {
        foreach ($request->dataSelect as $data) {
            $category = Category::find($data);
            $category->status = $request->statusInfo;
            $category->save();
        }
    }
}
