@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>投稿一覧</h1>
        @foreach ($tasks as $task)
            @if (session('success'))
             <div class="alert alert-success">
             {{ session('success') }}
             </div>
            @endif

    <table class="table">
        <thead>
            <tr>
                <th>タイトル{{$task->title }}</th>

                <th>内容{{ $task->body }}</th>

                <th>作成日時{{ $task->created_at }}</th>
            
        @endforeach   
@endsection