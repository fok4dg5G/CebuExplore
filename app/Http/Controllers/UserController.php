<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    //
    // app/Http/Controllers/Auth/RegisterController.php

    public function show($id)
    {
        // dd($id);
        $user = User::find($id);
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
        return view('mypage')->with('user', $user)->with('bookmarks', $bookmarked_post);
    }

    public function edit($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);
        return view('mypage_edit', compact('user'));
    }

    public function update(Request $request,$id)
    {
        $user = User::find($id);

        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> password = $request -> password;

        $user -> save();
        return view('mypage',compact('user'));
    }


    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'avatar' => $data['avatar']->store('avatars', 'public'), // アバター画像の保存
    //     ]);
    // }
}
