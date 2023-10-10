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
    {{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>
<body>
    <header>
        <div class="head-cebu">
            <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" class="aa-b"></a>
            <form action="">
                @csrf
                <input type="text" class="search aa-b">
            </form>
            <a href=""><i class="fa-solid fa-magnifying-glass header-img aa-b" ></i></a>
            @if (Auth::check())
                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
                    <img src="{{ asset('storage/images/' . $user->avatar) }}" alt="" class="self">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>