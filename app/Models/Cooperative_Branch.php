<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cooperative_Branch extends Model
{
    use HasFactory;
    protected $table = 'cooperative_branches';
    protected $fillable = ['coop_name', 'koperasi_id', 'user_id'];

    public function cooperative_centers()
    {
        return $this->belongsTo('App\Models\Cooperative_Center', 'koperasi_id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function modul_cooperatives()
    {
        return $this->hasMany('App\Models\ModulCooperative', 'c_koperasi_id');
    }
}
