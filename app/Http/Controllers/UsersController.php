<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
 
       public function index()
    {
       //cacooの⑤    
        $data = [];
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの作品の一覧を作成日時の降順で取得
            $works = $user->works()->orderBy('created_at', 'desc')->paginate(20);
         
            $data = [
             'user' => $user,
             'works' => $works,
            ];

        // users.indexでそれらを表示
        return view('users.index', $data);       
       
       
        // // idの値でユーザを検索して取得
        // $user = User::findOrFail($id);

        // // 関係するモデルの件数をロード
        // $user->loadRelationshipCounts();

        // // ユーザの作品一覧を作成日時の降順で取得
        // $works = $user->works()->orderBy('created_at', 'desc')->paginate(10);

        // // ユーザ一覧ビューでそれらを表示
        // return view('users.index', [
        //     'user' => $user,
        //     'works' => $works,
        // ]);
    } 
    
    
    /**
     * ユーザのお気に入り作品一覧ページを表示するアクション。
     *
     * @param  $id  ユーザのid
     * @return \Illuminate\Http\Response
     */
    public function favorites($id)
    {
        
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザのお気に入り作品一覧を取得
        $favorites = $user->favorites()->paginate(20);



        // // お気に入り一覧ビューでそれらを表示
        // return view('users.index', [
        //     'user' => $user,
        //     'works' => $favorites,
        // ]);
    }       
    
    
    
    
}
