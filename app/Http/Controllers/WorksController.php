<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Work;

use Illuminate\Support\Facades\Storage; //S3を使用するのに必要

class WorksController extends Controller
{
    public function index()
    {
       //cacooの①   
     
        // 公開にチェックをいれた作品一覧をidの降順で取得
        $works = Work::where('work_public', 1)->paginate(20);

        // 作品一覧ビューでそれを表示
        return view('works.index', [
           
            'works' => $works,
            
        ]);

    }
    
    
    
    public function create()
    {
       //cacooの⑥        
        $work = new Work;
        
        
        // 作品作成ビューを表示
        return view('works.create', [
            'work' => $work,
        ]);
        
 
    }            
        


    public function store(Request $request)
    {
        // dd(env('AWS_BUCKET'));
        // dd(\Config::get('filesystems'));
        
        
        // バリデーション
        $request->validate([
            'photo' => 'required',      //仮置き、あとで修正
            'title' => 'required|max:100',
            'description' => 'required|max:300',            
            'work_public' => 'nullable',        //仮置き、後で修正       
        ]);

        //s3アップロード開始
        $image = $request->file('photo');
        // dd($image);
        $path = Storage::disk('s3')->putFile('test', $image, 'public');        
        // パスをデータベースに格納
        $image_path = Storage::disk('s3')->url($path);
        


        $request->user()->works()->create([
        // 作品を作成
        'photo' => $image_path,
        'title' => $request->title,        
        'description' => $request->description,
        'work_public' => $request->work_public, 
        ]);
        
        // トップページへリダイレクトさせる
          return redirect('/');
        
    }   


    
    public function show($id)
    {

       //cacooの⑧ 
               
        $data = [];        
  
        // idの値で作品を検索して取得
        $work = Work::findOrFail($id);    
    
        $data = [
            'work' => $work,
        ];    
        // 作品詳細ビューでそれを表示
        return view('works.show', $data);        
        
        // トップページへリダイレクトさせる
          return redirect('/');       
        
    }    
    
    public function edit($id)
    {
       //cacooの⑦
        // idの値で作品を検索して取得
        $work = Work::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、作品を編集
        if (\Auth::id() === $work->user_id) {
        // 作品編集ビューでそれを表示
        return view('works.edit', [
            'work' => $work,
        ]); 

    }
        // トップページへリダイレクトさせる
        return redirect('/');    
    }
    
    
    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'photo' => 'nullable',             
            'title' => 'required|max:100',
            'description' => 'required|max:300',            
            'work_public' => 'nullable',
        ]);
        
        // idの値で作品を検索して取得
        $work = Work::findOrFail($id);

        //s3アップロード開始
        $image = $request->file('photo');
        
    if ($request->file('photo')) {        //->isValid()
    
        $path = Storage::disk('s3')->putFile('test', $image, 'public');        
        // パスをデータベースに格納
        $image_path = Storage::disk('s3')->url($path);        
      
        // 作品を更新
        $work->photo = $image_path;
    }
        $work->title = $request->title;
        $work->description = $request->description;          
        $work->work_public = $request->work_public;        
        $work->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }    
    
    
    
    public function destroy($id)
    {
        // idの値で作品を検索して取得
        $work = \App\Work::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその作品の所有者である場合は、作品を削除
        if (\Auth::id() === $work->user_id) {
            $work->delete();
        }

        // トップページへリダイレクトさせる
        return redirect('/');  
    }    
    
    
}
