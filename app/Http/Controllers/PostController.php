<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use Flash;
use App\Step;

class PostController extends Controller
{
    public function __construct()
{
    $this->middleware('checkuseremail');
}

    public function index(){
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }
    public function create(){
        $categories = Category::all();
        return view('post.create',compact('categories'));
    }
    public function edit($id){
        $post = Post::find($id);
        $categories = Category::all();
        return view('post.edit',compact('post','categories'));
    }
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'lead_paragraph' => 'required',
        'table_of_contents' => 'required',
        'content' => 'required',
        'image1' => 'sometimes|image',
        'categories' => 'required|array',
        'categories.*' => 'exists:categories,id',
        'tags' => 'required',
        'keywords' => 'required',
        'steps.title.*' => 'required|max:255', 
        'steps.desc.*' => 'required', 
        'steps.image.*' => 'sometimes|image', 
    ]);

    $post = Post::findOrFail($id);

    if ($request->hasFile('image1')) {
        // Delete the old image
        Storage::disk('public')->delete($post->image);
        $file1 = $request->file('image1');
        $filename1 = time() . '_1.' . $file1->getClientOriginalExtension();
        $path1 = $file1->storeAs('images', $filename1, 'public');
        Storage::disk('public')->delete($post->image1);
        $post->image1 = $path1;
        if($request->hasFile('image2')){
            $file2 = $request->file('image2');
            $filename2 = time() . '_2.' . $file2->getClientOriginalExtension();
            $path2 = $file2->storeAs('images', $filename2, 'public');
            Storage::disk('public')->delete($post->image2);
            $post->image2 = $path2;
        }   
    }  
    $tags = explode(',',$request->tags); 
    $keywords = explode(',',$request->keywords); 
       
    $post->title = $request->title;
    $post->lead_paragraph = $request->lead_paragraph;
    $post->table_of_contents = $request->table_of_contents;
    $post->content = $request->content;
    $post->tags = json_encode($tags);
    $post->keywords = json_encode($keywords);
    $post->save();
    if($request->has('steps')) {
        foreach($request->steps['title'] as $index => $step) {
            
            // Get existing step or create a new one
            $stepInstance = Step::firstOrNew(['title' => $step, 'post_id' => $post->id]);
            
            // Only update the step if the content has changed
            if($stepInstance->description != $request->steps['desc'][$index] || 
              (isset($request->steps['image'][$index]) && $stepInstance->image != $request->steps['image'][$index]->getClientOriginalName())) {
                
                $stepInstance->description = $request->steps['desc'][$index];
                
                if(isset($request->steps['image'][$index])) {
                    if($stepInstance->image) {
                        // Delete the old image if it exists
                        Storage::disk('public')->delete($stepInstance->image);
                    }
                    $stepImage = $request->steps['image'][$index];
                    $stepImageName = time() . '_' . $index . '.' . $stepImage->getClientOriginalExtension();
                    $stepImagePath = $stepImage->storeAs('images', $stepImageName, 'public');
                    $stepInstance->image = $stepImagePath;
                }
    
                // Assign the post_id manually
                $stepInstance->post_id = $post->id;
                
                // Save the step
                $stepInstance->save();
            }
        }
    }
    
    
    

    // Sync categories to the Post
    $post->categories()->sync($request->categories);
    Flash::success('Model Updated successfully!');
    return redirect()->route('post.index')->with('success', 'Post updated successfully.');
}

public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'lead_paragraph' => 'required',
        'table_of_contents' => 'required',
        'content' => 'required',
        'image1' => 'required|image',
        'categories' => 'required|array',
        'tags' => 'required',
        'keywords' => 'required',
        'steps.title.*' => 'required|max:255', 
        'steps.desc.*' => 'required', 
        'steps.image.*' => 'required|image', 
    ]);

    // Handling the images
    if ($request->hasFile('image1')) {
        $post = new Post;
        $file1 = $request->file('image1');
        $filename1 = time() . '_1.' . $file1->getClientOriginalExtension();
        $path1 = $file1->storeAs('images', $filename1, 'public');
        $post->image1 = $path1;
        if($request->hasFile('image2')){
            $file2 = $request->file('image2');
            $filename2 = time() . '_2.' . $file2->getClientOriginalExtension();
            $path2 = $file2->storeAs('images', $filename2, 'public');
            $post->image2 = $path2;
        }      
        $tags = explode(',',$request->tags); 
        $keywords = explode(',',$request->keywords); 
        
        $post->title = $request->title;
        $post->lead_paragraph = $request->lead_paragraph;
        $post->table_of_contents = $request->table_of_contents;
        $post->content = $request->content;
        $post->tags = json_encode($tags);
        $post->keywords = json_encode($keywords);


        $post->save();
        if($request->has('steps')) {
            foreach($request->steps['title'] as $index => $step) {
                $stepInstance = new Step();
                $stepInstance->title = $step;
                $stepInstance->description = $request->steps['desc'][$index];
                
                if(isset($request->steps['image'][$index])) {
                    $stepImage = $request->steps['image'][$index];
                    $stepImageName = time() . '_' . $index . '.' . $stepImage->getClientOriginalExtension();
                    $stepImagePath = $stepImage->storeAs('images', $stepImageName, 'public');
                    $stepInstance->image = $stepImagePath;
                }
        
                $post->steps()->save($stepInstance);
            }
        }
        
        
        // Attaching categories to the Post
        $post->categories()->attach($request->categories);
        Flash::success('Post Created successfully!');
        return redirect()->route('post.index')->with('success', 'Post created successfully.');
    }
    Flash::error('Images are required!');
    return back()->withInput()->withErrors(['image' => 'Images are required.']);
}
    public function view($id){
        $post = Post::find($id);
        return view('post.view',compact('post'));
    }
    public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Delete the post images from storage
    Storage::disk('public')->delete($post->image1);
    Storage::disk('public')->delete($post->image2);

    // Detach all categories related to the post
    $post->categories()->detach();
    foreach($post->steps as $step){
        Storage::disk('public')->delete($step->image);
        $step->delete();
    }

    // Delete the post
    $post->delete();

    Flash::success('Post deleted successfully!');
    return redirect()->route('post.index')->with('success', 'Post deleted successfully.');
}

}
