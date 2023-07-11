<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;
use App\Affiliate;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    public function posts(){
        return $this->belongsToMany(Post::class);
    }
    public function affiliates(){
        return $this->belongsToMany(Affiliate::class);
    }
}
