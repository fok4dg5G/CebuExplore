<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    //
    // app/Http/Controllers/Auth/RegisterController.php

    public function show($id)
    {
        // dd($id);
        $user = User::find($id);
        $tasks = Task::all();
        $bookmarks = User::find($id)->bookmarks;
        // dd($bookmarks);

        $bookmarked_post = [];

        foreach($bookmarks as $bookmark ) {
            $post_to_push = Task::where('id', $bookmark->task_id)->first();
            // dd($post_to_push);
            if($post_to_push) {
                // array_push($bookmarked_post, $post_to_push);
                $bookmarked_post[] = $post_to_push;
            }
        }

        // dd($user);
        return view('mypage')->with('user', $user)->with('bookmarks', $bookmarked_post)->with('tasks', $tasks);

    }
    

    public function edit($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);

        $tasks = Task::all();
        // dd($tasks);
        return view('mypage_edit', compact('user','tasks'));
    }


    public function update(Request $request, $id)
    {
        // dd($id);
        // dd($request);
        $user = User::find($id);
        // dd($user);
        $user->name = $request->name;
        $user->email = $request->email;
        // パスワードの更新は別途処理が必要ですが、この例ではそのまま代入しています。
        $user->password = $request->password;

        $user->save();

        $tasks = Task::all();
        // dd($tasks);
        return view('mypage', compact('user', 'tasks'));
    }

}
