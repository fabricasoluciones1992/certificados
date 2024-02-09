<?php

namespace App\Http\Controllers;
use App\Models\Contract;
use App\Models\Post;
use App\Models\TypeContracts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $contracts = Contract::all();
            return view('contracts.index', compact('contracts'));
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
    public function create()
    {
        try {
            $contracts = Contract::all();
            $typeContracts = TypeContracts::all();
            $users = User::all();
            $posts = Post::all();
            return view('contracts.create', compact('contracts','typeContracts','users','posts'));
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
        $request->validate([
            'id_users'=>'required',
            'id_posts'=>'required',
            'start'=>'date',
            'salary'=>'required|numeric',
            'id_type_contracts'=>'required'
        ],[
            'id_users.required'=>'Seleccione un usuario',
            'id_posts.required'=>'Seleccione un cargo',
            'start.date'=>'Por favor seleccione la fecha de inicio del contrato',
            'end.date'=>'Por favor seleccione la fecha de fin del contrato',
            'salary.required'=>'Por favor digite el salario del contrato',
            'salary.numeric'=>'Por favor digite solo números',
            'id_type_contracts.required'=>'Seleccione un cargo'
        ]);
        try {
            // Validar si el usuario ya tiene un contrato
        $existingContract = Contract::where('id_users', $request->id_users)->where('status', 1)->first();
        if ($existingContract) {
            // El usuario ya tiene un contrato
                $request;
                return view('contracts.modal',compact('request'));
        }else{
            try {
                $contracts = new Contract();
                $contracts->id_users = $request->id_users;
                $contracts->start = $request->start;
                $contracts->end = $request->end;
                $contracts->salary = $request->salary;
                $contracts->id_posts = $request->id_posts;
                $contracts->id_type_contracts = $request->id_type_contracts;
                $contracts->status = 1;
                $contracts->save();
                return redirect(route('contracts.index'));
                } catch (\Exception $e) {
                return redirect(route('contracts.index'));
                }
            }
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }

    }
    public function create2(Request $request)
    {
        $id = $request->id_users;
        if($request->opc == 1){
            try {
                try {
                    $contracts = new Contract();
                    $contracts->id_users = $request->id_users;
                    $contracts->start = $request->start;
                    $contracts->end = $request->end;
                    $contracts->salary = $request->salary;
                    $contracts->id_posts = $request->id_posts;
                    $contracts->id_type_contracts = $request->id_type_contracts;
                    $contracts->status = 0;
                    $contracts->save();
                    return redirect(route('contracts.index'));
                    } catch (\Exception $e) {
                    return redirect(route('contracts.index'));
                    }
            } catch (\Throwable $th) {
                $error = array();
                $error['tittle'] = "Error";
                $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
                return view('errors.error', compact('error'));
            }
        }else{
            // try {
                //el error esta en que confunde el id del request que deberia ser el id del usuario con el id de campo de la tabla 
                $contracts = Contract::findOrFail($request->id_users);
                $contracts->status = 0;
                $contracts->save();
                $contracts = new Contract();
                $contracts->id_users = $request->id_users;
                $contracts->start = $request->start;
                $contracts->end = $request->end;
                $contracts->salary = $request->salary;
                $contracts->id_posts = $request->id_posts;
                $contracts->id_type_contracts = $request->id_type_contracts;
                $contracts->status = 1;
                $contracts->save();
                return redirect(route('contracts.index'));
            // } catch (\Throwable $th) {
            //     $error = array();
            //     $error['tittle'] = "Error";
            //     $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            //     return view('errors.error', compact('error'));
            // }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $contracts = Contract::find($id);
        // return view('contratos.show', compact('contracts'));
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
            $contracts = Contract::find($id);
            $users = User::find($contracts->id_users);
            $posts = Post::all();
            $typeContracts = TypeContracts::all();
            return view('contracts.edit', compact('contracts','users','posts','typeContracts'));
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
        $request->validate([
            'start'=>'date',
            'end'=>'date',
            'salary'=>'required|numeric',
            'id_type_contracts'=>'in:1,2,3,4'
        ],[
            'start.date'=>'Por favor seleccione la fecha de inicio del contrato',
            'end.date'=>'Por favor seleccione la fecha de fin del contrato',
            'salary.required'=>'Por favor digite el salario del contrato',
            'salary.numeric'=>'Por favor digite solo números',
            'id_type_contracts.in'=>'Seleccione un cargo'
        ]);
        try {
            $contracts = Contract::find($id);
            $contracts->start = $request->start;
            $contracts->end = $request->end;
            $contracts->salary = $request->salary;
            $contracts->id_posts = $request->id_posts;
            $contracts->id_type_contracts = $request->id_type_contracts;
            $contracts->status = 1;
            $contracts->save();
            return redirect(route('contracts.index'));
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
        try {
            $contracts = Contract::find($id);
            $contracts->end = Carbon::now();
            $contracts->status = 0;
            $contracts->save();
            return redirect(route('contracts.index'));
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
            return view('errors.error', compact('error'));
        }
    }
}
