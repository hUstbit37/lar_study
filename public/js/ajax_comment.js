$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// function show_button() {
//     document.getElementById("a").hide() = true;
// }

var page = 0;
$(document).ready(function () {

    $(".f_load").on('click', 'button', function (e) {
        e.preventDefault();
        var id = $(this).parent().attr('id');
        $('#load_more-' + id).hide();
        page = page + 1;

        $.ajax({
            url: "commentPagination/" + id,
            data: { page: page }

        }).done(function (data) {
            $('#comment_area-' + id).append(data.html);
            if (data.cmt.length == 5) {
                $('#load_more-' + id).show();
            } else {
                $('#load_more-' + id).hide();
                $('.nocomment' + id).append('No more comments');
            }

        }).fail(function () {
            alert('Fail');
        });
    });

    //Input comment
    $(".form_comment").submit(function (event) {
        event.preventDefault();
        var id = $(this).attr('idForm');

        $.ajax({
            url: 'comment/' + id,
            type: "POST",
            data: $(this).serialize(),
        }).done(function (data) {
            // console.log(data);
            if (data.html) {
                $(".form_comment").trigger('reset');
                $('#comment_area-' + id).prepend(data.html);
                $('#message-' + id).html(data.message);
            }
        }).fail(function (data) {
            alert('Comment could not be loaded.');
        });
    });
});