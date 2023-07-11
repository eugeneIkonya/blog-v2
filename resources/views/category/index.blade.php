@extends('layouts.app')

@section('content')

<div class="container">
    <h2 class="my-3">Categories</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach($categories as $category)          
    <tr>
        <th scope="row">{{ $category->id }}</th>
        <td>{{ $category->name }}</td>
        <td>{{ $category->description }}</td>
        <td>
            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success">Edit</a>
            <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display: inline;" class="delete-form">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach         
        </tbody>
    </table>
</div>
<script>
  document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.delete-form').forEach(form => {
      form.addEventListener('submit', function(event) {
        const confirmDelete = confirm('Are you sure you want to delete this category?');
        if (!confirmDelete) {
          event.preventDefault();
        }
      });
    });
  });
</script>

@endsection