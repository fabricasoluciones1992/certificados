<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AreaController extends Controller
{
    public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        try {
            $areas = Area::orderby('name')->get();
            $posts = Post::orderby('name')->get();
         $user = Auth::user();
            if ($user->id_roles != 2) {
                return redirect(route('users.index'));
            }else{
                return view('areas.index', compact('areas','posts'));
            }
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
        
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {

       $request->validate([
        'name' =>'required|min:1|max:60|regex:/^[A-ZÑÁÉÍÓÚÜ\s]+$/u',
        ],[
        'name.required' => 'El nombre del área es requerido.',
        'name.min' => 'El área debe tener al menos 1 caracter.',
        'name.max' => 'El área no debe tener más de 60 caracteres.',
        'name.regex' => 'Solo se puede agregar el nombre en mayusculas, sin numeros ni caracteres especiales.'
        ]);

        try {
            $area = Area::create($request->all());
            return redirect(route('areas.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
        
    }

    public function show($post)
    {
        try {
            $area = Area::find($post);
            return view('areas.show', compact('area'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
        
    }

    public function edit($post)
    {
        try {
            $area = Area::find($post);
            return view('areas.edit', compact('area'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
        
    }

    public function update(Request $request, $post)
    {
        $request->validate([
            'name' =>'required|min:1|max:60|regex:/^[A-ZÑÁÉÍÓÚÜ\s]+$/u',
        ],[
            'name.required' => 'El nombre del área es requerido.',
            'name.min' => 'El área debe tener al menos 1 caracter.',
            'name.max' => 'El área no debe tener más de 60 caracteres.',
        ]);

        try {
            $area = Area::find($post);
            $area->name = $request->name;
            $area->save();
            return redirect(route('areas.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }

}
