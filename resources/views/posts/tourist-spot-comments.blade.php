@foreach($specificComments as $comment)
    <div>{{ $comment->body }} - <img src="{{ asset($comment->user->avatar ) }}" alt="Image" width="170px" height="130px" margin="20px"></div>
    
@endforeach

