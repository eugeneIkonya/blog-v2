<div class="s-search">
    <div class="search-block">
        <form action="{{route('reader.search')}}" class="search-form" method="POST" role="search">
            @csrf
            {{ method_field('POST') }}
            <label>
                <span class="hide-content">Search for:</span>
                <input type="search" name="search" class="search-field" placeholder="Type Keywords" title="Search for:" autocomplete="off">
            </label>
            <input type="submit" value="search" class="search-submit">
        </form>
        <a href="#0" title="Close Search" class="search-close">Close</a>
    </div>
    <a href="#0" class="search-trigger">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill:rgba(0, 0, 0, 1);transform:;-ms-filter:"><path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z"></path></svg>
        <span>Search</span>
    </a>
    <span class="search-line"></span>
</div>
