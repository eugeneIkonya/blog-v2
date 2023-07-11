<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Affiliate extends Model
{
    protected $fillable = [
        'name',
        'company',
        'link',
        'days_left',
        'views',
        'images',
    ];
    protected $attributes = [
        'views' => 0,
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
