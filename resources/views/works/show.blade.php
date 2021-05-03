@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-md-center">    
        <h1>{{ $work->user->name }}さんの作品</h1>
    </div>    

            
            <div class="row card col-sm-12 justify-content-between">
            <div class="card-body">
            <div>{{ $work->photo }}</div>                
            <div class="card-text">{{ $work->work_public }} </div>
            <div class="card-text"><h2>タイトル：{{ $work->title }}</h2></div>  
            <div class="card-text"><h2>紹介文：{{ $work->description }}</h2></div>              
            </div>  
            </div>   

</div>

    <div class="row justify-content-center">
        @if (Auth::user()->is_favorite($work->id))
            {{-- お気に入り解除ボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
                {!! Form::submit('Unfavorite', ['class' => 'btn btn-warning']) !!}
            {!! Form::close() !!}                                 
        @else
            {{-- お気に入り追加ボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.favorite', $work->id]]) !!}
                {!! Form::submit('Favorite', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}   
        @endif
    
    </div>    

    <div class="row justify-content-center">
        {{-- Homeボタン --}}
        {!! link_to_route('works.index', 'Home', [],  ['class' => 'btn btn-info']) !!}    
    </div>

@endsection