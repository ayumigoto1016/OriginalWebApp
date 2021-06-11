<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Article;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Log;

class ArticlesController extends Controller
{
    public function is_public(Request $request)
    {
        
        //引数取得
        $workId = $request->get('workId');
        $workPublicVal = $request->get('workPublicVal');

        try{
            // $workIdに対して、DBの変更を行う
        $work = \App\Work::findOrFail($workId);
        $work->work_public = $request->workPublicVal;
        $work->save();
        
        } catch ( Exception $ex ) {
            //エラーの場合
            // HTTPステータス:500 エラー
            return response()->json("{\"status\": 500, \"workId\":".$workId.", \"workPublicVal\":".$workPublicVal."}");
            
        }
 
        // HTTPステータス:200 成功
        return response()->json("{\"status\": 200, \"workId\":".$workId.", \"workPublicVal\":".$workPublicVal."}");
    } 
}
