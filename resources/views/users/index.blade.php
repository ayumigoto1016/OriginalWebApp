@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">    
    <h1 class="text-center text-secondary">{{ Auth::user()->name }}さんの作品一覧</h1>    
</div>
</div>

    <div class="row justify-content-end mb-3 mr-3">
        {{-- Homeボタン --}}
        {!! link_to_route('works.index', 'TOP', [],  ['class' => 'btn btn-info']) !!}    
    </div>


    <div class="row mb-5">        
        @foreach ($works as $key => $work)
        
            {{-- cacoo⑤ユーザーの作品一覧ページ--}}          
        <div class="card col-sm-3">
        <div class="card-body">                
            {{-- ユーザーの作品それぞれのお気に入り数表示--}}   
        <h5 class="text-secondary">Favorites: <span class="badge badge-secondary">{{$work->favorite_users()->count()}}</span></h5>                
        <div class="row justify-content-center"><img src="{{ $work->photo }}" class="rounded" width="200" height="200"  alt="image"></div>

        <div class="card-text"><p class="text-center pt-3">{{ $work->title }}</p></div>             
        {{-- cacoo⑦登録済み作品編集ページへのリンク --}}
        <p class="text-center pt-3">{!! link_to_route('works.edit', 'Edit', ['work' => $work->id],  ['class' => 'btn btn-outline-info']) !!}</p>    
        </div>  
        
                            <!--公開トグル-->
        <div class="row justify-content-end mr-1 mb-3">
        
        <label class="custom-control custom-switch mb-4" for="customSwitch-{{ $key }}">
            <input type="checkbox" name="work_public" class="custom-control-input" id="customSwitch-{{ $key }}"  value="{{ (empty($work->work_public)) ? '0' : '1'}}" {{ (empty($work->work_public)) ? '' : 'checked'}}>
            <input type="hidden" class="work_id" value="{{ $work->id }}" />
            @if(!empty($work->work_public))
            <span class="custom-control-label">公開</span>  
            @else
            <span class="custom-control-label">非公開</span> 
            @endif
        </label>  
        
        </div>

        </div>  
        @endforeach 
     
        
        <script src="{{ asset('/js/toggle.js') }}"></script>        
    </div>
    
@endsection