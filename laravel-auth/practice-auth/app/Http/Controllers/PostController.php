<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $posts = Post::get();
        // dd($posts);
        if(Gate::allows('posts-index')){
            $post = Post::paginate(5);
            return view('posts.index', compact('post'))->with('i',(request() -> input('page',1)-1)*5);
        }else{
            return view('authen-view');
        }
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::allows('posts-create')){
            
            return view('posts.create');
        }else{
            return view('authen-view');
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
        return redirect()->route('posts.index');
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
    public function edit($id)
    {
        if(Gate::allows('posts-edit')){
            $post = Post::find($id);
            return view('posts.edit',compact('post'));
        }else{
            return view('authen-view');
        }
        
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
    public function destroy($id)
    {   
        if(Gate::allows('posts-delete')){
            Post::destroy($id);
            return redirect()->route('posts.index');
        }else{
            return view('authen-view');
        }
        
    }

}


