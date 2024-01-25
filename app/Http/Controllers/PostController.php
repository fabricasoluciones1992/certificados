<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth');
     }
    public function index()
    {
        try {
            $posts = Post::all();
            return view('posts.index', compact('posts'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $areas = Area::all();
            return view('posts.create', compact('areas'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $post = Post::create($request->all());
            return redirect(route('posts.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post)
    {
        try {
            $post = Post::find($post);
            return view('posts.show', compact('post'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post)
    {
        try {
            $post = Post::find($post);
            $areas = Area::all();
            return view('posts.edit', compact('post', 'areas'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post)
    {
        try {
            $post = Post::find($post);
            $post->name = $request->name;
            $post->save();
            return redirect(route('posts.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post)
    {
        try {
            $post = Post::find($post);
            $post->destroy($post);
            return redirect(route('posts.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }
}
