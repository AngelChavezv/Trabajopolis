<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'user_id','ciudad_id','trabajos','logros','profesion','telefono','fechadenacimiento'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }
}
