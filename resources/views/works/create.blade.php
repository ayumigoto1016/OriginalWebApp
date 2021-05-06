@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-md-center">    
        <h1>Add New Works</h1>    
    </div>
    
    <div class="row justify-content-end">
        {{-- Go Backボタン --}}
        {!! link_to_route('users.index', 'Go Back', [],  ['class' => 'btn btn-secondary']) !!}    
    </div>  
    

    
{!! Form::model($work, ['route' => 'works.store', 'files' => true]) !!}

    <!-- アップロードフォームの作成 -->
    <input type="file" name="photo">
    {{ csrf_field() }}

    
    <div class="custom-control custom-switch">
      <input type="checkbox" name="work_public" class="custom-control-input" id="customSwitch1"  value="1" >
      <label class="custom-control-label" for="customSwitch1">公開</label>
    </div>
    
    
    <div class="form-group">
        {!! Form::label('title', 'タイトル:') !!}         
        {!! Form::textarea('title', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div> 
    <div class="form-group">
        {!! Form::label('description', '紹介文:') !!}           
        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => '5']) !!}
    </div>    

        {{-- Saveボタン --}}
        {!! Form::submit('登録', ['class' => 'btn btn-primary btn-lg']) !!}

{!! Form::close() !!}

   
</div>    


    <!--<div class="col-sm-6">-->
    <!--  <label for="formFileLg" class="form-label">Photo</label>-->
    <!--  <input class="form-control form-control-lg" id="formFileLg" type="file">-->
    <!--</div>-->

    <!--<div class="col-sm-6">-->
    <!--<div class="custom-control custom-switch">-->
    <!--  <input type="checkbox" class="custom-control-input" id="customSwitch1">-->
    <!--  <label class="custom-control-label" for="customSwitch1">公開</label>-->
    <!--</div>-->
    <!--</div>-->

    <!--<div class="col-sm-6">-->
    <!--  <label for="exampleFormControlInput1" class="form-label">Title</label>-->
    <!--  <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="例：おへそスイッチ">-->
    <!--</div>-->
    
    <!--<div class="col-sm-6">-->
    <!--  <label for="exampleFormControlTextarea1" class="form-label">Description</label>-->
    <!--  <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="例：おへそって押したくなる、と思い、トイレの電気の消し忘れを防ぐためにを作りました。" rows="5"></textarea>-->
    <!--</div>-->
    
@endsection