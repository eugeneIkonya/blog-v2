@extends('layouts.reader')
@section('description', '')
@section('title', 'ByteInsider: Home ')
@section('content')

    <div class="masonry-wrap">
        <div class="masonry">
            <div class="grid-sizer"></div>
            @php
                $i = 0;
            @endphp
            @foreach ($posts as $post)
            @php
                $i++;
            @endphp
            <article class="masonry__brick entry format-standard animate-this">
                <div class="entry__thumb">
                    <a href="{{ route('reader.view', $post->id) }}" class="entry__thumb-link">
                        <img src="{{Storage::url($post->image1)}}" alt="">
                    </a>
                </div>
                <div class="entry__text">
                    <div class="entry__header">
                        <h2 class="entry__title"><a href="{{ route('reader.view', ['id'=>$post->id]) }}">{{ $post->title }}</a>
                        </h2>
                        <div class="entry__meta">
                            <span class="entry__meta-cat">
                                @foreach ($post->categories as $category)
                                    <a href="{{route('reader.category',['id'=>$category->id])}}">{{$category->title}}</a>                                 
                                @endforeach
                            </span>
                            <span class="entry__meta-date">
                                <a>{{ $post->created_at->format('F d, Y') }}</a>
                            </span>
                        </div>
                    </div>
                    <div class="entry__excerpt">
                        <p>
                            {!!Str::limit($post->lead_paragraph, 250)!!}
                        </p>
                    </div>
                </div>
            </article> <!-- end article -->
            @if ($i == 1)
            <article class="masonry__brick entry format-quote animate-this">

                <div class="entry__thumb">
                    <blockquote>
                        <p>Good design is making something intelligible and memorable. Great design is making
                            something memorable and meaningful.</p>

                    </blockquote>
                </div>

            </article> <!-- end article -->
            @endif
            
            @endforeach
            

            
        </div>
    </div>
    @include('components.pagination')
@endsection
