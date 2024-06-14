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
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
        return redirect(route('home'));
        
    }
    public function create()
    {
        //
    }
    public function show($id)
    {
        try {
            $user = Auth::user();
            return view('users.admins.show', compact('users'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error regrese a la anterior pantalla"; 
            return view('errors.error', compact('error'));
        }
        
    }
    public function edit($id)
    {
        // try {
            $user = User::find($id);
            $roles = Role::all();
            $documents = Document::all();
            return view('users.admins.edit', compact('user','roles','documents'));
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
    public function update(Request $request, $id)
    {
            $val = DB::select("SELECT * FROM users WHERE document = '$request->document'");
            $rule = ($request->type_document == 5) ? "required|min:4|max:15" : 'required|numeric|digits_between:4,15' ;
            $document = ltrim($request->document, '0');
            if (strlen($document)<4) {
                $error = array();
                $error['tittle'] = "Documento invalido";
                $error['message'] = "el documento debe ser minimo de 4 caracteres"; 
                return view('errors.error', compact('error'));
            }
            if (empty($val)) {
                $request->validate([
                    'document' => $rule,
                    'name' => 'required|min:2|max:100|regex:/^[a-zA-ZÁÉÍÓÚÜáéíóúü\s]+$/',
                ],[
                    'document.required' => 'Se requiere número de documento',
                    'document.min' => 'Caracteres mínimos:4',
                    'document.max' => 'Caracteres máximos:15',
                    'name.min' => 'Caracteres mínimos:2',
                    'name.max' => 'Caracteres máximos:100',
                    'name.required' => 'Se requiere nombre',
                    'role.in' => 'Se requiere rol',
                ]);
                $user = User::find($id);
                $user->name = $request->name;
                $user->document = $document;
                $user->id_roles = $request->role;
                $user->save();
            }elseif($val[0]->id == $id) {
                $request->validate([
                    'document' => $rule,
                    'name' => 'required|min:2|max:100|regex:/^[a-zA-ZÁÉÍÓÚÜáéíóúü\s]+$/',
                ],[
                    'document.required' => 'Se requiere número de documento',
                    'document.min' => 'Caracteres mínimos:4',
                    'document.max' => 'Caracteres máximos:15',
                    'name.min' => 'Caracteres mínimos:2',
                    'name.max' => 'Caracteres máximos:100',
                    'name.required' => 'Se requiere nombre',
                    'name.regex' => 'El nombre contiene caracteres invalidos',
                    'role.in' => 'Se requiere rol',
                ]);
                $user = User::find($id);
                $user->name = $request->name;                
                $user->document = $document;
                $user->id_roles = $request->role;
                $user->save();
            }else{
                $error = array();
                $error['tittle'] = "Documento existente";
                $error['message'] = "Estas intentado usar el documento de un usuario existente"; 
                return view('errors.error', compact('error'));
            }
            return redirect(route('users.index'));
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
        // try {
        $user = Auth::user();
        if ($user == null) {
            $errors = array();
            $errors ['name'] = "Sin permisos";
            $errors ['des'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
            return view('error', compact('errors'));
        }
        if ($user->id_roles == 2) {
            $certificate = Certificates::orderBy('download_date', 'desc')->take(100)->get();
            return view('users.admins.histories', compact('certificate'));
        }else{
            //agregar el error de permisos
            $errors = array();
            $errors ['tittle'] = "Sin permisos";
            $errors ['message'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
            return view('error', compact('errors'));
        }
        // } catch (\Exception $e) {
        //     $error = array();
        //     $error ['tittle'] = "opss lo siento regrese a la vista anterior";
        //     $error ['message'] = "La vista anterior";
        //     return view('errors.error', compact('error'));
        // }
        

    }

    public function certificates($id)
    {
        try {
            $contract = Contract::find($id);
            if (Auth::user()->id_roles != 2) {
                if ($contract->id_users != Auth::id()) {
                    $error = array();
                    $error ['tittle'] = "Sin permisos";
                    $error ['message'] = "Vuelva a la pagina anterior debido a que no posee los permisos necesarios";
                    return view('errors.error', compact('error'));
                }
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
INNER JOIN users ON certificates.id_users = users.id 
ORDER BY certificates.download_date DESC
LIMIT 100;
");

        return view('users.admins.export', compact('data'));
    }
    
}
