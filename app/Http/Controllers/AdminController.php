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
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }else{
            return view('users.admins.index');
        }
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
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }
        return view('users.admins.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.admins.edit', compact('user','roles'));
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
        $users = User::all();
        $roles = Role::all();
        $certificate = Certificates::all();
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }
        return view('users.admins.histories', compact('users','roles','certificate')); 

    }

    public function certificates($id)
    {
        $users = DB::table('users')->where('id', $id)->first();
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }
        return view('users.admins.certificates', compact('users'));
    }

    public function show_users()
    {
        $users = User::all();
        $roles = Role::all();
        $user = Auth::user();
        if ($user->id_roles != 2) {
            return redirect(route('users.index'));
        }
        
        return view('users.admins.show_users', compact('users','roles'));

    }
    
}
