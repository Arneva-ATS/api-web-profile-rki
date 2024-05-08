<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'modul';
    protected $fillable = [
        'modul_name', 'group_modul_id',
    ];

    public function group_modul()
    {
        return $this->belongsTo('App\Models\Group_Modul', 'group_modul_id');
    }

    public function modul_cooperatives()
    {
        return $this->hasMany('App\Models\ModulCooperative', 'modul_id');
    }
}
