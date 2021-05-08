@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">    
        <h1 class="text-center text-secondary">{{ $work->user->name }}さんの作品</h1>
   
            <div class="card col-sm-12">
            <div class="card-body">
            <div class="row justify-content-center"><img src="{{ $work->photo }}" class="rounded w-100 h-100" alt="image"></div>  
            

            <div class="row mt-4">
              <div class="col-sm-3"><h5 class="text-secondary">タイトル：</h5></div>
              <div class="col-sm-9"><p class="lead"><strong>{{ $work->title }}</strong></div>
              
              <div class="col-sm-3"><h5 class="text-secondary">説明：</h5></div>
              <div class="col-sm-9"><p class="lead"><strong>{{ $work->description }}</strong></div>              
            </div>
            
            
            </div>  
            </div>  
    </div>             
</div>


    <div class="row justify-content-center m-4">
        @if (Auth::user()->is_favorite($work->id))
            {{-- お気に入り解除ボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.unfavorite', $work->id], 'method' => 'delete']) !!}
                {!! Form::submit('Unfavorite', ['class' => 'btn btn-warning']) !!}
            {!! Form::close() !!}                                 
        @else
            {{-- お気に入り追加ボタンのフォーム --}}
            {!! Form::open(['route' => ['favorites.favorite', $work->id]]) !!}
                {!! Form::submit('Favorite', ['class' => 'btn btn-lg btn-success']) !!}
            {!! Form::close() !!}   
        @endif
    
    </div>    

    <div class="row justify-content-center mb-5">
        {{-- Homeボタン --}}
        {!! link_to_route('works.index', 'Home', [],  ['class' => 'btn btn-info']) !!}    
    </div>

@endsection