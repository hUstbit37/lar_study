<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($data2 ->video as $value)
        <a href="testwatch/{{$value->id}}">{{$value->video_name}}</a><br><br>
        @foreach($value->comment as $val)
            <p>{{$val->comment_content}}</p>
        @endforeach
    @endforeach
</body>
</html>