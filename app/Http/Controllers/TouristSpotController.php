<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

// ...

function index()
{
    $posts = Post::latest()->paginate(10); // 新しい投稿から表示し、1ページあたり10件表示
    return view('touristspot.blade', ['posts' => $posts]);
}

function show($id)
{
    $post = Post::findOrFail($id);
    $comments = $post->comments;
    return view('touristspot.show', compact('post', 'comments'));
}

function storeComment(Request $request, $postId)
{
    $validatedData = $request->validate([
        'text' => 'required|max:255',
    ]);

    Comment::create([
        'post_id' => $postId,
        'user_id' => Auth::user()->id,
        'text' => $request->input('text'),
    ]);

    return redirect()->back();
}

function create()
{
    return view('touristspot.create'); // 新規投稿フォームを表示
}

function store(Request $request)
{
    $validatedData = $request->validate([
        'image' => 'required|image',
        'title' => 'required',
        'text' => 'required',
    ]);

    // 画像アップロードとデータベースへの保存処理を追加

    return redirect()->route('touristspot'); // 一覧にリダイレクト
}

// function show($id)
// {
//     $post = Post::findOrFail($id);
//     $comments = $post->comments;
//     return view('tourist.show', compact('post', 'comments'));
// }

// function storeComment(Request $request, $postId)
// {
//     $validatedData = $request->validate([
//         'text' => 'required|max:255',
//     ]);

//     Comment::create([
//         'post_id' => $postId,
//         'user_id' => Auth::user()->id,
//         'text' => $request->input('text'),
//     ]);

//     return redirect()->back();
// }



