<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleo extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'titulo', 'descripcion', 'empresa','fecha','telefono','correocontacto','user_id','ciudad_id'
    ];
    public function ciudad(){
        return $this->belongsTo(Ciudad::class);
    }

    public function scopeTitulo($query,$titulo){
        if($titulo)
            return $query->orWhere('titulo','LIKE',"%$titulo%");
    }

    public function scopeFecha($query,$fecha){
        if($fecha)
            return $query->orWhere('fecha','LIKE',"%$fecha%");
    }

}
