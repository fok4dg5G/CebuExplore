@extends('layouts.CebuExplore1')
{{-- <link rel="stylesheet" href="{{ asset('css/mypage.css') }}"> --}}
@section('content')
{{-- ----------------------------------------------------------------------------------------------- --}}
{{-- マイページの編集 --}}
<div class="mypage-wrapper">
    <div class="mypage-update">
        <form method="POST" action="{{ route('user.edit',['id' => $user->id]) }}">
            @csrf
            <h1>MYPAGE</h1>
            <div class="self_containar">
                <div class="one">
                    <img src="{{ asset('storage/images/' . $user->avatar) }}" class="self">

                    <label for="image">Image selection</label>
                </div>
                <div class="two">
                    <label for="name">name</label>
                    <input type="text" value="{{ $user->name }}" name="name" class="input-name">

                    <label for=""><br>E-mail</label>
                    <input type="text" value="{{ $user->email }}" name="email" class="input-email">

                    <!-- パスワードは表示しない（セキュリティ上の理由） -->

                    {{-- <label for="">Password</label>
                    <input type="password" name="password" value="{{ $user->password }}">

                    <label for="">Password</label>
                    <input type="password" name="password" value="{{ $user->password }}"> --}}
                    <button type="submit" href><i class="fa-regular fa-pen-to-square btn"> EDIT</i></button>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- ------------------------------------------------------------------------- --}}
{{-- ポストリストの編集 --}}
<div class="Task_Bookmark">
    <h1>POSTS LIST</h1>
    <div>
        @foreach ($tasks as $task)
            <form method="POST" action="{{ route('task.edit',['id'=>$task->id]) }}">
                @csrf
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
                        <button type="submit"><i class="fa-solid fa-file-pen"></i></button>
                    </div>
                    @else
                    
                    <p>

                        <form method="POST" action="{{ route('task.destroy',['id'=>$task->id]) }}">
                            @csrf
                            @method('delete')
                            <input type="submit" value="delete">
                        </form>
                    </p>
                @endif
            </form>
            
        @endforeach
        <form method="POST" action="{{ route('task.destroy',['id'=>$task->id]) }}">
            @csrf
            @method('delete')
            <input type="submit" value="delete">
        </form>
    </div>

    {{-- ------------------------------------------------------------------------------------ - --}}
    {{-- ブックマークの編集 --}}
    <h1>BOOKMARK</h1>
    <div class="card">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
            <h5>title</h5>
            <i class="fa-solid fa-bookmark"></i>
            <i class="fa-solid fa-heart"></i>
            <p>内容</p>
            <p class="card-text">コメント</p>
            <button><i class="fa-solid fa-eraser"></i></button>
        </div>
    </div>
</div>
@endsection
   