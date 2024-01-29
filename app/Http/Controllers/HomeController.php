<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use App\Models\Certificates;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpWord\TemplateProcessor;

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
                return view('home');
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
    public function generateWord() {
        try {
            $user = Auth::user();
            $contract = DB::table('contracts')->where('id_users', '=', $user->id)->where('status','=',1)->first();
            if ($contract == null) {
                return "El usuario no tiene contrato activo actualmente";
            }else{
            $contract = Contract::find($contract->id);
            $templete = new TemplateProcessor('document.docx');
            $templete->setValue('name', $user->name);
            $templete->setValue('type_document', $user->documents->type);
            $templete->setValue('document', $user->document);
            $templete->setValue('type_contract', $contract->typeContracts->type_contract);
            $templete->setValue('post', $contract->posts->name);
            $templete->setValue('start', $contract->start);
            $templete->setValue('salary', $contract->salary);
            $templete->saveAs($user->name.'.docx');
            response()->download(storage_path('document.docx'))->deleteFileAfterSend(false);
            return response()->download($user->name.'.docx')->deleteFileAfterSend(false);
            }
        } catch (\PhpOffice\PhpWord\Exception\Exception $e) {
            $error = array();
            $error['tittle'] = "Error";
            $error['message'] = "Opss se presento un error regrese a la anterior vista"; 
            return view('errors.error', compact('error'));        }
    }

}
