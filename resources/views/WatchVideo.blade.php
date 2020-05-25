@extends('layouts.app')

@section('scripts')
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
     -->
    
@endsection

@section('content')
 
    
    
<div class='container'>
    <video width='640' controls>
        <source src="/upload/video/{{$video_watch->video_name}}" type='video/mp4'>
        <source src="/upload/video/{{$video_watch->video_name}}" type='video/ogg'>
        <source src="/upload/video/{{$video_watch->video_name}}" type='video/webm'>
    </video><br>

    <div style='width:640px;padding-bottom:15px;font-size:20px'>
        <strong>{{$video_watch->video_name}}</strong>
    </div>

    
        <form action="{{route('postcomment', $video_watch->id)}}" method='POST' class='form-horizontal' id='form_input_comment'>
            @csrf
            <input type="hidden" value='{{$video_watch->id}}' name='id'>
            <label for="comment_area" style='font-weight:bold'>Comment hear</label><br>
            <textarea name="comment" id="comment_area" placeholder="Write comment.." style="width:640px"></textarea><br>
            <button type='submit' class='btn btn-primary comment_button' style="color:red">Enter</button>
        </form>

    

    
        @if ( Session::has('thongbao'))
            <div class="alert alert-success alert-dismissible" role="alert" style='width:640px'>
                <strong>{{ Session::get('thongbao') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
        @endif
        <div id='show_comment'>
            @include('ShowComment')
        </div>  
    
</div>

@endsection
@section('myscript') 
<!-- <script type="text/javascript" src="{{ asset('js/ajax_comment.js') }}"></script> -->
@endsection