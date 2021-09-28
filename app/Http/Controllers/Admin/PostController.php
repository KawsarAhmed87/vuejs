<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::with("category", "user")
                ->orderBy('id', "DESC")
                ->get();
        return response()->json([
            'posts' => $posts,
        ], 200);
    }

    public function getPostFront(){
        $posts = Post::with("category", "user")
                ->where("status", 'published')
                ->orderBy('id', "DESC")
                ->get();
        return response()->json([
            'posts' => $posts,
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

        $file = explode(';', $request->thumbnail);
        $file = explode('/', $file[0] );
        $file_exten = end($file); 
        $image = slugify($request->title).".".$file_exten;

        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',

        ]);

        $success = Post::create([
            'title' => $request->title,
            'user_id' => Auth()->user()->id,
            'category_id' => $request->category_id,
            'content' => $request->content,
            'thumbnail' => $image,
            'status' => $request->status,
        ]);

        if ($success) {

           Image::make($request->thumbnail)->resize(400, 200)->save(public_path('upload/posts/').$image);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return response()->json(['post' => $post], 200);
    }

    public function singlePost($id){
        $post = Post::with('user')->find($id);
        return response()->json(['post' => $post], 200);
    }

    public function postByCategory($id){

        $posts = Post::with('category','user')->where('category_id', $id)->get();
        return response()->json(['posts' => $posts], 200);
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
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'category_id' => 'required',
            'content' => 'required',
            'status' => 'required',

        ]);

        $post = Post::find($id);
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->content = $request->content;
        $post->status = $request->status;

        if ($request->thumbnail != $post->thumbnail) {

        $fileName = $post->thumbnail;

        if (file_exists(public_path('upload/posts/'.$fileName))) {
              unlink(public_path('upload/posts/'.$fileName));
            }

        $file = explode(';', $request->thumbnail);
        $file = explode('/', $file[0] );
        $file_exten = end($file); 
        $image = slugify($request->title).".".$file_exten;
        $post->thumbnail = $image;
        

        Image::make($request->thumbnail)->resize(400, 200)->save(public_path('upload/posts/').$image);

        }

        $post->save();



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $fileName = $post->thumbnail;
        if ($post->delete()) {
            if (file_exists(public_path('upload/posts/'.$fileName))) {
              unlink(public_path('upload/posts/'.$fileName));
            }
        }
        
    }

    public function bulkDelete(Request $request){
       foreach ($request->dataSelect as $data) {
         $post = Post::find($data);
         $fileName = $post->thumbnail;
        if ($post->delete()) {
            if (file_exists(public_path('upload/posts/'.$fileName))) {
              unlink(public_path('upload/posts/'.$fileName));
            }
        }

       }
    }

    public function changeBulkStatus(Request $request){
        foreach ($request->dataSelect as $data) {
            $post = Post::find($data);
            $post->status = $request->statusInfo;
            $post->save();
          }
    }
}
