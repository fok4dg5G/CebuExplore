@extends('layouts.CebuExplore')
@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- <div class="container custom">
        <div class="posts-section"> --}}
    <h3 class="header-title2">Tourist Spot</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- <div class="container">   --}}
                <!-- 以下はループでタスクを表示する例です -->

    <div class="posts-posts">
    @foreach ($tasks as $task)
        <div class="posts-box" >
            <label for="title" class="form-label">Title : {{ $task->title }}</label><br>
            @if($task->image_at)
            <img src="{{ asset($task->image_at) }}" alt="Image" width="170px" height="130px" margin="20px">
            @endif
            <div class="functions">
                <form action="{{ route('bookmarks.add', ['task_id' => $task->id]) }}" method="POST" id="bookmarkForm">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    <img src="images/dele.png" alt="" width="11px" height="15px" type="button" onclick="$(this).closest('form').submit()">
                    <button type="submit" class="btn btn-primary hidden">ブックマーク追加</button>
                </form>
                
            @if($goods->firstWhere('task_id', $task->id))
                <img onclick="like({{ $task->id }})" src="images/Red1.png" alt="" width="20px" height="20px">
            @else 
                <img onclick="like({{ $task->id }})" src="images/like.png" alt="" width="15px" height="15px">
            @endif
                <img src="images/delete.png" alt="" width="18px" height="20px">
    </div>


            
            <div class="content-box">{{ $task->contents }}</label></div>

            <div class="function-box">
                <div class="datecreate">
                    <th >date created:  &emsp; {{ $task->created_at }}</th><br>
                </div>
            </div> 
            <label for="comment" class="form-label">Comment :</label><br>
            <img src="images/jolli.jpg" class="img-thumbnail" alt="...">
        
            <div class="yahho">
                <input type="text" class="comment-box" id="comment">
                <div>
                    <img src="images/plain.png" alt="" width="20px" height="20px">
                </div>
            </div>
        </div>

    @endforeach
        </div>


    <!-- ページネーションリンクの表示 -->
    <div class="pagination-links ">
        {{ $tasks->links() }}
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
                        <textarea name="contents" id="content" class="content" oninput="addLineBreaks(this)"></textarea>
                    </div>
                    
                    {{-- <button type="submit" class="btn btn-primary custom-btn">Submit</button> --}}
                    
                </form>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
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

            function addLineBreaks(textarea) {
                // 入力テキストを取得
                const inputText = textarea.value;

                // 20文字ごとに改行文字を挿入
                const newText = inputText.replace(/(.{20})/g, '$1\n');

                // テキストエリアに新しいテキストをセット
                textarea.value = newText;
            }

        function like(taskId) {
            console.log(taskId)
            $.ajax({
                headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                url: "/task/like",
                type: "POST",
                data: {
                    task_id: taskId
                },
                success: function(res) {
                    console.log("success")
                    location.reload()
                },
                error: function(res) {
                    console.log(res)
                }
            })          
        }

        function submitForm() {
            let form = document.getElementById('bookmarkForm')
            form.submit();
        }


    </script>
@endpush

