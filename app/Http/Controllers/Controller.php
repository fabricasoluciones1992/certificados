<?php

namespace App\Http\Controllers;

use App\Models\Certificates;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function validateCode(){
        return view('validarCertificado');
    }
    public function valCode(Request $request) {
        $decoded_data = base64_decode($request->valCode);
        $values = explode(',', $decoded_data);
        if (!empty($contract) || !empty($values[2])) {
            $sql = "SELECT * FROM contracts where id = $values[2]";
            try {
                $contract = DB::select($sql);
            } catch (\Throwable $th) {
                $error = [
                    'title' => "El contrato es inválido.",
                    'message' => "El contrato que usted busca es inválido."
                ];
                return redirect()->back()->with('error', $error);
            }
            $user = User::find($contract[0]->id_users);
            $error = [
                'title' => "El contrato es válido.",    
                'message' => "El contrato fue validado y generado en la fecha: $values[1], para la persona: $user->name, identificada con el número de documento: $user->document."
            ];
            return redirect()->back()->with('error', $error);
        } else {
            $error = [
                'title' => "El contrato es inválido.",
                'message' => "El contrato que usted busca es inválido."
            ];
            return redirect()->back()->with('error', $error);
        }
    }
    
}

