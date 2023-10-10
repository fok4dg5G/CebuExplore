@extends('layouts.CebuExplore1')
@section('content')
        {{-- ----------------------------------------------------------------------------------------------- --}}
        {{-- マイページの編集 --}}
        <div class="mypage-wrapper">
            <div class="mypage-update">
                <form method="POST" action="{{ route('user.update',$user->id) }}">
                    @csrf
                    @method('PUT')
                    <h1>MYPAGE</h1>
                    <div class="self_containar">
                        <div class="one">
                            <img src="{{ asset('storage/images/' . $user->avatar) }}" alt="" class="self">
                            <label for="image">Image selection</label>
                        </div>
                        {{-- <input type="text" value="{{ $user->avatar }}" name="avatar" > --}}
                        <div class="two">
                            <label for="name">name</label>
                            <input type="text" value="{{ $user->name }}" name="name" class="input-name">

                            <label for=""><br>E-mail</label>
                            <input type="text" value="{{ $user->email }}" name="email" class="input-email">

                            <!-- パスワードは表示しない（セキュリティ上の理由） -->

                            <label for=""><br>Password</label>
                            <input type="password" name="password" value="{{ $user->password }}">

                            <button type="submit" href><i class="fa-regular fa-pen-to-square btn"> update</i></button>
                       </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
