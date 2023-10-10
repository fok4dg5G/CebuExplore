@extends('layouts.CebuExplore1')
@section('content')
<form method="POST" action="{{ route('task.update', ['id'=> $task->id]) }}">
    @csrf
    @method('PUT')
    @if($task->user->id == Auth::user()->id)
        <div class="self_post">
            <div class="three">
                <img src="{{ asset('storage/images/' . $task->image_at) }}" width="150px" height="140px">
            </div>
            <div class="four">
                <label for="title">TITLE</label>
                <input type="text" value="{{ $task->title }}" name="title">
            
                <br><label for="content">CONTENT</label>
                <br><textarea name="content" cols="30" rows="5">{{ $task->contents }}</textarea>
            </div>
            <button type="submit">UPDATE</button>
        </div>
    @else

    @endif
</form>
@endsection
