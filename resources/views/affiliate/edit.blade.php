@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('affiliate.update', $affiliate) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $affiliate->name }}">
        </div>

        <div class="form-group">
            <label>Company</label>
            <input type="text" name="company" class="form-control" value="{{ $affiliate->company }}">
        </div>

        <div class="form-group">
            <label>Link</label>
            <input type="text" name="link" class="form-control" value="{{ $affiliate->link }}">
        </div>
        <div class="form-group">
                <label class="form-label">Categories</label>
                <div class="d-flex flex-wrap">
                    @foreach($categories as $category)
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" name="categories[]" id="category{{ $category->id }}" value="{{ $category->id }}"
                            @if($affiliate->categories->contains($category->id)) checked @endif >
                            <label class="form-check-label" for="category{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        <div class="form-group">
            <label>Days Left</label>
            <input type="number" name="days_left" class="form-control" value="{{ $affiliate->days_left }}">
        </div>

        <div class="form-group">
            <label>Image</label>
            <input type="file" name="image" class="form-control-file">
            <img src="{{ Storage::url($affiliate->image) }}" alt="" width="50" height="50">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
