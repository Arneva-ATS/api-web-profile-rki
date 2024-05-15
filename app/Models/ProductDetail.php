<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $table = 'product_details';
    protected $fillable = ['product_name', 'description', 'image', 'modul_id'];
    protected $primaryKey = 'id';

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
}
