<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group_Modul extends Model
{
    use HasFactory;
    protected $table = 'group_modul';
    protected $fillable = ['group_modul_name'];

    public function modul()
    {
        return $this->hasMany('App\Models\Modul', 'group_modul_id');
    }
}
