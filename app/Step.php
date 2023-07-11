<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Step extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
    ];
    protected $attributes = [
        'image' => null,
    ];
    public function post(){
        return $this->belongsTo(Post::class);
    }

}
