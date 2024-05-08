<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModulCooperative extends Model
{
    use HasFactory;

    protected $table = 'modul_cooperatives';
    protected $fillable = ['modul_id', 'koperasi_id', 'c_koperasi_id', 'status'];

    public function cooperative_branches()
    {
        return $this->belongsTo('App\Models\Cooperative_Branch', 'c_koperasi_id');
    }


    public function cooperative_centers()
    {
        return $this->belongsTo('App\Models\Cooperative_Center', 'koperasi_id');
    }

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
}
