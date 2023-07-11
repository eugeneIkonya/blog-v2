<?php // routes/breadcrumbs.php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use App\Category;
use App\Post;

// Home
Breadcrumbs::for('reader.welcome', function ($trail) {
    $trail->push('Home', route('reader.welcome'));
});

// Home > Blog
Breadcrumbs::for('reader.blog', function ($trail) {
    $trail->parent('reader.welcome');
    $trail->push('Blog', route('reader.blog'));
});

// Home > Search
Breadcrumbs::for('reader.search', function ($trail) {
    $trail->parent('reader.welcome');
    $trail->push('Search', route('reader.search'));
});

// Home > View
Breadcrumbs::for('reader.view', function ($trail, Post $post) {
    $trail->parent('reader.welcome');
    $trail->push($post->title, route('reader.view', $post->id));
});

// Home > Category
Breadcrumbs::for('reader.category', function ($trail, Category $category) {
    $trail->parent('reader.welcome');
    $trail->push($category->name, route('reader.category', $category->id));
});
