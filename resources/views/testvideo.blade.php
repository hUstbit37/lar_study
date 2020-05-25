@extends('layouts.app')

@section('content')
<style>
    .edit{
        color: red;
    }
</style>

<div class='container'>
    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert" style='width:640px'>
            <strong>{{ Session::get('success') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <?php //Hiển thị thông báo lỗi?>
    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible style='width:640px" role="alert">
            <strong>{{ Session::get('error') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                <span class="sr-only">Close</span>
            </button>
        </div>
    @endif
    <!-- <form action="" method='post' enctype='multipart/form-data'>
        @csrf
        <input type="file" name='video_name'>
        <input class='btn btn-danger' type="submit" name='uploadClick' value='Upload'>
    </form>
     -->    
            
                <video width='640' controls>
                    <source src="./upload/video/{{$s}}" type='video/mp4'>
                    <source src="./upload/video/{{$s}}" type='video/ogg'>
                    <source src="./upload/video/{{$s}}" type='video/webm'>
                </video>
                <p><b>Video: {{$s}}</b></p>
                <div class='edit'>
                    <p><strong>Đây là nơi để sửa thông tin video trước khi lưu</strong></p>
                </div>
        
</div>

@endsection