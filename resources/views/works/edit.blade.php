@extends('layouts.app')

@section('content')

    <div class="row justify-content-md-center">    
        <h1>Edit Your Works</h1>    
    </div>

    <div class="row justify-content-end">
        {{-- Go Backボタン --}}
        {!! link_to_route('users.index', 'Go Back', [],  ['class' => 'btn btn-secondary']) !!}    
    </div>    


{!! Form::model($work, ['route' => ['works.update', $work->id], 'method' => 'put']) !!}

    <div class="form-group">
        {!! Form::label('photo', '作品画像:') !!}      
        {!! Form::textarea('photo', null, ['class' => 'form-control', 'rows' => '2']) !!}
    </div> 
 
                                <!--ここに公開トグルいれる-->
              
    <div class="custom-control custom-switch">
      <input type="checkbox" name="work_public" class="custom-control-input" id="customSwitch1"  value="1" {{ (empty($work->work_public)) ? '' : 'checked'}}>
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


        {{-- Deleteボタン --}}
{!! Form::model($work, ['route' => ['works.destroy', $work->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger btn-sm']) !!}
{!! Form::close() !!} 



@endsection