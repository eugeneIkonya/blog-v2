<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index(Request $r)
    {
        $posts = Post::orderBy('id', 'desc')->get();
        $categories = Category::orderBy('id', 'desc')->get();

        return response()->view('sitemap', compact('posts', 'categories'))
          ->header('Content-Type', 'text/xml');
    }
}
