
<div class="row">
    <div class="column large-full">
        <nav class="pgn">
            <ul>
                @if ($posts->onFirstPage())
                    <li><span class="pgn__prev">Prev</span></li>
                @else
                    <li><a href="{{ $posts->previousPageUrl() }}" class="pgn__prev">Prev</a></li>
                @endif

                @foreach ($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                     @if ($page == $posts->currentPage())
                        <li><span class="pgn__num current">{{$page}}</span></li>
                     @else
                        <li><a href="{{$url}}" class="pgn__num">{{$page}}</a></li>
                        <li><span class="pgn__num dots">...</span></li>
                     @endif
                     @if ($posts->hasMorePages())
                        <li><a href="{{$posts->nextPageUrl()}}" class="pgn__next">Next</a></li>
                        <li><span class="pgn__next">Next</span></li>
                     @else

                     @endif
                @endforeach
            </ul>
        </nav>
    </div>
</div>