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
            return redirect(route('areas.index'));
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
        // Validación para crear un cargo
        $request->validate([
            'name' =>'required|min:1|max:60|regex:/^[A-Z]+$/u',
            'id_areas' =>'required|numeric',
        ],[
            'name.required' => 'El nombre del cargo es requerido.',
            'name.min' => 'El cargo debe tener al menos 1 caracter.',
            'name.max' => 'El cargo no debe tener más de 60 caracteres.',
            'name.regex' => 'Solo se puede agregar el nombre en mayusculas, sin numeros ni caracteres especiales.',
            'id_areas.numeric' => 'El campo area es requerido.',
        ]);

        try {
            $post = Post::create($request->all());
            return redirect(route('areas.index'));
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
        $request->validate([
            'name' =>'required|min:1|max:60',
            'id_areas' =>'required',
        ],[
            'name.required' => 'Este campo es requerido.',
            'name.min' => 'El cargo debe tener al menos 1 caracter.',
            'name.max' => 'El cargo no debe tener más de 60 caracteres.',
            'id_areas.required' => 'El campo area es requerido.',
        ]);

        try {
            $post = Post::find($post);
            $post->name = $request->name;
            $post->id_areas = $request->id_areas;
            $post->save();
            return redirect(route('areas.index'));
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
            return redirect(route('areas.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }
}
