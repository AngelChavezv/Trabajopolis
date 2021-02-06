<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriaEmpleo extends Model
{
    protected $table ='categoria_empleos';
    public $timestamps = false;
    protected $fillable = [
        'empleo_id','categoria_id'
    ];
    public function empleo(){
        return $this->belongsTo(Empleo::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }
}
