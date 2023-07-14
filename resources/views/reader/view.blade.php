@extends('layouts.reader')
@php
    $keywords = implode(',', json_decode($single->keywords));
@endphp
@section('keywords')
    {{ $keywords }}
@endsection
@section('description') {{ $single->lead_paragraph }} @endsection
@section('title')
    {{ $single->title }}
@endsection
@section('content')
    <main class="row content__page">
        <article class="column large-full entry format-standard">
            {{-- image --}}
            <div class="media-wrap entry__media">
                <div class="entry__post-thumb">
                    <img lazy="loading" src="{{ Storage::url($single->image1) }}" alt="">
                </div>
            </div>
            {{-- entry header  --}}
            <div class="content__page-header entry__header">
                <h1 class="display-1 entry__title">
                    {{ $single->title }}
                </h1>
                <ul class="entry__header-meta">
                    <li class="date">{{ $single->created_at->format('F d, Y') }}</li>
                    <li class="cat-links">
                        @foreach ($single->categories as $tag)
                            <a href="{{ route('reader.category', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
            {{-- entry content  --}}
            @if ($single->steps()->exists())
                <div class="entry__content">
                    <p class="lead drop-cap">
                        {{ $single->lead_paragraph }}
                    </p>
                    <p>
                        {!! $single->table_of_contents !!}
                    </p>
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($single->steps as $step)
                        @php
                            $i++;
                        @endphp
                        <h2 id="title{{ $i }}">{{ $step->title }}</h2>
                        <p>
                            {!! $step->description !!}
                        </p>
                        @if($step->image)
                        <div class="entry__post-thumb">
                            <img src="{{ Storage::url($step->image) }}" alt="">
                        </div>
                        @endif
                    @endforeach
                    <p>
                        {!! $single->content !!}
                    </p>
                    <div class="entry__post-thumb">
                        <img lazy="loading" src="{{ Storage::url($single->image2) }}" alt="">
                    </div>
                </div>
            @else
                <div class="entry__content">
                    <p class="lead drop-cap">
                        {!! $single->lead_paragraph !!}
                    </p>
                    <p>
                    <h2>Table of Contents</h2>
                    {!! $single->table_of_contents !!}
                    </p>
                    <div class="entry__post-thumb">
                        <img lazy="loading" src="{{ Storage::url($single->image2) }}" alt="">
                    </div>
                    <p>
                        {!! $single->content !!}
                    </p>
                    <div class="entry__post-thumb">
                        <img lazy="loading" src="{{ Storage::url($single->image1) }}" alt="">
                    </div>

                    <p class="entry__tags">
                        <span>Post Tags</span>

                        <span class="entry__tag-list">
                            @foreach ($single->categories as $tag)
                                <a href="{{ route('reader.category', ['id' => $tag->id]) }}">{{ $tag->name }}</a>
                            @endforeach
                        </span>
                    </p>

                </div>

            @endif

            <div class="entry__related">
                <h3 class="h2">Related Articles</h3>
                <ul class="related">
                    @foreach ($related as $relate)
                        <li class="related__item">
                            <a href="{{ route('reader.view', ['id' => $relate->id,'name'=>$relate->title]) }}" class="related__link">
                                <img lazy="loading" src="{{ Storage::url($relate->image1) }}" alt="">
                            </a>
                            <h5 class="related__post-title">{{ $relate->title }}</h5>
                        </li>
                    @endforeach
                </ul>
            </div>
        </article>
    </main>
@endsection
