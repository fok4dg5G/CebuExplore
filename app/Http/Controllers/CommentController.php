<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function index (Request $request, $id) {

        $tasks = Task::all();
        // dd("test");
        $specificComments = Comment::where('task_id', $id)->with('user')->get();
        return view('posts.tourist-spot-comments')->with('specificComments', $specificComments)->with('tasks', $tasks)->render();

    }

    public function store(Request $request)
    {
        // dd("test");
        $comment = new Comment;
        $comment->body = $request->input('comment');
        $comment->task_id = $request->input('task_id');
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->route('tourist-spot', ['task_id' => $comment->task_id]);
    }

    public function storeFood(Request $request)
    {
        // dd("test");
        $comment = new Comment;
        $comment->body = $request->input('comment');
        $comment->task_id = $request->input('task_id');
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->route('food', ['task_id' => $comment->task_id]);
    }

    public function storeHotel(Request $request)
    {
        // dd("test");
        $comment = new Comment;
        $comment->body = $request->input('comment');
        $comment->task_id = $request->input('task_id');
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->route('hotel', ['task_id' => $comment->task_id]);
    }
    public function storeTranspo(Request $request)
    {
        // dd("test");
        $comment = new Comment;
        $comment->body = $request->input('comment');
        $comment->task_id = $request->input('task_id');
        $comment->user_id = Auth::id();
        $comment->save();
        return redirect()->route('transportation', ['task_id' => $comment->task_id]);
    }
    }