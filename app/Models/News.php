<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = ['title', 'content', 'image_title', 'publisher', 'image_section1', 'image_section2', 'image_section3', 'category_id', 'modul_id'];
    protected $primaryKey = 'id';

    public function modul()
    {
        return $this->belongsTo('App\Models\Modul', 'modul_id');
    }
    public function news_categories()
    {
        return $this->belongsTo('App\Models\NewsCategory', 'category_id');
    }
}
