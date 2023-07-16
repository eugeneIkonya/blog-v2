<?php

namespace App;

use App\Post;
use App\Affiliate;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    public function sluggable():array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getLink()
    {
        return url('category/'.$this->slug);
    }

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    public function affiliates()
    {
        return $this->belongsToMany(Affiliate::class);
    }
}
