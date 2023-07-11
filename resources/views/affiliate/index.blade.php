@extends('layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Company</th>
                <th>Link</th>
                <th>Days left</th>
                <th>Views</th>
                <th>Categories</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($affiliates as $affiliate)
                <tr>
                    <td>{{$affiliate->id}}</td>
                    <td>{{ $affiliate->name }}</td>
                    <td>{{ $affiliate->company }}</td>
                    <td>{{ $affiliate->link }}</td>
                    <td>{{ $affiliate->days_left }}</td>
                    <td>{{ $affiliate->views }}</td>
                    <td>
                    @foreach($affiliate->categories as $category)
                        <span class="badge badge-primary">{{ $category->name }}</span>
                    @endforeach
                    </td>
                    <td><img src="{{ Storage::url($affiliate->image) }}" width="50" height="50" /></td>
                    <td>
                        <a href="{{ route('affiliate.edit', $affiliate) }}" class="btn btn-primary">Edit</a>

                        <form action="{{ route('affiliate.destroy', $affiliate) }}" method="POST" onsubmit="return confirm('Are you sure?');">
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
@endsection
