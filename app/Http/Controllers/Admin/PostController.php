<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Auth;
use Session;

class PostController extends Controller
{

    //__construct
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user()->id);
        //$this->authorize('showdata');
        /*if(Gate::allows('showdata',auth()->user()))
        {*/
        $this->authorize('checkme',Post::class);
        $posts = Post::orderBy('created_at', 'desc')->paginate(30);


          return view('admin.posts.index',compact('posts'));
        /*}
        else{
          abort(403);
        }*/

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
         'image'=> 'image',
         'body'=>'required'
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
    public function store(Post $post)
    {
      if(request('image')){
        request('image')->storeAs('images', request('image')->getClientOriginalName());
        $attributes['image']=request('image')->getClientOriginalName();
      }
      $attributes = $this->validateattributes();
      $attributes['user_id']=Auth::user()->id;

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

        //$this->authorize('delete', $post);
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
