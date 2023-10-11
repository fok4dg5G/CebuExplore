@extends('layouts.CebuExplore1')
@section('content')
{{------------------------------------------------------------------------- --}}
<div class="content">
    <h1 class="title bb">CEBU <br>EXPLORE</h1>
    <p class="bb">Let's share new information <br>about Cebu Island</p>
    @if (Route::has('login'))
        <div class="btn-container">
            @auth
                <!-- ユーザーがログインしている場合 -->
                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}"></a>
                <a href="{{ route('logout') }}" class="btn logout_btn" 
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                <!-- ログアウトのフォーム -->
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <!-- ユーザーがログインしていない場合 -->
                <a href="{{ route('login') }}" class="btn">Log in</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn">Register</a>
                @endif
            @endauth
        </div>
    @endif

</div>
{{-- ---------------------------------------------------------------------------- --}}
<div class="middle">

</div>
{{-- ------------------------------------------------------------------------ --}}
<div class="low"> 
    <a href="{{ route('tourist-spot') }}" class="btn_low">#TouristSpost</a>
    <a href="{{ route('hotel') }}" class="btn_low">#Hotel</a>
    <a href="{{ route('food') }}" class="btn_low">#Food</a>
    <a href="{{ route('transportation') }}" class="btn_low">#Transportation</a>
</div>
{{-- ------------------------------------------------------------------------------------- --}}
@endsection