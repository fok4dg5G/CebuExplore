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
    
@foreach($tasks as $task)
    @if($task && $task->user)
        <div class="self_post">
            <div class="three">
                <img src="{{ asset($task->image_at) }}" width="90px" height="70px">
            </div>
            <div class="moji">
                <p>Title {{ $task->title }}</p>
                <p>Content {{ $task->contents }}</p>
            </div>
            <div>
                @if($task->user->id == Auth::user()->id)
                    <form action="{{ route('task.edit', ['id' => $task->id]) }}" method="GET">
                        <button type="submit" class="btn btn-edit">
                            <i class="fa-solid fa-file-pen"></i>
                        </button>
                    </form>
                    <form method="POST" action="{{ route('task.destroy', ['id' => $task->id]) }}">
                        @csrf
                        @method('delete')
                        <input type="submit" value="delete">
                    </form>
                @endif
            </div>
        </div>
    @endif
@endforeach

    </div>


<h1 class="text-center my-30">Bookmark  List</h1>
<div class="container custom">
    @if(isset($bookmarks))
    <!-- $bookmarks 変数が存在する場合のコード -->  
    
    @foreach ($bookmarks as $bookmark)
  
    <div class="card custom mb-3">
        <div class="card-body">
            <img src="{{ asset($bookmark->image_at) }}" alt="{{ $bookmark->title }}" class="bookmark-img">
            <h5 class="card-title">Title : {{ $bookmark->title }}</h5>
            <p class="card-text">Content : {{ $bookmark->contents }}</p>
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
   
@push('js')
    <script>
function addLineBreaks(textarea) {
    // 入力テキストを取得
    const inputText = textarea.value;

    // 20文字ごとに改行文字を挿入
    const newText = inputText.replace(/(.{15})/g, '$1\n');

    // テキストエリアに新しいテキストをセット
    textarea.value = newText;
}

</script>
@endpush

