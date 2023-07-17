@extends('layouts.reader')
@section('title', 'ByteInsider: Home ')
@section('description','Homepage of Byteinsider')
@section('content')
<h1 class="h2">Home</h1>
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
                        <p>At Byte Insider, we're all about empowering you to seize the benefits of technology and enhance your lifestyle. Together, let's explore and embrace the future, one byte at a time.</p>

                    </blockquote>
                </div>

            </article> <!-- end article -->
            @endif
            
            @endforeach
            

            
        </div>
    </div>
    @include('components.pagination')
@endsection
