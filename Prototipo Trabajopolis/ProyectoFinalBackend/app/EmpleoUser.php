<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpleoUser extends Model
{
    protected $table ='empleo_users';
    public $timestamps = false;
    protected $fillable = [
        'user_id','empleo_id'
    ];
    public function empleo(){
        return $this->belongsTo(Empleo::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
