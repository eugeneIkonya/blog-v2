@extends('layouts.reader')
@section('description', 'Search Results')
@section('title')
{{$search}}
@endsection
@section('content')
<header class="listing-header">
    <h1 class="h2">Search Results</h1>
</header>
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
                    <a href="{{$post->getLink()}}" class="entry__thumb-link">
                        <img lazy="loading" src="{{Storage::url($post->image1)}}" alt="">
                    </a>
                </div>
                <div class="entry__text">
                    <div class="entry__header">
                        <h2 class="entry__title"><a href="{{$post->getLink()}}">{{ $post->title }}</a>
                        </h2>
                        <div class="entry__meta">
                            <span class="entry__meta-cat">
                                @foreach ($post->categories as $category)
                                    <a href="{{$category->getLink()}}">{{$category->name}}</a>                                 
                                @endforeach
                            </span>
                            <span class="entry__meta-date">
                                {{ $post->created_at->format('F d, Y') }}
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
                        <p>You Searched for: {{$search}} </p>

                    </blockquote>
                </div>

            </article> <!-- end article -->
            @endif
            
            @endforeach          
        </div>
        <div class="entry__related">
            <h3 class="h2">You might also like</h3>
            <ul class="related">
                @foreach($recents as $relate)
                <li class="related__item">
                    <a href="{{$post->getLink()}}" class="related__link">
                        <img src="{{ Storage::url($relate->image1) }}" alt="">
                    </a>
                    <h5 class="related__post-title">{{$relate->title}}</h5>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
