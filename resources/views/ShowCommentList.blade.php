@foreach($cmt as $val)          
    <div class="media item_cmt" style='width:640px; padding:5px; font: Arial;'>
        <img src="" alt="avatar" class="mr-3 mt-3 rounded-circle" style="width:60px;">
        <div class="media-body">                    
            <div style='font-size:19px; font-weight:bold; color:blue'>{{ $val->user->name }}</div>
            <div style='font-size:16px'>{{$val->comment_content}}</div>
            <div><i style='font-size:14px;color:#999;'>{{$val->created_at}}</i></div>
        </div>
    </div>
@endforeach
