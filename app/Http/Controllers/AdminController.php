<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Document;
use App\Models\Contract;
use App\Models\Certificates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
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
        return redirect(route('home'));
        
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $user = Auth::user();
            if ($user->id_roles != 2) {
                return redirect(route('users.index'));
            }
            return view('users.admins.show', compact('users'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error regrese a la anterior pantalla"; 
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
        try {
            $user = User::find($id);
            $roles = Role::all();
            return view('users.admins.edit', compact('user','roles'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'doc' => 'required|min:4|max:15',
                'name' => 'required|min:2|max:100',
            ],[
                'doc.required' => 'Se requiere número de documento',
                'doc.min' => 'Caracteres mínimos:4',
                'doc.max' => 'Caracteres máximos:15',
                'name.min' => 'Caracteres mínimos:2',
                'name.max' => 'Caracteres máximos:100',
                'name.required' => 'Se requiere nombre',
                'role.in' => 'Se requiere rol',
            ]);
    
            $user = User::find($id);
            $user->name = $request->name;
            $user->document = $request->doc;
            $user->id_roles = $request->role;
            $user->save();
    
            return redirect(route('users.index'));
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

    public function histories()
    {
        try {
        $user = Auth::user();
        if ($user == null) {
            $errors = array();
            $errors ['name'] = "Sin permisos";
            $errors ['des'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
            return view('error', compact('errors'));
        }
        if ($user->id_roles == 2) {
            $certificate = Certificates::all();
            return view('users.admins.histories', compact('certificate'));
        }else{
            //agregar el error de permisos
            $errors = array();
            $errors ['name'] = "Sin permisos";
            $errors ['des'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
            return view('error', compact('errors'));
        }
        } catch (\Exception $e) {
            $error = array();
            $error ['des'] = "opss lo siento regrese a la vista anterior";
            $error ['name'] = "La vista anterior";
            return view('errors.error', compact('error'));
        }
        

    }

    public function certificates($id)
    {
        try {
            $users = Auth::user();
            if ($users == null) {
                $errors = array();
                $errors ['name'] = "Sin permisos";
                $errors ['des'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
                return view('error', compact('errors'));
            }
            return view('users.admins.certificates', compact('id'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
        
    }

    public function show_users()
    {
        
        

    }

    public function export()
    {
        $data = DB::select("SELECT certificates.download_date, certificates.download_hour, users.name 
        FROM certificates
        INNER JOIN users ON certificates.id_users = users.id");
        // return $data;

        return view('users.admins.export', compact('data'));
    }
    
}
