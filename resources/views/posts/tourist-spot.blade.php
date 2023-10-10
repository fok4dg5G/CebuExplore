@extends('layouts.app')
{{-- <link rel="stylesheet" href="{{ asset('css/index.css') }}"> --}}
@section('content')
@if (session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

<div class="container custom">
    <div class="posts-section">
        <h3 class="header-title2">Tourist Spot</h3>

        <div class="container">  
            <!-- 以下はループでタスクを表示する例です -->
<div class="posts-posts">
@foreach ($tasks as $task)

    <div class="posts-box">
        <label for="title" class="form-label">Title : {{ $task->title }}</label><br>
        @if($task->image_at)
        <img src="{{ asset($task->image_at) }}" alt="Image" width="150px" height="100px">
        @endif

        {{-- <div id="imageDisplay2">{{ $task->image_at }}</div> --}}
        <div  class="functions">
            <label for="content" class="form-label">Content : <br>{{ $task->contents }}</label><br><br><br>
            
            <div class="function-box">
                <img src="images/delete.png" alt="" width="12px" height="15px">
                <img src="images/dele.png" alt="" width="11px" height="15px">
                <img src="images/like.png" alt="" width="15px" height="15px">
            <div>        
        </div>
        </div> 
        </div> 
        <div class="datecreate">
            <th >date created: <br>
                {{ $task->created_at }}</th><br>
        </div>
        
        <thead>
        <label for="comment" class="form-label">Comment :</label><br>
        <img src="images/jolli.jpg" class="img-thumbnail" alt="...">
        </thead>
        
        <div class="yahho">
            <input type="text" class="comment-box" id="comment">
            <div>
               
                <img src="images/plain.png" alt="" width="20px" height="20px">
            </div>
        </div>
    </div>


@endforeach

        
    </div>
    <div class="create-post-section">
        <h3 class="header-title">New post</h3>
        <div class="create-post">
            <form class="d-flex justify-content-evenly" method="POST" action="{{ route('tourist-spot.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="parent">
                    <div class="mb-3">
                        <p>Image</p>
                        <img id="imageDisplay"/>
                        <label for="image" class="form-label label-center">Image selection</label>
                        <input type="file" class="form-control d-none" id="image" aria-describedby="emailHelp" name="image" onchange="showImage(event)">
                      </div>
                </div>
                <div class="parent">
                    
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control title" id="title" name="title">
                    <label for="content" class="form-label">Content</label><br>
                    <textarea name="contents" id="content" class="content"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary custom-btn">Submit</button>
                
              </form>
        </div>
    </div>
    </div>
</div>
@endsection
@push('js')
    <script>1
            function showImage(event) {
                var selectedFile = event.target.files[0]
                var reader = new FileReader()

                var img = document.getElementById("imageDisplay")
                img.title = selectedFile.name

                reader.onload = function(event) {
                    img.src = event.target.result
                }

                reader.readAsDataURL(selectedFile)
            }
    </script>
@endpush

