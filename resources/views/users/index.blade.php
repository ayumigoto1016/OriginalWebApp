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
        
                {{-- cacoo⑤ユーザーの作品一覧ページ--}}          
            <div class="card col-sm-3">
            <div class="card-body">                
                {{-- ユーザーの作品それぞれのお気に入り数表示--}}   
            <h5>Favorites:<span class="badge badge-secondary">{{$work->favorite_users()->count()}}</span></h5>                
            <div><img src="{{ $work->photo }}" class="img-fluid" alt="Responsive image"></div>

            {{-- cacoo⑦登録済み作品編集ページへのリンク --}}
            <p>{!! link_to_route('works.edit', 'Edit', ['work' => $work->id]) !!}</p>
            

            <div class="card-text">{{ $work->title }} </div>             
      
            </div>  
            
                                <!--一回提出後ここに公開トグルいれる?-->

    <!-- <div class="custom-control custom-switch">-->
    <!--  <input type="checkbox" name="work_public" class="custom-control-input" id="customSwitch1"  value="1" {{ (empty($work->work_public)) ? '' : 'checked'}}>-->
    <!--  <label class="custom-control-label" for="customSwitch1">公開</label>-->
    <!--</div>  -->
    
            </div>  
        @endforeach 
     
        
    </div>
    
@endsection