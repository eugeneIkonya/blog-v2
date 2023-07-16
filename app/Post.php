<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Category;
use App\Step;

class Post extends Model
{
    use Sluggable;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }
    public function getLink()
    {
        return url('blog/'.$this->slug);
    }
    protected $fillable = [
        'title',
        'image1',
        'image2',
        'lead_paragraph',
        'table_of_contents',
        'content',
        'views',
        'slug',
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
