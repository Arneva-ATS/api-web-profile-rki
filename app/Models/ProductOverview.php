<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOverview extends Model
{
    use HasFactory;
    protected $table = 'product_overviews';
    protected $fillable = ['overview', 'content', 'product_id', 'modul_id'];
    protected $primaryKey = 'id';

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
}
