@extends('layouts.app')

@section('content')
    <div class='container'>
        <form action="{{ route('upload')}}" method='post' enctype='multipart/form-data'>
            @csrf
            <input type="file" name='video_name'>
            <input class='btn btn-danger' type="submit" name='uploadClick' value='Upload'>
        </form><br>

        @if($errors->any())
            <ul>
                @foreach ($errors ->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        @if ( Session::has('noVideo'))
            <p><strong>{{ Session::get('success') }}</strong></p>
        @endif
            <hr>
            @foreach ($data3->video as $value)

                <video width='320' controls>
                    <source src="/upload/video/{{$value->video_name}}" type='video/mp4'>
                    <source src="/upload/video/{{$value->video_name}}" type='video/ogg'>
                    <source src="/upload/video/{{$value->video_name}}" type='video/webm'>
                </video><br>
                <div style='width:320px;padding-bottom:15px'>
                    <a href="{{ route('watch', $value->id )}}"><b>{{$value->video_name}}</b></a>
                </div><br>
            @endforeach
    </div>
@endsection
