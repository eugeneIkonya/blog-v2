@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="my-3">Create Category</h2>
    <form action="{{route('category.store')}}" method="POST">
    @csrf
    {{ method_field('POST') }}
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter category name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Enter category Description">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection