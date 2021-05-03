@extends('layouts.app')

@section('content')
//    @if (Auth::check())
        <div class="row">
            <aside class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ Auth::user()->name }}</h3>
                    </div>
                    
                </div>
            </aside>
            <div class="col-sm-8">
                {{-- 作品検索タグ --}}
                @include('works.research')
                {{-- 作品一覧 --}}
                @include('works.works')
                {{-- お気に入り作品一覧 --}}
                @include('users.favorites')                
            </div>
        </div>
//    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Let's enioy Hennamono!</h1>
                {{-- ユーザ登録ページへのリンク --}}
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
//    @endif
@endsection