<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task; // 投稿モデルを適切にインポート
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller

{
    public function touristSpot()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::all(); // 仮の例です
    
        // ビューにデータを渡す
        return view('posts.tourist-spot')->with('tasks', $tasks);
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
            'title' => 'required|max:25',
            'content' => 'required|max:255',
            'image'=>'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    
        // バリデーション実行
        // $validatedData = $request->validate($rules);
    
        // バリデーションが成功したら、Taskモデルを使用してデータベースに投稿を保存
        
        // Task::create([
        //     'user_id' => auth()->user()->id, // ログインユーザーのIDを取得する例
        //     'title' => $request->input('title'),
        //     'content' => $request->input('content'),
        // ]);
        
        $task = new Task;
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->user_id = auth()->user()->id;
    
        // 投稿成功後にリダイレクト
        return redirect()->route('posts.tourist-spot')->with('success', '投稿が作成されました');
    }
    
    public function store(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:255',
                'contents' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ];
    
            // バリデーション実行
            $request->validate($rules);
    
            // 新しい投稿を作成
            $task = new Task();
            $task->title = $request->input('title');
            $task->contents = $request->input('contents');
            $task->user_id = Auth::id();
        
            // 画像アップロード処理
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $task->image_at = 'images/' . $imageName;
            }
            // 保存
            $task->save();
    
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('tourist-spot')->with('success', 'Post created');
     }  
    }
}