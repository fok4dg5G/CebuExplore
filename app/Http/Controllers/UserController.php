<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;



class UserController extends Controller
{
    //
    // app/Http/Controllers/Auth/RegisterController.php

    public function show($id)
    {
        // dd($id);
        $user = User::find($id);
        // dd($user);
        return view('mypage', compact('user'));
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
