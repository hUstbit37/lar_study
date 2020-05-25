
@foreach ($comment as $value)
    <div class="media" style='width:640px; padding:5px; font: Arial;'>
        <img src="" alt="avatar" class="mr-3 mt-3 rounded-circle" style="width:60px;">
        <div class="media-body">
            <!-- <h4>{{ $value->name }} <small><i>{{$value->created_at}}</i></small></h4> -->
            <div style='font-size:19px; font-weight:bold; color:blue'>{{ $value->user->name }}</div>

            <div style='font-size:16px'>{{$value->comment_content}}</div>
            <div><i style='font-size:14px;color:#999;'>{{$value->created_at}}</i></div>
                            
        </div>
    </div>
@endforeach

{!! $comment->links() !!}