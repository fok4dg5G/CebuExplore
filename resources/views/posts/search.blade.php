@extends('layouts.CebuExplore')
@section('content')
<div class="posts-posts">
    @foreach ($tasks as $task)
        <div class="posts-box" >
            <label for="title" class="form-label">Title : {{ $task->title }}</label><br>
            @if($task->image_at)
                <img src="{{ asset($task->image_at) }}" alt="Image" width="170px" height="130px" margin="20px">
            @endif
            {{-- <div class="functions">
                <form action="{{ route('bookmarks.add', ['task_id' => $task->id]) }}" method="POST" id="bookmarkForm">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <img src="images/dele.png" alt="" width="11px" height="15px" type="button" onclick="$(this).closest('form').submit()">
                    <button type="submit" class="btn btn-primary hidden">ブックマーク追加</button>
                </form>
            </div> --}}
                <div class="content-box">{{ $task->contents }}</label></div>
            <div class="function-box">
                <div class="datecreate">
                    <th >date created:  &emsp; {{ $task->created_at }}</th><br>
                </div>
            </div>
            {{-- <label for="comment" class="form-label">Comment :</label><br> --}}
            <img src="images/jolli.jpg" class="img-thumbnail" alt="...">
{{--
            <div class="yahho">
                <input type="text" class="comment-box" id="comment">
                <div>
                    <img src="images/plain.png" alt="" width="20px" height="20px">
                </div>
            </div> --}}
        </div>
    @endforeach
@endsection