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
        // switch ($user->id_roles) {
        //     case '2':
        //         $user = DB::table('people')->where('id_users','=',$user->id)->first();
        //         $user = People::find($user->id);
        //         return view('users.admins.index', compact('people'));
        //         break;
        //     case '1':
        //             return redirect(route('people.edit',$user->id));
        //             if ($user->id_contracts == '1'){
        //                 return view('home');
        //             }
        //             else{
        //                 return redirect(route('users.index', compact('people')));
        //             }
        //     break;
        //     default:
        //     return view('users.index');
        //     break;
        // }
    }
    public function historial()
    {
        return view('historial');
    }

    public function error()
    {
        return view('auth.error');
    }
    // public function generateWord($request, $id){
    //     $meses_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    //     $meses_es = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        
    //     $month = date('F');
    //     $month_es = str_replace($meses_en, $meses_es, $month);

    //     function convertNumberToWords($number)
    //     {
    //         $units = [
    //             '', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez',
    //             'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'
    //         ];
        
    //         $tens = [
    //             '', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'
    //         ];
        
    //         $hundreds = [
    //             '', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos',
    //             'setecientos', 'ochocientos', 'novecientos'
    //         ];
        
    //         if ($number == 0) {
    //             return 'cero';
    //         }
        
    //         if ($number < 0) {
    //             return 'menos ' . convertNumberToWords(abs($number));
    //         }
        
    //         $words = '';
        
    //         if (($number / 1000000) >= 1) {
    //             $words .= convertNumberToWords((int)($number / 1000000)) . ' millón ';
    //             $number %= 1000000;
    //         }
        
    //         if (($number / 1000) >= 1) {
    //             $words .= convertNumberToWords((int)($number / 1000)) . ' mil ';
    //             $number %= 1000;
    //         }
        
    //         if (($number / 100) >= 1) {
    //             $words .= $hundreds[(int)($number / 100)] . ' ';
    //             $number %= 100;
    //         }
        
    //         if ($number >= 20) {
    //             $words .= $tens[(int)($number / 10)] . ' ';
    //             $number %= 10;
    //         }
        
    //         if ($number > 0) {
    //             $words .= $units[$number] . ' ';
    //         }
            
    //         return trim($words);
        
    //     }


    //     $user = User::find($id);
    //     $contract = DB::table('contracts')->where('id_users', '=', $user->id)->where('status','=',1)->first();
    //         if ($contract == null) {
    //             return "El usuario no tiene contrato activo actualmente";
    //         }
    //     if($request->contract == "on" ){
    //         $contract = Contract::find($contract->id);
    //     }else{
    //         $contract = 0;
    //     }
    //     if($request->date_i == "on"){
    //         $date_i = $contract->start;
    //     }else{
    //         $date_i = 0;
    //     }
    //     if($request->salary == "on"){
    //         $salary = $contract->salary;
    //         $salary = convertNumberToWords($salary);
    //     }else{
    //         $salary = 0;
    //     }

    //         $name = $user->name;
    //         $day = date('d');
    //         $month = $month_es;
    //         $year = date('Y');

    //     $certificate = new Certificates();
    //     date_default_timezone_set("America/Bogota");
    //     $certificate->download_date = date("y.m.d"); 
    //     $certificate->download_hour = date("H:i:s"); 
    //     $certificate->id_users = Auth::user()->id;
    //     $confirmdate = $request->confirmdate;

    //     if(Auth::user()->id_roles == '2'){
    //         $certificate->save();
    //         return view('myWord',compact('user','name','day','month','year','contract','salary','date_i'));
    //     }else{

    //         if($confirmdate == $user->date){

    //             $certificate->save();
    //             return view('myWord');

    //         }else{
    //             return '<script language="javascript">alert("Fecha de expedición errónea");window.location.href="/home"</script>';
    //         }

    //     }

    // }

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
            return back($e->getCode());
        }
    }

}
