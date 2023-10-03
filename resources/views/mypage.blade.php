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
@endsection
   