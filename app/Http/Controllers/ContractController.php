<?php

namespace App\Http\Controllers;
use App\Models\Contract;
use App\Models\Post;
use App\Models\TypeContracts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            foreach ($contracts as $contract) {
                $contract->salary = "$".number_format($contract->salary,2,".",",");
            }
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
            $users = User::orderby('name')->get();
            $posts = Post::orderby('name')->get();
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
            'id_users' => 'required|exists:users,id',
            'id_posts' => 'required|exists:posts,id',
            'start' => 'required|date|after_or_equal:1990-01-01|before_or_equal:2100-01-01',
            'end' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    if (!empty($value) && $value < $request->input('start')) {
                        $fail('la fecha de fin del contrato no puede ser menor o igual a la de inicio');
                    }
                },
            ],
            'salary' => 'required|numeric',
            'id_type_contracts' => 'required|exists:type_contracts,id'
        ], [
            'id_users.required' => 'Seleccione un usuario',
            'id_posts.required' => 'Seleccione un cargo',
            'start.date' => 'Por favor seleccione la fecha de inicio del contrato',
            'start.required' => 'Por favor seleccione la fecha de inicio del contrato',
            'end.date' => 'Por favor seleccione la fecha de fin del contrato',
            'end.date' => 'la fecha de fin del contrato no puede ser menor o igual a la de inicio',
            'salary.required' => 'Por favor digite el salario del contrato',
            'salary.numeric' => 'Por favor digite solo números',
            'id_type_contracts.required' => 'Seleccione un tipo de contrato',
            'start.after_or_equal' => 'La fecha minima es: 1990-01-01',
            'start.before_or_equal' => 'La fecha maxima es: 2100-01-01'
        ]);
        
        try {
            // Validar si el usuario ya tiene un contrato
        $existingContract = Contract::where('id_users', $request->id_users)->where('status', 1)->first();
        if ($existingContract) {
            // El usuario ya tiene un contrato
                $request;
                return view('contracts.modal',compact('request'));
        }else{
                $contracts = new Contract();
                $date = date('Y-m-d');
                $status = ($request->end < $date) ? 1 : 0;
                $contracts->id_users = $request->id_users;
                $contracts->start = $request->start;
                $contracts->end = $request->end;
                $contracts->salary = $request->salary;
                $contracts->id_posts = $request->id_posts;
                $contracts->id_type_contracts = $request->id_type_contracts;
                $contracts->status = $status;
                $contracts->save();
                return redirect(route('contracts.index'));
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
        if($request->opc == 1){
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
            } catch (\Throwable $th) {
                $error = array();
                $error['tittle'] = "Error";
                $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
                return view('errors.error', compact('error'));
            }
        }else{
            try {
                $contract = DB::table("contracts")->where('id_users','=',$request->id_users)->where('status','=','1')->first();
                $contract = Contract::find($contract->id);
                $contract->status = 0;
                $contract->end = date('Y-m-d');
                $contract->save();
                $contracts = new Contract();
                $contracts->id_users = $request->id_users;
                $contracts->start = $request->start;
                $contracts->end = $request->end;
                $contracts->salary = $request->salary;
                $contracts->id_posts = $request->id_posts;
                $contracts->id_type_contracts = $request->id_type_contracts;
                $date = date('Y-m-d');
                $status = ($request->end < $date) ? 1 : 0;
                $contracts->status = $status;
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
            $posts = Post::orderby('name')->get();
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
            'id_users' => 'required|exists:users,id',
            'id_posts' => 'required|exists:posts,id',
            'start' => 'required|date|after_or_equal:1990-01-01|before_or_equal:2100-01-01',
            'end' => [
                'nullable',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $start = $request->input('start');
                    if (!empty($value) && !empty($start)) {
                        if (strtotime($value) < strtotime($start)) {
                            $fail('La fecha de fin debe ser posterior o igual a la fecha de inicio.');
                        }
                    }
                },
            ],
            'salary' => 'required|numeric',
            'id_type_contracts' => 'required|exists:type_contracts,id'
        ],[
            'id_users.required' => 'Por favor seleccione un usuario',
            'id_posts.required' => 'Por favor seleccione un post',
            'start.required' => 'Por favor seleccione la fecha de inicio del contrato',
            'end.date' => 'Por favor seleccione una fecha válida para el fin del contrato',
            'salary.required' => 'Por favor digite el salario del contrato',
            'salary.numeric' => 'Por favor digite solo números para el salario',
            'id_type_contracts.required' => 'Por favor seleccione un tipo de contrato',
            'id_type_contracts.exists' => 'El tipo de contrato seleccionado no es válido',
            'start.after_or_equal' => 'La fecha minima es: 1990-01-01',
            'start.before_or_equal' => 'La fecha maxima es: 2100-01-01'
        ]);
        try {
            $contracts = Contract::find($id);
            if($contracts->status == 0){
                $error = array();
                $error['tittle'] = "Error";
                $error['message'] = "El contrato que intentas modificar esta inactivo"; 
                return view('errors.error', compact('error'));
            }else{
                $valDate = (now()->format('Y-m-d') < $request->end) ? 1 : 0 ;
                $contracts->start = $request->start;
                $contracts->end = $request->end;
                $contracts->salary = $request->salary;
                $contracts->id_posts = $request->id_posts;
                $contracts->id_type_contracts = $request->id_type_contracts;
                $contracts->status = $valDate;
                $contracts->save();
                return redirect(route('contracts.index'));
            }
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
            $actYdes = ($contracts->status == 0) ? 1 : 0;
            $contracts->status = $actYdes;
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
