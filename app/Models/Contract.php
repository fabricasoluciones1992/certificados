<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class, 'id_users');
    }
    public function typeContracts(){
        return $this->belongsTo(TypeContracts::class,'id_type_contracts');
    }
    public function posts(){
        return $this->belongsTo(Post::class, 'id_posts');
    }
}
