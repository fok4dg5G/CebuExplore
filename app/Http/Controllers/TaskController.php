<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Task; 
use App\Models\Comment; 
use App\Models\Good; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class TaskController extends Controller

{
    public function touristSpot()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::where('category_id', 1)->orderBy('id', 'DESC')->paginate(8);  // 仮の例です
        $goods = Good::all();
        $bookmarks = Bookmark::all();
        $comments = Comment::all();
        // ビューにデータを渡す
        return view('posts.tourist-spot')->with('tasks', $tasks)->with('goods', $goods)->with('bookmarks', $bookmarks)->with('comments', $comments)->render();
    }

    public function search(Request $request)
    {
        // 検索フォームで入力された値を取得する
        $search = $request->input('search');
        // クエリビルダ
        $query = Task::query();
        // もし検索フォームにキーワードが入力されたら
        if ($search) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            // 単語をループで回し、タイトルと部分一致するものがあれば、$queryとして保持される
            foreach ($wordArraySearched as $value) {
                $query->where('title', 'like', '%' . $value . '%');
            }
            // 上記で取得した$queryをページネートにし、変数$tasksに代入
            $tasks = $query->paginate(20);
        } else {
            // 検索キーワードが入力されていない場合、通常のタスクリストを取得
            $tasks = Task::paginate(20);
        }
        // ビューにデータを渡す
        return view('posts.search', compact('tasks', 'search'));
    }

    public function hotel()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::where('category_id', 2)->orderBy('id', 'DESC')->paginate(8);  // 仮の例です
        $goods = Good::all();
        $bookmarks = Bookmark::all();
        $comments = Comment::all();
        // ビューにデータを渡す
        return view('posts.hotel')->with('tasks', $tasks)->with('goods', $goods)->with('bookmarks', $bookmarks)->with('comments', $comments)->render();
    }

    public function food()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::where('category_id', 3)->orderBy('id', 'DESC')->paginate(8);  // 仮の例です
        $goods = Good::all();
        $bookmarks = Bookmark::all();
        $comments = Comment::all();
        // ビューにデータを渡す
        return view('posts.food')->with('tasks', $tasks)->with('goods', $goods)->with('bookmarks', $bookmarks)->with('comments', $comments)->render();
    }

    public function transportation()
    {
        // タスクのデータを取得（適切な方法でデータを取得する必要があります）
        $tasks = Task::where('category_id', 4)->orderBy('id', 'DESC')->paginate(8);  // 仮の例です
        $goods = Good::all();
        $bookmarks = Bookmark::all();
        $comments = Comment::all();
        // ビューにデータを渡す
        return view('posts.transportation')->with('tasks', $tasks)->with('goods', $goods)->with('bookmarks', $bookmarks)->with('comments', $comments)->render();
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
            'image_at' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
         
        $task = new Task;
        $task->title = $request->input('title');
        $task->content = $request->input('content');
        $task->image_at = $request->input('image_at');
        $task->user_id = auth()->user()->id;

        return redirect('/tourist-spot')->with('success', 'Post created');
    
       
    }

    public function store(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:15',
                'contents' => 'required|max:100',
                'image_at' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
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
            $task->image_at = $request->input('image_at');
            $task->category_id = $request->input('category_id');
            $task->user_id = Auth::id();

              // 画像アップロード処理
            if ($request->hasFile('image_at')) {
                $image_at = $request->file('image_at');
                $imageName = time() . '_' . $image_at->getClientOriginalName();
                $image_at->storeAs('public/img', $imageName); // storage/app/public/img ディレクトリに保存
                $task->image_at = 'storage/img/' . $imageName; // シンボリックリンクを使用してアクセス
            }
            // 保存
            $task->save();
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('tourist-spot')->with('success', 'Post created');
     }   
    }

    public function storehotel(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:15',
                'contents' => 'required|max:100',
                'image_at' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];
    
            // バリデーション実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションが失敗した場合
        if ($validator->fails()) {
            return redirect()
                ->route('hotel') // リダイレクト先を適切に設定
                ->withErrors($validator) // エラーメッセージをセット
                ->withInput(); // フォーム入力データをセット
        }
            // 新しい投稿を作成
            $task = new Task();
            $task->title = $request->input('title');
            $task->contents = $request->input('contents');
            $task->image_at = $request->input('image_at');
            $task->category_id = $request->input('category_id');
            $task->user_id = Auth::id();

              // 画像アップロード処理
            if ($request->hasFile('image_at')) {
                $image_at = $request->file('image_at');
                $imageName = time() . '_' . $image_at->getClientOriginalName();
                $image_at->storeAs('public/img', $imageName); // storage/app/public/img ディレクトリに保存
                $task->image_at = 'storage/img/' . $imageName; // シンボリックリンクを使用してアクセス
            }
            // 保存
            $task->save();
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('hotel')->with('success', 'Post created');
     }   
    }

    public function storeFood(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:15',
                'contents' => 'required|max:100',
                'image_at' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];
    
            // バリデーション実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションが失敗した場合
        if ($validator->fails()) {
            return redirect()
                ->route('food') // リダイレクト先を適切に設定
                ->withErrors($validator) // エラーメッセージをセット
                ->withInput(); // フォーム入力データをセット
        }
            // 新しい投稿を作成
            $task = new Task();
            $task->title = $request->input('title');
            $task->contents = $request->input('contents');
            $task->image_at = $request->input('image_at');
            $task->category_id = $request->input('category_id');
            $task->user_id = Auth::id();

              // 画像アップロード処理
            if ($request->hasFile('image_at')) {
                $image_at = $request->file('image_at');
                $imageName = time() . '_' . $image_at->getClientOriginalName();
                $image_at->storeAs('public/img', $imageName); // storage/app/public/img ディレクトリに保存
                $task->image_at = 'storage/img/' . $imageName; // シンボリックリンクを使用してアクセス
            }
            // 保存
            $task->save();
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('food')->with('success', 'Post created');
     }   
    }


    public function storeTransportation(Request $request)
    {
       
        // ユーザーがログインしているかを確認
        if (Auth::check()) {
            // バリデーションルールを定義
            $rules = [
                'title' => 'required|max:15',
                'contents' => 'required|max:100',
                'image_at' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            ];
    
            // バリデーション実行
        $validator = Validator::make($request->all(), $rules);

        // バリデーションが失敗した場合
        if ($validator->fails()) {
            return redirect()
                ->route('transportation') // リダイレクト先を適切に設定
                ->withErrors($validator) // エラーメッセージをセット
                ->withInput(); // フォーム入力データをセット
        }
            // 新しい投稿を作成
            $task = new Task();
            $task->title = $request->input('title');
            $task->contents = $request->input('contents');
            $task->image_at = $request->input('image_at');
            $task->category_id = $request->input('category_id');
            $task->user_id = Auth::id();

              // 画像アップロード処理
            if ($request->hasFile('image_at')) {
                $image_at = $request->file('image_at');
                $imageName = time() . '_' . $image_at->getClientOriginalName();
                $image_at->storeAs('public/img', $imageName); // storage/app/public/img ディレクトリに保存
                $task->image_at = 'storage/img/' . $imageName; // シンボリックリンクを使用してアクセス
            }
            // 保存
            $task->save();
            // 成功時のリダイレクトなどの処理を追加
            return redirect()->route('transportation')->with('success', 'Post created');
     }   
    }

        public function ajaxlike(Request $request)
    {
        // 投稿にいいねを追加する
        $tasks = Task::find($request->id);
        $tasks->likes()->attach($request->user()->id);
        // レスポンスデータを返す
        return response()->json([
            'success' => true,
        ]);
    }

    public function bookmarkedByUsers()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'article_id', 'user_id')->withTimestamps();
    }


    public function edit($id)

    {
        // dd($id);
        $task = Task::where('id', $id)->first();
        // $tasks = Task::where('user_id', Auth::user()->id)->find($id);

        // Check if the post belongs to the authenticated user
        // if ($post->user_id !== Auth::user()->id) {
        //     return redirect()->route('posts.index')->with('error', 'Unauthorized access.');
        // }

        return view('post_list_edit')->with('task', $task);
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

        return redirect()->route('user.show', Auth::id())->with('success', 'Post updated successfully.');
    // }
        //return view('mypage', compact('tasks','user'));
    }

    public function destroy($id)
    {
     
        // dd("delete");
     $task = Task::find($id);
     if (!$task) {
         // タスクが見つからない場合の処理
         return redirect()->route('mypage.index')->with('error', 'Posting not found');
     }

    // 関連するブックマークを削除
     $task->bookmarks()->delete();
     // タスクが見つかった場合、削除処理を行う
     $task->delete();
     return redirect()->route('mypage.index')->with('success', 'Post has been deleted');

    }

    public function destroyHotel($id)
    {
     
        // dd("delete");
     $task = Task::find($id);
     if (!$task) {
         // タスクが見つからない場合の処理
         return redirect()->route('hotel')->with('error', 'タスクが見つかりませんでした。');
     }

    // 関連するブックマークを削除
     $task->bookmarks()->delete();
     // タスクが見つかった場合、削除処理を行う
     $task->delete();
     return redirect()->route('hotel')->with('success', 'Post has been deleted');

    }

    public function destroyFood($id)
    {
     
        // dd("delete");
     $task = Task::find($id);
     if (!$task) {
         // タスクが見つからない場合の処理
         return redirect()->route('food')->with('error', 'タスクが見つかりませんでした。');
     }

    // 関連するブックマークを削除
     $task->bookmarks()->delete();
     // タスクが見つかった場合、削除処理を行う
     $task->delete();
     return redirect()->route('food')->with('success', 'Post has been deleted');

    }


    public function destroyTransportation($id)
    {
     
        // dd("delete");
     $task = Task::find($id);
     if (!$task) {
         // タスクが見つからない場合の処理
         return redirect()->route('transportation')->with('error', 'Posting not found');
     }

    // 関連するブックマークを削除
     $task->bookmarks()->delete();
     // タスクが見つかった場合、削除処理を行う
     $task->delete();
     return redirect()->route('transportation')->with('success', 'Post has been deleted');

    }


}