<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        // $posts = Post::get();
        // dd($posts);
        // if ($request->user()->can('view', $post)) {
            $post = Post::paginate(5);
            return view('posts.index', compact('post'))->with('i',(request() -> input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Post $post){
        if ($request->user()->cannot('create', $post)) {
            abort(403);
        }else{
            return view('posts.create');
        }
      
    }

    /**y
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post,$id)
    {
        if ($request->user()->cannot('update', $post)) {
            abort(403);
        }
        $post = Post::find($id);
        return view('posts.edit',compact('post'));
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
        $post = Post::where('id',$id)->update([
            'title' => $request->get('title'),
            'content' => $request->get('content')
        ]);
        if($post){
            return redirect()->route('posts.index');
        }else{
            return false;
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Post $post,$id)
    {   
        if ($request->user()->cannot('delete', $post)) {
            abort(403);
        }
        Post::destroy($id);
        return redirect()->route('posts.index');
    }

}


