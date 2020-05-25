@extends('layouts.app')

@section('content')

@if(session('thongbao'))
    {{sesion('thongbao')}}
@endif
    
    <div class='container'>
        <div class='video'>
            <video width='640' controls="control">
                <source src="/upload/video/{{$dat->video_name}}" type='video/mp4'>
                <source src="/upload/video/{{$dat->video_name}}" type='video/ogg'>
                <source src="/upload/video/{{$dat->video_name}}" type='video/webm'>
            </video>
            <p><b>Video: {{$dat->video_name}}</b></p>
        </div>
        @if(Auth::check())
        <div class='comment'>
            <!-- $url=route('comment',['id'=>$dat->id]); -->
            <form action="{{ route('comment', $dat->id)}}" method='post'>
                @csrf
                <!-- <input type="text" name='comment' placeholder='Nhập bình luận'> -->
                <label for="comment">Comment</label><br>
                <textarea name="comment" id="comment" placeholder="Write comment.." style="width:600px"></textarea><br>
                <button type='submit' clas='btn btn-primary' style="background-color:blue;color:red">Enter</button>
            </form>
        </div>

        <div class='show-comment'>
            <p>Noi hien comment</p>
        </div>
        @endif
    </div>

@endsection
