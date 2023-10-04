<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CebuExplore</title>
    <link rel="stylesheet" href="{{ asset('css/CebuExplore.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mypage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcom.css') }}">
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="head">
            <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" class="aa"></a>
            <form action="">
                @csrf
                <input type="text" class="search aa">
            </form>
            <a href=""><i class="fa-solid fa-magnifying-glass header-img aa" ></i></a>
            @if (Auth::check())
                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
                    <i class="fa-regular fa-user header-img aa"></i>
                </a>
            @else
            <!-- ログインしていないユーザーに対する代替コンテンツをここに追加 -->
            @endif
        </div>
    </header>
    @yield('content')
    <footer>
        <div class="footer">
            <img src="{{ asset('img/logo.png') }}" class="fot_pic">
            <a href="#" class="btn_footer">#TouristSpost</a>
            <a href="#" class="btn_footer">#Hotel</a>
            <a href="#" class="btn_footer">#Food</a>
            <a href="#" class="btn_footer">#Transportation</a>
        </div>
    </footer>
</body>
</html>