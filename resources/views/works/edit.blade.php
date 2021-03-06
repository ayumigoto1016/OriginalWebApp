@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">    
            <h1 class="text-secondary">Edit Your Works</h1> 
        </div>
    </div>

    <div class="row justify-content-end mr-3">
        {{-- Go Backボタン --}}
        {!! link_to_route('users.index', 'Go Back', [],  ['class' => 'btn btn-secondary']) !!}    
    </div>    


{!! Form::model($work, ['route' => ['works.update', $work->id], 'method' => 'put', 'files' => true]) !!}
    <div class="mb-4">
        <label>現在の作品画像：</label><img src="{{ $work->photo }}" class="img-fluid rounded" alt="image">
    </div>

    <div class="form-group">
    <div class="mb-4">         
        {!! Form::label('photo', '新しい画像をアップロード:') !!}   
        <!-- アップロードフォームの作成 -->    
         <input type="file" name="photo">
        {{ csrf_field() }}
    <p><small>注意：正方形のように縦と横の幅が等しい画像を選択してください</small></p>        
    </div>
    </div>

                                <!--ここに公開トグルいれる-->
              
    <div class="custom-control custom-switch mb-4">
      <input type="checkbox" name="work_public" class="custom-control-input" id="customSwitch1"  value="1" {{ (empty($work->work_public)) ? '' : 'checked'}}>
      <label class="custom-control-label" for="customSwitch1">公開</label>
    </div>  

   
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}         
        {!! Form::textarea('title', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div> 
    <div class="form-group">
        {!! Form::label('description', '説明:') !!}           
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>    

        {{-- Saveボタン --}}
    {!! Form::submit('登録', ['class' => 'btn btn-primary btn-lg']) !!}
{!! Form::close() !!}


    <div class="mt-4 mb-4">
            {{-- Deleteボタン --}}
    {!! Form::model($work, ['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
            {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
    {!! Form::close() !!} 
    </div>


@endsection