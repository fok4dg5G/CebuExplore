@extends('layouts.CebuExplore1')
@section('content')
    <h1>TouristSpot Posts</h1>

    @foreach ($posts as $post)
        <div class="post">
            <img src="{{ $post->image }}" alt="{{ $post->title }}">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->text }}</p>
            
            <!-- コメントフォームを表示 -->
            <form method="post" action="{{ route('tourist.comments.store', $post->id) }}">
                @csrf
                <div class="form-group">
                    <label for="text">コメント</label>
                    <input type="text" name="text" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">コメントする</button>
            </form>
            
            <a href="{{ route('tourist.show', $post->id) }}">詳細を見る</a>
        </div>
    @endforeach

    <!-- ページングリンクを表示 -->
    {{ $posts->links() }}

    <!-- 新規投稿フォームを表示 -->
    <h2>新規投稿</h2>
    <form method="post" action="{{ route('tourist.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="image">画像</label>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" class="form-control">
        </div>
        <div class="form-group">
            <label for="text">文章</label>
            <textarea name="text" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">投稿する</button>
    </form>
@endsection