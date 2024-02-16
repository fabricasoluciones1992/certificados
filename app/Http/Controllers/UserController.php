<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function __construct()
     {
         $this->middleware('auth');
     }

     public function index()
    {
        $user = Auth::user();
        if ($user->id_roles == 2) {
            $users = User::all();
            return view('users.admins.show_users', compact('users'));
        }else{
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $user = User::find(Auth::id());
            return view('users.show', compact('user'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // try {
            $users = User::find(Auth::id());
            $documents = Document::all();
            return view('users.edit', compact('users','documents'));
        // } catch (\Throwable $th) {
        //     $error = array();
        //     $error['tittle'] = "Error";
        //     $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
        //     return view('errors.error', compact('error'));
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $request->validate([
                'doc' => 'required|min:4|max:15',
                'type' => 'required|in:2,3,4,5',
            ],[
                'doc.required' => 'Se requiere número de documento',
                'type.in' => 'Se requiere tipo de documento',
                'doc.min' => 'Caracteres mínimos:4',
                'doc.max' => 'Caracteres máximos:15',
            ]);
    
            $user = User::find(Auth::id());
            $user->id_documents = $request->type;
            $user->document = $request->doc; 
            $user->save();
    
            return redirect(route('home'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
