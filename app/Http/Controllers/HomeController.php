<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Certificates;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Validation\Rules\Password;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try {
            $user = Auth::user();
        if ($user->id_roles == 2) {
            return view('users.admins.index');
        }else{
            if ($user->document != "0"){
                return redirect(route('select_contract'));
            }
            else{
                return redirect(route('users.edit',$user->id));
            }
        }
        } catch (\Throwable $th) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error regrese a la anterior pantalla"; 
            return view('errors.error', compact('error'));
        }
    }

    public function edit(){
        $user = User::find(Auth::id());
        return view('users.edit_password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&.+])[A-Za-z\d@$!%*?&.+]{8,20}$/'],
            'new_password' => ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&.+])[A-Za-z\d@$!%*?&.+]{8,20}$/'],
            'password_confirmation' => ['required', 'same:new_password'],
        ], [
            'password.required' => "Contraseña requerida",
            'password.regex' => "La contraseña debe tener al menos 8 caracteres, incluyendo al menos una letra, un número y un caracter especial entre estos: (@$!%*?&.)",
            'new_password.required' => "Contraseña requerida",
            'new_password.regex' => "La contraseña debe tener al menos 8 caracteres, incluyendo al menos una letra, un número y un caracter especial entre estos: (@$!%*?&.)",
            'password_confirmation.required' => "Contraseña requerida",
            'password_confirmation.same' => "Las contraseñas no coinciden",
        ]);
        
        $user = Auth::id();
        $user = User::find($user);

        // Verificar que la contraseña actual sea válida
        if (password_verify($request->password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->save();
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('login')->with('success', 'Contraseña cambiada exitosamente. Por favor, inicie sesión con su nueva contraseña.');
        }else{
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Contraseña actual no coinciden."; 
            return view('errors.error', compact('error'));
        }
    }

    public static function generateWord(Request $request, $id) {
            $meses_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $meses_es = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
            $month = date('F');
            $month_es = str_replace($meses_en, $meses_es, $month);
            $date_create =" (".(date('d')).") días del mes de ($month_es) de ".(date('Y'))."";
            $hoy = date('Y-m-d');
            $contract = Contract::find($id);
            $user = User::find($contract->id_users);
            $templete = new TemplateProcessor('document.docx');
            $templete->setValue('name', $user->name);
            $templete->setValue('type_document', $user->documents->type);
            $templete->setValue('document', $user->document);
            $templete->setValue('post', $contract->posts->name);
            $templete->setValue('date_create', $date_create);
            if($request->contract == "on"){
                $templete->setValue('type_contract', "Mediante un contrato a ".$contract->typeContracts->type_contract.".");
            }else{
                $templete->setValue('type_contract', "");
            }
            if($request->date_i == "on"){
                $msg = "";
                if ($hoy > $contract->end && $contract->end !== null) {
                    $msg = "Desde el ".$contract->start. " hasta el ". $contract->end;
                }else{
                    $msg = "Actualmente vigente desde el ".$contract->start;
                    if ($contract->end != null) {
                    $msg = $msg. " hasta el ". $contract->end;
                    }
                }
                $templete->setValue('start', $msg);
            }else{
                $templete->setValue('start', "");
            }
            if($request->salary == "on"){
                $templete->setValue('salary', "devengando un salario de $ ".$contract->salary.".");
            }else{
                $templete->setValue('salary', "");
            }
            $templete->setValue('date', "(".$hoy.")");
            $templete->saveAs('Certificado Laboral.docx');
            response()->download(storage_path('document.docx'))->deleteFileAfterSend(false);
            return response()->download('Certificado Laboral.docx')->deleteFileAfterSend(false);
            }

    function select_contract() {
        $user = Auth::user();
        $contracts = DB::table('contracts')->where('id_users','=',$user->id)->get();
        $data = array();
        foreach ($contracts as $contract) {
            $contract = Contract::find($contract->id);
            array_push($data,$contract);
        }
        return view('contracts', compact('data'));
    }

    function select_contracts($id) {;
        $contracts = DB::table('contracts')->where('id_users','=',$id)->get();
        $data = array();
        foreach ($contracts as $contract) {
            $contract = Contract::find($contract->id);
            array_push($data,$contract);
        }
        return view('contracts', compact('data'));
    }

}
