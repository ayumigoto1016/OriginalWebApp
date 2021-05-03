@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-md-center">    
    <h1>{{ Auth::user()->name }}さんの作品一覧</h1>    
</div>
</div>

    <div class="row justify-content-end">
        {{-- Homeボタン --}}
        {!! link_to_route('works.index', 'Home', [],  ['class' => 'btn btn-info']) !!}    
    </div>


    <div class="row">        
        @foreach ($works as $work)
        
                {{-- cacoo⑤ユーザーの作品一覧ページへのリンク --}}          
            <div class="card col-sm-3">
                {{-- ユーザーの作品それぞれのお気に入り数表示--}}   
            <span class="badge badge-secondary">{{$user->favorites->count()}}</span>                
            <div>{{ $work->photo }}</div>

            {{-- cacoo⑦登録済み作品編集ページへのリンク --}}
            <p>{!! link_to_route('works.edit', 'Edit', ['work' => $work->id]) !!}</p>
            
            <div class="card-body">
            <div class="card-text">{{ $work->work_public }} </div>
            <div class="card-text">{{ $work->title }} </div>            
            </div>  
            </div>  
        @endforeach 
     
        
    </div>
    
@endsection