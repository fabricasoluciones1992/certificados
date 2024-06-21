<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function validateCode(){
        return view('validarCertificado');
    }
    function valCode(Request $request){
        $code = base64_decode($request->valCode);
        $contract = Certificates::find($code);
            if (!empty($contract)){
                $error = array();
                $error['tittle'] = "EL contrato es valido.";
                $error['message'] = "El contrato es validado y fue generado en la fecha: $contract->download_date "; 
                return view('errors.error', compact('error'));
            }else{
                $error = array();
                $error['tittle'] = "EL contrato es invalido";
                $error['message'] = "El contrato que usted busca es invalidó."; 
                return view('errors.error', compact('error'));
            }
            return $contract;
            return view('validarCertificado');
        }
}

