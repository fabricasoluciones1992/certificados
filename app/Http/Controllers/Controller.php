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
    function valCode(Request $request) {
        $decoded_data = base64_decode($request->valCode);
        $values = explode(',', $decoded_data);
        $contract = Certificates::find($values[0]);
        if (!empty($contract)) {
            $error = [
                'tittle' => "El contrato es válido.",
                'message' => "El contrato fue validado y fue generado en la fecha: $values[1]"
            ];
            return view('errors.error', compact('error'));
        } else {
            $error = [
                'tittle' => "El contrato es inválido.",
                'message' => "El contrato que usted busca es inválido."
            ];
            return view('errors.error', compact('error'));
        }
    }
}

