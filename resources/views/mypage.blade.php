@extends('layouts.CebuExplore')
@section('content')
{{-- ----------------------------------------------------------------------------------------------- --}}
{{-- マイページの編集 --}}
<div class="mypage-wrapper">
    <div class="mypage-update">
        <form method="POST" action="{{ route('user.edit',$user->id) }}">
            @csrf
            <h1>MYPAGE</h1>
            <div class="self_containar">
                <div class="one">
                    <img src="{{ asset('storage/img/' . $user->avatar) }}" alt="" class="self">
                    <label for="image">Image selection</label>
                </div>
                {{-- <input type="text" value="{{ $user->avatar }}" name="avatar" > --}}
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
{{-- <div class="postlist-wrapper">
    <h1>POSTS LIST</h1>
    <div class="postlist-update">
        @foreach($tasks as $task)
        <form action="">
            <div class="col-md-4">
                {{ $task->image_at }} <!-- image_at が Task モデルのプロパティであると仮定 -->
                <img src="{{ $task->image_path }}" class="img-fluid rounded-start" >
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $task->title }}</h5>
                    <p class="card-text">{{ $task->contents }}</p>
                    <button><i class="fa-regular fa-pen-to-square"></i></button>
                    <button><i class="fa-solid fa-eraser"></i></button>
                </div>
            </div>
        </form>
        @endforeach

    </div>
</div> --}}
{{-- ------------------------------------------------------------------------------------------- --}}
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

<h2 class="text-center my-30">Bookmark  List</h2>
<div class="container">
    @if(isset($bookmarks))
    <!-- $bookmarks 変数が存在する場合のコード -->  
    
    @foreach ($bookmarks as $bookmark)
  
    <div class="card mb-3 " >
        <div class="card-body">
            <img src="{{ asset($bookmark->image_at) }}" alt="{{ $bookmark->title }}" width="170px" height="100px">
            <h5 class="card-title">{{ $bookmark->title }}</h5>
            <p class="card-text">{{ $bookmark->contents }}</p>
            <form action="{{ route('bookmarks.remove', ['task_id' => $bookmark->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn custom"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                  </svg></button>
            </form>
        </div>
    </div>
    @endforeach
    @else
        <!-- $bookmarks 変数が存在しない場合のコード -->
        <p>No bookmarks found.</p>
    @endif
    {{-- {{ $bookmarks }} --}}
    
</div>
@endsection
   