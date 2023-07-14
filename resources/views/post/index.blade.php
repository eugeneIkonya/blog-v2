@extends('layouts.app')

@section('content')
<style> 
  .disp{
    border:2px solid;
    margin-bottom:3px;
    transition:all .5s easeIn;
  }
  .disp:hover{
    transform:scale(2);
  }
</style>
<div class="container">
    <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Content</th>
      <th scope="col">Image</th>
      <th scope="col">Categories</th>
      <th scope="col">Views</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($posts as $post)
      <tr>
        <th scope="row">{{ $post->id }}</th>
        <td>{{ $post->title }}</td>
        <td>{!! Str::limit($post->content1, 250) !!}</td>
        <td>
          <img src="{{ Storage::url($post->image1) }}" alt="Post Image" class="disp" width="100">
          @if($post->image2) <img src="{{ Storage::url($post->image2) }}" alt="Post Image" class="disp" width="100">@endif
        </td>
        <td>
          @foreach($post->categories as $category)
            <span class="badge badge-primary">{{ $category->name }}</span>
          @endforeach
        </td>
        <td>
          {{$post->views}}
        </td>
        <td>
          <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-primary">Edit</a>
          <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST" style="display:inline;" class="delete-form">
            @csrf
            @method('DELETE')
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
        const confirmDelete = confirm('Are you sure you want to delete this post?');
        if (!confirmDelete) {
          event.preventDefault();
        }
      });
    });
  });
</script>
@endsection