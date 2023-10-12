@extends('layouts.CebuExplore')
@section('content')
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container custom">
        <div class="posts-section">
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


    <div class="container post">  
                <!-- 以下はループでタスクを表示する例です -->
    @foreach ($tasks as $task)
    <div class="posts-posts">
    
        <div class="posts-box" >
            <label for="title" class="form-label">Title : {{ $task->title }}</label><br>
            @if($task->image_at)
            <img src="{{ asset($task->image_at) }}" alt="Image" width="170px" height="130px" margin="30px" >
            @endif
            <div class="functions">
                <form action="{{ route('bookmarks.add', ['task_id' => $task->id]) }}" method="POST" id="bookmarkForm">
                    @csrf
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                    @if($bookmarks->firstWhere('task_id', $task->id))
                        <img src="images/amibook.png" alt="" width="15px" height="20px" type="button" onclick="$(this).closest('form').submit()">
                    @else
                        <img src="images/dele.png" alt="" width="15px" height="20px" type="button" onclick="$(this).closest('form').submit()">
                    @endif
                </form>
                @if($goods->firstWhere('task_id', $task->id))
                    <img onclick="like({{ $task->id }})" src="images/Like4.png" alt="" width="22px" height="22px">
                @else 
                    <img onclick="like({{ $task->id }})" src="images/like5.png" alt="" width="20px" height="20px">
                @endif
                    {{-- <td> --}}
                        @if($task->user_id == Auth::id())
                            <form action="{{ route('task.destroy',['id'=>$task->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <button type="submit" class="deletebtn"><img src="images/delete.png" alt=""  width="18px" height="20px"></button>
                            </form>
                        @endif
                    {{-- </td> --}}
                    {{-- <img onclick="deleteTask({{ $task->id }})"  src="images/delete.png" alt="" width="18px" height="20px"> --}}
            </div>
            <div class="content-box">{{ $task->contents }}</label></div>
            <div class="function-box">
                <div class="datecreate">
                    <th >date created:  &emsp; {{ $task->created_at }}</th><br>
                </div>
                <label for="comment" class="form-label">Comment :</label><br>
                @foreach($comments as $comment)
                       @if($comment->task_id == $task->id)
                           <div>{{ $comment->body }}</div>
                       @endif
                @endforeach
                   
            </div>
            <div class="yahho">
                {{-- <input type="text" class="comment-box" id="comment">
                <div onclick="">
                    <img src="images/plain.png" alt="" width="20px" height="20px" >
                </div> --}}
                <form action="{{ route('comment.add', ['task_id' => $task->id]) }}" method="POST" class="commentForm">
                @csrf
                <input type="text" class="comment-box" id="comment" name="comment">
                <input type="number" class="comment-box" id="task_id" name="task_id" value="{{ $task->id }}" hidden>
                <div onclick="$(this).closest('form').submit()">
                    <img src="images/plain.png" alt="" width="20px" height="20px">
                </div>
            </form>
            <button type="button" class="showbtn" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="showAll({{ $task->id }})">
                Show Comments
              </button>
        </div>
        </div>
         
            
                   {{-- <img src="images/jolli.jpg" class="img-thumbnail" alt="..."> --}}
        
            
            </div>
        @endforeach
        </div>
       
  

    <!-- ページネーションリンクの表示 -->
    <div class="pagination-links">
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
                            <input type="file" class="form-control d-none" id="image" aria-describedby="emailHelp" name="image_at" onchange="showImage(event)">
                        </div>
                    </div>
                    <div class="parent">
                        <input type="number" name="category_id" value="1" hidden>
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control title" id="title" name="title">
                        <label for="content" class="form-label">Content</label><br>
                        <textarea name="contents" id="content" class="content" oninput="addLineBreaks(this)"></textarea>
                    </div>
                    <div class="parent">
                    
                        <button type="submit" class="btn btn-primary custom-btn">Submit</button>

                </form>
            </div>
        </div>
    </div>

    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Comments</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="user-comments">
         <div>
            <img src="../img/メイン背景画像.png" alt="">
            <div>コメント</div>
         </div>

  </div>
        <div class="modal-body" id="allComments">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                const newText = inputText.replace(/(.{15})/g, '$1\n');

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
                    console.log('hello')
                    console.log($('meta[name="csrf-token"]').attr("content"))
                    console.log(res.errors)
                    location.reload()
                }
            })          
        }

        



        function submitForm() {
            let form = document.getElementById('bookmarkForm')
            form.submit();
        }

        function deleteTask(taskId) {
    if (confirm('タスクを削除してもよろしいですか？')) {
        // ユーザーが確認したら削除リクエストを送信
        console.log(taskId)
        $.ajax({
            url: '/tourist-spot/' + taskId, // タスクのIDに応じてURLを設定
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
                // サーバーからの成功レスポンスを処理する
                if (response.success) {
                    // タスクが正常に削除された場合、ページをリロードまたは必要な処理を実行
                    location.reload(); // または別の処理を実行
                } else {
                    alert('タスクの削除に失敗しました。');
                }
            },
            error: function (xhr, textStatus, error) {
                // エラーレスポンスを処理する
                alert('エラーが発生しました。');
                console.log(xhr.responseText);
            }
        });
    }
}



    </script>
@endpush

