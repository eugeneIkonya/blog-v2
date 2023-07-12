@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="my-3">Edit Blog Post</h2>
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name='title' class="form-control" id="title" placeholder="Enter title"
                    value="{{ old('title', $post->title) }}">
            </div>
            <div class="mb-3">
                @php
                    $tags = implode(',', json_decode($post->tags));
                    $keywords = implode(',', json_decode($post->keywords));
                @endphp
                <label for="tags" class="form-label">Tags</label>
                <input type="text" name="tags" class="form-control" id="tags" value="{{ $tags }}"
                    placeholder="Enter tags separated by commas">
            </div>
            <div class="mb-3">
                <label for="keywords" class="form-label">Keywords</label>
                <input type="text" name="keywords" class="form-control" id="keywords" value="{{ $keywords }}"
                    placeholder="Enter keywords separated by commas">
            </div>
            <div class="mb-3">
                <label for="image1" class="form-label">Image 1</label>
                <input type="file" name='image1' class="form-control" id="image1">
                <img src="{{ Storage::url($post->image1) }}" alt="Post Image" width="100">
            </div>
            @if ($post->image2)
                <div class="mb-3">
                    <label for="image2" class="form-label">Image 2</label>
                    <input type="file" name='image2' class="form-control" id="image2">
                    <img src="{{ Storage::url($post->image2) }}" alt="Post Image" width="100">
                </div>
            @endif
            <div class="mb-3">
                <label class="form-label">Categories</label>
                <div class="d-flex flex-wrap">
                    @foreach ($categories as $category)
                        <div class="form-check me-4">
                            <input class="form-check-input" type="checkbox" name="categories[]"
                                id="category{{ $category->id }}" value="{{ $category->id }}"
                                @if ($post->categories->contains($category->id)) checked @endif>
                            <label class="form-check-label" for="category{{ $category->id }}">
                                {{ $category->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="lead_paragraph" class="form-label">lead paragraph</label>
                <div id="editor-buttons-lead_paragraph">
                    <button type="button" onclick="addTag('a', 'lead_paragraph')">Add Link</button>
                    <button type="button" onclick="addList('lead_paragraph')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'lead_paragraph')">Add H3</button>
                    <button type="button" onclick="addTag('h3', 'lead_paragraph')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'lead_paragraph')">Add Strong</button>
                </div>
                <textarea name='lead_paragraph' class="form-control" id="lead_paragraph" rows="10">{{ old('lead_paragraph', $post->lead_paragraph) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="table_of_contents" class="form-label">Table of contents</label>
                <div id="editor-buttons-table_of_contents">
                    <button type="button" onclick="addTag('a', 'table_of_contents')">Add Link</button>
                    <button type="button" onclick="addList('table_of_contents')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'table_of_contents')">Add H3</button>
                    <button type="button" onclick="addTag('h3', 'table_of_contents')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'table_of_contents')">Add Strong</button>
                </div>
                <textarea name='table_of_contents' class="form-control" id="table_of_contents" rows="10">{{ old('table_of_contents', $post->table_of_contents) }}</textarea>
            </div>
            @if ($post->steps()->exists())
                <div id="stepsContainer">
                    <!-- Step fields will be inserted here -->
                </div>
            @endif
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <div id="editor-buttons-content">
                    <button type="button" onclick="addTag('a', 'content')">Add Link</button>
                    <button type="button" onclick="addList('content')">Add List</button>
                    <button type="button" onclick="addTag('h2', 'content')">Add H3</button>
                    <button type="button" onclick="addTag('h3', 'content')">Add H3</button>
                    <button type="button" onclick="addTag('strong', 'content')">Add Strong</button>
                </div>
                <textarea name='content' class="form-control" id="content" rows="10">{{ old('content', $post->content) }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <form action="{{ route('post.destroy', ['id' => $post->id]) }}" method="POST" style="display:inline;"
            class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
    @php
        $steps = $post->steps;
    @endphp
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = @json($steps);
            const stepsContainer = document.getElementById('stepsContainer');
            console.log(steps);
            console.log(stepsContainer);

            for (let step of steps) {
                const stepDiv = document.createElement('div');
                stepDiv.classList.add('my-2');


                const titleField = document.createElement('input');
                titleField.type = 'text';
                titleField.name = 'steps[title][]';
                titleField.placeholder = 'Title';
                titleField.value = step.title;
                titleField.classList.add('form-control', 'my-2');
                console.log(titleField);

                const descField = document.createElement('input');
                descField.type = 'text';
                descField.name = 'steps[desc][]';
                descField.placeholder = 'Description';
                descField.value = step.description;
                descField.classList.add('form-control', 'my-2');

                const imageField = document.createElement('input');
                imageField.type = 'file';
                imageField.name = 'steps[image][]';
                imageField.classList.add('form-control', 'my-2');

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.textContent = 'Delete this step';
                deleteButton.classList.add('btn', 'btn-danger', 'my-2');
                deleteButton.onclick = function() {
                    stepsContainer.removeChild(stepDiv);
                };

                stepDiv.appendChild(titleField);
                stepDiv.appendChild(descField);
                stepDiv.appendChild(imageField);
                stepDiv.appendChild(deleteButton);

                stepsContainer.appendChild(stepDiv);
            }

            // Adding button to add more steps
            const addStepButton = document.createElement('button');
            addStepButton.type = 'button';
            addStepButton.textContent = 'Add new step';
            addStepButton.classList.add('btn', 'btn-primary', 'my-2');
            addStepButton.onclick = function() {
                const stepDiv = document.createElement('div');
                stepDiv.classList.add('my-2');

                const titleField = document.createElement('input');
                titleField.type = 'text';
                titleField.name = 'steps[title][]';
                titleField.placeholder = 'Title';
                titleField.classList.add('form-control', 'my-2');

                const descField = document.createElement('textarea');
                descField.type = 'text';
                descField.name = 'steps[desc][]';
                descField.rows = '10';
                descField.placeholder = 'Description';
                descField.classList.add('form-control', 'my-2');

                const imageField = document.createElement('input');
                imageField.type = 'file';
                imageField.name = 'steps[image][]';
                imageField.classList.add('form-control', 'my-2');

                // Create a container to hold the image preview
                const imagePreviewContainer = document.createElement('div');
                imagePreviewContainer.classList.add('image-preview-container', 'my-2');

                // Create an image element for the preview
                const imagePreview = document.createElement('img');
                imagePreview.src = "{{ Storage::url($post->image1) }}";
                imagePreview.alt = "Step Image";
                imagePreview.width = 100;
                
                // Add the image element to the container
                imagePreviewContainer.appendChild(imagePreview);
                console.log(imagePreview);

                // When a file is chosen in the file input, update the image preview
                imageField.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function(event) {
                            imagePreview.src = event.target.result;
                        }

                        reader.readAsDataURL(e.target.files[0]);
                    }
                });

                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.textContent = 'Delete this step';
                deleteButton.classList.add('btn', 'btn-danger', 'my-2');
                deleteButton.onclick = function() {
                    stepsContainer.removeChild(stepDiv);
                };

                stepDiv.appendChild(titleField);
                stepDiv.appendChild(descField);
                stepDiv.appendChild(imagePreviewContainer); // Add this line
                stepDiv.appendChild(imageField);
                stepDiv.appendChild(deleteButton);

                stepsContainer.appendChild(stepDiv);
            };

            stepsContainer.appendChild(addStepButton);
        });
    </script>
@endsection
