<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax-Comment-Input Form</title>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div class='container'>
        <h1>My</h1>
        <div>
            <video width='640' controls>
                <source src="/upload/video/dungnoitoidien" type='video/mp4'>
            </video><br>
            <p><strong>Đừng nói tôi điên- Hiền Hồ</strong></p>
            <form action="{{ route('add')}}" class='form-horizontal' id='form_input' method='POST'>
                @csrf
                <label for="comment" style='font-weight:bold'>Comment hear</label><br>
                <textarea name="comment" id="comment" placeholder="Write comment.." style="width:640px"></textarea><br>
                <button type="submit" class='btn btn-primary ajax-click'>Gửi</button>
            </form><br>
            <div id='show-comment'>
                @include('TestAjax_ShowCmt')
            </div>
        </div><br>
            
        
    </div>     
    
    <!-- <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }               
        });
        $(document).ready(function()
            {
                $(document).on('click', '.pagination a',function(event)
                    {
                        event.preventDefault();
                        var page=$(this).attr('href').split('page=')[1];
                        getData(page);
                    });
                });
                function getData(page)
                {
                    $.ajax(
                    {
                        url: "/ajax2?page="+page,
                        success:function(data)
                        {
                            $('#show-comment').html(data);
                        }
                    });
                }
        $('.ajax-click').click(function(event){
            event.preventDefault();
            let URL = $(this).parents('form').attr('action');
            $.ajax({
                url: URL,
                type: "POST",
                data: $('#form_input').serialize(),
            }).done(function( results){
                 $('#show-comment').load(' #show-comment >*');
                 
            });
        });        
    </script>     -->
    <script type="text/javascript" src="{{ asset('js/ajax_comment_test.js') }}"></script>
</body>
</html>