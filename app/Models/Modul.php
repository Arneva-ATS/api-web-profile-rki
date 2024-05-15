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
    public function cooperative_branches()
    {
        return $this->hasMany('App\Models\Cooperative_Branch', 'modul_id');
    }
    public function cooperative_centers()
    {
        return $this->hasMany('App\Models\Cooperative_Center', 'modul_id');
    }
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact', 'modul_id');
    }
    public function ads_contents()
    {
        return $this->hasMany('App\Models\AdsContent', 'modul_id');
    }
    public function news_categories()
    {
        return $this->hasMany('App\Models\AdsContent', 'modul_id');
    }
    public function news()
    {
        return $this->hasMany('App\Models\News', 'modul_id');
    }
    public function profile_contents()
    {
        return $this->hasMany('App\Models\News', 'modul_id');
    }
    public function product_details()
    {
        return $this->hasMany('App\Models\ProductDetail', 'modul_id');
    }
    public function product_overviews()
    {
        return $this->hasMany('App\Models\ProductOverview', 'modul_id');
    }
}
