<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task; // 投稿モデルを適切にインポート
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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

    public function edit($id)

    {
        $task = Task::findOrFail($id);

        // Check if the post belongs to the authenticated user
        // if ($post->user_id !== Auth::user()->id) {
        //     return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        // }

        return view('post_list_edit', compact('task'));
        // dd($id);
        // Fetch a single task by its ID
        //$task = Task::find($id); // Replace $taskId with the actual task ID you want to edit
        //dd($task);
        // $user = Auth::user();
        // return view('post_list_edit', compact('task','user'));
    }


    public function update(Request $request, $id)
    {
        // dd($id);
       // $tasks = Task::find($id);
        //dd($tasks);

        // タスクが存在しない場合のエラーチェック
        // if (!$tasks) {
        //     return redirect()->route('task.edit')->with('error', 'タスクが見つかりませんでした');
        // }

        // タスクの情報を更新
        // $tasks->title = $request->input('title');
        // $tasks->contents = $request->input('content');
        // $tasks->save();

        // 更新後のタスクリストを再取得
        //$tasks = Task::find($id);
        // dd($tasks);
       // $user = Auth::user();
        // dd($user);
        // Fetch the post by its ID
        $task = Task::findOrFail($id);

        // Check if the post belongs to the authenticated user (optional)
        // if ($task->author_id !== Auth::user()) {
        //     return abort(403); // Handle unauthorized access
        // }

        // Validate the form data
        // $request->validate([
        //     'title' => 'required|string|max:255',
        //     'content' => 'required|string',
        // ]);

        // Update the post
        $task->update([
            'title' => $request->input('title'),
            'contents' => $request->input('contents'),
        ]);

        return redirect()->route('tasks.index')->with('success', 'Post updated successfully.');
    // }
        //return view('mypage', compact('tasks','user'));
    }

 
    public function destroy($id)
    {
        // dd($id);
        // タスクのIDを使用してタスクを取得
        $task = Task::find($id);
        // dd($task);
        $task->delete();
        // dd($task);
        return redirect()->route('tasks.index');
    }

}