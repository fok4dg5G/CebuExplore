<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CebuExplore</title>
    <link href="{{ asset('css/tourist-spot.css')}}" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v6.4.2/css/all.css" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <header class="header">
        <div style="display: flex; align-items: center; border solid 1px black">
            <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.png') }}" style="margin-right: 10px; height: 40px;
            }"></a>
           <form method="GET" action="{{ route('tasks.search') }}">
            <input type="search" placeholder="search" name="search" value="{{ $search ?? '' }}">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
           </form>
        
            @if (Auth::check())
                <a href="{{ route('user.show', ['id' => Auth::user()->id]) }}">
                    <img src="{{ asset('storage/images/' . Auth::user()->avatar) }}" alt="" class="self" width="30px" height="30px" border-radius="50px">
                </a>
            @else
            <!-- ログインしていないユーザーに対する代替コンテンツをここに追加 -->
            @endif
        </div>
    </header>
    @yield('content')
    <footer class="footer">
        <div class="footer">
            <img src="{{ asset('img/logo.png') }}" style="height: 40px;">
            <a href="#" style="font-size: 10px; text-decoration: none; color: black; border: 0.5px solid black;">#TouristSpost</a>
            <a href="#" style="font-size: 10px; text-decoration: none; color: black; border: 0.5px solid black;   ">#Hotel</a>
            <a href="#" style="font-size: 10px; text-decoration: none; color: black; border: 0.5px solid black;    ">#Food</a>
            <a href="#" style="font-size: 10px; text-decoration: none; color: black; border: 0.5px solid black;    ">#Transportation</a>
        </div>
    </footer>
    @stack('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        setTimeout(() => {
            document.querySelector('.alert').style.display = "none"
        }, 5000);
        function showAll(taskId) {
            //  alert(taskId)
            $.ajax({
                headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "task/comments/"+taskId,
                type: "GET",
                success: function(res) {
                    $("#allComments").html(res);
                    // alert(res)
                },
                error: function(res) {
                    console.log(res)
                }
            })  
}
    </script>
</body>
</html>