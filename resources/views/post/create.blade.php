@extends('layouts.app')

@section('content')
<div class="container">
        <h2 class="my-3">New Blog Post</h2>
        <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('POST')}}  
        <div class="mb-3">
            <label class="form-label">Has Steps</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hasSteps" id="hasStepsYes" value="yes">
                <label class="form-check-label" for="hasStepsYes">Yes</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="hasSteps" id="hasStepsNo" value="no" checked>
                <label class="form-check-label" for="hasStepsNo">No</label>
            </div>
        </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name='title' class="form-control" id="title" placeholder="Enter title">
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" id="tags" placeholder="Enter tags separated by commas">
            </div>
            <div class="mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" class="form-control" id="keywords" placeholder="Enter keywords separated by commas">
            </div>
            <div class="mb-3">
                <label for="image1" class="form-label">Image 1</label>
                <input type="file" name ='image1' class="form-control" id="image1">
            </div>
            <div class="mb-3">
                <label for="image2" class="form-label">Image 2</label>
                <input type="file" name ='image2' class="form-control" id="image2">
            </div>
            <div class="mb-3">
                <label class="form-label">Categories</label>
                <div class="d-flex flex-wrap">
                    <!-- You would replace this with a loop in your actual Laravel code -->
                    @foreach($categories as $category)
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="category{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                    <!-- End of Laravel code -->
                </div>
            </div>
            <div class="mb-3">
                <label for="lead_paragraph" class="form-label">Lead Paragraph</label>
                <div id="editor-buttons-lead_paragraph">
                    <button type="button" onclick="addTag('a', 'lead_paragraph')">Add Link</button>
                    <button type="button" onclick="addList('lead_paragraph')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'lead_paragraph')">Add H2</button>
                    <button type="button" onclick="addTag('h3', 'lead_paragraph')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'lead_paragraph')">Add Strong</button>
                </div>
                <textarea name= 'lead_paragraph' class="form-control" id="lead_paragraph" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="table_of_contents" class="form-label">Table of contents</label>
                <div id="editor-buttons-table_of_contents">
                    <button type="button" onclick="addTag('a', 'table_of_contents')">Add Link</button>
                    <button type="button" onclick="addList('table_of_contents')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'table_of_contents')">Add H2</button>
                    <button type="button" onclick="addTag('h3', 'table_of_contents')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'table_of_contents')">Add Strong</button>
                </div>
                <textarea name= 'table_of_contents' class="form-control" id="table_of_contents" rows="3"></textarea>
            </div>
            <div id="stepsContainer" style="display: none;">
                <!-- Step fields will be inserted here -->
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <div id="editor-buttons-content">
                    <button type="button" onclick="addTag('a', 'content')">Add Link</button>
                    <button type="button" onclick="addList('content')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'content')">Add H2</button>
                    <button type="button" onclick="addTag('h3', 'content')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'content')">Add Strong</button>
                </div>
                <textarea name= 'content' class="form-control" id="content" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>
    <script src="{{ asset('js/step.js') }}"></script>
@endsection