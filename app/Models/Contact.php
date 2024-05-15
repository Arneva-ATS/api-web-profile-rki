<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['contact_name', 'email', 'phone', 'address', 'modul_id'];
    protected $primaryKey = 'id';

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
}
