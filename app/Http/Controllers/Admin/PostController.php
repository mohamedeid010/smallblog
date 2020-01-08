<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use Session;
use Illuminate\Http\UploadedFile;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(30);
        return view('admin.posts.index',compact('posts'));
    }

    /**
     *
     * vaidations
     *@return \Illuminate\Http\Response
     */
     public function validateattributes()
     {
       return Request()->validate([
         'title' => 'required|max:200|min:5',
       ]);
     }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,Post $post)
    {

      request('image')->storeAs('images', request('image')->getClientOriginalName());
      //request('image')->store('image');
      $attributes = $this->validateattributes();
      $attributes['body']=request('content');
      $attributes['user_id']=Auth::user()->id;
      $attributes['image']=request('image')->getClientOriginalName();

      //$attributes['user_id']=$request->logo->store('logos');
        $post::create($attributes);
        Session::flash('message','New Post saved Succefuly');
        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.view',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.update',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post)
    {
      $attributes = $this->validateattributes();
      $attributes['body']=request('content');
      $attributes['user_id']=Auth::user()->id;
        $post->update($attributes);
        Session::flash('message','Post updated Succefuly');
        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Session::flash('message','Post Deleted Succefuly');
        return redirect('/posts');
    }
}
