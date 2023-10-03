@extends('layouts.CebuExplore')
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
    <div class="middle_up">
        <h5 >About Cebu Explore</h5>
        <img src="{{ asset('img/濃い青.png') }}" alt="">
        <p class="art1 p">Cebu Explore is  a new SNS site. <br>You can share the latest information 
        <br>and reviews about Cebu. <br>You might find the information you want here...</p>
    </div>
    <div class="middle_down">
        <h5>Cebu News</h5>
        <img src="{{ asset('img/薄い青.png') }}" alt="">
        <p class="art2 p">Cebu Explore is  a new SNS site. <br>You can share the latest information 
        <br>and reviews about Cebu. <br>You might find the information you want here...</p>
    </div>
    <h5 class="last_p">What do you want to know about ?</h5>
</div>
{{-- ------------------------------------------------------------------------ --}}
<div class="low"> 
    <a href="#" class="btn_low">#TouristSpost</a>
    <a href="#" class="btn_low">#Hotel</a>
    <a href="#" class="btn_low">#Food</a>
    <a href="#" class="btn_low">#Transportation</a>
</div>
{{-- ------------------------------------------------------------------------------------- --}}
@endsection