<?php
  
namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\User;
use App\Models\Document;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
  
class PDFController extends Controller
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

    public static function generatePDF(Request $request, $id)
    {
        // try {
            $meses_en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            $meses_es = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
            $month = date('F');
            $month_es = str_replace($meses_en, $meses_es, $month);
    
            function convertNumberToWords($number)
            {
                $units = [
                    '', 'un', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho', 'nueve', 'diez',
                    'once', 'doce', 'trece', 'catorce', 'quince', 'dieciséis', 'diecisiete', 'dieciocho', 'diecinueve'
                ];
    
                $tens = [
                    '', '', 'veinte', 'treinta', 'cuarenta', 'cincuenta', 'sesenta', 'setenta', 'ochenta', 'noventa'
                ];
    
                $hundreds = [
                    '', 'ciento', 'doscientos', 'trescientos', 'cuatrocientos', 'quinientos', 'seiscientos',
                    'setecientos', 'ochocientos', 'novecientos'
                ];
    
                if ($number == 0) {
                    return 'cero';
                }
    
                if ($number < 0) {
                    return 'menos ' . convertNumberToWords(abs($number));
                }
    
                $words = '';
    
                if (($number / 1000000) >= 1) {
                    $words .= convertNumberToWords((int)($number / 1000000)) . ' millón ';
                    $number %= 1000000;
                }
    
                if (($number / 1000) >= 1) {
                    $words .= convertNumberToWords((int)($number / 1000)) . ' mil ';
                    $number %= 1000;
                }
    
                if (($number / 100) >= 1) {
                    $words .= $hundreds[(int)($number / 100)] . ' ';
                    $number %= 100;
                }
    
                if ($number >= 20) {
                    $words .= $tens[(int)($number / 10)] . ' ';
                    $number %= 10;
                }
    
                if ($number > 0) {
                    $words .= $units[$number] . ' ';
                }
    
                return trim($words);
    
            }
            $user = Auth::user();
            if($request->contract == "on" ){
                $contract = Contract::find($id);
            }else{
                $contract = 0;
            }
            if($request->date_i == "on"){
                $date_i = $contract->start;
            }else{
                $date_i = 0;
            }
            if($request->salary == "on"){
                $salary = $contract->salary;
                $salary = convertNumberToWords($salary);
            }else{
                $salary = 0;
            }
    
    
            $data = [
                'title' => 'CERTIFICA',
                'name' => $user->name,
                't_doc' => $user->documents->type,
                'contract' => $contract,
                'document' => $user->document,
                'id_roles' => $user->id_roles,
                'date_i' => $date_i,
                'salary' => $salary,
                'date_f' => $user->date_f,
                'onus' => $user->onus,
                'area' => $user->area,
                'day' => date('d'),
                'month' => $month_es,
                'year' => date('Y')
            ];
              
            $pdf = PDF::loadView('myPDF', $data);
        
    
            $certificate = new Certificates();
            date_default_timezone_set("America/Bogota");
            $certificate->download_date = date("y.m.d");
            $certificate->download_hour = date("H:i:s");
            $certificate->id_users = Auth::user()->id;
            $confirmdate = $request->confirmdate;
    
            if(Auth::user()->id_roles == '2'){
                $certificate->save();
                return $pdf->download('CertificadoLaboral.pdf');
            }else{
    
                if($confirmdate == $user->date){
                    
                    $certificate->save();
                    return $pdf->download('CertificadoLaboral.pdf');
    
                }else{
                    return '<script language="javascript">alert("Fecha de expedición errónea");window.location.href="/home"</script>';
                }
                
            }
        // } catch (\Throwable $th) {
        //     $error = array();
        //     $error['tittle'] = "Error";
        //     $error['message'] = "Opss se presento un error, pongase en contacto con fabrica de soluciones"; 
        //     return view('errors.error', compact('error'));
        // }

    }

}