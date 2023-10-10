<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;

class GoodController extends Controller
{
    
        public function store(Request $request)
        {
            $isLiked = Good::where('task_id', $request->input('task_id'))->where('user_id', Auth::id())->where('isLike', 1)->first();
            if($isLiked) {
                $isLiked->delete();
            } else {
                $good = new Good;
                $good->isLike = true;
                $good->task_id = $request->input('task_id');
                $good->user_id = Auth::id();
                $good->save();
            }
            return redirect()->route('tourist-spot');
        }
    
        public function destroy($postId)
        {
            Auth::user()->unlike($postId);
            return 'ok!'; //レスポンス内容
        }
        
        public function ajaxlike(Request $request)
        {
            // 投稿にいいねを追加する
            $good = Good::find($request->id);
            $good->users()->attach($request->user()->id);
        
            // レスポンスデータを返す
            return response()->json([
                'success' => true,
            ]);
        }


        
}
