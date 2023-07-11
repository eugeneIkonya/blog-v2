<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Affiliate;
use Illuminate\Support\Facades\Session;

class ReaderController extends Controller
{   
    public function index(){
        $posts = Post::orderByDesc('views')->paginate(10);
        $affiliates = $this->getAffiliatesFromPosts($posts);
        $recents = $this->getRecentPosts(5);
        $popular_posts = $this->getPopularPosts(5);
        $popular_categories = $this->getPopularCategories(10);
        return view('reader.index',compact('posts','recents','popular_posts','popular_categories','affiliates'));
    }
    public function view($id){
        $single = Post::findOrFail($id);
        $sessionId = Session::getId();
        $recents = $this->getRecentPosts(5);
        $popular_posts = $this->getPopularPosts(5);
        $popular_categories = $this->getPopularCategories(10);
        if (!Session::has("post_view_{$single->id}_{$sessionId}")) {
            // Increment the single views count
            $single->increment('views');
            $views = $single->views;
            // Set a session key to mark that the single view has been counted
            Session::put("post_view_{$single->id}_{$sessionId}", true);
        }
        $posts = Post::all();
        $related = $this->getRelatedPosts($single);
        return view('reader.view',compact('related','single','posts','recents','popular_posts','popular_categories'));
    }
    public function category($id){
        $recents = $this->getRecentPosts(5);
        $popular_posts = $this->getPopularPosts(5);
        $popular_categories = $this->getPopularCategories(10);
        $category = Category::find($id);
        $posts = $category->posts()->paginate(12);
        return view('reader.category',compact('category','posts','recents','popular_posts','popular_categories'));
    }
    public function affiliate($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $affiliate->increment('views');
        return redirect()->away($affiliate->link);
    }
    public function blog(){
        $recents = $this->getRecentPosts(5);
        $popular_posts = $this->getPopularPosts(5);
        $popular_categories = $this->getPopularCategories(10);
        $posts = Post::orderByDesc('created_at')->paginate(14);
        return view('reader.blog',compact('posts','recents','popular_posts','popular_categories'));
    }
    public function search(Request $request){
        $recents = $this->getRecentPosts(5);
        $popular_posts = $this->getPopularPosts(5);
        $popular_categories = $this->getPopularCategories(10);
        $validatedData = $request->validate([
            'search' => 'required|max:255|min:2',
        ]);
        $search = $request->search;
        $post = Post::query()
                ->orWhere('title', 'LIKE', "%{$search}%")
                ->orWhere('lead_paragraph', 'LIKE', "%{$search}%")
                ->orWhere('table_of_contents', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%")
                ->get();
            $posts = collect();
            
            if ($post->isNotEmpty()) {
                $categories = Category::query()
                    ->where('name', 'LIKE', "%{$search}%")
                    ->get();
            
                foreach ($categories as $category) {
                    $category_post = $category->posts();
            
                    if ($category_post->count() > 0) {
                        $diff = $post->diff($category_post->get());
                        $posts = $post->merge($diff);
                    }
                }
            }
            $all = collect();
            if ($posts->isEmpty()) { 
                $all = Post::all()->take(6);
            } else {
                foreach ($posts as $post) {
                    $categories = $post->categories;
                    foreach ($categories as $category) {
                        $all->push($category->posts);   
                    }
                }
                $all = $all->flatten()->unique()->reject(function ($post) use ($posts) {
                    return $posts->contains('id', $post->id);
                });
            }
            return view('reader.search', compact('search','posts','all','recents','popular_posts','popular_categories'));
            

    }
    
    // custom functions
    public function getRecentPosts($total){
        $posts = Post::all()->take($total)->sortByDesc('created_at');
        return $posts;
    }
    public function getRelatedPosts($post)
    {
        // Get the IDs of the categories the post is associated with
        $categoryIds = $post->categories()->pluck('categories.id')->toArray();
    
        // Find other posts that are in any of these categories
        $relatedPosts = Post::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })
        ->where('id', '!=', $post->id)  // Exclude the current post from the related posts
        ->take(6)  // Limit to 6 related posts
        ->get();  // Execute the query and get the results
    
        return $relatedPosts;
    }
    
    public function getPopularPosts($total){
        $posts = Post::all()->take($total)->sortByDesc('views');
        return $posts;
    }
    public function getPopularCategories($total){
        $categories = Category::withCount('posts')->orderByDesc('posts_count')->take($total)->get();
        return $categories;
    }
    public function getAffiliatesFromPosts($posts){
        $affiliates = collect();
        foreach($posts as $post) {
            foreach($post->categories as $category) {
                foreach($category->affiliates as $affiliate) {
                    $affiliates->push($affiliate);
                }
            }
        }
        $uniqueAffiliates = $affiliates->unique('id');
        return $uniqueAffiliates;   
    }


}
