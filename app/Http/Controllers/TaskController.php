<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task; 
use App\Models\Good; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class TaskController extends Controller

{
    public function touristSpot()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::orderBy('id', 'DESC')->paginate(8);  // 仮の例です
        $goods = Good::all();
        // ビューにデータを渡す
        return view('posts.tourist-spot')->with('tasks', $tasks)->with('goods', $goods)->render();
    }
    
        public function index()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::all(); // 仮の例です
    
        // ビューにデータを渡す
        return view('posts.tourist-spot', compact('tasks'));
    }
    public function create(Request $request)
    {
        // バリデーションルールを定義
        $rules = [
            'title' => 'required|max:15',
            'content' => 'required|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
         
        $task = new Task;
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->user_id = auth()->user()->id;

        // return redirect('/tourist-spot')->with('success', 'Post created');
    
        // 投稿成功後にリダイレクト
        return redirect()->route('posts.tourist-spot')->with('success', '投稿が作成されました');
    }

    public function store(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:15',
                'contents' => 'required|max:100',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
    
            // バリデーション実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションが失敗した場合
        if ($validator->fails()) {
            return redirect()
                ->route('tourist-spot') // リダイレクト先を適切に設定
                ->withErrors($validator) // エラーメッセージをセット
                ->withInput(); // フォーム入力データをセット
        }
            // 新しい投稿を作成
            $task = new Task();
            $task->title = $request->input('title');
            $task->contents = $request->input('contents');
            $task->user_id = Auth::id();

              // 画像アップロード処理
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/img', $imageName); // storage/app/public/img ディレクトリに保存
                $task->image_at = 'storage/img/' . $imageName; // シンボリックリンクを使用してアクセス
            }
            // 保存
            $task->save();
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('tourist-spot')->with('success', 'Post created');
         
     }   
    }
        public function ajaxlike(Request $request)
    {
        // 投稿にいいねを追加する
        $tasks = Task::find($request->id);
        $tasks->likes()->attach($request->user()->id);
;;
        // レスポンスデータを返す
        return response()->json([
            'success' => true,
        ]);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'article_id', 'user_id')->withTimestamps();
    }


}