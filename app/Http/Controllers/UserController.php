<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
        $val = DB::select("SELECT * FROM users WHERE document = '$request->doc'");
        if (empty($val) || $val[0]->id == $request->id_users) {
            $rule = ($request->type == "5") ? "required|min:4|max:15" : 'required|numeric|digits_between:4,15' ;
            $request->validate([
                'doc' => $rule,
                'type' => 'required|'.Rule::notIn(['1']),
            ],[
                'doc.required' => 'Se requiere número de documento',
                'type.not_in' => 'Se requiere tipo de documento',
                'doc.min' => 'Caracteres mínimos:4',
                'doc.max' => 'Caracteres máximos:15',
                'doc.numeric' => 'El documento debe ser de tipo numerico',
                'doc.digits_between' => 'El documento debe tener entre 4 y 15 caracteres'
            ]);

            $doc = ltrim($request->doc, '0');
            $user = User::find(Auth::id());
            $user->id_documents = $request->type;
            $user->document = $doc; 
            $user->save();
    
            return redirect(route('home'));
        }else{
            $error = array();
            $error['tittle'] = "Documento existente";
            $error['message'] = "Estas intentado usar el documento de un usuario existente"; 
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
