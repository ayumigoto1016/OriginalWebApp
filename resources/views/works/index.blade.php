@extends('layouts.app')

@section('content')

<div class="container">
<div class="row justify-content-center">    
    <h1 class="text-center text-secondary">ヘンナモノ ポートフォリオ</h1> 
</div>
<div class="row justify-content-center">    
    <h5 class="lead text-secondary mt-4">モノ作りが好きな素人さんのための、創作作品共有ポートフォリオです。あるとちょっと楽しい、ばかばかしい、くだらないハンドメイド作品を公開できます。『何かに役立つわけではないけどこんなもの作ってみたよ！』大歓迎です！！</h5>
    <h5 class="lead text-secondary">簡単なアカウント登録後に全ての機能を使用することができます。いいなあ、と思った作品はFavoriteボタンを押すことでお気に入り登録ができ、トップ画面からいつでも閲覧可能です。</h5>
</div>
<div class ="container d-flex justify-content-center" >
    <div class="col-sm-6 m-4">
    {{-- 作品作成ページへのリンク --}}
    {!! link_to_route('works.create', 'Add New Works!', [], ['class' => 'btn btn-lg btn-success btn-block']) !!}    
    </div>
</div>
</div>

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All</a>
  </li>
        
@if (!Auth::check())    <!--未ログインの場合レイアウト崩れないように-->
</ul>
@else
@endif

@if (Auth::check()) 

  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Favorites</a>
    
  </li>
</ul>  

<div class="tab-content" id="myTabContent">
  
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="row">

            <!--ユーザーのお気に入り作品のみ表示-->

        @foreach (Auth::user()->favorites as $favorite)

                {{-- cacoo①トップページへのリンク --}}          
            <div class="card col-sm-3">
            <div class="card-body">              
            <div class="row justify-content-center"><img src="{{ $favorite->photo }}" class="rounded w-100 h-100" alt="image"></div>
           
            <div class="card-text"><p class="text-center pt-3">{{ $favorite->title }}</p></div>
            {{-- cacoo⑧登録済み作品詳細ページへのリンク --}}
            <p class="text-center pt-3">{!! link_to_route('works.show', '詳しく見る', ['work' => $favorite->id]) !!}</p>             
            </div>  
            </div>  
        
        @endforeach     <!-- Topページがログインユーザしか見れなくなっているのでここを別ページに書く必要あり -->

        
    </div>          
    </div>



@else
    
@endif        
        
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="row">

        
            <!--作品全て表示-->
        @foreach ($works as $work)
                {{-- cacoo①トップページへのリンク --}}          
            <div class="card col-sm-3">
            <div class="card-body">                
            <div class="row justify-content-center"><img src="{{ $work->photo }}" class="rounded w-100 h-100" alt="image"></div>

            <div class="card-text"><p class="text-center pt-3">{{ $work->title }}</p></div>
            {{-- cacoo⑦登録済み作品編集ページへのリンク --}}            
            <p class="text-center pt-2">{!! link_to_route('works.show', '詳しく見る', ['work' => $work->id]) !!}</p>            
            </div>  
            </div>  
        
        @endforeach

        </div>    <!--rowのdiv  -->
    </div>
  


</div>
    
@endsection