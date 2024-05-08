<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperative_Center extends Model
{
    use HasFactory;
    protected $table = 'cooperative_centers';
    protected $fillable = ['coop_name', 'user_id'];
    protected $primaryKey = 'id';



    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function cooperative_branches()
    {
        return $this->hasMany('App\Models\Cooperative_Branch', 'koperasi_id');
    }

    public function modul_cooperatives()
    {
        return $this->hasMany('App\Models\ModulCooperative', 'koperasi_id');
    }
}
