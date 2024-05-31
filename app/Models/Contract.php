<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $fillable = [
        // Otras propiedades fillable,
        '_token',
        'start',
        'end',
        'salary',
        'status',
        'id_users',
        'id_type_contracts',
        'id_posts',
        'created_at',
        'updated_at',
    ];
    public function users(){
        return $this->belongsTo(User::class, 'id_users');
    }
    public function typeContracts(){
        return $this->belongsTo(TypeContracts::class,'id_type_contracts');
    }
    public function posts(){
        return $this->belongsTo(Post::class, 'id_posts');
    }
    public static function contractMonth($data){
        $mes = substr($data, 5, 2);
        switch ($mes) {
            case '1':
                $mes =  "enero";
                return $mes;
                break;
            case '2':
                $mes =  "febrero";
                return $mes;
                break;
            case '3':
                $mes =  "marzo";
                return $mes;
                break;
            case '4':
                $mes =  "Abril";
                return $mes;
                break;
            case '5':
                $mes =  "Mayo";
                return $mes;
                break;
            case '6':
                $mes =  "Junio";
                return $mes;
                break;
            case '7':
                $mes =  "Julio";
                return $mes;
                break;
            case '8':
                $mes =  "Agosto";
                return $mes;
                break;
            case '9':
                $mes =  "Septiembre";
                return $mes;
                break;
            case '10':
                $mes =  "Octubre";
                return $mes;
                break;
            case '11':
                $mes =  "Noviembre";
                return $mes;
                break;
            case '12':
                $mes =  "Diciembre";
                return $mes;
                break;
            default:
                $mes =  "N/a";
                break;
        }
    }
    public static function contractYear($data){
        $anio = substr($data, 0, 4);
        return $anio;
    }
    public static function contractDay($data){
        $dia = substr($data, 8, 2);
        return $dia;
    }
}
