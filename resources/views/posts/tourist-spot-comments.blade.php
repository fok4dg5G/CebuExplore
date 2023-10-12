@foreach($specificComments as $comment)
    <div class="avatar-container"><img src="{{ asset('storage/images/' . $comment->user->avatar) }}" alt="Image" class="avatar"><span style="margin-right: 30px">{{ $comment->user->name }} </span>-  {{ $comment->body }}</div>
@endforeach