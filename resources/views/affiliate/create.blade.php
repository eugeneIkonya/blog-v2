@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="my-3">Create Affiliate</h2>
    <form action="{{ route('affiliate.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        {{method_field('POST')}} 
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" class="form-control">
        </div>
        <div class="form-group">
            <label>Link</label>
            <input type="url" name="link" class="form-control">
        </div>
        <div class="form-group">
                <label class="form-label">Categories</label>
                <div class="d-flex flex-wrap">
                    <!-- You would replace this with a loop in your actual Laravel code -->
                    @foreach($categories as $category)
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category{{ $category->id }}" value="{{ $category->id }}">
                            <label class="form-check-label" for="category{{ $category->id }}">{{ $category->name }}  </label>
                        </div>
                    @endforeach
                    <!-- End of Laravel code -->
                </div>
            </div>
        <div class="form-group">
            <label>Days Left</label>
            <input type="number" name="days_left" class="form-control">
        </div>
        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
