<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdsContent extends Model
{
    use HasFactory;
    protected $table = 'ads_contents';
    protected $fillable = ['title', 'content', 'image', 'url', 'modul_id'];
    protected $primaryKey = 'id';

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
}
