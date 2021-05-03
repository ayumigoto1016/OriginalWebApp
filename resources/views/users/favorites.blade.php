@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-md-center">    
    <h1>ヘンナモノ ポートフォリオ</h1>    
</div>
</div>

<div>
    {{-- 作品作成ページへのリンク --}}
    {!! link_to_route('works.create', 'Add New Works!', [], ['class' => 'btn btn-lg btn-success btn-block']) !!}    
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link " id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
  </li>
@if (Auth::check())      
  <li class="nav-item">
    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Favorites</a>
  </li>
@else
    
@endif
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">

        

        </div>    <!--rowのdiv  -->
    </div>
  
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row">

            <!--ユーザーのお気に入り作品のみ表示-->

        @foreach (Auth::user()->favorites as $favorite)

                {{-- cacoo①トップページへのリンク --}}          
            <div class="card col-sm-3">
              
            <div>{{ $favorite->photo }}</div>
            {{-- cacoo⑧登録済み作品詳細ページへのリンク --}}
            <p>{!! link_to_route('works.show', '詳細', ['work' => $favorite->id]) !!}</p>            
            
            <div class="card-body">
            <div class="card-text">{{ $favorite->title }} </div>
            </div>  
            </div>  
        
        @endforeach.     <!-- Topページがログインユーザしか見れなくなっているのでここを別ページに書く必要あり -->

        
    </div>          
    </div>

</div>
    
@endsection