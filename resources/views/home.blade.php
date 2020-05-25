@extends('layouts.app')

@section('styles')

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/jquery3.4.1.min.js') }}"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->

@endsection

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-8">
            <div style='width:640px'>

            @if(count($data2->video)>0)
                @foreach ($data2->video as $value)

                    <strong style='font-size:20px'>{{$value->video_name}}</strong><br>
                    <video width='640' controls>
                        <source src="/upload/video/{{$value->video_name}}" type='video/mp4'>
                        <source src="/upload/video/{{$value->video_name}}" type='video/ogg'>
                        <source src="/upload/video/{{$value->video_name}}" type='video/webm'>
                    </video><br>
                    <div id='cmt_count{{$value->id}}'></div>
                    <div>
                         <form action="{{route('postcomment', $value->id)}}" method='POST' class='form-horizontal form_comment' idForm='{{$value->id}}'>
                            @csrf
                            <input type="hidden" value='{{$value->id}}' name='id'>
                            <label for="comment_area" style='font-weight:bold'>Comment hear...</label><br>
                            <textarea name="comment" id="comment_area" placeholder="Write comment.." style="width:640px"></textarea><br>
                            <div style='text-align: right' id='a'>

                                <button type='submit' idButton='{{$value->id}}' class='btn btn-primary comment_submit_ajax' style="color:red">Comment</button>
                            </div>
                        </form>
                    </div><br>

                    <!-- <div id='message-{{$value->id}}' class='alert-primary' style='width:640px; font-size:18px' > </div> -->
                    @php
                        $cmt=App\QlVideo::find($value->id)->comment()->orderBy('created_at', 'desc')->skip(0)->take(0)->get();

                    @endphp

                    <div class="comment_area" id='comment_area-{{$value->id}}' id_div='{{$value->id}}'>
                        @include('ShowCommentList')
                    </div>
                    <div class='nocomment{{$value->id}} text-center'></div>
                    <div class='f_load' id='{{$value->id}}' style='padding:10px 0 30px 0'>
                        <button id='load_more-{{$value->id}}' class='btn btn-outline-primary btn-block '>Load comment</button>
                    </div>

                @endforeach
                @else <p class='text-center' style='font-size:25px; font-weight:bold'>Bạn chưa có video nào!!!</p>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('myscript')
    <script type="text/javascript" src="{{ asset('js/ajax_comment.js') }}"></script>
@endsection
