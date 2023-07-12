<header class="s-header">
    <div class="header__top">
        <div class="header__logo">
            <a href="{{ route('reader.welcome') }}" class="site-logo">
                <img src="{{ asset('images/logo.png') }}" alt="Homepage">
            </a>
        </div>
    </div>
    <nav class="header__nav-wrap">
        <ul class="header__nav">
            <li class="current"><a href="{{ route('reader.welcome') }}">Home</a></li>
            <li class="has-children">
                <a href="#0" title="">Categories</a>
                <ul class="sub-menu">
                    @foreach ($popular_categories as $tag)
                        <li><a href="{{route('reader.category',['id'=>$tag->id])}}">{{$tag->name}}</a></li>   
                    @endforeach            
                </ul>
            </li>
            <li><a href="{{route('reader.blog')}}" title="">Blog</a></li>
            <li><a href="{{route('reader.about')}}" title="">About</a></li>
            {{-- <li><a href="#0" title="">Trending</a></li>
            <li><a href="#0" title="">About</a></li> --}}
        </ul>
        {{-- <ul class="header__social">
            <li class="ss-facebook">
                <a href="#0"><span class="screen-reader-text">Facebook</span></a>
            </li>
            <li class="ss-twitter">
                <a href="#0"><span class="screen-reader-text">Twitter</span></a>
            </li>
            <li class="ss-dribbble">
                <a href="#0"><span class="screen-reader-text">Dribble</span></a>
            </li>
            <li class="ss-pinterest">
                <a href="#0"><span class="screen-reader-text">Pinterest</span></a>
            </li>
        </ul> --}}
    </nav>
    <a href="#0" class="header__menu-toggle">
        <span>Menu</span>
    </a>
</header>