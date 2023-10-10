<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Bookmark;
use App\Models\User;

class BookmarkController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        // ブックマークデータを取得
        $bookmarks = Bookmark::where('user_id', $user_id)->get();


        // ビューにデータを渡す
        return view('mypage', compact('bookmarks'));
    }


    // ブックマークを追加
    public function addBookmark(Request $request)
    {
            // ユーザーがログインしているか確認
        if (Auth::check()) {
            $user_id = Auth::id();
            $task_id = $request->input('task_id');
               // すでにブックマークされているか確認
            $existingBookmark = Bookmark::where('task_id', $task_id)
            ->where('user_id', $user_id)
            ->first();
              
        } else {
            // ユーザーがログインしていない場合の処理
            return redirect()->back()->with('error', 'ログインしていません');
        }


        if (!$existingBookmark) {
            // ブックマークを作成
            Bookmark::create([
                'task_id' => $task_id,
                'user_id' => $user_id,
            ]);
            return redirect()->back()->with('success', 'ブックマークしました');
        } else {
            return redirect()->back()->with('error', 'ブックマークに失敗しました');
        }
    }

    // ブックマークを削除
    public function removeBookmark(Request $request)
    {
        $task_id = $request->input('task_id');
        $user_id = Auth::id();

        // ブックマークを削除
        Bookmark::where('task_id', $task_id)
            ->where('user_id', $user_id)
            ->delete();

        return redirect()->back()->with('success', 'ブックマークを削除しました');
    }


}
