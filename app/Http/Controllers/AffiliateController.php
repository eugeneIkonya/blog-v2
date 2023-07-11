<?php

namespace App\Http\Controllers;

use Flash;
use App\Category;
use App\Affiliate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
{
    $this->middleware('checkuseremail');
}
    
    public function index()
    {
        $affiliates = Affiliate::all();
        return view('affiliate.index',compact('affiliates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        return view('affiliate.create',compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'company' => 'required|string',
            'link' => 'required',
            'days_left' => 'required|integer',
            'image' => 'required|image',
            'categories' => 'required|array',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_1.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images',$filename,'public');

            $affiliate = new Affiliate();
            $affiliate->name=$request->name;
            $affiliate->company=$request->company;
            $affiliate->link=$request->link;
            $affiliate->days_left=$request->days_left;
            $affiliate->image=$path;
            $affiliate->save();

            $affiliate->categories()->sync($request->categories);
            Flash::success('Affiliate Created successfully!');
            return redirect()->route('affiliate.index')->with('success', 'Affiliate Added successfully.');
        }
        Flash::error('Images are required!');
        return back()->withInput()->withErrors(['image' => 'Images are required.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        $categories = Category::all();
        return view('affiliate.edit',compact('affiliate','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'company' => 'required|string',
            'link' => 'required|url',
            'days_left' => 'required|integer',
            'image' => 'sometimes|image',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
        ]);
        $affiliate = Affiliate::findOrFail($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_1.'.$file->getClientOriginalExtension();
            $path = $file->storeAs('images',$filename,'public');
            $affiliate->image=$path;
        }
        $affiliate->name=$request->name;
        $affiliate->company=$request->company;
        $affiliate->link=$request->link;
        $affiliate->days_left=$request->days_left;
        $affiliate->save();

        $affiliate->categories()->sync($request->categories);
        Flash::success('Affiliate Updated successfully!');
        return redirect()->route('affiliate.index')->with('success', 'Affiliate Added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Affiliate  $affiliate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affiliate = Affiliate::findOrFail($id);
        Storage::disk('public')->delete($affiliate->image);
        $affiliate->categories()->detach();
        $affiliate->delete();
        
        Flash::success('Affiliate Deleted successfully!');
        return redirect()->route('affiliate.index')->with('success', 'Affiliate Deleted successfully.');
    }
}
