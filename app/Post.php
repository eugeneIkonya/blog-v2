<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Step;

class Post extends Model
{
    protected $fillable = [
        'title',
        'image1',
        'image2',
        'lead_paragraph',
        'table_of_contents',
        'content',
        'views',
        'tags',
        'keywords',
    ];
    protected $attributes = [
        'image2' => null,
        'views'=>0,
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function steps(){
        return $this->hasMany(Step::class);
    }
}
