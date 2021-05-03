<ul class="nav nav-tabs nav-justified mb-3">

//このviewいらないかも？？

    {{-- 作品一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('works.index', ['id' => $work ?? ''->id]) }}" class="nav-link {{ Request::routeIs('works.index') ? 'active' : '' }}">
            All
            <span class="badge badge-secondary">{{ $user->works_count }}</span>
        </a>
    </li>
    
    {{-- お気に入り一覧タブ --}}
    <li class="nav-item">
        <a href="{{ route('users.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::routeIs('users.favorites') ? 'active' : '' }}">
            Favorites
            <span class="badge badge-secondary">{{ $user->favorites_count }}</span>
        </a>
    </li>    

</ul>
