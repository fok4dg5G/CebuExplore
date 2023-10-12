@extends('layouts.CebuExplore1')
@section('content')
<form method="POST" action="{{ route('task.update', ['id'=> $task->id]) }}">
    @csrf
    @method('PUT')
    {{-- @if($task->user->id == Auth::user()->id) --}}
        <div class="self_post edit">
            <div class="post">
                <div class="three">
                    <img src="{{ asset($task->image_at) }}" width="150px" height="140px">
                </div>
                <div class="four">
                    <div>
                        <label for="title">TITLE</label>
                    <input type="text" value="{{ $task->title }}" name="title" id="title">
                    </div>
                
                    <div>
                        <label for="contents">CONTENT</label>
                        <textarea name="contents" id="contents" cols="30" rows="5">{{ $task->contents }}</textarea>
                    </div>
                </div>
            </div>
            <button type="submit" style="background: blue; color: white">UPDATE</button>
        </div>
    {{-- @else

    @endif --}}
</form>
@endsection
